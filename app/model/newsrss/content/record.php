<?php

namespace model\newsrss\content;

/**
 * Item record Class record
 * @package model\item\content
 */
class record extends \finger\model\record {
	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;

	/**
	 * Feautured
	 * @var int
	 */
	protected $a_typeid;

	/**
	 * Title from Language
	 * @var string
	 */
	protected $a_title;

	/**
	 * Intro from Language
	 * @var string
	 */
	protected $a_intro;

	protected $a_link;
	protected $a_url;
	protected $a_status;

	protected $a_urlid;

	private $b_title;
	private $b_intro;
	private $b_url;

	public $_statusTitle = array(
		- 1 => 'Feldolgozásra vár',
		0   => 'Inaktív',
		1   => 'Aktív'
	);

	public function getTypeTitle() {
		return $this->b_title;
	}

	public function getTypeUrl() {
		return $this->b_url;
	}

	public function getStatusTitle() {
		$_return = $this->_statusTitle[ $this->getStatus() ];

		return $_return;
	}

	public function getImage() {
		$_return = '';
		$_images = $this->getImages();
		if ( is_array( $_images ) ) {
			$_image    = $_images[0];
			$_fileName = $_image->getId() . '.' . $_image->getExtension();
			if ( \finger\storage::isExitsFile( 'newsrss/' . $_fileName ) ) {
				$_return = $_fileName;
			}
		}

		return $_return;
	}

}
