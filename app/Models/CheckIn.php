<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckIn extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = ['tenant_id', 'room_id', 'child_id', 'checked_in_at', 'checked_out_at'];

    protected $casts = [
        'checked_in_at' => 'datetime',
        'checked_out_at' => 'datetime',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function child(): BelongsTo
    {
        return $this->belongsTo(Child::class);
    }

    /** Currently open check-ins (child hasn't checked out yet). */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereNull('checked_out_at');
    }
}
