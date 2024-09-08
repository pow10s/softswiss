<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Pow10s\Softswiss\Http\Controllers\WebhookController;

Route::any('webhook', [WebhookController::class, 'webhook']);
