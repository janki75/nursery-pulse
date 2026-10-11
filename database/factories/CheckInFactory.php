<?php

namespace Database\Factories;

use App\Models\CheckIn;
use App\Models\Child;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckInFactory extends Factory
{
    protected $model = CheckIn::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'child_id' => Child::factory(),
            'checked_in_at' => now(),
            'checked_out_at' => null,
        ];
    }

    public function forTenant(string $tenantId): static
    {
        return $this->state(fn () => ['tenant_id' => $tenantId]);
    }

    public function checkedOut(): static
    {
        return $this->state(fn () => ['checked_out_at' => now()]);
    }
}
