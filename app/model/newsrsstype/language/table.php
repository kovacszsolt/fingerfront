<?php
namespace model\newsrsstype\language;

/**
 * News RSS Type Language Table Class
 * @package model\newsrsstype\language
 */
class table extends \finger\model\language
{
    /**
     * Table name
     * @var string
     */
    public $tableName = 'newsrsstypelanguage';

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
	    'url' => array('type' => 'varchar(200)'),
	    'urlid' => array('type' => 'int(10)'),
    );




}
