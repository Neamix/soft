<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Service\User\AuthenticationService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $authenticationService;
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login (LoginRequest $request)
    {
        $response = $this->authenticationService->login($request);
        return [
            'status'  => $response['status'],
            'message' => $response['message'],
            'user' => (isset($response['user'])) ? new UserResource($response['user']) : []
        ];
    }
}
