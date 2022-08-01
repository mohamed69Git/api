<?php

namespace App\Custom;

class CustomResponse
{
    protected $error;
    protected $success;
    protected $message;
    protected $data;

    function __construct($error, $errors, $data)
    {
        $this->error = $error;
        $this->errors = $errors;
        $this->data = $data;
    }

    public static function buildSuccessResponse($data)
    {
        return [
            'error' => false,
            'data' => $data
        ];
    }

    public static function buildErrorResponse($data)
    {
        return [
            'error' => true,
            'data' => $data
        ];
    }

    public static function buildValidationErrorResponse($errors)
    {
        return [
            'error' => true,
            'validationError' => true,
            'data' => $errors
        ];
    }
}
