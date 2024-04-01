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

    public function orders()
    {



        //Part 3: Query Refactoring
        $orders = \DB::table('orders')
            ->select('orders.id as order_id','orders.amount as order_cost','products.name as product_name','categories.name as category_name','order_items.quantity as saleQuantity')
            ->join('order_items','orders.id','=','order_items.order_id')
            ->join('products','order_items.product_id','=','products.id')
            ->join('categories','products.category_id','=','categories.id')
            ->where('categories.name','=','Electronics')
             ->whereDate('orders.created_at', '>', \Carbon\Carbon::now()->subDays(30))
            ->orderBy('orders.created_at','desc')
            ->limit(10)
            ->get();














    }

}
