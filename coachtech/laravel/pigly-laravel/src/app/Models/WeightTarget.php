<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'target_weight'];

    // 各目標体重は1人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
