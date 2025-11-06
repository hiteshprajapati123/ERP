<?php

namespace App\Traits;

use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        static::created(function ($model) {
            $model->logActivity('created');
        });

        static::updated(function ($model) {
            $model->logActivity('updated');
        });

        static::deleted(function ($model) {
            $model->logActivity('deleted');
        });
    }

    protected function logActivity($event)
    {
        // Skip if no authenticated user (e.g., during seeding)
        if (!auth()->check()) {
            return;
        }

        $modelClass = get_class($this);
        $modelName = class_basename($modelClass);
        
        // Skip logging UserActivity to prevent infinite loops
        if ($modelClass === 'App\Models\UserActivity') {
            return;
        }

        $description = ucfirst($event) . ' ' . $this->getActivityDescription($event);
        
        UserActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => $event,
            'description' => $description,
            'model_type' => $modelClass,
            'model_id' => $this->id,
            'old_values' => $event === 'updated' ? $this->getOriginal() : null,
            'new_values' => $event !== 'deleted' ? $this->toArray() : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    protected function getActivityDescription($event)
    {
        $modelName = class_basename($this);
        
        if (method_exists($this, 'getActivityDescription')) {
            return $this->getActivityDescription($event);
        }
        
        return $modelName . ' ' . $event;
    }
}
