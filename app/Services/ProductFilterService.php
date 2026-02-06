<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Product Filter Service
 * 
 * Handles product filtering logic
 */
class ProductFilterService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected ProductRepository $productRepository
    ) {
    }

    /**
     * Apply filters and get products.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function filterProducts(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->productRepository->getFilteredProducts($filters, $perPage);
    }

    /**
     * Count products matching filters.
     *
     * @param array $filters
     * @return int
     */
    public function countFiltered(array $filters = []): int
    {
        return $this->productRepository->countFiltered($filters);
    }
}
