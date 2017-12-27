<?php

namespace Tests\Unit;

use App\Traits\CurrencyCodes;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyCodesTest extends TestCase
{
    use CurrencyCodes;

    /**
     * @return void
     */
    public function test_currencies_class_variable_has_an_array_of_at_least_two_items()
    {
        self::assertGreaterThan(1, count($this->currencies));
    }
}
