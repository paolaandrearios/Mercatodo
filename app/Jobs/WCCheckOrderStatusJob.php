<?php

namespace App\Jobs;

use App\Actions\Payment\UpdatePaymentStatusAction;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class WCCheckOrderStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function handle(UpdatePaymentStatusAction $updatePaymentStatusAction): int
    {
        $pendingPayments = Payment::query()->with('order')->where('status', 'pending')->get();
        foreach ($pendingPayments as $pendingPayment) {
            $updatePaymentStatusAction->execute($pendingPayment);
        }

        return 0;
    }
}
