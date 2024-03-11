<?php

namespace App\Repositories\User;

use App\Exceptions\Http\ValidationHttpException;
use App\Repositories\AbstractRepository;
use App\Interfaces\Auth\AuthenticableInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractRepository implements AuthenticableInterface
{

    public function findAuthenticable(string $username): User
    {
        $user = User::query()->where('email', $username)->orWhere('phone', $username);
        if ($user->doesntExist()) {
            throw new ValidationHttpException(trans('validation.username.exists.false'));
        }

        return $user->first();
    }

    public function removeFromFavorites(User $user, int $productId): bool
    {
        return $user->favorites()->detach($productId);
    }

    public function addFavorites(User $user, Collection $products): User
    {
        $user->favorites()->withTimestamps()->syncWithoutDetaching($products);

        return $user;
    }

    public function update(?string $firstName, ?string $lastName, ?string $email, ?string $phone, User $user): User
    {
        !$email ?: $user->unverify();
        $user->update([
            'first_name' => $firstName ?? $user->first_name,
            'last_name' => $lastName ?? $user->last_name,
            'email' => $email ?? $user->email,
            'phone' => $phone ?? $user->phone,
        ]);

        return $user;
    }

    public function updatePassword(string $password, User $user): void
    {
        $user->password = bcrypt($password);
        $user->save();
    }
}
