<?php

namespace App\Console\Commands;

use App\Actions\Payment\UpdatePaymentStatusAction;
use App\Models\Payment;
use Illuminate\Console\Command;

class WebCheckoutCheckOrderStatusCommand extends Command
{

    private UpdatePaymentStatusAction $updatePaymentStatusAction;

    protected $signature = 'webcheckout:checkorderstatus';

    protected $description = 'Command to check payment order status directly in WebCheckout';

    public function __construct(UpdatePaymentStatusAction $updatePaymentStatusAction)
    {
        parent::__construct();
        $this->updatePaymentStatusAction = $updatePaymentStatusAction;
    }

    public function handle(): int
    {
        $pendingPayments = Payment::query()->with('order')->where('status', 'pending')->get();
        foreach ($pendingPayments as $pendingPayment){
            $this->updatePaymentStatusAction->execute($pendingPayment);
        }
        return 0;
    }
}
