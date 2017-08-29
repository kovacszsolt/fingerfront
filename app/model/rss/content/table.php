<?php

namespace model\rss\content;

/**
 * Item Class table
 * @package model\item\content
 */
class table extends \finger\model\table
{

	/**
	 * Table name
	 * @var string
	 */
	public $tableName = 'rss';

	/**
	 * Export tables
	 * @var array
	 */
	protected $_export_tables = array();

	/**
	 * this table
	 * @var string
	 */
	public $className = __CLASS__;

	/**
	 * Table fields
	 * @var array
	 */
	public $fields = array(
		'domain' => array('type' => 'varchar(200)'),
		'url' => array('type' => 'varchar(200)'),
		'utf8' => array('type' => 'int(10)'),
	);

	/**
	 * Find domain
	 * @param string $domain
	 * @return array|mixed|null
	 */
	public function findDomain(string $domain)
	{
		$this->addWhere('domain', $domain);
		$_return = $this->query();
		if (is_array($_return)) {
			$_return = $_return[0];
		}
		return $_return;
	}

}
