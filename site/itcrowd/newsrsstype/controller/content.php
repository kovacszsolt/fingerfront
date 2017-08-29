<?php

namespace site\itcrowd\newsrsstype\controller;

use model\newsrss\content\table as newsrssContentTable;
use finger\request as request;


class content extends \site\itcrowd\main {


	public function indexGet() {
		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->findTypeActive( (int) $this->_params[1] );
		$this->view->addValue( 'newsrssContentRecords', $_newsrssContentRecords );
		$this->view->page_title = $this->settings['social']['pagetitle'] . ' - ' . $_newsrssContentRecords[0]->getTypeTitle();
		$this->render();
	}


}