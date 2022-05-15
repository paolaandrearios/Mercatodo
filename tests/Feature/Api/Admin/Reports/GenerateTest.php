<?php

namespace Tests\Feature\Api\Admin\Reports;

use App\Jobs\ExportProductsJob;
use App\Jobs\ReportsJob;
use App\Models\Order;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductVisitsPerDaySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Queue;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class GenerateTest extends TestCase
{
    use UserApiFaker;
    use RequestFaker;
    use RefreshDatabase;

    protected $endPoint = '/api/admin/reports';

    public function test_reports_generate_to_file_and_job()
    {
        Queue::fake();

        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
        $this->seed(OrderSeeder::class);
        $this->seed(ProductVisitsPerDaySeeder::class);


        $data = [
            'report-option' => 'most_visited',
            'initial-date' => '2022-04-01',
            'end-date' => '2022-05-20',
            'locale' => 'en'
        ];

        $response = $this->get($this->endPoint .'?'. Arr::query($data), $this->headers);


        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertJsonFragment(['message' => __('general.api.data_management.report_status')]);

        $this->assertTrue($response->json()['quantity'] > 0);

        Queue::assertPushed(ReportsJob::class);

    }

}
