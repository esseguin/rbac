<?php
namespace PhpRbac;

use \Jf;

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
    public function __construct($unit_test = '', $db_config_params=null)
    {
        if (! is_null($db_config_params)) {
            if ($db_config_params['adapter'] instanceof \PDO) {
                $adapter = $db_config_params['adapter'];
            } else {
                foreach (array('adapter', 'host', 'user', 'pass', 'dbname') as $db_config_param) {
                    $$db_config_param = (string) $db_config_params[$db_config_param];
                }
            }

            $tablePrefix = (string) $db_config_params['tablePrefix'];
        } else if ((string) $unit_test === 'unit_test') {
            require_once dirname(dirname(__DIR__)) . '/tests/database/database.config';
        } else {
            require_once dirname(dirname(__DIR__)) . '/database/database.config';
        }

        require_once 'core/lib/Jf.php';

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
