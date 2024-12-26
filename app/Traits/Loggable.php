<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

trait Loggable
{
    public static function boot(): void
    {
        parent::boot();

        static::updated(static function (Model $model) {
            self::logActivity('updated', $model);
        });
    }

    protected static function logActivity($event, $model): void
    {
        [$oldValues, $newValues] = match ($event) {
            'updated' => [
                $oldValues = array_intersect_key($model->getOriginal(), $model->getDirty()),
                $newValues = $model->getDirty(),
            ],
        };


        ActivityLog::create([
            'event' => $event,
            'model_type' => get_class($model),
            'model_id' => $model->id,
            'user_id' => auth()->user()?->id,
            'old_values' => $oldValues,
            'new_values' => $newValues
        ]);
    }
}
