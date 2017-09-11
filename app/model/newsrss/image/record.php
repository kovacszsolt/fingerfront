<?php
namespace model\newsrss\image;

/**
 * News RSS Image Record Class
 * @package model\newsrss\image
 */
class record extends \finger\model\imagerecord {

    /**
     * save folder name
     * @var string
     */
    protected $path='newsrss';
    public $className = __CLASS__;

}