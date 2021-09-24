<?php

namespace App\Traits;

trait ApiResponder
{
    protected function successsResponseWithToken($message = null, $data, $token = null, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => [
                'authToken' => $token,
                'user' => $data,
            ],
        ], $code);
    }

    protected function successResponseWithMessageOnly($message, $code = 200)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    protected function successResponse($message = null, $data, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function badRequestResponse($message = null, $errors = null, $code = 400)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function unauthorizedResponse($message = null, $errors = null, $code = 401)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function forbiddenResponse($message = null, $errors = null, $code = 403)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function notFoundResponse($message = null, $errors = null, $code = 404)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function errorResponse($message = null, $errors = null, $code = 404)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function notAcceptableResponse($message = null, $errors = null, $code = 406)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function conflictResponse($message = null, $errors = null, $code = 409)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function errorUnprocessableEntity($message = null, $errors = null, $code = 422)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }

    protected function internalServerError($message = null, $errors = null, $code = 500)
    {
        return response()->json([
            'message' => $message,
            'error' => $errors,
        ], $code);
    }
}
