<?php
namespace model\newsrsstype\language;

use \model\web\url\table as urlTable;
use \model\web\url\record as urlRecord;
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
