<?php

namespace App\Http\Controllers;

use App\Traits\CurrencyCodes;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CurrencyCodes;

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'currencies' => $this->currencies,
        ]);
    }
}
