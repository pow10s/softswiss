<?php

declare(strict_types=1);

namespace Pow10s\Softswiss\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;

class WebhookController extends Controller
{
    public function __construct()
    {
    }

    public function webhook(): JsonResponse
    {
        return Response::json([
            'status' => 'ok',
        ]);
    }
}
