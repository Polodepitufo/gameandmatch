<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platforms = ['STEAM', 'SWITCH', 'PLAY 4', 'XBOX', 'MOVIL'];
        $platform = $platforms[array_rand($platforms)];
        return [
            'name' => $name=fake()->name(),
            'platform' => $platform,
            'description' => fake()->paragraph(),
            'background' => str_replace(' ', '-', $name) . '.png',
        ];
    }
}
