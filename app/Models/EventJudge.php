<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class EventJudge extends Model
{
    use HasUuids;

    protected $table = 'event_judges';

    protected $fillable = [
        'event_id',
        'judge_id',
        'status',
        'assigned_at',
        'assigned_by',
        'notes',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    /**
     * Relación con el evento
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Relación con el juez (usuario)
     */
    public function judge()
    {
        return $this->belongsTo(User::class, 'judge_id');
    }

    /**
     * Relación con quien asignó al juez
     */
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    /**
     * Scope para jueces activos
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
