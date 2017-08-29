<?php

namespace model\rss\content;

use \finger\convert as convert;

/**
 * Item record Class record
 * @package model\item\content
 */
class record extends \finger\model\record
{
	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;


	protected $a_domain;
	protected $a_url;
	protected $a_convertutf8;

	protected $a_utf8;


}
