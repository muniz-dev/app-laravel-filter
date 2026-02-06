<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SearchLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Search Log Controller
 * 
 * Handles viewing search logs
 */
class SearchLogController extends Controller
{
    /**
     * Display a listing of search logs.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = SearchLog::query()->orderBy('created_at', 'desc');

        // Filter by search term
        if ($request->has('search_term') && !empty($request->search_term)) {
            $query->where('search_term', 'like', '%' . $request->search_term . '%');
        }

        // Filter by date range
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by results count
        if ($request->has('min_results') && !empty($request->min_results)) {
            $query->where('results_count', '>=', $request->min_results);
        }

        $logs = $query->paginate(50);

        // Statistics
        $totalSearches = SearchLog::count();
        $avgResultsCount = SearchLog::avg('results_count');
        $mostSearchedTerm = SearchLog::whereNotNull('search_term')
            ->selectRaw('search_term, COUNT(*) as count')
            ->groupBy('search_term')
            ->orderBy('count', 'desc')
            ->first();

        return view('admin.search-logs.index', [
            'logs' => $logs,
            'totalSearches' => $totalSearches,
            'avgResultsCount' => round($avgResultsCount ?? 0, 2),
            'mostSearchedTerm' => $mostSearchedTerm,
        ]);
    }
}
