<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Collection;

/**
 * Brand Repository
 * 
 * Handles all database operations for brands
 */
class BrandRepository
{
    /**
     * Get all brands.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Brand::orderBy('name')->get();
    }

    /**
     * Get brand by ID.
     *
     * @param int $id
     * @return Brand|null
     */
    public function findById(int $id): ?Brand
    {
        return Brand::find($id);
    }

    /**
     * Get brands with product count.
     *
     * @return Collection
     */
    public function getAllWithProductCount(): Collection
    {
        return Brand::withCount('products')
            ->orderBy('name')
            ->get();
    }
}
