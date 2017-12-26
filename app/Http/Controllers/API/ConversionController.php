<?php

namespace App\Http\Controllers\API;

use App\Contracts\CurrencyConversion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversionController extends Controller
{
    public function store(Request $request, CurrencyConversion $conversion)
    {
        return $conversion->from($request->from)
            ->to($request->to)
            ->with($request->amount);
    }
}
