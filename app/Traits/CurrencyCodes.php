<?php

namespace App\Traits;

use InvalidArgumentException;

trait CurrencyCodes
{
    /**
     * @var array
     */
    protected $currencies = [
        'GBP' => 'British Pound (GBP)',
        'USD' => 'US Dollar (USD)',
        'AUD' => 'Australian Dollar (AUD)',
        'CAD' => 'Canadian Dollar (CAD)',
        'CNY' => 'Chinese Yen (CNY)',
        'EUR' => 'Euro (EUR)',
        'HKD' => 'Hong Kong Dollar (HKD)',
        'INR' => 'Indian Rupee (INR)',
        'JPY' => 'Japanese Yen (JPY)',
        'NZD' => 'New Zealand Dollar (NZD)',
    ];

    /**
     * @param string $code
     * @return bool
     */
    protected function validateCurrency(string $code)
    {
        return in_array($code, array_keys($this->currencies));
    }

    /**
     * @param string $code
     * @return bool
     * @throws InvalidArgumentException
     */
    protected function validateCurrencyOrFail(string $code)
    {
        if (! $this->validateCurrency($code)) {
            throw new InvalidArgumentException('An invalid currency code was provided');
        }

        return true;
    }
}
