<?php

namespace site\itcrowd\newsrss\controller;

use finger\request as request;
use model\newsrss\content\table as newsrssContentTable;

class content extends \site\itcrowd\main {


	public function indexGet() {
		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->findActive( $this->_params[1] );
		$this->view->addValue( 'newsrssContentRecords', $_newsrssContentRecords );
		$this->view->page_title           = $this->settings['social']['pagetitle'] . ' - ' . $_newsrssContentRecords->getTitle();
		$this->view->facebook_description = $_newsrssContentRecords->getIntro();
		$_image                           = $_newsrssContentRecords->getImage();
		if ( $_image != '' ) {
			$this->view->facebook_image = '/itcrowd/root/index/read/newsrss/' . $_image;
		}
		$this->render();
	}

	public function allJson() {
		$_return=array();
		$_newsrssContentTable   = new newsrssContentTable();
		$_records=$_newsrssContentTable->queryActive();
		foreach ($_records as $_record) {
			$_return[]=array(
			'title'=>$_record->getTitle(),
			'intro'=>$_record->getIntro(),
			'type_title'=>$_record->getIntro(),
			);
		}
		echo json_encode($_return);exit;
	}


}