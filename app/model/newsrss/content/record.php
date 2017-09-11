<?php

namespace model\newsrss\content;

/**
 * News RSS Content Record Class
 * @package model\newsrss\content
 */
class record extends \finger\model\record {

	/**
	 * this Class
	 * @var string
	 */
	protected $className = __CLASS__;

	/**
	 * Type ID
	 * @var integer
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

	/**
	 * News Link
	 * @var string
	 */
	protected $a_link;

	/**
	 * SEO URL
	 * @var string
	 */
	protected $a_url;

	/**
	 * Status
	 * @var integer
	 */
	protected $a_status;

	/**
	 * SEO URL Id
	 * @var integer
	 */
	protected $a_urlid;

	/**
	 * Saved user id
	 * @var integer
	 */
	protected $a_frontuserid;

	/**
	 * Type Title
	 * @var string
	 */
	private $b_title;

	private $b_intro;

	/**
	 * Type SEO URL
	 * @var string
	 */
	private $b_url;

	/**
	 * Status Id Titles
	 * @var array
	 */
	public $_statusTitle = array(
		- 1 => 'Feldolgozásra vár',
		0   => 'Inaktív',
		1   => 'Aktív'
	);

	/**
	 * Get Type Title
	 * @return string
	 */
	public function getTypeTitle(): string {
		return $this->b_title;
	}

	/**
	 * Get Type URL
	 * @return string
	 */
	public function getTypeUrl(): string {
		return $this->b_url;
	}

	/**
	 * Get Status Title from array
	 * @return string
	 */
	public function getStatusTitle(): string {
		$_return = $this->_statusTitle[ $this->getStatus() ];

		return $_return;
	}

	/**
	 * Get Thumb Image
	 * @return string
	 */
	public function getImage(): string {
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
