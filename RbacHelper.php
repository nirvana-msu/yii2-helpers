<?php
/**
 * @link https://github.com/nirvana-msu/yii2-helpers
 * @copyright Copyright (c) 2016 Alexander Stepanov
 * @license MIT
 */

namespace nirvana\helpers;

use Yii;
use yii\rbac\Permission;
use yii\rbac\Role;

/**
 * RbacHelper provides convenient shortcut methods for working with RBAC system
 *
 * @author Alexander Stepanov <student_vmk@mail.ru>
 */
class RbacHelper
{
    /**
     * Creates role with a given name and description and adds it to RBAC system.
     * @param string $name
     * @param string $description
     * @return Role
     */
    public static function createRole($name, $description)
    {
        // Create role with a given name and description and add it to RBAC system
        $auth = Yii::$app->authManager;
        $role = $auth->createRole($name);
        $role->description = $description;
        $auth->add($role);

        return $role;
    }

    /**
     * Creates permission with a given name and description and adds it to RBAC system,
     * assigning permission to the role.
     * @param Role $role
     * @param string $name
     * @param string $description
     * @return Permission
     */
    public static function createChildPermission($role, $name, $description)
    {
        // Create permission with a given name and description and add it to RBAC system
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission($name);
        $permission->description = $description;
        $auth->add($permission);

        // Add this permission to a given role
        $auth->addChild($role, $permission);

        return $permission;
    }

    /**
     * Removes rule from RBAC system by name.
     * @param string $name
     * @return boolean whether the rule is successfully removed
     */
    public static function removeRuleByName($name)
    {
        $auth = Yii::$app->authManager;
        $rule = $auth->getRule($name);
        return $auth->remove($rule);
    }

    /**
     * Removes permission from RBAC system by name.
     * @param string $name
     * @return boolean whether the permission is successfully removed
     */
    public static function removePermissionByName($name)
    {
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($name);
        return $auth->remove($permission);
    }

    /**
     * Removes role from RBAC system by name.
     * @param string $name
     * @return boolean whether the role is successfully removed
     */
    public static function removeRoleByName($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        return $auth->remove($role);
    }
}
