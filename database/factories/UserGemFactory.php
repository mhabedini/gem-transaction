<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserGem>
 */
class UserGemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'count' => random_int(10, 100000),
        ];
    }
}
