<?php

namespace Tests\Unit\Services;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\Product;
use App\Models\SearchLog;
use App\Services\AuditService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuditServiceTest extends TestCase
{
    use RefreshDatabase;

    protected AuditService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new AuditService();
    }

    #[Test]
    public function it_can_log_activity()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $log = $this->service->logActivity('created', $product);

        $this->assertInstanceOf(ActivityLog::class, $log);
        $this->assertEquals('created', $log->action);
        $this->assertEquals(Product::class, $log->model_type);
        $this->assertEquals($product->id, $log->model_id);
    }

    #[Test]
    public function it_can_log_search()
    {
        $filters = [
            'name' => 'teste',
            'categories' => [1, 2],
            'brands' => [1]
        ];

        $log = $this->service->logSearch($filters, 10);

        $this->assertInstanceOf(SearchLog::class, $log);
        $this->assertEquals('teste', $log->search_term);
        $this->assertEquals($filters, $log->filters);
        $this->assertEquals(10, $log->results_count);
    }

    #[Test]
    public function it_generates_description_for_created_action()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $log = $this->service->logActivity('created', $product);

        $this->assertStringContainsString('Product', $log->description);
        $this->assertStringContainsString('created', $log->description);
    }

    #[Test]
    public function it_generates_description_for_updated_action()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $log = $this->service->logActivity('updated', $product);

        $this->assertStringContainsString('Product', $log->description);
        $this->assertStringContainsString('updated', $log->description);
    }

    #[Test]
    public function it_generates_description_for_deleted_action()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $log = $this->service->logActivity('deleted', $product);

        $this->assertStringContainsString('Product', $log->description);
        $this->assertStringContainsString('deleted', $log->description);
    }
}
