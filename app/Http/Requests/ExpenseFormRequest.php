<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseFormRequest extends FormRequest
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
        return [
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'vendor_name' => 'nullable|exists:vendors,id',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'nullable|exists:subcategories,id',
        ];
    }
}
