<?php

namespace App\Models\Admin\MasterData;

use App\Concerns\HasAuditable;
use App\Models\Admin\MasterData\Status;
use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusApplication extends Model
{
    use HasFactory;
    use HasAuditable;

    protected $fillable = [
        'applies_to',
        'status_id',
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

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'status_application_id');
    }
}
