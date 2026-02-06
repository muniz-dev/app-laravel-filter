<?php

namespace Tests\Unit\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected ProductRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new ProductRepository();
    }

    #[Test]
    public function it_can_get_all_active_products()
    {
        $brand = Brand::factory()->create();
        $activeProduct = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        $inactiveProduct = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => false]);

        $products = $this->repository->getAllActive();

        $this->assertCount(1, $products);
        $this->assertTrue($products->contains($activeProduct));
        $this->assertFalse($products->contains($inactiveProduct));
    }

    #[Test]
    public function it_can_filter_products_by_name()
    {
        $brand = Brand::factory()->create();
        Product::factory()->create(['name' => 'Produto Teste', 'brand_id' => $brand->id, 'is_active' => true]);
        Product::factory()->create(['name' => 'Outro Produto', 'brand_id' => $brand->id, 'is_active' => true]);

        $filters = ['name' => 'Teste'];
        $products = $this->repository->getFilteredProducts($filters, 15);

        $this->assertCount(1, $products);
        $this->assertEquals('Produto Teste', $products->first()->name);
    }

    #[Test]
    public function it_can_filter_products_by_brand()
    {
        $brand1 = Brand::factory()->create(['name' => 'Marca A']);
        $brand2 = Brand::factory()->create(['name' => 'Marca B']);
        
        Product::factory()->create(['brand_id' => $brand1->id, 'is_active' => true]);
        Product::factory()->create(['brand_id' => $brand2->id, 'is_active' => true]);

        $filters = ['brands' => [$brand1->id]];
        $products = $this->repository->getFilteredProducts($filters, 15);

        $this->assertCount(1, $products);
        $this->assertEquals($brand1->id, $products->first()->brand_id);
    }

    #[Test]
    public function it_can_filter_products_by_category()
    {
        $brand = Brand::factory()->create();
        $category1 = Category::factory()->create(['name' => 'Categoria A']);
        $category2 = Category::factory()->create(['name' => 'Categoria B']);
        
        $product1 = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        $product2 = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        
        $product1->categories()->attach($category1->id);
        $product2->categories()->attach($category2->id);

        $filters = ['categories' => [$category1->id]];
        $products = $this->repository->getFilteredProducts($filters, 15);

        $this->assertCount(1, $products);
        $this->assertTrue($products->first()->categories->contains($category1));
    }

    #[Test]
    public function it_can_filter_products_by_multiple_categories()
    {
        $brand = Brand::factory()->create();
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $category3 = Category::factory()->create();
        
        $product1 = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        $product2 = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        $product3 = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => true]);
        
        $product1->categories()->attach([$category1->id, $category2->id]);
        $product2->categories()->attach($category2->id);
        $product3->categories()->attach($category3->id);

        $filters = ['categories' => [$category1->id, $category2->id]];
        $products = $this->repository->getFilteredProducts($filters, 15);

        $this->assertCount(2, $products);
    }

    #[Test]
    public function it_can_filter_products_by_multiple_filters()
    {
        $brand1 = Brand::factory()->create(['name' => 'Marca A']);
        $brand2 = Brand::factory()->create(['name' => 'Marca B']);
        $category = Category::factory()->create();
        
        $product1 = Product::factory()->create([
            'name' => 'Produto Teste',
            'brand_id' => $brand1->id,
            'is_active' => true
        ]);
        $product2 = Product::factory()->create([
            'name' => 'Outro Produto',
            'brand_id' => $brand2->id,
            'is_active' => true
        ]);
        
        $product1->categories()->attach($category->id);

        $filters = [
            'name' => 'Teste',
            'brands' => [$brand1->id],
            'categories' => [$category->id]
        ];
        $products = $this->repository->getFilteredProducts($filters, 15);

        $this->assertCount(1, $products);
        $this->assertEquals('Produto Teste', $products->first()->name);
    }

    #[Test]
    public function it_can_count_filtered_products()
    {
        $brand = Brand::factory()->create();
        Product::factory()->count(5)->create(['brand_id' => $brand->id, 'is_active' => true]);
        Product::factory()->count(3)->create(['brand_id' => $brand->id, 'is_active' => false]);

        $count = $this->repository->countFiltered([]);

        $this->assertEquals(5, $count);
    }

    #[Test]
    public function it_can_find_product_by_id()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $found = $this->repository->findById($product->id);

        $this->assertNotNull($found);
        $this->assertEquals($product->id, $found->id);
    }

    #[Test]
    public function it_returns_null_when_product_not_found()
    {
        $found = $this->repository->findById(999);

        $this->assertNull($found);
    }
}
