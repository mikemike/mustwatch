<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Response;
use Auth;

class AccountUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id.',id'],
            'password' => ['min:8', 'confirmed']
        ];
    }

    public function messages()
    {
        return [
        ];
    }

    public function authorize()
    {
        return true;
    }

}