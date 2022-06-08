<?php

namespace App\DataTransferObjects;

use Inertia\Inertia;

/** @typescript */
class FrontendState
{
    public ?UserData $user;

    public static function share(string $key, mixed $value = null): void
    {
        app(static::class)->{$key} = $value;

        Inertia::share($key, $value);
    }

    public static function setUp(array $properties): void
    {
        foreach ($properties as $key => $value) {
            static::share($key, $value);
        }
    }
}
