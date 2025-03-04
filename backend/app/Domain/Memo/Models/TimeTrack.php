<?php

namespace App\Domain\Memo\Models;

use App\Domain\BaseFunctions\Models\AbstractModel;
use App\Domain\Memo\Factories\TimeTrackFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Memo\Enums\TimeTrackStatus;

class TimeTrack extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['project_id', 'start', 'finish', 'duration', 'memo', 'status'];

    protected $casts = [
        'start' => 'datetime',
        'finish' => 'datetime',
        'status' => TimeTrackStatus::class
    ];

    /**
     * Set default attributes.
     */
    protected $attributes = [
        'status' => TimeTrackStatus::DRAFT->value,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($timeTrack) {
            if ($timeTrack->start && $timeTrack->finish) {
                $timeTrack->duration = $timeTrack->finish->diffInSeconds($timeTrack->start);
            }

            if ($timeTrack->status === 'final' && (!$timeTrack->start || !$timeTrack->finish)) {
                throw new \Exception('A finalized time track must have both start and finish times.');
            }
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    protected static function newFactory(): TimeTrackFactory
    {
        return TimeTrackFactory::new();
    }
}
