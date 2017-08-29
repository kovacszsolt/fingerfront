<?php
namespace model\newsrsstype\image;

/**
 * Item image Class table
 * @package model\item\image
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