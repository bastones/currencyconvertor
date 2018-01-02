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
     * @return array
     */
    public function with(float $amount)
    {
        $this->with = $amount;

        return $this->convert();
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    protected function convert()
    {
        if (empty($this->from) || empty($this->to)) {
            throw new InvalidArgumentException('Cannot convert without two valid currencies');
        }

        $exchangeRate = $this->getExchangeRate();

        $formattedOriginalAmount = number_format($this->with, 2);
        $formattedExchangeAmount = number_format($this->with * $exchangeRate, 2);

        return [
            'from' => $this->from,
            'to' => $this->to,
            'result' => [
                'amount' => $formattedExchangeAmount,
                'description' => $formattedOriginalAmount. ' ' . $this->from . ' = ' . $formattedExchangeAmount . ' ' . $this->to,
            ],
        ];
    }

    /**
     * @return int
     */
    protected function getExchangeRate()
    {
        // Check if the client is attempting to convert between two identical currencies
        if ($this->from === $this->to) {
            // Return a fixed exchange rate to prevent further logic attempting to retrieve a non-existent property
            return 1;
        }

        // Check if the exchange rate is cached. Otherwise, retrieve the exchange rate and cache it for future requests
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
