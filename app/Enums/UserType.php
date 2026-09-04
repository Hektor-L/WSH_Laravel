<?php

namespace App\Enums;

enum UserType: string
{
    case Common = 'common';
    case Worker = 'worker';
    case Employer = 'employer';
    case Staff = 'staff';
}
