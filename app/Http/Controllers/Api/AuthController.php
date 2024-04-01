<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Support\Traits\GeneralTrait;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\{
    AuthRequest,
    RegisterRequest
};


class AuthController extends Controller
{
    use GeneralTrait;

    private  AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService=$authService;
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = $this->authService->login($credentials);
        if (!$token)
            return $this->returnError('Incorrect Email or password', Response::HTTP_PRECONDITION_FAILED);

        $data = $this->authService->createToken($token);
        $data['user'] = new UserResource(auth('api')->user());
        return $this->returnDate( $data, 'User Login Successfully');

    }

    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $registerRequest['password'] = Hash::make($registerRequest->password);
        $user=$this->authService->register($registerRequest->all());

        return $this->returnSuccessMessage('User Register Successfully');
    }

}
