<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;

class ReportRepository
{
    public function get(string $initialDate, string $endDate, String $reportOption): array
    {
        $products = Product::with('categories', 'images');

        $reports = '';

        if($reportOption === 'most_visited'){

        }

        if($reportOption === 'best_selling_products'){

        }

        if($reportOption === 'least_sold_products'){

        }

        if($reportOption === 'abandoned_carts'){

            $reports = Order::query()->where('status', '=','rejected')
                                    ->whereDate('created_at', '>=', $initialDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get(['id','reference','first_name', 'last_name', 'email', 'phone', 'total', 'created_at', 'updated_at'])->toArray();

        }

        if($reportOption === 'best_selling_category'){

        }

        return $reports;
    }
}
