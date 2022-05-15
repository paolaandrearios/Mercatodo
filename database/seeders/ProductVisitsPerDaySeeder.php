<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVisitsPerDay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductVisitsPerDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $products = Product::all();
       $dates = $this->getBetweenDates('2022-04-01', date('Y-m-d'));
       foreach ($products as $product) {
            foreach ($dates as $date) {
                ProductVisitsPerDay::factory(1)->create(['product_id' => $product->id, 'date' => $date]);
            }
       }
    }

    function getBetweenDates($startDate, $endDate)
    {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for ($currentDate = $startDate; $currentDate <= $endDate;
             $currentDate += (86400)) {

            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }

        return $rangArray;
    }
}
