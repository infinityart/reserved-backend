<?php
/**
 * Class legitPhoneNumber.php
 *
 * Class documentation
 *
 * @author: Jonty Sponsleee <jsponselee97@gmail.com>
 * @since: 23/01/2020
 */
declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Carbon;

class AppointableTime implements Rule
{
    const RESIDUAL_NUMBERS = 0;
    const INTERVAL = 15;

    /**
     * Passes the rule if the interval modulo of the minutes of the
     * given dateTime equals the residual numbers.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $minutes = Carbon::createFromFormat('d-m-Y H:i', $value)->minute;

        return $minutes % self::INTERVAL == self::RESIDUAL_NUMBERS;
    }

    /**
     * Get the validation message.
     *
     * @return array|string
     */
    public function message()
    {
        return 'The time of :attribute is not dividable by 15 minutes.';
    }
}