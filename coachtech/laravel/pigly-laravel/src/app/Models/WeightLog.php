<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;
     protected $fillable = ['user_id', 'date', 'weight', 'calories', 'exercise_content','exercise_time'];

      // date カラムを Carbon にキャスト
    protected $casts = [
        'date' => 'datetime',
    ];

    // 各体重記録は1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
