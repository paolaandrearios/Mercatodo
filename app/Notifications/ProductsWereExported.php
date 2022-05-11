<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductsWereExported extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return  (new MailMessage)->markdown('vendor.notifications.productsExportedNotification', [
            'actionUrl' => 'file:///C:/xampp/htdocs/evertec/mercatodo/storage/app/public/exported-products/',
            'importFile' => $this->importFile,
            'actionText' => __('general.web.data_management.download_file')

        ])->subject(__('general.web.data_management.success_mail_exported_products', ['fileName'=> $this->importFile]));
    }

}
