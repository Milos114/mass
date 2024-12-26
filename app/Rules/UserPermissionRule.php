<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserPermissionRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $filePermissions = config('mass.orders.permission-required');

        if (!auth()->user()->hasPermission($filePermissions)) {
            $fail('You do not have permission to upload this file.');
        }
    }
}
