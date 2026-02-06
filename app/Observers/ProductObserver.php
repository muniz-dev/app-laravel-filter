<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\AuditService;

/**
 * Product Observer
 * 
 * Observes Product model events and logs activities
 */
class ProductObserver
{
    /**
     * Create a new observer instance.
     */
    public function __construct(
        protected AuditService $auditService
    ) {
    }

    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->auditService->logActivity(
            'created',
            $product,
            null,
            $product->toArray()
        );
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->auditService->logActivity(
            'updated',
            $product,
            $product->getOriginal(),
            $product->getChanges()
        );
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->auditService->logActivity(
            'deleted',
            $product,
            $product->toArray(),
            null
        );
    }
}
