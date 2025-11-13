<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'date' => ['required', 'date'],
        'weight' => ['required', 'numeric', 'digits_between:1,4', 'regex:/^\d{1,3}(\.\d)?$/'],
        'calories' => ['required', 'numeric'],
        'exercise_hours' => ['required', 'integer', 'min:0'],
        'exercise_minutes' => ['required', 'integer', 'min:0', 'max:59'], // 追加
        'exercise_minutes' => ['required', 'integer', 'min:0', 'max:59'], // 追加
        'exercise_content' => ['required', 'string', 'max:120'],
        ];
    }

     public function messages()
    {
        return [
         'date.required' => '日付を入力してください',
         'weight.required' => '体重を入力してください',
        'weight.numeric' => '数字で入力してください',
        'weight.digits_between' => '4桁までの数字で入力してください',
        'weight.regex' => '小数点は1桁で入力してください',
        'calories.required' => '摂取カロリーを入力してください',
        'calories.numeric' => '数字で入力してください',
        'exercise_hours.required' => '運動時間を入力してください',
        'exercise_minutes.required' => '運動時間の分を入力してください', // 追加
        'exercise_minutes.integer' => '分は数字で入力してください',
        'exercise_minutes.min' => '分は0以上で入力してください',
        'exercise_minutes.max' => '分は59以下で入力してください',
        'exercise_content.required' => '運動内容を入力してください',
        'exercise_content.max' => '120文字以内で入力してください',
    ];
    }
}
