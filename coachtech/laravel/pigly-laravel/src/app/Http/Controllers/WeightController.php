<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\WeightRequest;
use App\Http\Requests\GoalSettingRequest;

class WeightController extends Controller
{

     // index 表示
    public function index(Request $request)
{
    $user = Auth::user();

    // 検索用日付取得
    $from = $request->input('from');
    $to = $request->input('to');

    // クエリ作成
    $query = WeightLog::where('user_id', $user->id);

    if ($from) {
        $query->where('date', '>=', $from);
    }

    if ($to) {
        $query->where('date', '<=', $to);
    }

    $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

    $weightTarget = WeightTarget::where('user_id', $user->id)->first();

    // 最新体重・目標との差分計算
    $latestWeight = $weightLogs->first();
    $diffWeight = $weightTarget && $latestWeight
        ? $latestWeight->weight - $weightTarget->target_weight
        : null;

    return view('weight.index', compact('weightLogs', 'weightTarget', 'latestWeight', 'diffWeight'));
   }

    public function store(WeightRequest $request)
    {
         \Log::info('WeightController@store called', $request->all());

        $user = Auth::user();

        // 運動時間を分単位で計算
        $exerciseTime = ($request->exercise_hours ?? 0) * 60 + ($request->exercise_minutes ?? 0);

        // 体重ログ作成
        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $exerciseTime,
            'exercise_content' => $request->exercise_content,
        ]);

        // 保存後は体重一覧ページへリダイレクト
        return redirect()->route('weight.index')->with('success', '体重ログを登録しました。');
    }

    public function goal()
    {
    $user = auth()->user();
    $weightTarget = $user->weightTarget;
    return view('weight.goal', compact('weightTarget'));
    }

public function updateGoal(GoalSettingRequest $request)
    {
    $user = auth()->user();
    $user->weightTarget()->updateOrCreate([], [
        'target_weight' => $request->target_weight
    ]);
    return redirect()->route('weight.index');
    }

    public function show($id)
    {
    $weightLog = WeightLog::findOrFail($id);
    return view('weight.show', compact('weightLog'));
    }

    // 更新
public function update(WeightRequest $request, $id)
{
    $weightLog = WeightLog::findOrFail($id);
   
    $exerciseTime = ($request->exercise_hours ?? 0) * 60 + ($request->exercise_minutes ?? 0);
    
    $weightLog->update([
    'date' => $request->date,
    'weight' => $request->weight,
    'calories' => $request->calories,
    'exercise_time' => $exerciseTime,
    'exercise_content' => $request->exercise_content,
    ]);

    return redirect()->route('weight.index')->with('success', '体重ログを更新しました');
}

// 削除
    public function destroy($id)
    {
    $weightLog = WeightLog::findOrFail($id);
    $weightLog->delete();
    return redirect()->route('weight.index')->with('success', '体重ログを削除しました');
    }
}
