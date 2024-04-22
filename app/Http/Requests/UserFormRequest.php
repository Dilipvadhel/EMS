<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        $userId = $this->user ? $this->user->id : null;

        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userId),
            ],
            'username' => [
                'required',
                'max:255',
                'alpha',
                Rule::unique('users')->ignore($userId),
            ],
            'password' => 'nullable|min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'nullable|min:6',
            'role_id' => 'required|exists:roles,id',
            'profile_picture' => 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048',


        ];
    }
}
