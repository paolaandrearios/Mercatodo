<?php

namespace Tests\Feature\Api\Admin\Export\Product;

use App\Jobs\ExportProductsJob;
use App\Jobs\ImportProductsJob;
use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class ExportTest extends TestCase
{
    use UserApiFaker;
    use RequestFaker;
    use RefreshDatabase;

    protected $endPoint = '/api/admin/export/products';

    public function test_product_export_to_file_and_job()
    {
        Queue::fake();

        $this->seed(RoleSeeder::class);
        $this->seed(UserSeeder::class);
        $this->seed(CategorySeeder::class);

        $data = [
            'status' => '',
            'category' => '',
            'initial-date' => '2022-04-01',
            'end-date' => '2022-04-20',
            'locale' => 'en'
        ];

        $response = $this->get($this->endPoint .'?'. Arr::query($data), $this->headers);

        //dump($response);

        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertJsonFragment(['message' => __('general.api.data_management.export_status')]);

        Queue::assertPushed(ExportProductsJob::class);

    }


}
