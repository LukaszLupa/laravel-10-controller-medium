<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\CreateUserDto;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        public readonly UserService $userService
    ) {
    }

    public function store(CreateUserRequest $request): UserResource
    {
        $user = $this->userService->create(
            new CreateUserDto(
                email: $request->input('email'),
                name: $request->input('name'),
                password: $request->input('password')
            )
        );

        return UserResource::make($user);
    }
}