<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BulkPriceUpdateRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    
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
            'percentage' => ['required', 'integer', 'min:1', 'max:100'],
            'adjustment_type' => ['required', 'in:increase,decrease'],
            // 'seller_id' => ['nullable', 'integer', 'exists:sellers,id'],
            'brand_id' => ['nullable', 'integer', 'exists:brands,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'sub_category_id' => ['nullable', 'integer', 'exists:categories,id'],
            'sub_sub_category_id' => ['nullable', 'integer', 'exists:categories,id'],
            // 'request_status' => ['nullable', 'integer'],
            // 'status' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'percentage.required' => translate('The percentage field is required.'),
            'percentage.integer' => translate('The percentage must be a whole number.'),
            'percentage.min' => translate('The percentage must be at least 1%.'),
            'percentage.max' => translate('The percentage cannot exceed 100%.'),
            'adjustment_type.required' => translate('Please select an adjustment type.'),
            // 'seller_id.integer' => translate('The seller ID must be a valid number.'),
            // 'seller_id.exists' => translate('The selected seller does not exist.'),
            'brand_id.integer' => translate('The brand ID must be a valid number.'),
            'brand_id.exists' => translate('The selected brand does not exist.'),
            'category_id.integer' => translate('The category ID must be a valid number.'),
            'category_id.exists' => translate('The selected category does not exist.'),
            'sub_category_id.integer' => translate('The sub-category ID must be a valid number.'),
            'sub_category_id.exists' => translate('The selected sub-category does not exist.'),
            'sub_sub_category_id.integer' => translate('The sub-sub-category ID must be a valid number.'),
            'sub_sub_category_id.exists' => translate('The selected sub-sub-category does not exist.'),
        ];
    }
}