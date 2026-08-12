<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /** Return unread count + newest unread notifications (for polling). */
    public function unread()
    {
        $user         = Auth::user();
        $unread       = $user->unreadNotifications()->latest()->take(20)->get();
        $unreadCount  = $user->unreadNotifications()->count();

        return response()->json([
            'unread_count' => $unreadCount,
            'notifications' => $unread->map(function ($n) {
                return [
                    'id'         => $n->id,
                    'issue_id'   => $n->data['issue_id']  ?? null,
                    'ring'       => $n->data['ring']      ?? 'raised',
                    'item_name'  => $n->data['item_name'] ?? '',
                    'raised_by'  => $n->data['raised_by'] ?? '',
                    'fixed_by'   => $n->data['fixed_by']  ?? '',
                    'department' => $n->data['department'] ?? '',
                    'link'       => $n->data['link']       ?? route('issues.index'),
                    'created_at' => $n->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    /** Mark all notifications as read. */
    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['ok' => true]);
    }

    /** Mark a single notification as read by its UUID. */
    public function markOne($id)
    {
        $notification = Auth::user()->notifications()->where('id', $id)->first();
        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        return response()->json(['ok' => true]);
    }
}
