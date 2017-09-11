<?php

namespace model\system\module;

/**
 * System Module Record Class
 * @package model\system\module
 */
class record extends \finger\model\record
{
	/**
	 * this Class
	 * @var string
	 */
    protected $className = __CLASS__;

	/**
	 * Class Name
	 * @var string
	 */
    protected $a_class='';

	/**
	 * Status
	 * @var string
	 */
    protected $a_status='';

	/**
	 * Menu Title
	 * @var string
	 */
    protected $a_menu='';

	/**
	 * Check moduel enabled
	 * @return bool
	 */
    public function getEnabled()
    {
        $_return = false;
        if ($this->a_status == 1) {
            $_return = true;
        }
        return $_return;
    }

	/**
	 * Set Module enabled
	 * @param bool $value
	 */
    public function setEnabled(bool $value)
    {
        $this->a_status = 0;
        if ($value) {
            $this->a_status = 1;
        }
    }

	/**
	 * Set menus
	 * @param $value
	 */
    public function setMenu($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $this->a_menu = $value;
    }

	/**
	 * Get Menus
	 * @param bool $return_array
	 *
	 * @return mixed|string
	 */
    public function getMenu( bool $return_array = false)
    {
        $_return = $this->a_menu;
        if ($return_array) {
            $_return = json_decode($this->a_menu,true);
        }
        return $_return;
    }
}