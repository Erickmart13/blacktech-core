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
        // 🔥 usar slug estilo Laravel
        $baseCode = Str::slug(Str::ascii($name), '_');
        // Ej: "Datos Maestros" → "datos_maestros"

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

        if (!empty($this->module_id)) {
            $query->where('module_id', $this->module_id);
        }

        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        return $query->exists();
    }
}
