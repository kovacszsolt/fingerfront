<?php
namespace model\newsrsstype\content;

/**
 * Item Class table
 * @package model\item\content
 */
class table extends \finger\model\table {

    /**
     * Table name
     * @var string
     */
    public $tableName = 'newsrsstype';

    /**
     * Export tables
     * @var array
     */
    protected $_export_tables = array(
        'newsrsstype',
	    'newsrsstypeimage',
        'newsrsstypelanguage',
    );

    /**
     * this table
     * @var string
     */
    public $className = __CLASS__;

    /**
     * Table fields
     * @var array
     */
    public $fields = array(
        'title' => array('type' => 'varchar(200)'),
	    'urlid' => array('type' => 'int(10)'),
	    'url' => array('type' => 'varchar(200)'),
    );

	public function findTitle($title)
	{
		$this->addWhere('title', $title);
		$_return = $this->query();
		return $_return;
	}

	public function findUrl($url)
	{
		$this->addWhere('url', $url);
		$_return = $this->query();
		return $_return;
	}

}
