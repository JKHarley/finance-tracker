<?php

namespace App\DataTransferObjects;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

/** @typescript */
class UserData extends DataTransferObject
{
    public string $name;
    public string $email;

    public static function create(User $user): self
    {
        return new static([
            'name' => "{$user->first_name} {$user->last_name}",
            'email' => $user->email,
            'password' => bcrypt($user->password),
        ]);
    }

    public static function from(User $user): self
    {
        return new static([
            'name' => "{$user->first_name} {$user->last_name}",
            'email' => $user->email,
        ]);
    }
}
