<?php

namespace model\system;
use \finger\storage as Storage;
class tables extends \finger\database\mysql
{

    private function getTables()
    {
        $_prepare = $this->prepare('SHOW TABLES');
        $_prepare->execute();
        $_tables = $_prepare->fetchAll(\PDO::FETCH_COLUMN);
        return $_tables;
    }


    public function findTable($tableName)
    {
        $_return = false;
        if (in_array($tableName, $this->getTables())) {
            $_return = true;
        }
        return $_return;
    }
}
