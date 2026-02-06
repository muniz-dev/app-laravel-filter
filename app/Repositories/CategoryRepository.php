<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * Category Repository
 * 
 * Handles all database operations for categories
 */
class CategoryRepository
{
    /**
     * Get all categories.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Category::orderBy('name')->get();
    }

    /**
     * Get category by ID.
     *
     * @param int $id
     * @return Category|null
     */
    public function findById(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Get categories with product count.
     *
     * @return Collection
     */
    public function getAllWithProductCount(): Collection
    {
        return Category::withCount('products')
            ->orderBy('name')
            ->get();
    }
}
