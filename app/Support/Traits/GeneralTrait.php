<?php

namespace App\Support\Traits;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait GeneralTrait
{
    public function returnError($message, $code): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ], $code);
    }

    public function returnSuccessMessage($message = ""): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message
        ],Response::HTTP_OK);

    }

    public function returnDate($value, $message): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'Data' => $value
        ], Response::HTTP_OK);
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->returnError($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
