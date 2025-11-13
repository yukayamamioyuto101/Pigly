<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
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
             'weight' => ['required','numeric'],
            'target_weight' => ['required','numeric'],
        ];
    }

    public function messages()
    {
        return [
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '体重は数値で入力してください',
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric' => '目標体重は数値で入力してください',
        ];
    }
}
