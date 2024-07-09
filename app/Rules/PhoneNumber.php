<?php

namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // التحقق من الرقم المحلي أو الدولي
        $countryCodePattern = '/^\+?[1-9]\d{1,14}$/'; // للارقام مع كود الدولة
        $localPhonePattern = '/^0\d{10}$/'; // للارقام بدون كود الدولة

        return preg_match($countryCodePattern, $value) || preg_match($localPhonePattern, $value);
    }

    public function message()
    {
        return 'يجب أن يكون رقم الهاتف مكونًا من 11 رقمًا ويبدأ بـ 0 أو يكون مكون من كود الدولة ورقم الهاتف.';
    }
}

