<?php
namespace site\itcrowd\newsrss\controller;

use finger\request as request;


class index extends \finger\controller\front
{


    public function indexGet()
    {
    	$this->render();
    }

    public function tesztGet()
    {

        exit;

    }

    public function allimagesGet()
    {
        $this->session->setValue('returnURL', request::currentURL());
        $_facebookuserImageTable = new facebookuserImageTable();
        $_facebookuserImageTable->order = 'id DESC';
        $_facebookuserImageRecords = $_facebookuserImageTable->query();
        $this->view->addValue('facebookuserImageRecords', $_facebookuserImageRecords);
        $this->render();
    }

}