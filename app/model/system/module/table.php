<?php

namespace model\system\module;

/**
 * System Module Table Class
 * @package model\system\module
 */
class table extends \finger\database\main {

	/**
	 * Table name
	 * @var string
	 */
	public $tableName = 'systemmodule';

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
		'title'  => array( 'type' => 'varchar(200)' ),
		'class'  => array( 'type' => 'varchar(200)' ),
		'menu'   => array( 'type' => 'text' ),
		'status' => array( 'type' => 'int(10)' ),
	);

	/**
	 * Find by Class
	 * @param string $className
	 *
	 * @return bool
	 */
	public function isOpenClass( string $className ) {
		$_return = false;
		$this->addWhere( 'class', $className );
		$_record = $this->query();
		if ( ! is_null( $_record ) ) {
			$_return = true;
		}

		return $_return;
	}
}
