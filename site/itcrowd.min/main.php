<?php

namespace site\itcrowd;

use model\newsrsstype\content\table as newsrsstypeContentTable;
use finger\request as request;
use finger\storage as storage;
use finger\session as session;

/**
 * Main frontend Class
 * @package site\itcrowd
 */
class main extends \finger\controller\front {

	/**
	 * Current user
	 * @var null
	 */
	protected $currentUser = null;

	/**
	 * main constructor.
	 */
	public function __construct() {
		parent::__construct();
		$_newsrsstypeContentTable   = new newsrsstypeContentTable();
		$_newsrsstypeContentRecords = $_newsrsstypeContentTable->query();
		$this->view->addValue( 'newsrsstypeContentRecords', $_newsrsstypeContentRecords );
		$this->currentUser = session::get( 'frontuser', null );
		$this->view->addValue( 'currentuser', $this->currentUser );
		// set default OG Tags from ini File
		$this->view->page_title           = $this->settings['social']['pagetitle'];
		$this->view->facebook_pages       = $this->settings['social']['facebookpages'];
		$this->view->facebook_appid       = $this->settings['social']['facebookpappid'];
		$this->view->facebook_type        = $this->settings['social']['facebooktype'];
		$this->view->facebook_description = $this->settings['social']['facebookdescription'];
		$this->view->facebook_image       = $this->settings['social']['defaultimage'];
		$this->init();

	}

	/**
	 * Inicalization
	 */
	public function init() {
	}

	/**
	 * Read file from Storage
	 */
	public function readGet() {
		$_params = request::get( '_params' );
		storage::getFile( $_params[0] . '/' . $_params[1] . '/' . $_params[2] );
	}

}