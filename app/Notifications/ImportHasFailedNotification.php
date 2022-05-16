<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportHasFailedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected array $error;
    protected string $importFile;

    public function __construct(array $error, string $importFile)
    {
        $this->error = $error;
        $this->importFile = $importFile;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return  (new MailMessage)->markdown('vendor.notifications.failednotification', [
             'errors' => $this->error,
             'actionUrl' => 'http://localhost/evertec/mercatodo/public/',
             'importFile' => $this->importFile,
             'actionText' => __('general.web.data_management.go_store'),

         ])->subject(__('general.web.data_management.error_mail_products', ['fileName'=> $this->importFile]));
    }
}
