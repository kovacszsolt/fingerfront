<?php

namespace model\rss\content;

/**
 * RSS Feed Content Record Class
 * @package model\rss\content
 */
class record extends \finger\model\record
{
	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;

	/**
	 * Domain name
	 * @var string
	 */
	protected $a_domain;

	/**
	 * Domain URL
	 * @var string
	 */
	protected $a_url;

	/**
	 *Convert to UTF8
	 * 1: yes
	 * 0: no
	 * @var integer
	 */
	protected $a_utf8;


}
