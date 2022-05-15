<?php

namespace App\Jobs;

use App\Models\ProductVisitsPerDay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddVisitToProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $productId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $prodctId)
    {
        $this->productId = $prodctId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $productVisitPerDay = ProductVisitsPerDay::query()
            ->where('product_id', $this->productId)
            ->where('date', date('Y-m-d'))
            ->first();

        if($productVisitPerDay){
            $productVisitPerDay->count++;
            $productVisitPerDay->save();
        } else {
            $productVisitPerDay = new ProductVisitsPerDay();
            $productVisitPerDay->product_id = $this->productId;
            $productVisitPerDay->count = 1;
            $productVisitPerDay->save();

        }
    }
}
