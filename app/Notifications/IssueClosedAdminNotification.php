<?php

namespace App\Notifications;

use App\Models\Issue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IssueClosedAdminNotification extends Notification
{
    public function __construct(public Issue $issue, private bool $mailOnly = false)
    {}

    public function via($notifiable): array
    {
        return $this->mailOnly ? ['mail'] : ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'ring'       => 'closed',
            'issue_id'   => $this->issue->id,
            'item_name'  => $this->issue->item_name,
            'fixed_by'   => $this->issue->fixed_by,
            'department' => $this->issue->department,
            'link'       => route('issues.edit', $this->issue->id),
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        $msg = (new MailMessage)
            ->subject('[NCWorkflow] Issue Resolved: ' . $this->issue->item_name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A tech issue has been marked as **closed**.')
            ->line('**Item:** ' . $this->issue->item_name)
            ->line('**Department:** ' . ($this->issue->department ?: 'N/A'));

        if ($this->issue->fixed_by) {
            $msg->line('**Fixed by:** ' . $this->issue->fixed_by);
        }
        if ($this->issue->action_taken) {
            $msg->line('**Action taken:** ' . $this->issue->action_taken);
        }

        return $msg
            ->action('View Closed Issue', route('issues.edit', $this->issue->id))
            ->salutation('NC Workflow');
    }
}
