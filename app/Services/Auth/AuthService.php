<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Dtoes\Auth\LoginRequestDto;
use App\Repositories\Auth\AuthRepository;
use App\Dtoes\Auth\UserRegisterRequestDto;
use App\Dtoes\Auth\UserRegisterResponseDto;
use App\Interfaces\Auth\AuthenticableInterface;
use App\Dtoes\Auth\Subscription\CreateSubscriptionRequestDto;

class AuthService
{
    public function __construct(
        private AuthRepository $repository
    )
    {
    }

    public function login(LoginRequestDto $dto, AuthenticableInterface $authenticable): string
    {
        $user = $authenticable->findAuthenticable($dto->getUsername());
        return $this->repository->login($user, $dto->getPassword(), $dto->getRecognizer())->plainTextToken;
    }

    public function register(UserRegisterRequestDto $dto): UserRegisterResponseDto
    {
        $user = $this->repository->register(
            $dto->getFirstName(),
            $dto->getLastName(),
            $dto->getEmail(),
            $dto->getPhone(),
            $dto->getPassword(),
        );

        return new UserRegisterResponseDto(
            $user->createToken($dto->getRecognizer())->plainTextToken,
            $user->load('role'),
        );
    }

    public function subscribe(CreateSubscriptionRequestDto $dto): void
    {
        $this->repository->subscribe($dto->getEmail(), $dto->getIp());
    }

    public function verify(User $user, string $token): bool
    {
        return $this->repository->verify($user, $token);
    }
}
