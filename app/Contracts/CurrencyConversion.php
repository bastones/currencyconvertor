<?php

namespace App\Contracts;

interface CurrencyConversion
{
    /**
     * @param string $code
     * @return CurrencyConversion
     * @throws \InvalidArgumentException
     */
    public function from(string $code);

    /**
     * @param string $code
     * @return CurrencyConversion
     * @throws \InvalidArgumentException
     */
    public function to(string $code);

    /**
     * @param float $amount
     * @return CurrencyConversion
     */
    public function with(float $amount);
}
