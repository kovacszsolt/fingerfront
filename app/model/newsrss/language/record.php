<?php
namespace model\newsrss\language;

/**
 * Item language Class record
 * @package model\item\language
 */
class record extends \finger\model\languagerecord
{
    /**
     * @var string
     */
    protected $className = __CLASS__;

    /**
     * Title
     * @var string
     */
    protected $a_title;

    /**
     * Intro
     * @var string
     */
    protected $a_intro;
	protected $a_url;

	protected $a_urlid;

}
