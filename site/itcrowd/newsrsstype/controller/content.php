<?php

namespace site\itcrowd\newsrsstype\controller;

use model\newsrss\content\table as newsrssContentTable;

/**
 * News Types
 * @package site\itcrowd\newsrsstype\controller
 */
class content extends \site\itcrowd\main {

	/**
	 * List type news
	 */
	public function indexGet() {
		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->findTypeActive( (integer) $this->_params[1] );
		$this->view->addValue( 'newsrssContentRecords', $_newsrssContentRecords );
		// set OG tag
		if ( is_array( $_newsrssContentRecords ) ) {
			$this->view->page_title = $this->settings['social']['pagetitle'] . ' - ' . $_newsrssContentRecords[0]->getTypeTitle();
		}
		$this->render();
	}


}