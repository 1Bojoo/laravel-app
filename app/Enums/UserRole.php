<?php

namespace App\Enums;

class UserRole{
    const ADMIN = 'admin';
    const STUDENT = 'student';
    const GUEST = 'guest';

    const TYPES = [
        self::ADMIN,
        self::STUDENT,
        self::GUEST,
    ];
}