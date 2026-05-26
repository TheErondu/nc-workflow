<?php

namespace App\Notifications;

use App\Models\Issue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class IssueRaisedAdminNotification extends Notification
{
    public Issue $issue;

    public function __construct(Issue $issue)
    {
        $this->issue = $issue;
    }

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable): array
    {
        return [
            'ring'       => 'raised',
            'issue_id'   => $this->issue->id,
            'item_name'  => $this->issue->item_name,
            'raised_by'  => $this->issue->raised_by,
            'department' => $this->issue->department,
            'location'   => $this->issue->location,
            'link'       => route('issues.edit', $this->issue->id),
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        $msg = (new MailMessage)
            ->subject('[NCWorkflow] New Issue: ' . $this->issue->item_name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A new tech issue has been raised and needs attention.')
            ->line('**Item:** ' . $this->issue->item_name)
            ->line('**Raised by:** ' . $this->issue->raised_by)
            ->line('**Department:** ' . ($this->issue->department ?: 'N/A'))
            ->line('**Location:** ' . ($this->issue->location ?: 'N/A'));

        if ($this->issue->description) {
            $msg->line('**Description:** ' . $this->issue->description);
        }

        return $msg
            ->action('View & Assign Issue', route('issues.edit', $this->issue->id))
            ->salutation('NC Workflow');
    }
}
