<?php

namespace Tests\Feature\Api\Admin\Import\Product;

use App\Jobs\ImportProductsJob;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\Feature\Common\RequestFaker;
use Tests\Feature\Common\User\UserApiFaker;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use UserApiFaker;
    use RequestFaker;
    use RefreshDatabase;

    protected $endPoint = '/api/admin/import/products';

    public function test_product_export_to_file_and_job()
    {
        Queue::fake();

        Category::factory(1)->create(['status' => 'active', 'id' => 1])->first();

        $file = new UploadedFile(resource_path('test-files/products-import.xlsx'), 'products-import.xlsx', null, null, true);
        $response = $this->post($this->endPoint, [
            'products' => $file,
        ], $this->headers);

        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertJsonFragment(['message' => __('general.api.data_management.import_status')]);

        Queue::assertPushed(ImportProductsJob::class, function ($job) use ($response) {
            return $job->getImportFilePath() === 'imported-products/' . $response->json()['file_name'];
        });

        $job = new ImportProductsJob($this->userConfig['user'], 'imported-products/' . $response->json()['file_name'], $this->headers['locale']);
        $job->handle();

        $products = Product::all();
        $this->assertCount(2, $products);
    }

    public function test_product_import_from_file_and_job_validation_errors()
    {
        Queue::fake();
        Notification::fake();
        Mail::fake();

        Category::factory(1)->create(['status' => 'active', 'id' => 1])->first();

        $file = new UploadedFile(resource_path('test-files/products-import-invalid.xlsx'), 'products-import-invalid.xlsx', null, null, true);
        $response = $this->post($this->endPoint, [
            'products' => $file,
        ], $this->headers);

        $response->assertStatus(200);
        $response->assertSessionHasNoErrors();
        $response->assertJsonFragment(['message' => __('general.api.data_management.import_status')]);

        Queue::assertPushed(ImportProductsJob::class, function ($job) use ($response) {
            return $job->getImportFilePath() === 'imported-products/' . $response->json()['file_name'];
        });

        $job = new ImportProductsJob($this->userConfig['user'], 'imported-products/' . $response->json()['file_name'], $this->headers['locale']);

        $response = $job->handle();
        if ($response !== true) {
            $this->assertEquals(ValidationException::class, $response);
        } else {
            $this->assertTrue(false);
        }
    }
}
