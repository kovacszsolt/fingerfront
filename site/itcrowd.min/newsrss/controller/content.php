<?php

namespace site\itcrowd\newsrss\controller;

use model\newsrss\content\table as newsrssContentTable;

/**
 * News Content
 * @package site\itcrowd\newsrss\controller
 */
class content extends \site\itcrowd\main {

	/**
	 * Show one item
	 */
	public function indexGet() {
		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->findActive((int) $this->_params[1] );
		$this->view->addValue( 'newsrssContentRecords', $_newsrssContentRecords );
		// OG tags
		$this->view->page_title           = $this->settings['social']['pagetitle'] . ' - ' . $_newsrssContentRecords->getTitle();
		$this->view->facebook_description = $_newsrssContentRecords->getIntro();
		$_image                           = $_newsrssContentRecords->getImage();
		if ( $_image != '' ) {
			$this->view->facebook_image = '/itcrowd/root/index/read/newsrss/' . $_image;
		}
		$this->render();
	}


}