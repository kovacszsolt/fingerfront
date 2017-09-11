<?php

namespace model\system;

/**
 * System Table Class
 * @package model\system
 */
class tables extends \finger\database\mysql
{

	/**
	 * Get all tables form database
	 * @return array
	 */
    private function getTables()
    {
        $_prepare = $this->prepare('SHOW TABLES');
        $_prepare->execute();
        $_tables = $_prepare->fetchAll(\PDO::FETCH_COLUMN);
        return $_tables;
    }

	/**
	 * Check table in current Database
	 * @param string $tableName
	 *
	 * @return bool
	 */
    public function findTable(string $tableName)
    {
        $_return = false;
        if (in_array($tableName, $this->getTables())) {
            $_return = true;
        }
        return $_return;
    }
}
