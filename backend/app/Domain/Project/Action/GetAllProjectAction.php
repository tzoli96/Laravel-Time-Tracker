<?php

namespace App\Domain\Project\Action;

use App\Domain\Project\Models\Project;
use Illuminate\Database\Eloquent\Collection;


class GetAllProjectAction
{
    public function __invoke(): Collection
    {
        return Project::all();
    }
}
