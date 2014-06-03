<?php
namespace PhpRbac;

use \Jf;

require_once __DIR__."/core/lib/rbac.php";

/**
 * @file
 * Provides NIST Level 2 Standard Role Based Access Control functionality
 *
 * @defgroup phprbac Rbac Functionality
 * @{
 * Documentation for all PhpRbac related functionality.
 */
class Rbac
{
    public function __construct($db_adapter, $table_prefix, $unit_test='')
    {
        if ((string) $unit_test === 'unit_test') {
            require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
        }

        require_once 'core/lib/Jf.php';

        Jf::setTablePrefix($table_prefix);
        Jf::$Rbac=new \RbacManager();

	Jf::$Db = $db_adapter;

        $this->Permissions = Jf::$Rbac->Permissions;
        $this->Roles = Jf::$Rbac->Roles;
        $this->Users = Jf::$Rbac->Users;
    }

    public function assign($role, $permission)
    {
        return Jf::$Rbac->assign($role, $permission);
    }

    public function check($permission, $user_id)
    {
        return Jf::$Rbac->check($permission, $user_id);
    }

    public function enforce($permission, $user_id)
    {
        return Jf::$Rbac->enforce($permission, $user_id);
    }

    public function reset($ensure = false)
    {
        return Jf::$Rbac->reset($ensure);
    }

    public function tablePrefix()
    {
        return Jf::$Rbac->tablePrefix();
    }
}

/** @} */ // End group phprbac */
