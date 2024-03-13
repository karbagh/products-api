<?php

namespace App\Services\Users;

use App\Dtoes\Users\Settings\ChangePasswordRequestDto;
use App\Dtoes\Users\Settings\UpdateUsersSettingsRequestDto;
use App\Exceptions\Http\ValidationHttpException;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    public function __construct(
        private readonly UserRepository $repository
    )
    {
    }

    public function update(UpdateUsersSettingsRequestDto $dto): User
    {
        return $this->repository->update(
            $dto->getFirstName(),
            $dto->getLastName(),
            $dto->getEmail(),
            Auth::user()
        );
    }

    public function changePassword(ChangePasswordRequestDto $dto): void
    {
        $user = Auth::user();
        if (!Hash::check($dto->getPassword(), $user->password)) {
            throw new ValidationHttpException(trans('validation.username.exists.false'));
        }
        $this->repository->updatePassword($dto->getNewPassword(), $user);
    }
}
