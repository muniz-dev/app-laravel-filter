<?php

namespace App\Livewire;

use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Services\AuditService;
use App\Services\ProductFilterService;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Product Filter Component
 * 
 * Handles product filtering with URL persistence
 */
class ProductFilter extends Component
{
    use WithPagination;

    public string $name = '';
    public array $selectedCategories = [];
    public array $selectedBrands = [];

    /**
     * Updated selected categories - ensure they are integers.
     */
    public function updatedSelectedCategories($value): void
    {
        // Ensure all values are integers
        $this->selectedCategories = array_map('intval', $this->selectedCategories);
        // Remove empty values and reindex
        $this->selectedCategories = array_values(array_filter($this->selectedCategories, fn($v) => $v > 0));
        $this->resetPage();
        $this->logSearch();
    }

    /**
     * Updated selected brands - ensure they are integers.
     */
    public function updatedSelectedBrands($value): void
    {
        // Ensure all values are integers
        $this->selectedBrands = array_map('intval', $this->selectedBrands);
        // Remove empty values and reindex
        $this->selectedBrands = array_values(array_filter($this->selectedBrands, fn($v) => $v > 0));
        $this->resetPage();
        $this->logSearch();
    }

    protected $queryString = [
        'name' => ['except' => ''],
        'selectedCategories' => ['except' => []],
        'selectedBrands' => ['except' => []],
    ];

    /**
     * Create a new component instance.
     */
    public function mount(): void
    {
        // Sync with URL query parameters
        $this->syncWithUrl();
    }

    /**
     * Sync component properties with URL query parameters.
     */
    protected function syncWithUrl(): void
    {
        $query = request()->query();

        if (isset($query['name'])) {
            $this->name = $query['name'];
        }

        if (isset($query['selectedCategories'])) {
            $this->selectedCategories = is_array($query['selectedCategories'])
                ? $query['selectedCategories']
                : explode(',', $query['selectedCategories']);
            $this->selectedCategories = array_values(array_filter(array_map('intval', $this->selectedCategories)));
        }

        if (isset($query['selectedBrands'])) {
            $this->selectedBrands = is_array($query['selectedBrands'])
                ? $query['selectedBrands']
                : explode(',', $query['selectedBrands']);
            $this->selectedBrands = array_values(array_filter(array_map('intval', $this->selectedBrands)));
        }
    }

    /**
     * Update URL when name filter changes.
     */
    public function updatedName($value): void
    {
        $this->resetPage();
        $this->logSearch();
    }

    /**
     * Log the current search.
     */
    protected function logSearch(): void
    {
        try {
            $filters = $this->getFilters();
            
            // Only log if there's at least one filter active
            if (!empty($filters['name']) || !empty($filters['categories']) || !empty($filters['brands'])) {
                $filterService = app(ProductFilterService::class);
                $auditService = app(AuditService::class);
                
                $resultsCount = $filterService->countFiltered($filters);
                $auditService->logSearch($filters, $resultsCount);
            }
        } catch (\Exception $e) {
            // Silently fail - don't break the UI if logging fails
            \Log::error('Failed to log search: ' . $e->getMessage());
        }
    }

    /**
     * Apply filters and log search.
     */
    public function filter(ProductFilterService $filterService, AuditService $auditService): void
    {
        $this->resetPage();
        $this->updateUrl();
        $this->logSearch();
    }

    /**
     * Clear all filters.
     */
    public function clearFilters(): void
    {
        $this->name = '';
        $this->selectedCategories = [];
        $this->selectedBrands = [];
        $this->resetPage();
        $this->updateUrl();
    }

    /**
     * Get current filters as array.
     */
    protected function getFilters(): array
    {
        return [
            'name' => $this->name,
            'categories' => $this->selectedCategories,
            'brands' => $this->selectedBrands,
        ];
    }

    /**
     * Update URL with current filters.
     * Livewire's queryString property handles this automatically.
     */
    protected function updateUrl(): void
    {
        // Livewire automatically updates the URL based on queryString property
    }

    /**
     * Render the component.
     */
    public function render(
        ProductFilterService $filterService,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository
    ) {
        $filters = $this->getFilters();
        $products = $filterService->filterProducts($filters, 15);

        return view('livewire.product-filter', [
            'products' => $products,
            'categories' => $categoryRepository->getAll(),
            'brands' => $brandRepository->getAll(),
        ])
            ->layout('layouts.app');
    }
}
