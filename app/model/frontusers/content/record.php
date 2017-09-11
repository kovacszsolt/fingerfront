<?php

namespace model\frontusers\content;

use finger\random as random;

/**
 * Front User Content Record Class
 * @package model\frontusers\content
 */
class record extends \finger\model\record {

	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;

	/**
	 * e-mail address
	 * @var string
	 */
	protected $a_email = '';

	/**
	 * Password
	 * not return
	 * @var string
	 */
	protected $a_password = '';

	/**
	 * User Status
	 * @var integer
	 */
	protected $a_status = 0;

	/**
	 * Registration and Password recreate Key
	 * @var string
	 */
	protected $a_regkey = '';

	/**
	 * Status Denied
	 * not enabled login
	 * @var int
	 */
	private $STATUS_DENIED = 0;

	/**
	 * Status Uploader
	 * not activate the news
	 * @var int
	 */
	private $STATUS_UPLOADER = 1;

	/**
	 * Status Trusted
	 * automation activated the news
	 * @var int
	 */
	private $STATUS_TRUSTED = 2;

	/**
	 * Set Password
	 * @param string $value
	 * @param bool $encode if not then plain text stored
	 */
	public function setPassword( string $value, bool $encode = true ) {
		if ( $value != '' ) {
			$this->a_password = ( $encode ) ? md5( $value ) : $value;
		}
	}

	/**
	 * Create Hash Key
	 * @return string
	 */
	public function createKey() {
		$_key = random::hash( 10 );
		$this->setRegkey( $_key );

		return $_key;
	}

	/**
	 * Get Status Title
	 * @return string
	 */
	public function getStatusName() {
		$_return = '';
		switch ( $this->getStatus() ) {
			case $this->STATUS_DENIED:
				$_return = 'Tiltott';
				break;
			case $this->STATUS_UPLOADER:
				$_return = 'Felöltő';
				break;
			case $this->STATUS_TRUSTED:
				$_return = 'Megbízható';
				break;
		}

		return $_return;
	}

	/**
	 * Get the Soical Facebook Data
	 * @return array|mixed|null
	 */
	public function getSociailFacebook() {
		$_socailTable  = new \model\frontusers\social\table();
		$_socailRecord = $_socailTable->findUserFacebookId( $this->getId() );

		return $_socailRecord;
	}


}