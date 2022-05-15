<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function get(string $initialDate, string $endDate, String $reportOption, int $quantity = 10): array
    {
        $products = Product::with('categories', 'images');

        $reports = '';

        if($reportOption === 'most_visited'){
            $reports = DB::select(DB::raw(
                "select pvpd.*, p.name_en, p.name_es, p.price, p.stock from products p,
                        (select sum(pvpd.count) quantity, pvpd.product_id from product_visits_per_days pvpd
                        where pvpd.date BETWEEN '{$initialDate}' and '{$endDate}'
                        group by pvpd.product_id
                        order by quantity desc
                        limit {$quantity}) pvpd
                        where p.id = pvpd.product_id"));
        }

        if($reportOption === 'less_visited'){
            $reports = DB::select(DB::raw(
                "select pvpd.*, p.name_en, p.name_es, p.price, p.stock from products p,
                        (select sum(pvpd.count) quantity, pvpd.product_id from product_visits_per_days pvpd
                        where pvpd.date BETWEEN '{$initialDate}' and '{$endDate}'
                        group by pvpd.product_id
                        order by quantity asc
                        limit {$quantity}) pvpd
                        where p.id = pvpd.product_id"));

        }

        if($reportOption === 'best_selling_products'){
            $reports = DB::select(DB::raw(
                "select  count(od.quantity) quantity, od.product_id, p.name_es, p.name_en, p.price, p.stock
                        from orders o, order_details od, products p
                        where
                        p.id = od.product_id
                        and od.order_id = o.id
                        and o.updated_at BETWEEN '{$initialDate}' and '{$endDate}'
                        and o.status = 'approved'
                        group by od.product_id, p.name_es, p.name_en, p.price, p.stock
                        order by quantity desc
                        limit {$quantity}"));
        }

        if($reportOption === 'least_sold_products'){
            $reports = DB::select(DB::raw(
                "select  count(od.quantity) quantity, od.product_id, p.name_es, p.name_en, p.price, p.stock
                        from orders o, order_details od, products p
                        where
                        p.id = od.product_id
                        and od.order_id = o.id
                        and o.updated_at BETWEEN '{$initialDate}' and '{$endDate}'
                        and o.status = 'approved'
                        group by od.product_id, p.name_es, p.name_en, p.price, p.stock
                        order by quantity asc
                        limit {$quantity}"));

        }

        if($reportOption === 'abandoned_carts'){

            $reports = Order::query()->where('status', '=','rejected')
                                    ->whereDate('created_at', '>=', $initialDate)
                                    ->whereDate('created_at', '<=', $endDate)
                                    ->get(['id','reference','first_name', 'last_name', 'email', 'phone', 'total', 'created_at', 'updated_at'])->toArray();

        }

        if($reportOption === 'best_selling_category'){
            $reports = DB::select(DB::raw(
                "select  count(od.quantity) quantity, c.id, c.name_es, c.name_en
                        from orders o, order_details od, category_product cp, categories c
                        where
                        c.id = cp.category_id
                        and cp.product_id = od.product_id
                        and od.order_id = o.id
                        and o.updated_at BETWEEN '{$initialDate}' and '{$endDate}'
                        and o.status = 'approved'
                        group by c.id, c.name_es, c.name_en
                        order by quantity desc"));
        }

        return $reports;
    }
}
