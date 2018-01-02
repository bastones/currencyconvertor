<?php

namespace Tests\Feature;

use App\Support\FloatRatesCurrencyConversion;
use App\Traits\CurrencyCodes;
use Tests\TestCase;

class FloatRatesCurrencyConversionTest extends TestCase
{
    use CurrencyCodes;

    /**
     * @var FloatRatesCurrencyConversion
     */
    protected $conversion;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->conversion = new FloatRatesCurrencyConversion();
    }

    /**
     * @return void
     */
    public function test_from_method_validates_each_currency_code_and_returns_instance_of_self()
    {
        foreach (array_keys($this->currencies) as $currency) {
            $instance = $this->conversion->to($currency);

            self::assertInstanceOf(FloatRatesCurrencyConversion::class, $instance);
        }
    }

    /**
     * @return void
     */
    public function test_to_method_validates_each_currency_code_and_returns_instance_of_self()
    {
        foreach (array_keys($this->currencies) as $currency) {
            $instance = $this->conversion->from($currency);

            self::assertInstanceOf(FloatRatesCurrencyConversion::class, $instance);
        }
    }

    /**
     * @return void
     */
    public function test_with_method_returns_array_of_converted_currencies_when_currencies_identical()
    {
        $currency = array_keys($this->currencies)[0];
        $conversion = $this->conversion->from($currency)->to($currency)->with(1);

        self::assertInternalType('array', $conversion);
    }

    /**
     * @return void
     */
    public function test_with_method_returns_array_of_converted_currencies_when_currencies_differ()
    {
        $from = array_keys($this->currencies)[0];
        $to = array_keys($this->currencies)[1];
        $conversion = $this->conversion->from($from)->to($to)->with(1);

        self::assertInternalType('array', $conversion);
    }
}
