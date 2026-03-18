<?php

namespace App\Models\Admin\MasterData;

use App\Concerns\GeneratesCode;
use App\Concerns\HasAuditable;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    use GeneratesCode;
    use HasAuditable;

    protected $fillable = [
        'name',
        'code',
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
    // public function statusApplication()
    // {
    //     return $this->hasMany(StatusApplication::class, 'status_id');
    // }
}
