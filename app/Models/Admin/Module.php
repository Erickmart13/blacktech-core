<?php

namespace App\Models\Admin;

use App\Concerns\GeneratesCode;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use GeneratesCode;
    protected $fillable = [
        'name',
        'code',
        'order',
        'is_active'
    ];
}
