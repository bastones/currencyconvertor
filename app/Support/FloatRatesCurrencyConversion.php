<?php

namespace App\Support;

use App\Contracts\CurrencyConversion;
use App\Traits\CurrencyCodes;
use InvalidArgumentException;

class FloatRatesCurrencyConversion implements CurrencyConversion
{
    use CurrencyCodes;

    /**
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var int
     */
    protected $with;

    /**
     * @param string $code
     * @return $this
     * @throws InvalidArgumentException
     */
    public function from(string $code)
    {
        $this->validateOrFail($code);

        return $this;
    }

    /**
     * @param string $code
     * @return $this
     * @throws InvalidArgumentException
     */
    public function to(string $code)
    {
        $this->validateOrFail($code);

        return $this;
    }

    /**
     * @param int $amount
     * @return int
     */
    public function with(int $amount)
    {
        return $this->convert();
    }

    /**
     * @return int
     * @throws InvalidArgumentException
     */
    protected function convert()
    {
        if (empty($this->from) || empty($this->to)) {
            throw new InvalidArgumentException('Cannot convert without two currencies provided.');
        }

        return 0;
    }
}
