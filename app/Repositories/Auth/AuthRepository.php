<?php

namespace App\Repositories\Auth;

use App\Models\Role;
use App\Models\Subscription;
use App\Repositories\AbstractRepository;
use App\Models\User;
use App\Models\Device;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Facades\Hash;

class AuthRepository extends AbstractRepository
{
    /**
     * @throws ValidationException
     */
    public function login(User $user, string $password, string $recognizer): NewAccessToken
    {
        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => trans('validation.username.exists.false')
            ]);
        }

        return $user->createToken($recognizer);
    }

    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $phone,
        string $password,
    ): User
    {
        return User::query()->create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'password' => bcrypt($password),
            'role_id' => Role::query()->where('slug', 'user')->first()->id,
        ]);
    }

    public function subscribe(string $email, string $ip): void
    {
        Subscription::query()->create([
            'email' => $email,
            'ip' => $ip,
            'user_id' => Auth::id(),
        ]);
    }

    public function verify(User $user, string $token): bool
    {
        $hashedToken = $user->verifications()->whereNull('used_at')->latest()?->first()?->token;

        if ($response = Hash::check($token, $hashedToken)) {
            $user->verify();

            return $response;
        }

        throw new ValidationHttpException('Invalid token!');
    }

    public function createPasswordReset(string $token, string $email): bool
    {
        return DB::table('password_resets')->insert([
            'token' => $token,
            'email' => $email,
            'created_at' => now(),
        ]);
    }

    public function resetPassword(string $token, string $password): User
    {
        $resetQuery = DB::table('password_resets')->where('token', $token);
        $reset = $resetQuery->first();
        $user = User::query()->withTrashed()->where('email', $reset->email)->firstOrFail();

        $user->setAttribute('password', bcrypt($password))->save();
        $user->restore();
        $resetQuery->delete();

        return $user;
    }
}
