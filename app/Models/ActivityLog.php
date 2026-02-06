<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ActivityLog Model
 * 
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $action
 * @property array|null $old_values
 * @property array|null $new_values
 * @property string|null $user_id
 * @property string|null $ip_address
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class ActivityLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'model_type',
        'model_id',
        'action',
        'old_values',
        'new_values',
        'user_id',
        'ip_address',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the model that the activity log belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }
}
