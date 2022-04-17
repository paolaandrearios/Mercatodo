<?php

namespace App\Console\Commands;

use App\Actions\Payment\UpdatePaymentStatusAction;
use App\Jobs\WCCheckOrderStatusJob;
use Illuminate\Bus\Queueable;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use function Symfony\Component\String\u;

class WebCheckoutCheckOrderStatusCommand extends Command
{

    protected $signature = 'webcheckout:checkorderstatus';

    protected $description = 'Command to check payment order status directly in WebCheckout';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        dispatch(new WCCheckOrderStatusJob());
    }
}
