<?php

namespace App\Repositories;

use App\Helpers\StringHelper;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

/**
 * Product Repository
 * 
 * Handles all database operations for products
 */
class ProductRepository
{
    /**
     * Get all products with filters applied.
     *
     * @param array $filters
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getFilteredProducts(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        $query = Product::with(['brand', 'categories'])
            ->where('is_active', true);

        // Filter by name (case-insensitive and accent-insensitive)
        if (!empty($filters['name'])) {
            $searchTerm = trim($filters['name']);
            $normalizedSearch = StringHelper::normalizeForSearch($searchTerm);
            
            // Use PostgreSQL ILIKE for case-insensitive search with accents
            // And TRANSLATE for accent-insensitive search
            $query->where(function ($q) use ($searchTerm, $normalizedSearch) {
                // Direct match (with accents) - case insensitive using ILIKE
                $q->where('name', 'ILIKE', '%' . $searchTerm . '%');
                
                // Normalized match (without accents) using TRANSLATE function
                // This allows searching "cafe" and finding "café" or vice versa
                $q->orWhereRaw(
                    "LOWER(TRANSLATE(name, 'ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖòóôõöÙÚÛÜùúûüÇçÑñÝýÿ', 'AAAAAAaaaaaaEEEEeeeeIIIIiiiiOOOOOoooooUUUUuuuuCcNnYyy')) LIKE ?",
                    ['%' . $normalizedSearch . '%']
                );
            });
        }

        // Filter by categories
        if (isset($filters['categories']) && is_array($filters['categories']) && count($filters['categories']) > 0) {
            $categoryIds = array_map('intval', $filters['categories']);
            $categoryIds = array_values(array_filter($categoryIds, fn($id) => $id > 0));
            
            if (count($categoryIds) > 0) {
                $query->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                });
            }
        }

        // Filter by brands
        if (isset($filters['brands']) && is_array($filters['brands']) && count($filters['brands']) > 0) {
            $brandIds = array_map('intval', $filters['brands']);
            $brandIds = array_values(array_filter($brandIds, fn($id) => $id > 0));
            
            if (count($brandIds) > 0) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        return $query->orderBy('name')->paginate($perPage);
    }

    /**
     * Get all active products.
     *
     * @return Collection
     */
    public function getAllActive(): Collection
    {
        return Product::with(['brand', 'categories'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    /**
     * Get product by ID.
     *
     * @param int $id
     * @return Product|null
     */
    public function findById(int $id): ?Product
    {
        return Product::with(['brand', 'categories'])->find($id);
    }

    /**
     * Count products matching filters.
     *
     * @param array $filters
     * @return int
     */
    public function countFiltered(array $filters = []): int
    {
        $query = Product::where('is_active', true);

        // Filter by name (case-insensitive and accent-insensitive)
        if (!empty($filters['name'])) {
            $searchTerm = trim($filters['name']);
            $normalizedSearch = StringHelper::normalizeForSearch($searchTerm);
            
            $query->where(function ($q) use ($searchTerm, $normalizedSearch) {
                // Direct match (with accents) - case insensitive using ILIKE
                $q->where('name', 'ILIKE', '%' . $searchTerm . '%');
                
                // Normalized match (without accents) using TRANSLATE function
                // This allows searching "cafe" and finding "café" or vice versa
                $q->orWhereRaw(
                    "LOWER(TRANSLATE(name, 'ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖòóôõöÙÚÛÜùúûüÇçÑñÝýÿ', 'AAAAAAaaaaaaEEEEeeeeIIIIiiiiOOOOOoooooUUUUuuuuCcNnYyy')) LIKE ?",
                    ['%' . $normalizedSearch . '%']
                );
            });
        }

        if (!empty($filters['categories']) && is_array($filters['categories'])) {
            $categoryIds = array_map('intval', $filters['categories']);
            $categoryIds = array_filter($categoryIds, fn($id) => $id > 0);
            
            if (!empty($categoryIds)) {
                $query->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('categories.id', $categoryIds);
                });
            }
        }

        if (!empty($filters['brands']) && is_array($filters['brands'])) {
            $brandIds = array_map('intval', $filters['brands']);
            $brandIds = array_filter($brandIds, fn($id) => $id > 0);
            
            if (!empty($brandIds)) {
                $query->whereIn('brand_id', $brandIds);
            }
        }

        return $query->count();
    }
}
