<?php

namespace Tests\Feature\Controllers;

use App\Models\ActivityLog;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ActivityLogControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_display_activity_logs()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);
        
        ActivityLog::factory()->create([
            'model_type' => Product::class,
            'model_id' => $product->id,
            'action' => 'created'
        ]);

        $response = $this->get(route('admin.activity-logs.index'));

        $response->assertStatus(200)
            ->assertSee('Logs de Atividade');
    }

    #[Test]
    public function it_can_filter_activity_logs_by_action()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);
        
        ActivityLog::factory()->create([
            'model_type' => Product::class,
            'model_id' => $product->id,
            'action' => 'created'
        ]);
        
        ActivityLog::factory()->create([
            'model_type' => Product::class,
            'model_id' => $product->id,
            'action' => 'updated'
        ]);

        $response = $this->get(route('admin.activity-logs.index', ['action' => 'created']));

        $response->assertStatus(200);
    }

    #[Test]
    public function it_can_filter_activity_logs_by_model_type()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);
        
        ActivityLog::factory()->create([
            'model_type' => Product::class,
            'model_id' => $product->id,
            'action' => 'created'
        ]);

        $response = $this->get(route('admin.activity-logs.index', ['model_type' => Product::class]));

        $response->assertStatus(200);
    }
}
