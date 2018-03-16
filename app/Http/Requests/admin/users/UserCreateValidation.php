<?php

namespace App\Http\Requests\admin\users;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateValidation extends FormRequest
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
          'name'=>'bail|required|string|min:3|max:50',
          'email'=>'bail|required|email|max:100|unique:users,email',
          'password'=>'bail|required|string|min:8|max:20',
        ];
    }
}
