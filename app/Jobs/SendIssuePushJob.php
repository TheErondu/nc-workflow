<?php

namespace App\Jobs;

use App\Http\Controllers\PushController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SendIssuePushJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public int $tries = 1;

    public function __construct(
        private array  $userIds,
        private string $title,
        private string $body,
        private string $url
    ) {}

    public function handle(): void
    {
        try {
            PushController::sendToUsers($this->userIds, $this->title, $this->body, $this->url);
        } catch (\Throwable $e) {
            \Log::warning('Push job failed: ' . $e->getMessage());
        }
    }
}
