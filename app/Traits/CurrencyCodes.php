<?php

namespace App\Traits;

use InvalidArgumentException;

trait CurrencyCodes
{
    /**
     * @var array
     */
    protected $currencies = [
        'USD',
        'EUR',
        'GBP',
        'AUD',
        'CAD',
        'INR',
        'CNY',
        'JPY',
        'NZD',
    ];

    /**
     * @param string $code
     * @return bool
     */
    protected function validate(string $code)
    {
        return in_array($code, $this->currencies);
    }

    /**
     * @param string $code
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function validateOrFail(string $code)
    {
        if (! $this->validate($code)) {
            throw new InvalidArgumentException('An invalid currency code was provided');
        }

        return true;
    }
}
