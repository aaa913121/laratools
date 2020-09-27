<?php

namespace Nolin\Laratools\Rules;

use Illuminate\Contracts\Validation\Rule;

class IpRegex implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(?:((?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)|\*)\.){3}((?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)|\*)$/', $value) != false
        || filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('message.api_validate_ipRegexError');
    }
}
