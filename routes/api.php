<?php

/**
 * API Routes
 */

Route::apiResource('convert', 'ConversionController', ['only' => ['store']]);
