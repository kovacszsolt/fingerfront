<?php

namespace model\web\url;

/**
 * SEO URL Table Class
 * @package model\web\url
 */
class table extends \finger\database\main
{

	/**
	 * Table name
	 * @var string
	 */
    public $tableName = 'url';

	/**
	 * this table
	 * @var string
	 */
    public $className = __CLASS__;

	/**
	 * Export tables
	 * @var array
	 */
    protected $_export_tables = array(
        'web',
    );

	/**
	 * Table fields
	 * @var array
	 */
    public $fields = array(
        'url' => array('type' => 'varchar(200)'),
        'method' => array('type' => 'varchar(200)'),
    );

	/**
	 * Find via SEO URL
	 * @param string $url
	 *
	 * @return array|null
	 */
	public function findURL(string $url)
	{
		$this->addWhere('url', $url);
		return $this->query();
	}
}
