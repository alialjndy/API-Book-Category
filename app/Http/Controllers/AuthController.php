<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthUserRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Service\UserService;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller implements \Illuminate\Routing\Controllers\HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(middleware:'auth:api',except:['login','register']),
        ];
    }
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware();
        $this->userService = $userService;
    }
    /**
     * Summary of register
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(AuthUserRequest $authUserRequest){
        $validatedData = $authUserRequest->validated();
        $user = $this->userService->createUser($validatedData);
        return Response::api('success','user created successfully',$user , 201);
    }
    /**
     * Summary of login
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest){
        $validatedData = $loginRequest->validated();
        $token = $this->userService->login($validatedData);
        return Response::api('success','user logged in successfully',$token , 200);
    }
    /**
     * Summary of me
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function me(){
        $user =  $this->userService->me();
        return Response::api('success','My Info',[$user->name, $user->email] , 200);
    }
    /**
     * Summary of logout
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->userService->logout();
        return Response::api('success','user logged out successfully',[],200);
    }
}
