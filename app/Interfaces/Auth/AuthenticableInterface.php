<?php

namespace App\Interfaces\Auth;

use App\Models\User;

interface AuthenticableInterface
{
    public function findAuthenticable(string $username): User;
}
