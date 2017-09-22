<?php

namespace site\itcrowd\newsletter\controller;

use finger\request as request;
use finger\mail\mail as mail;
use finger\mail\mailchimp as mailchimp;

/**
 * Newsletter Page
 * @package site\itcrowd\newsletter\controller
 */
class index extends \site\itcrowd\main {

	/**
	 * Subscribe Form Page
	 */
	public function subscribeGet() {
		$this->render();
	}

	/**
	 * Unsubscribe Form Page
	 */
	public function unsubscribeGet() {
		$this->render();
	}

	/**
	 * Unsubscribe Form Process
	 * AJAX call
	 */
	public function unsubscribePost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'newsletter.unsubscribe' );
		if ( $this->_form->check() ) {
			$_mailchimpClass  = new mailchimp();
			$_mailchimpresult = $_mailchimpClass->remove( request::get( 'email' ) );
			switch ( $_mailchimpresult ) {
				case $_mailchimpClass::UNSUBSCRIBE_STATUS_OK :
					$_result['result'] = 'ok';
					break;
				case $_mailchimpClass::UNSUBSCRIBE_STATUS_EMAILNOTFOUND:
					$_result['message'] = 'no_email';
					break;
			}
		}
		$this->view->renderJSON( $_result );
		die();
	}

	/**
	 * Subscribe Form Process
	 * AJAX Call
	 */
	public function subscribePost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'newsletter.subscribe' );
		if ( $this->_form->check() ) {
			$_mailchimpClass  = new mailchimp();
			$_mailchimpresult = $_mailchimpClass->add( request::get( 'email' ) );
			switch ( $_mailchimpresult ) {
				case $_mailchimpClass::SUBSCRIBE_STATUS_OK :
					$_result['result'] = 'ok';
					break;
				case $_mailchimpClass::SUBSCRIBE_STATUS_DUPLICATEERROR:
					$_result['message'] = 'duplicate_email';
					break;
			}
		}
		$this->view->renderJSON( $_result );
		die();
	}

}