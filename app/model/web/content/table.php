<?php

namespace model\web\content;

class table extends \finger\database\main
{


    public $tableName = 'web';

    public $className = __CLASS__;

    protected $_export_tables = array(
        'web',
    );
    public $fields = array(
        'title' => array('type' => 'varchar(200)'),
        'company' => array('type' => 'varchar(200)'),
        'description' => array('type' => 'varchar(200)'),
        'keywords' => array('type' => 'varchar(200)'),
        'author' => array('type' => 'varchar(200)'),
    );


}
