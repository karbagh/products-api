<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Response::macro('successMessage', function (string $message, $status = ResponseStatus::HTTP_OK) {
            return Response::json([
                'errors'  => false,
                'message' => $message,
            ], $status);
        });

        Response::macro('success', function (array $data, string $message) {
            return Response::json([
                'errors'  => false,
                'message' => $message,
                'data' => $data,
            ]);
        });

        Response::macro('error', function (string $message, $status = ResponseStatus::HTTP_BAD_REQUEST) {
            return Response::json([
                'errors'  => true,
                'message' => $message,
            ], $status);
        });
    }
}
