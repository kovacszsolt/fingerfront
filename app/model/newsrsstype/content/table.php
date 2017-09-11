<?php
namespace model\newsrsstype\content;

/**
 * News RSS Type Content Table Class
 * @package model\newsrsstype\content
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

	/**
	 * Find by Title
	 * @param string $title
	 *
	 * @return array|null
	 */
	public function findTitle(string $title)
	{
		$this->addWhere('title', $title);
		$_return = $this->query();
		return $_return;
	}

	/**
	 * Find by URL
	 * @param string $url
	 *
	 * @return array|null
	 */
	public function findUrl(string $url)
	{
		$this->addWhere('url', $url);
		$_return = $this->query();
		return $_return;
	}

}
