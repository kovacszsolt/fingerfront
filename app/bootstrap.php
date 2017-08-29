<?php
try {
	$_extraParam = '';
	$_configSettings = new \finger\config('settings');
	date_default_timezone_set($_configSettings->get('timezone', 'Europe/Budapest'));
	error_reporting(0);
	ini_set('display_errors', 0);
	if ($_configSettings->get('developer', 0)==1) {
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}
	ini_set('session.cookie_lifetime', $_configSettings->get('sessionlife',1) * 60 * 60 * 24);
	ini_set('session.gc_maxlifetime', $_configSettings->get('sessionlife',1) * 60 * 60 * 24);
	$_tables = new \model\system\tables();
	if (!$_tables->findTable('web')) {
		$_object = new \model\web\url\table();
		$_object->install();
	}
	$_url = \finger\server::uri();
	$_url = \finger\routing::find($_url, $_extraParam);
// main path for root path
	$_url = ((isset($_url) && ($_url != '/')) ? $_url : $_configSettings->get('defaultmodule') . '/' . $_configSettings->get('defaultcontroller') . '/' . $_configSettings->get('defaultaction') . '/' . $_configSettings->get('defaultmethod'));
	$_url = explode('/', $_url);
	if ($_url == array('')) {
		$_url = array();
	}
	$_url[0] = (isset($_url[0]) ? $_url[0] : $_configSettings->get('defaultmodule'));
	$_url[1] = ((isset($_url[1]) && $_url[1] != '') ? $_url[1] : $_configSettings->get('defaultcontroller'));
	$_url[2] = (isset($_url[2]) ? $_url[2] : $_configSettings->get('defaultaction'));
	$_url[3] = (isset($_url[3]) ? $_url[3] : $_configSettings->get('defaultmethod'));
	$_params = array();
	if (sizeof($_url) > 4) {
		$_tmps = $_url;
		unset($_tmps[0]);
		unset($_tmps[1]);
		unset($_tmps[2]);
		unset($_tmps[3]);
		foreach ($_tmps as $_tmp)
			$_params[] = $_tmp;
	}
	if ($_extraParam != '') {
		$_params = explode('/', $_extraParam);
	}
	foreach ($_params as $_params_id => $_param) {
		if (substr($_param, -1) == '/') {
			$_params[$_params_id] = substr($_param, 0, -1);
		}
		if ($_param == '') {
			unset($_params[$_params_id]);
		}
	}
	$_module = $_url[0];
	$_controller = $_url[1];
	$_action = $_url[2];
	$_method = $_url[3];

	$error = false;

	$_className = 'site\\' . $_module . '\\' . $_controller . '\controller\\' . $_action;
	//echo $_className;exit;
// controller check
	if (!class_exists($_className)) {
		$error = true;
	}

	if (!$error) {
		\finger\request::set('_module', $_module);
		\finger\request::set('_controller', $_controller);
		\finger\request::set('_action', $_action);
		\finger\request::set('_method', $_method);
		\finger\request::set('_params', $_params);

		$controller = new $_className();

		$controller->_module = $_module;
		$controller->_controller = $_controller;
		$controller->_action = $_action;
		$controller->_method = $_method;
		$controller->_params = $_params;

		if (substr($_method, -5) == '.json') {
			$_method = substr($_method, 0, (strrpos($_method, '.'))) . 'Json';
		} else {
			$_method .= \finger\server::method();
		}
		$controller->$_method();

	} else {
		if ($_configSettings->get('developer', 1) == 1) {
			\finger\log::save('classnotfound::' . $_className);
			exit;
		} else {
			\finger\log::save('classnotfound::' . $_className, false);
			include_once \finger\server::documentRoot() . '../site/' . $_configSettings->get('defaultmodule') . '/404.php';
			exit;
		}

		// no controller

	}
} catch (Exception $e) {
	print_r($e);
	exit;
}
