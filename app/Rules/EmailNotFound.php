<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailNotFound implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $registreduser = User::where('email', '=', $value)->get();
        if (count($registreduser) === 0) {
            $fail(__('The :attribute field is not founded.'));

            return;
        }

    }
}
