<?php

namespace model\web\url;

/**
 * SEO URL Record Class
 * @package model\web\url
 */
class record extends \finger\model\record
{
	/**
	 * this Class
	 * @var string
	 */
    protected $className = __CLASS__;

	/**
	 * SEO URL
	 * @var string
	 */
    protected $a_url;

	/**
	 * System URL
	 * /module/controller/action/
	 * @var string
	 */
    protected $a_method;


}