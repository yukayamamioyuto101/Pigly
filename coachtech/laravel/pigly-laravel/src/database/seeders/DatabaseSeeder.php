<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. 初期ユーザー作成
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // 2. 初期ユーザーに紐づく weight_target 作成
        WeightTarget::factory()->create([
            'user_id' => $user->id,
            'target_weight' => 60.0,
        ]);

        // 3. 初期ユーザーに紐づく weight_logs を 35件作成
        WeightLog::factory(35)->create([
            'user_id' => $user->id,
        ]);
    }
}
