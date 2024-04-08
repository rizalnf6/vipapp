<?php

use App\Enums\Roles;
use App\Models\User;

function getUser(): User
{
    return auth()->user();
}

function isSuperAdmin(): bool
{
    return  getUser()->hasRole(Roles::SUPER_ADMIN);
}
