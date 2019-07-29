<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\TwijackModel\GamePonyModel as GamePony;

class GamePonyRequest extends FormRequest
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
            'desc' => 'required',
        ];
    }

    public function withValidator($validator){
        if(request()->hasFile('thumb')){
            $imageName = uploadImage(request()->file('thumb'),'thumb','',150);
            session()->flash('thumb_image',$imageName);
        }

        $validator->after(function ($validator){
            $id = request('id');
            $name = request('name');
            $location = request('location');
            $thumb_image = request('thumb_image');

            if(!$id && !request()->hasFile('thumb') && !$thumb_image){
                $validator->errors()->add('thumb','缩略图哪去了？ (╯°-°）╯︵┻━┻');
            }

            $pony = GamePony::name($name)->location($location)->first();
            if($pony){
                if(($id && $id != $pony['id']) || !$id){
                    $validator->errors()->add('pony','这匹小马的信息已经记录过了 (╯°□°）╯︵ ┻━┻');
                }
            }
        });
    }

    public function messages()
    {
        return [
            'name.required' => '小马的名字一定要写 (╯o_o）╯︵┻━┻',
            'desc.required' => '别忘了小马的简介 (╯-_-）╯︵┻━┻',
        ];
    }
}
