<?php

namespace site\itcrowd\secure;

use finger\request as request;
use finger\session as session;
use finger\config as config;
use model\frontusers\content\record as frontusersContentRecord;


class main extends \site\itcrowd\main {

	public function __construct() {
		parent::__construct();
		$this->checkSecure();
	}

	private function checkSecure() {
		$_secureConfig = new config( 'secure' );
		$_key          = $this->_controller . '_' . $this->_action . '_' . $this->_method;
		$_enabled      = $_secureConfig->get( 'login.' . $_key, 0 );
		if ( $_enabled == 1 ) {
			$_frontuser= $this->session->getValue('frontuser') ;
			if (!($_frontuser  instanceof frontusersContentRecord  )) {
				header('Location: /hozzaferesmegtagadva/');die();
			}
		}

	}

}