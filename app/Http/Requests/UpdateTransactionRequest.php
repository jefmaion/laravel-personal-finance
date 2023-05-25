<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'date' => ['required'],
            'value' => ['required'],
            'type' => ['required'],
            'description' => 'required',
            'category_id' => ['required'],
            'account_id'=> ['required'],
            'payment_id' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => currency($this->value, true)
        ]);

    }
}
