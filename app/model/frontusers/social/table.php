<?php

namespace model\frontusers\social;

use \model\users\content\record as userRecord;
use \model\users\content\table as userTable;

class table extends \finger\database\main {


	public $tableName = 'frontuserssocial';

	public $className = __CLASS__;

	public $fields = array(
		'type'     => array( 'type' => 'varchar(200)' ),
		'socialid' => array( 'type' => 'varchar(200)' ),
		'userid'   => array( 'type' => 'int(10)' )
	);

	public function findFacebookId( $facebookId ) {
		$this->addWhere( 'type', 'facebook' );
		$this->addWhere( 'socialid', $facebookId );
		$_return = $this->query();
		if ( is_array( $_return ) ) {
			$_return = $_return[0];
		}

		return $_return;
	}

	public function findUserFacebookId( $userId ) {
		$this->addWhere( 'type', 'facebook' );
		$this->addWhere( 'userid', $userId );
		$_return = $this->query();
		if ( is_array( $_return ) ) {
			$_return = $_return[0];
		}

		return $_return;
	}


}
