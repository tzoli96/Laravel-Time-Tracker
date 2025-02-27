<?php

namespace App\Domain\BaseFunctions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class AbstractModel extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function (self $model) {
            cache()->forget($model->getCacheKeyForOptions());
        });
    }

    public function getCacheKeyForOptions():string
    {
        return get_class($this).'_forOptions';
    }

    public static function forOptions(): array
    {
        return cache()->rememberForever((new static())->getCacheKeyForOptions(), function () {
           return static::query()
               ->orderBy('name')
               ->pluck('name','id')
               ->toArray();
        });
    }
}
