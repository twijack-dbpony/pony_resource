<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        ];
    }

    public function withValidator($validator){
        if(request()->hasFile('path')){
            $imageName = uploadImage(request()->file('path'),'path','');
            session()->flash('path_image',$imageName);
        }

        $validator->after(function ($validator){
            $id = request('id');
            $thumb_image = request('path_image');

            if(!$id && !request()->hasFile('path') && !$thumb_image){
                $validator->errors()->add('path','缩略图哪去了？ (╯°-°）╯︵┻━┻');
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => '图片的名字一定要写 (╯o_o）╯︵┻━┻',
        ];
    }
}
