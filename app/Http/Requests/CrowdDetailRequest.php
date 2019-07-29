<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrowdDetailRequest extends FormRequest
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
            'name' => 'required',
            'level_id' => 'required',
        ];
    }

    public function withValidator($validator){
        if(request()->hasFile('thumb')){
            $imageName = uploadImage(request()->file('thumb'),'crowd','');
            session()->flash('thumb_image',$imageName);
        }

        $validator->after(function ($validator){
            $id = request('id');
            $thumb_image = request('thumb_image');

            if(!$id && !request()->hasFile('thumb') && !$thumb_image){
                $validator->errors()->add('thumb','缩略图哪去了？ (╯°-°）╯︵┻━┻');
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => '众筹回报的名称一定要补充 (╯o_o）╯︵┻━┻',
            'level_id.required' => '众筹等级不能不填 (╯-_-）╯︵┻━┻',
        ];
    }
}
