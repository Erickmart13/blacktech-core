<?php

namespace App\Concerns;

use Exception;

trait HasAutoCode
{
    protected static function bootHasAutoCode()
    {
        static::creating(function ($model) {
            if (!blank($model->code)) {
                return;
            }

            $prefix = $model->codePrefix ?? 'COD';
            $length = 4;
            
            // Máximo 3 intentos para evitar duplicados por concurrencia
            $attempts = 0;
            $maxAttempts = 3;
            
            do {
                // Obtener el último número secuencial
                $lastCode = static::where('code', 'like', $prefix . '%')
                    ->orderByRaw('CAST(SUBSTRING(code, ' . (strlen($prefix) + 1) . ') AS UNSIGNED) DESC')
                    ->value('code');
                
                $nextNumber = 1;
                if ($lastCode) {
                    $numericPart = substr($lastCode, strlen($prefix));
                    $nextNumber = (int) $numericPart + 1;
                }
                
                $newCode = $prefix . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
                
                // Verificar si el código ya existe (por si acaso)
                $exists = static::where('code', $newCode)->exists();
                
                if (!$exists) {
                    $model->code = $newCode;
                    break;
                }
                
                $attempts++;
                
                if ($attempts >= $maxAttempts) {
                    throw new Exception("No se pudo generar un código único para " . get_class($model));
                }
                
                // Si existe, forzar la búsqueda del siguiente disponible
                $nextNumber++;
                
            } while (true);
        });
    }
}