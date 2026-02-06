<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Activity Log Controller
 * 
 * Handles viewing activity logs
 */
class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = ActivityLog::query()->orderBy('created_at', 'desc');

        // Filter by action
        if ($request->has('action') && !empty($request->action)) {
            $query->where('action', $request->action);
        }

        // Filter by model type
        if ($request->has('model_type') && !empty($request->model_type)) {
            $query->where('model_type', $request->model_type);
        }

        // Filter by date range
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->paginate(50);

        return view('admin.activity-logs.index', [
            'logs' => $logs,
            'actions' => ['created', 'updated', 'deleted'],
            'modelTypes' => ActivityLog::distinct()->pluck('model_type')->toArray(),
        ]);
    }
}
