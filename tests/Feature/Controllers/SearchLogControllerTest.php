<?php

namespace Tests\Feature\Controllers;

use App\Models\SearchLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchLogControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_display_search_logs()
    {
        SearchLog::factory()->create([
            'search_term' => 'teste',
            'results_count' => 5
        ]);

        $response = $this->get(route('admin.search-logs.index'));

        $response->assertStatus(200)
            ->assertSee('Logs de Pesquisa');
    }

    #[Test]
    public function it_can_filter_search_logs_by_search_term()
    {
        SearchLog::factory()->create(['search_term' => 'teste']);
        SearchLog::factory()->create(['search_term' => 'outro']);

        $response = $this->get(route('admin.search-logs.index', ['search_term' => 'teste']));

        $response->assertStatus(200);
    }

    #[Test]
    public function it_displays_statistics()
    {
        SearchLog::factory()->count(10)->create(['results_count' => 5]);

        $response = $this->get(route('admin.search-logs.index'));

        $response->assertStatus(200)
            ->assertSee('Total de Pesquisas');
    }
}
