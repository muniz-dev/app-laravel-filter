<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * SearchLog Model
 * 
 * @property int $id
 * @property string|null $search_term
 * @property array|null $filters
 * @property int $results_count
 * @property string|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class SearchLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'search_term',
        'filters',
        'results_count',
        'user_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'filters' => 'array',
        'results_count' => 'integer',
    ];
}
