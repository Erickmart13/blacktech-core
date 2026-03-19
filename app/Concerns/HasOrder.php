<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasOrder
{
    public static function bootHasOrder()
    {
        // Al crear: asigna el siguiente orden automáticamente
        static::creating(function ($model) {
            if (is_null($model->order)) {
                $model->order = static::max('order') + 1;
            }
        });

        // Al actualizar: reorganiza si cambia el orden
        static::updating(function ($model) {
            if ($model->isDirty('order')) {
                static::reorder($model);
            }
        });
    }

    public static function reorder($model)
    {
        $oldOrder = $model->getOriginal('order');
        $newOrder = $model->order;

        if ($oldOrder == $newOrder) {
            return;
        }

        if ($newOrder > $oldOrder) {
            // Baja el módulo
            static::where('order', '>', $oldOrder)
                ->where('order', '<=', $newOrder)
                ->decrement('order');
        } else {
            // Sube el módulo
            static::where('order', '<', $oldOrder)
                ->where('order', '>=', $newOrder)
                ->increment('order');
        }
    }

    // Scope útil
    public function scopeOrdered(Builder $query)
    {
        return $query->orderBy('order');
    }
}
