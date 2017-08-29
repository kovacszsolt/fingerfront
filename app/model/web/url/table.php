<?php

namespace model\web\url;

class table extends \finger\database\main
{


    public $tableName = 'url';

    public $className = __CLASS__;

    protected $_export_tables = array(
        'web',
    );
    public $fields = array(
        'url' => array('type' => 'varchar(200)'),
        'method' => array('type' => 'varchar(200)'),
    );

	public function findURL($url)
	{
		$this->addWhere('url', $url);
		return $this->query();
	}
}
