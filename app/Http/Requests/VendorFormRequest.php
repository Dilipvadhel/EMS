<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorFormRequest extends FormRequest
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
        // dd($this->all());
        return [
            'vendor_name' => 'required',
            'company_name' => 'required|max:255',
            'mobile_no' => 'required|numeric|min:10',
            'address' => 'required|max:255',
            'email' => 'required|email',


        ];
    }
}
