<?php

namespace App\Jobs;

use App\Models\Issue;
use App\Models\User;
use App\Notifications\IssueRaisedAdminNotification;
use App\Notifications\IssueClosedAdminNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendIssueAdminEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1;

    public function __construct(
        private array  $adminIds,
        private Issue  $issue,
        private string $type  // 'raised' | 'closed'
    ) {}

    public function handle(): void
    {
        $admins = User::whereIn('id', $this->adminIds)->get();

        foreach ($admins as $admin) {
            try {
                $notification = $this->type === 'closed'
                    ? new IssueClosedAdminNotification($this->issue, mailOnly: true)
                    : new IssueRaisedAdminNotification($this->issue, mailOnly: true);

                $admin->notify($notification);
            } catch (\Throwable $e) {
                \Log::warning('Issue admin email failed for ' . $admin->email . ': ' . $e->getMessage());
            }
        }
    }
}
