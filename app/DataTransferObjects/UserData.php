<?php

namespace App\DataTransferObjects;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

/** @typescript */
class UserData extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $created_at;

    public static function from(User $user): self
    {
        return new static([
            'name' => $user->name,
            'email' => $user->email,
            'created_at' => $user->created_at,
        ]);
    }
}
