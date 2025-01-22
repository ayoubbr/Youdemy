<?php
namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct()
    {
        $this->roleRepository = new RoleRepository();
    }

    public function getRoleByName(string $name)
    {
        if (empty($name)) {
            return false;
        }
        
        $role = $this->roleRepository->findByName($name);

        return $role;
    }

    public function getRoleById(int $id): Role
    {
        if (empty($id)) {
            return false;
        }

        $role = $this->roleRepository->findById($id);
        
        return $role;
    }

    public function create(Role $role):Role{
        return $this->roleRepository->create($role);
    }
}
