<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'team_id',
        'event_id',
        'advisor_id',
        'title',
        'description',
        'status',
        'repository_url',
        'demo_url',
        'presentation_url',
        'video_url',
        'documents',
        'final_score',
        'rank',
        'submission_file_path',
        'submission_file_name',
        'submitted_at',
        'evaluated_at',
    ];

    protected $casts = [
        'documents' => 'array',
        'final_score' => 'decimal:2',
        'rank' => 'integer',
        'submitted_at' => 'datetime',
        'evaluated_at' => 'datetime',
    ];

    // Relaciones
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    // Scopes
    public function scopeEvaluated($query)
    {
        return $query->where('status', 'evaluated');
    }

    public function scopeSubmitted($query)
    {
        return $query->where('status', 'submitted');
    }

    // Helpers
    public function isEvaluated()
    {
        return $this->status === 'evaluated';
    }

    public function isSubmitted()
    {
        return in_array($this->status, ['submitted', 'in_review', 'evaluated']);
    }
}
