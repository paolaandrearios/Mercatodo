<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductsWereExported extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $fileName = (explode('/', $this->filePath))[2];

        $filePath = 'http://localhost/evertec/mercatodo/public/storage/exported-products/' . $fileName;

        return  (new MailMessage)->markdown('vendor.notifications.productsExportedNotification', [
            'actionUrl' => $filePath,
            'exportFile' => $fileName,
            'actionText' => __('general.web.data_management.download_file'),

        ])->subject(__('general.web.data_management.success_mail_exported_products', ['fileName'=> $fileName]));
    }
}
