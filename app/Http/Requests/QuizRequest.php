<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
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
            'question' => 'required',
            'correct' => 'required',
        ];
    }

    public function withValidator($validator){
        $choices = request()->get('choices');

        $validator->after(function ($validator)use($choices){
            if(empty($choices)){
                $validator->errors()->add('choices','选项不能为空');
            }
        });
    }
}
