<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterStepRequest;
use App\Http\Requests\RegisterStep2Request;


class RegisterStepController extends Controller
{

     public function step1()
    {
        return view('register.step1');
    }

 // STEP2 フォーム表示
    public function step2()
    {
        return view('register.step2');
    }

    // STEP2 フォーム送信
    public function store(RegisterStep2Request $request)
    {
        $user = Auth::user();

        // 登録
        WeightLog::create([
             'user_id' => $user->id,
             'weight' => $request->weight,
             'date' => Carbon::today(),
             'calories' => 0, // とりあえず 0
            'exercise_time' => 0,
            'exercise_content' => '',
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $request->target_weight,
        ]);

        return redirect()->route('weight.index');
    }

   
}
