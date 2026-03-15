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
        // Normalización
        $baseCode = Str::ascii($name);            // Quito Aéreo -> Quito Aereo
        $baseCode = strtoupper($baseCode);        // -> QUITO AEREO
        $baseCode = preg_replace('/[^A-Z0-9]+/', '_', $baseCode); // -> QUITO_AEREO
        $baseCode = trim($baseCode, '_');         // quitar _ de inicio/fin

        $code = $baseCode;
        $counter = 1;

        while (static::where('code', $code)->exists()) {
            $code = $baseCode . '_' . $counter;
            $counter++;
        }

        return $code;
    }
}
