<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Random\Randomizer;
use function Illuminate\Support\enum_value;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'birthDate' => fake()->date(),
            'type' => random_int(1, 4) == 1 ? enum_value('common') : (random_int(1, 3) == 1 ? enum_value('worker') : 
            (random_int(1, 2) == 1 ? enum_value('employer') : enum_value('staff'))),
            'description' => fake()->realText(650),
            'password' => Hash::make(fake()->password(8, 34))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
