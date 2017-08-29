<?php
namespace model\frontusers\content;

use finger\random as random;

/**
 * Class record
 * @package model\frontusers\content
 */
class record extends \finger\model\record
{
	protected $className = __CLASS__;
	protected $a_email = '';
	protected $a_password = '';
	protected $a_status = 0;
	protected $a_regkey = '';

	private $STATUS_DENIED = 0;
	private $STATUS_UPLOADER = 1;
	private $STATUS_TRUSTED = 2;

	/**
	 * Set Password
	 * @param $value
	 * @param bool $encode
	 */
	public function setPassword($value, $encode = true)
	{
		if ($value != '') {
			$this->a_password = ($encode) ? md5($value) : $value;
		}
	}

	/**
	 * Create Reg Key
	 * hash
	 * @return string
	 */
	public function createKey()
	{
		$_key = random::hash(10);
		$this->setRegkey($_key);
		return $_key;
	}

	/**
	 * Status Name
	 * @return string
	 */
	public function getStatusName()
	{
		$_return = '';
		switch ($this->getStatus()) {
			case $this->STATUS_DENIED:
				$_return = 'Tiltott';
				break;
			case $this->STATUS_UPLOADER:
				$_return = 'Felöltő';
				break;
			case $this->STATUS_TRUSTED:
				$_return = 'Megbízható';
				break;
		}
		return $_return;
	}


}