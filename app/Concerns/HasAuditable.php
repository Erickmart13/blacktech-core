<?php

namespace App\Concerns;

trait HasAuditable
{
    protected static function bootHasAuditable()
    {
        static::creating(function ($model) {
            /** @var \Illuminate\Contracts\Auth\Guard $auth */
            $auth = auth();

            if ($auth->user()) {
                $model->created_by = $auth->user()->id;
                $model->updated_by = $auth->user()->id;
            }
        });

        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();

        static::updating(function ($model) use ($auth) {
            if ($auth->check()) {
                $model->updated_by = $auth->id();
            }
        });
    }
}
