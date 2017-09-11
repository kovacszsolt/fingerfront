<?php

namespace model\newsrsstype\content;

/**
 * News RSS Type Content Record Class
 * @package model\newsrsstype\content
 */
class record extends \finger\model\record {
	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;


	/**
	 * Title from Language
	 * @var string
	 */
	protected $a_title;

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
