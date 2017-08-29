<?php

namespace model\system\module;

class record extends \finger\model\record
{
    protected $className = __CLASS__;
    protected $a_class='';
    protected $a_status='';
    protected $a_menu='';

    public function getEnabled()
    {
        $_return = false;
        if ($this->a_status == 1) {
            $_return = true;
        }
        return $_return;
    }

    public function setEnabled($value)
    {
        $this->a_status = 0;
        if ($value) {
            $this->a_status = 1;
        }
    }
    public function setMenu($value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $this->a_menu = $value;
    }

    public function getMenu($return_array = false)
    {
        $_return = $this->a_menu;
        if ($return_array) {
            $_return = json_decode($this->a_menu,true);
        }
        return $_return;
    }
}