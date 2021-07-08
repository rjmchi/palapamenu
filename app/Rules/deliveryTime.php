<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class deliveryTime implements Rule
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
        $deliveryStart = Carbon::now('America/Mexico_City');
        $deliveryStart->add(30, 'minutes');

        $deliveryTime = Carbon::create($value, 'America/Mexico_City');

        if ($deliveryStart->greaterThan($deliveryTime))
            return false;
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Please allow at least 30 minutes');
    }
}
