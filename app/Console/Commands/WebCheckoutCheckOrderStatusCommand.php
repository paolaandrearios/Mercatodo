<?php

namespace App\Console\Commands;

use App\Jobs\WCCheckOrderStatusJob;
use Illuminate\Console\Command;

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
