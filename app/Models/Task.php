<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    public const STATUSES = [
        'UNFINISHED' => 0,
        'FINISHED' => 1,
    ];
    public const PRIORITIES = [
        'LOW' => 0,
        'MEDIUM' => 1,
        'HIGH' => 2,
    ];
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'priority',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPriorityClassAttribute()
    {
        return match ($this->attributes['priority']) {
            1 => 'btn-warning',
            2 => 'btn-danger',
            default => 'btn-primary',
        };
    }

    public function getPriorityNameAttribute()
    {
        return match ($this->attributes['priority']) {
            0 => __('LOW'),
            1 => __('MEDIUM'),
            2 => __('HIGH'),
            default => ''
        };
    }
}
