<?php

namespace model\system\module;

class table extends \finger\database\main
{


    public $tableName = 'systemmodule';

    public $className = __CLASS__;

    public $fields = array(
        'title' => array('type' => 'varchar(200)'),
        'class' => array('type' => 'varchar(200)'),
        'menu' => array('type' => 'text'),
        'status' => array('type' => 'int(10)'),
    );

    public function isOpenClass($className)
    {
        $_return = false;
        $this->addWhere('class', $className);
        $_record = $this->query();
        if (!is_null($_record)) {
            $_return = true;
        }
        return $_return;
    }
}
