<?php

namespace Database\Factories;

use App\Models\Child;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChildFactory extends Factory
{
    protected $model = Child::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
        ];
    }

    public function forTenant(string $tenantId): static
    {
        return $this->state(fn () => ['tenant_id' => $tenantId]);
    }
}
