<?php

namespace model\web\content;

/**
 * Web Content Record Class
 * @package model\web\content
 */
class record extends \finger\model\record
{
    protected $className = __CLASS__;


    private $a_description;
    private $a_keywords;
    private $a_author;
    private $a_company;


    public function setCompany($value)
    {
        $this->a_company = $value;
    }

    public function getCompany()
    {
        return $this->a_company;
    }

    public function setDescription($value)
    {
        $this->a_description = $value;
    }

    public function getDescription()
    {
        return $this->a_description;
    }

    public function setKeywords($value)
    {
        $this->a_keywords = $value;
    }

    public function getKeywords()
    {
        return $this->a_keywords;
    }

    public function setAuthor($value)
    {
        $this->a_author = $value;
    }

    public function getAuthor()
    {
        return $this->a_author;
    }
}