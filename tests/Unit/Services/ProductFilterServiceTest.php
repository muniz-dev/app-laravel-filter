<?php

namespace Tests\Unit\Services;

use App\Models\Brand;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductFilterService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductFilterServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ProductFilterService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProductFilterService(new ProductRepository());
    }

    #[Test]
    public function it_can_filter_products()
    {
        $brand = Brand::factory()->create();
        Product::factory()->count(3)->create(['brand_id' => $brand->id, 'is_active' => true]);

        $filters = [];
        $products = $this->service->filterProducts($filters, 15);

        $this->assertCount(3, $products);
    }

    #[Test]
    public function it_can_count_filtered_products()
    {
        $brand = Brand::factory()->create();
        Product::factory()->count(5)->create(['brand_id' => $brand->id, 'is_active' => true]);

        $filters = [];
        $count = $this->service->countFiltered($filters);

        $this->assertEquals(5, $count);
    }

    #[Test]
    public function it_respects_pagination()
    {
        $brand = Brand::factory()->create();
        Product::factory()->count(20)->create(['brand_id' => $brand->id, 'is_active' => true]);

        $filters = [];
        $products = $this->service->filterProducts($filters, 10);

        $this->assertCount(10, $products);
        $this->assertEquals(20, $products->total());
    }
}
