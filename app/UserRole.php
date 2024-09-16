<?php

namespace App;

enum UserRole: string
{
    case Student = 'student';
    case Teacher = 'teacher';
    case Admin = 'admin';


    public static function values(): array
    {
        return array_map(fn($role) => $role->value, self::cases());
    }
}
