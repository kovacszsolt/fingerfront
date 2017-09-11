<?php

namespace model\frontusers\content;

/**
 * Front User Content Table Class
 * @package model\frontusers\content
 */
class table extends \finger\database\main {

	/**
	 * Table name
	 * @var string
	 */
	public $tableName = 'frontusers';

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
		'frontusers'

	);

	/**
	 * Table fields
	 * @var array
	 */
	public $fields = array(
		'title'    => array( 'type' => 'varchar(200)' ),
		'email'    => array( 'type' => 'varchar(200)' ),
		'password' => array( 'type' => 'varchar(200)' ),
		'regkey'   => array( 'type' => 'varchar(200)' ),
		'status'   => array( 'type' => 'int(10)' )
	);

	/**
	 * Login Process
	 * Check email and password
	 *
	 * @param string $email
	 * @param string $password
	 *
	 * @return array|mixed|null
	 */
	public function login( string $email, string $password ) {
		$this->addWhere( 'email', $email );
		$this->addWhere( 'password', md5( $password ) );
		$_return = $this->query();
		if ( is_array( $_return ) ) {
			$_return = $_return[0];
		}

		return $_return;
	}

	/**
	 * Find user via e-mail address
	 *
	 * @param string $email
	 *
	 * @return array|mixed|null
	 */
	public function findEmail( string $email ) {
		$this->addWhere( 'email', $email );
		$_return = $this->query();
		if ( is_array( $_return ) ) {
			$_return = $_return[0];
		}

		return $_return;
	}

	/**
	 * Find user via Key
	 *
	 * @param string $key
	 *
	 * @return array|mixed|null
	 */
	public function findKey( string $key ) {
		$this->addWhere( 'regkey', $key );
		$_return = $this->query();
		if ( is_array( $_return ) ) {
			$_return = $_return[0];
		}

		return $_return;
	}

}
