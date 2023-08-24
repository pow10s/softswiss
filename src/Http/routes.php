<?php

use Illuminate\Support\Facades\Route;
use Pow10s\Softswiss\Http\Controllers\WebhookController;

Route::any('webhook', [WebhookController::class, 'webhook']);
