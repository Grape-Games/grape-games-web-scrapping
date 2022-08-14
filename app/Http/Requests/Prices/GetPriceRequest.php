<?php

namespace App\Http\Requests\Prices;

use App\Rules\CheckPriceTypeRule;
use Illuminate\Foundation\Http\FormRequest;

class GetPriceRequest extends FormRequest
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
            'type' => $this->route('type')
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
            'type' => ['required', new CheckPriceTypeRule()],
        ];
    }
}
