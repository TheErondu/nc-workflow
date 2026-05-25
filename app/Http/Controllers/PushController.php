<?php

namespace App\Http\Controllers;

use App\Models\PushSubscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

class PushController extends Controller
{
    private function getWebPush(): WebPush
    {
        return new WebPush([
            'VAPID' => [
                'subject'    => config('app.url'),
                'publicKey'  => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ],
        ]);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'endpoint'   => 'required|string',
            'public_key' => 'nullable|string',
            'auth_token' => 'nullable|string',
        ]);

        PushSubscription::updateOrCreate(
            ['user_id' => Auth::id(), 'endpoint' => $request->endpoint],
            ['public_key' => $request->public_key, 'auth_token' => $request->auth_token]
        );

        return response()->json(['success' => true]);
    }

    public function unsubscribe(Request $request)
    {
        $request->validate(['endpoint' => 'required|string']);

        PushSubscription::where('user_id', Auth::id())
            ->where('endpoint', $request->endpoint)
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Send a push notification to one or more users.
     * $userIds: array of user IDs, or null to broadcast to all subscribed users.
     */
    public static function sendToUsers(array $userIds = null, string $title, string $body, string $url = '/')
    {
        $query = PushSubscription::with('user');
        if ($userIds !== null) {
            $query->whereIn('user_id', $userIds);
        }
        $subscriptions = $query->get();

        if ($subscriptions->isEmpty()) {
            return;
        }

        $webPush = new WebPush([
            'VAPID' => [
                'subject'    => config('app.url'),
                'publicKey'  => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ],
        ]);

        $payload = json_encode(['title' => $title, 'body' => $body, 'url' => $url]);

        foreach ($subscriptions as $sub) {
            $webPush->queueNotification(
                Subscription::create([
                    'endpoint'        => $sub->endpoint,
                    'publicKey'       => $sub->public_key,
                    'authToken'       => $sub->auth_token,
                    'contentEncoding' => 'aesgcm',
                ]),
                $payload
            );
        }

        foreach ($webPush->flush() as $report) {
            if ($report->isSubscriptionExpired()) {
                PushSubscription::where('endpoint', $report->getRequest()->getUri()->__toString())->delete();
            }
        }
    }
}
