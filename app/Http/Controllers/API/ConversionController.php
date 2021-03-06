<?php

namespace App\Http\Controllers\API;

use App\Contracts\CurrencyConversion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversionController extends Controller
{
    /**
     * Handle a currency conversion request.
     *
     * @param Request $request
     * @param CurrencyConversion $conversion
     * @return CurrencyConversion
     */
    public function store(Request $request, CurrencyConversion $conversion)
    {
        return $conversion->from($request->from)
            ->to($request->to)
            ->with(preg_replace('/[^(?:\d+|\d*\.\d+)]/', '', $request->amount));
    }
}
