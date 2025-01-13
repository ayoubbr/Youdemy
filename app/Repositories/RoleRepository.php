<?php

namespace App\Repositories;

use App\Core\Database;
use App\DAOs\RoleDao;
use App\Models\Role;

class RoleRepository
{

    private RoleDao $roleDao;

    public function __construct()
    {
        $this->roleDao = new RoleDao();
    }

    public function findByName(string $name)
    {

        $query = "SELECT id, name, description, badge FROM roles WHERE name = '" . $name . "';";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        return $stmt->fetchObject(Role::class);
    }

    public function create(Role $role): Role
    {
        return $this->roleDao->create($role);
    }

    public function findById(int $id): Role
    {
        $query = "SELECT id, name, description, badge FROM roles WHERE id = " . $id . ";";
        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchObject(Role::class);
        return $result;
    }
}
