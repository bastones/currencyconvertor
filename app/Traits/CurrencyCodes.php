<?php

namespace App\Traits;

trait CurrencyCodes
{
    /**
     * @var array
     */
    protected $currencies = [
        'USD',
        'EUR',
        'GBP',
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
            throw new InvalidArgumentException('An invalid currency code was provided.');
        }

        return true;
    }
}
