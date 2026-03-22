<?php

namespace App\Concerns;

use Illuminate\Support\Str;

trait GeneratesCode
{
    public static function bootGeneratesCode()
    {
        static::creating(function ($model) {
            if (empty($model->code)) {
                $name = $model->getCodeSourceName();
                if ($name) {
                    $model->code = $model->generateUniqueCode($name);
                }
            }
        });
    }

    protected function getCodeSourceName()
    {
        // Por defecto, usa "name" si existe
        return $this->name ?? null;
    }

    protected function generateUniqueCode($name)
    {
        $moduleCode = $this->module?->code ?? '';

        $baseCode = Str::slug(
            Str::ascii($moduleCode . '_' . $name),
            '_'
        );

        $code = $baseCode;
        $counter = 1;

        while ($this->codeExists($code)) {
            $code = $baseCode . '_' . $counter;
            $counter++;
        }

        return $code;
    }
    protected function codeExists($code)
    {
        $query = static::where('code', $code);

        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        return $query->exists();
    }
}
