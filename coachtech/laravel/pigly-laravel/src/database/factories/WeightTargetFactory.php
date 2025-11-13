<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WeightTarget;
use App\Models\User;

class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'user_id' => User::factory(), // 後で紐づける場合も可
            'target_weight' => $this->faker->randomFloat(1, 55, 70), // 小数1桁//
        ];
    }

}
