<?php

namespace App\Http\Requests\Conversion;

use Illuminate\Foundation\Http\FormRequest;

class ConvertByCountryRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'to' => $this->route('to'),
            'from' => $this->route('from'),
            'amount' => $this->route('amount'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'to' => 'required|exists:countries,name',
            'from' => 'required|exists:countries,name',
            'amount' => 'nullable|numeric',
        ];
    }
}
