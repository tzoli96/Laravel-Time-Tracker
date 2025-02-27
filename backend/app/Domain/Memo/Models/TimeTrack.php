<?php
namespace App\Domain\Memo\Models;

use App\Domain\BaseFunctions\Models\AbstractModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimeTrack extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['project_id', 'start', 'finish', 'duration', 'memo'];

    protected $casts = [
        'start' => 'datetime',
        'finish' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($timeTrack) {
            if ($timeTrack->start && $timeTrack->finish) {
                $timeTrack->duration = $timeTrack->finish->diffInSeconds($timeTrack->start);
            }
        });
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
