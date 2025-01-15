<?php

namespace App\DAOs;

use App\Core\Database;
use App\Models\Role;

class RoleDao
{
    public function create(Role $role): Role
    {
        if (empty($role->getDescription()) || $role->getDescription() == null) {
            $role->setDescription("default Description");
        }

        if (empty($role->getBadge()) || $role->getBadge() == null) {
            $role->setBadge("Default badge");
        }

        $query = "INSERT INTO roles (name , description, badge) VALUES ( '" . $role->getName() . "', '" . $role->getDescription() . "', '" . $role->getBadge() . "');";

        $stmt = Database::getInstance()->getConnection()->prepare($query);
        $stmt->execute();

        $role->setId(Database::getInstance()
            ->getConnection()
            ->lastInsertId());

        return $role;
    }
}
