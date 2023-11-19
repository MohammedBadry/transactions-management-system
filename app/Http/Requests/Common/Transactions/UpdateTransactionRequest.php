<?php

namespace App\Http\Requests\Common\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'payer_id' => 'required|exists:users,id',
            'due_on' => 'required|date',
            'vat' => 'required|numeric',
            'vat_inclusive' => 'required',
        ];
    }
}
