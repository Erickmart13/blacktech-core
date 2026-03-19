<?php

namespace App\Models\Admin;

use App\Concerns\GeneratesCode;
use App\Concerns\HasAuditable;
use App\Concerns\HasOrder;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasAuditable;
    use GeneratesCode;
    use HasOrder;

    protected $fillable = [
        'name',
        'code',
        'order',
        'is_active'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
