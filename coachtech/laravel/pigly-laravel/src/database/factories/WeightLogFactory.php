<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightLog;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'date' => $this->faker->dateTimeBetween('-35 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 50, 100),
            'calories' => $this->faker->numberBetween(1500, 3000),
            'exercise_time' => $this->faker->numberBetween(0, 120),
            'exercise_content' => $this->faker->word(),
        ];
    }
}
