<?php

namespace site\itcrowd\secure\controller;

use model\newsrss\content\table as newsrssContentTable;
use finger\request as request;


class index extends \site\itcrowd\main {


	public function indexGet() {

		$this->render();
	}

	public function accessdeniedGet() {
		$this->render();
	}

}