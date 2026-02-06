<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\SearchLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Audit Service
 * 
 * Handles logging of activities and searches
 */
class AuditService
{
    /**
     * Log an activity (create, update, delete).
     *
     * @param string $action
     * @param Model $model
     * @param array|null $oldValues
     * @param array|null $newValues
     * @param string|null $description
     * @return ActivityLog
     */
    public function logActivity(
        string $action,
        Model $model,
        ?array $oldValues = null,
        ?array $newValues = null,
        ?string $description = null
    ): ActivityLog {
        return ActivityLog::create([
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'action' => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'description' => $description ?? $this->generateDescription($action, $model),
        ]);
    }

    /**
     * Log a search/filter operation.
     *
     * @param array $filters
     * @param int $resultsCount
     * @param Request|null $request
     * @return SearchLog
     */
    public function logSearch(array $filters, int $resultsCount, ?Request $request = null): SearchLog
    {
        $request = $request ?? request();

        return SearchLog::create([
            'search_term' => $filters['name'] ?? null,
            'filters' => $filters,
            'results_count' => $resultsCount,
            'user_id' => auth()->id(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);
    }

    /**
     * Generate a description for the activity log.
     *
     * @param string $action
     * @param Model $model
     * @return string
     */
    private function generateDescription(string $action, Model $model): string
    {
        $modelName = class_basename($model);
        
        return match ($action) {
            'created' => "{$modelName} #{$model->id} was created",
            'updated' => "{$modelName} #{$model->id} was updated",
            'deleted' => "{$modelName} #{$model->id} was deleted",
            default => "{$modelName} #{$model->id} action: {$action}",
        };
    }
}
