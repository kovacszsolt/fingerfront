<?php

namespace model\frontusers\content;

use \model\users\content\record as userRecord;
use \model\users\content\table as userTable;

class table extends \finger\database\main
{


	public $tableName = 'frontusers';

	public $className = __CLASS__;
	protected $_export_tables = array(
		'frontusers'

	);
	public $fields = array(
		'title' => array('type' => 'varchar(200)'),
		'email' => array('type' => 'varchar(200)'),
		'password' => array('type' => 'varchar(200)'),
		'regkey' => array('type' => 'varchar(200)'),
		'status' => array('type' => 'int(10)')
	);

	public function login($email, $password)
	{
		$this->addWhere('email', $email);
		$this->addWhere('password', md5($password));
		$_return = $this->query();
		if (is_array($_return)) {
			$_return = $_return[0];
		}
		return $_return;
	}

	public function findEmail($email)
	{
		$this->addWhere('email', $email);
		$_return = $this->query();
		if (is_array($_return)) {
			$_return = $_return[0];
		}
		return $_return;
	}

	public function findKey($key)
	{
		$this->addWhere('regkey', $key);
		$_return = $this->query();
		if (is_array($_return)) {
			$_return = $_return[0];
		}
		return $_return;
	}

}
