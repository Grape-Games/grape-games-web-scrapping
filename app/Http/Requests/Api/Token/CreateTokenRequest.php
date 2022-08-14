<?php

namespace App\Http\Requests\Api\Token;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\RequestValidatable;

class CreateTokenRequest extends FormRequest
{
    use RequestValidatable;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:255'
        ];
    }
}
