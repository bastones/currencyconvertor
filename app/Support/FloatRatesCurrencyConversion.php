<?php

namespace App\Support;

use App\Contracts\CurrencyConversion;
use App\Traits\CurrencyCodes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use RuntimeException;

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
     * @var string
     */
    protected $source = 'https://www.floatrates.com/daily/';

    /**
     * @param string $code
     * @return $this
     * @throws InvalidArgumentException
     */
    public function from(string $code)
    {
        $this->validateOrFail($code);

        $this->from = $code;

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

        $this->to = $code;

        return $this;
    }

    /**
     * @param float $amount
     * @return int
     */
    public function with(float $amount)
    {
        $this->with = $amount;

        return $this->convert();
    }

    /**
     * @return int
     * @throws InvalidArgumentException
     */
    protected function convert()
    {
        if (empty($this->from) || empty($this->to)) {
            throw new InvalidArgumentException('Cannot convert without two valid currencies.');
        }

        return $this->with * $this->getExchangeRate();
    }

    /**
     * @return int
     */
    protected function getExchangeRate()
    {
        if (cache()->has($this->from)) {
            $to = strtolower($this->to);

            return cache($this->from)->{$to}->rate;
        } else {
            // Source URL must have a trailing slash
            $source = (substr($this->source, -1) !== '/') ? $this->source . '/' : $this->source;

            // Generate an HTTP request to retrieve the daily exchange rate
            $client = new Client([
                'base_uri' => $source,
                'http_errors' => true,
            ]);

            try {
                // Retrieve the exchange rate with the currency we are converting from
                $response = $client->request('GET', $this->from . '.json');

                // Decode the returned JSON string and return an exception if it fails
                $rates = json_decode($response->getBody());

                if ($rates === null) {
                    throw new RuntimeException('Conversion failed: cannot parse JSON string');
                }

                // Cache the exchange rate
                cache([$this->from => $rates], now()->addDay());

                $to = strtolower($this->to);

                return $rates->{$to}->rate;
            } catch (RequestException $e) {

                throw new RuntimeException('Conversion failed: DNS or timeout error. Status code: ' . $e->getCode());

            } catch (RuntimeException $e) {

                throw new RuntimeException('Conversion failed. Status code: ' . $e->getCode());

            }
        }
    }
}
