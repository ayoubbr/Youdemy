<?php

namespace App\Controllers;

use App\Models\Role;
use App\Services\RoleService;

class RoleController
{
    private RoleService $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    public function create(Role $role)
    {
        return $this->roleService->create($role);
    }
}
