<?php

namespace App\Rules;

use App\Models\Resource;
use Illuminate\Contracts\Validation\InvokableRule;

class CheckPriceTypeRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $types = Resource::groupBy('type')->pluck('type')->toArray();

        if (!in_array($value, $types))
            $fail('Invalid type, must be one of: ' . implode(',', $types));
    }
}
