<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           'post.artist_name' => 'required|string|max:50',
            'post.venue' => 'required|string|max:50',
         'post.theday' => 'required|string|max:50',
        'post.seat' => 'required|string|max:100',
       'post.stage_distance' => 'required|string|max:50',
         'post.others' => 'required|string|max:1000',
        'post.fan_service' => 'required|string|max:50',

        'post.falling_objects' => 'required|string|max:50',
         'post.visible' => 'required|string|max:50',
        

            'post.comment' => 'required|string|max:4000',
        ];
    }
}
