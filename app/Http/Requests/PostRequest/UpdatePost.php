<?php

namespace App\Http\Requests\PostRequest;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePost extends FormRequest
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
            'id' => 'required|exists:posts,id',
            'name' => 'required|string|unique:posts,name,'.$this->id,
            'description' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
