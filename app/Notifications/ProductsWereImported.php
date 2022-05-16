<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductsWereImported extends Notification
{
    use Queueable;

    protected string $importFile;

    public function __construct(string $importFile)
    {
        $this->importFile = $importFile;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return  (new MailMessage)->markdown('vendor.notifications.productsImportedNotification', [
            'actionUrl' => 'http://localhost/evertec/mercatodo/public/',
            'importFile' => $this->importFile,
            'actionText' => __('general.web.data_management.go_store'),

        ])->subject(__('general.web.data_management.success_mail_products', ['fileName'=> $this->importFile]));
    }
}
