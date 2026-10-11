<?php

namespace App\Models;

use App\Models\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    use BelongsToTenant, HasFactory;

    protected $fillable = ['tenant_id', 'name'];

    public function checkIns(): HasMany
    {
        return $this->hasMany(CheckIn::class);
    }
}
