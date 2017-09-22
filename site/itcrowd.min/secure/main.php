<?php

namespace site\itcrowd\secure;

use finger\social\facebook as facebook;
use finger\social\google as google;
use finger\config as config;
use finger\request;
use finger\server;
use finger\session as session;
use model\frontusers\content\record as frontusersContentRecord;

/**
 * Secure Page Main Class
 * @package site\itcrowd\secure
 */
class main extends \site\itcrowd\main {

	/**
	 * Facebook class
	 * @var
	 */
	protected $_facebookClass;
	protected $_googleClass;

	/**
	 * main constructor.
	 */
	public function __construct() {
		parent::__construct();
		// Check page enabled without logedin
		$this->checkSecure();
	}

	/**
	 * Inicialization
	 */
	public function init() {
		$_socialConfig = new config( 'social' );
		if ( in_array( request::getRouting(), explode( ';', $_socialConfig->get( 'facebook.pages', '' ) ) ) ) {
			$this->_facebookClass = new facebook();
		}
		if ( in_array( request::getRouting(), explode( ';', $_socialConfig->get( 'google.pages', '' ) ) ) ) {
			$this->_googleClass = new google();
		}
	}

	/**
	 * Check page enabled without logedin
	 * using secure.ini file
	 */
	private function checkSecure() {
		$_secureConfig = new config( 'secure' );
		$_key          = $this->_controller . '_' . $this->_action . '_' . $this->_method;
		$_enabled      = $_secureConfig->get( 'login.' . $_key, 0 );
		if ( $_enabled == 1 ) {
			$_frontuser = session::get( 'frontuser' );
			if ( ! ( $_frontuser instanceof frontusersContentRecord ) ) {
				request::redirect('/');
			}
		}

	}

}