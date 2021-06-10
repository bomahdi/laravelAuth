<?php

namespace App\Http\Requests\UserRequest;

use App\Http\Requests\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUser extends FormRequest
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
            'id' => 'required|exists:users,id',
            'name' => 'required|string|unique:users,name,'.$this->id,
            'email' => 'required|string|email|unique:users,email,'.$this->id,
            'password' => 'nullable|min:8',
        ];
    }
}
