<?php
namespace model\newsrsstype\image;

/**
 * ews RSS Type Image Table Class
 * @package model\newsrsstype\image
 */
class table extends \finger\model\image
{
    /**
     * Table name
     * @var string
     */
    public $tableName = 'newsrsstypeimage';

    /**
     * @var string
     */
    public $className = __CLASS__;

    /**
     * Image folder name
     * @var string
     */
    protected $path='newsrsstype';

}