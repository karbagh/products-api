<?php

namespace App\Services\Auth;

use App\Dtoes\Auth\LoginRequestDto;
use App\Dtoes\Auth\ResetPasswordRequestDto;
use App\Dtoes\Auth\Subscription\CreateSubscriptionRequestDto;
use App\Dtoes\Auth\UserRegisterRequestDto;
use App\Dtoes\Auth\UserRegisterResponseDto;
use App\Dtoes\Product\Favorites\CreateFavoritesProductsRequestDto;
use App\Http\Resources\Users\UserResource;
use App\Interfaces\Auth\AuthenticableInterface;
use App\Mail\Auth\ResetPassword;
use App\Models\User;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

    public function sendResetEmail(string $email): void
    {
        $token = Str::random(60);

        $this->repository->createPasswordReset($token, $email);

        Mail::to($email)->send(new ResetPassword($token));
    }

    public function resetPassword(ResetPasswordRequestDto $dto): User
    {
        return $this->repository->resetPassword($dto->getToken(), $dto->getPassword());
    }
}
