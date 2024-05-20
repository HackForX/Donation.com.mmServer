<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EventDateFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $d = \DateTime::createFromFormat('M d, Y', $value);
        if (!($d && $d->format('M d, Y') === $value)) {
            $fail('The ' . $attribute . ' does not match the format May 17, 2024.');
        }
    }
}
