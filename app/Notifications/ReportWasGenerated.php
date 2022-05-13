<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportWasGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $filePath = 'http://localhost/evertec/mercatodo/public/storage/reports/'.$this->fileName;

        return  (new MailMessage)->markdown('vendor.notifications.reportWasGeneratedNotification', [
            'actionUrl' => $filePath,
            'reportFile' => $this->fileName,
            'actionText' => __('general.web.data_management.download_file')

        ])->subject(__('general.web.data_management.success_mail_report_generated', ['fileName'=> $this->fileName]));
    }

}
