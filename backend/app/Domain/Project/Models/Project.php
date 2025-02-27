<?php
namespace App\Domain\Project\Models;

use App\Domain\BaseFunctions\Models\AbstractModel;
use App\Domain\Project\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Memo\Models\TimeTrack;

/**
 * @property string $project_name
 */
class Project extends AbstractModel
{
    use HasFactory;

    protected $fillable = ['project_name'];

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }

    public function timeTracks(): HasMany
    {
        return $this->hasMany(TimeTrack::class);
    }
}
