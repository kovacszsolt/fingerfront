<?php
namespace model\newsrss\language;

/**
 * Item language Class table
 * @package model\item\language
 */
class table extends \finger\model\language
{
    /**
     * Table name
     * @var string
     */
    public $tableName = 'newsrsslanguage';

    /**
     * @var string
     */
    protected $className = __CLASS__;

    /**
     * Database fields
     * @var array
     */
    public $fields = array(
        'title' => array('type' => 'varchar(200)'),
        'intro' => array('type' => 'longtext'),
	    'url' => array('type' => 'varchar(200)'),
	    'urlid' => array('type' => 'int(10)'),
    );

}
