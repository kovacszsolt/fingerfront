<?php
namespace model\newsrss\language;

/**
 * News RSS Language Record Class
 * @package model\newsrss\language
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

	/**
	 * SEO URL
	 * @var string
	 */
	protected $a_url;

	/**
	 * SEO URL id
	 * @var integer
	 */
	protected $a_urlid;

}
