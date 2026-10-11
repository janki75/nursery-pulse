<?php

namespace App\Models\Concerns;

use App\Support\Tenancy\CurrentTenant;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    public static function bootBelongsToTenant(): void
    {
        static::addGlobalScope('tenant', function (Builder $builder): void {
            $builder->where($builder->getModel()->getTable().'.tenant_id', app(CurrentTenant::class)->id());
        });

        static::creating(function ($model): void {
            $model->tenant_id ??= app(CurrentTenant::class)->id();
        });
    }
}
