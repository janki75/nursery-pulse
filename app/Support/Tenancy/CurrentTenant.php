<?php

namespace App\Support\Tenancy;

class CurrentTenant
{
    public function __construct(private readonly string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
