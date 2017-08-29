<?php

namespace site\itcrowd\secure\controller;

use model\frontusers\content\table as frontusersContentTable;
use model\frontusers\content\record as frontusersContentRecord;
use finger\request as request;
use finger\mail\mail as mail;
use \model\newsrsstype\content\table as contentTypeTable;
use site\admin\main\view;


class user extends \site\itcrowd\secure\main {

	public function lostpasswordconfirmGet() {
		$_key   = request::getParam( 0 );
		$_error = true;
		if ( $_key != '' ) {

		}
		$this->render();
	}

	public function lostpasswordconfirmPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$_key    = request::getParam( 0 );
		$_error  = true;
		if ( $_key != '' ) {
			$frontusersContentTable   = new frontusersContentTable();
			$_frontusersContentRecord = $frontusersContentTable->findKey( $_key );
			if ( $_frontusersContentRecord instanceof frontusersContentRecord ) {
				if ( request::get( 'email', '' ) == $_frontusersContentRecord->getEmail() ) {
					$_frontusersContentRecord->setPassword( request::get( 'newpassword' ) );
					$_frontusersContentRecord->setRegkey( '' );
					$frontusersContentTable->update( $_frontusersContentRecord );
					$_result['result'] = 'ok';
					$this->session->flash( 'message', 'A jelszavadat frissítettük.' );
				}
			}
		}
		$this->view->renderJSON( $_result );
		die();
	}

	public function subscribeconfirmGet() {
		$_key   = request::getParam( 0 );
		$_error = true;
		if ( $_key != '' ) {
			$frontusersContentTable   = new frontusersContentTable();
			$_frontusersContentRecord = $frontusersContentTable->findKey( $_key );
			if ( $_frontusersContentRecord instanceof frontusersContentRecord ) {
				$_frontusersContentRecord->setRegkey( '' );
				$_frontusersContentRecord->setStatus( 1 );
				$frontusersContentTable->update( $_frontusersContentRecord );
				$this->session->flash( 'message', 'A regisztrációdat sikeresen megerősítetted.' );
				header( 'Location: /' );
				die;
			}
		}
		header( 'Location: /' );
		die;
	}

	public function loginGet() {
		$this->render();
	}

	public function indexPost() {

		$_config_secure = $this->settings['secure']['googlecaptcaptchasecret'];
		$secret         = $this->settings['secure']['googlecaptcaptchasecret'];
		$verifyResponse = file_get_contents( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
		$responseData   = json_decode( $verifyResponse );
		if ( $responseData->success ) {

		} else {
			header( 'Location: /login/' );
			exit;
		}
		$frontusersContentTable  = new frontusersContentTable();
		$frontusersContentRecord = $frontusersContentTable->login( request::get( 'email' ), request::get( 'password' ) );
		if ( is_null( $frontusersContentRecord ) ) {
			header( 'Location: /itcrowd/secure/login/index/' );
			die();
		}
		$this->session->setValue( 'userFront', $frontusersContentRecord );
		header( 'Location: /itcrowd/secure/upload/index/' );
		die();
	}

	public function registrationGet() {
		$this->render();
	}


	public function registrationPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'user.registration' );
		if ( $this->_form->check() ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->findEmail( request::get( 'email' ) );
			if ( ! is_null( $frontusersContentRecord ) ) {
				$_result['message'] = 'duplicate_email';
			} else {
				$frontusersContentRecord = new frontusersContentRecord();
				$frontusersContentRecord->setTitle( request::get( 'name' ) );
				$frontusersContentRecord->setEmail( request::get( 'email' ) );
				$frontusersContentRecord->setPassword( request::get( 'password' ) );
				$frontusersContentRecord->setStatus( 0 );
				$frontusersContentRecord->createKey();
				$frontusersContentTable->add( $frontusersContentRecord );
				$this->_sendConfirm( $frontusersContentRecord );
				$_result['result'] = 'ok';
			}
		} else {
			$_result['message'] = $this->_form->getError();
		}
		$this->view->renderJSON( $_result );
		die();
	}

	private function _sendConfirm( $record ) {
		$_htmlView = new \finger\view\render();
		$_htmlView->addValue( 'record', $record );
		$_htmlView->setFile( 'site/itcrowd/secure/email/registration.php' );
		$_htmlContent = $_htmlView->render( false );
		$_mail        = new mail();
		$_mail->setSubject( 'ITCrowd . hu regisztáció' );
		$_mail->addTo( $record->getEmail() );
		$_mail->setBody( $_htmlContent );
		$_mail->send();
	}

	private function _sendLostPassword( $record ) {
		$_htmlView = new \finger\view\render();
		$_htmlView->addValue( 'record', $record );
		$_htmlView->setFile( 'site/itcrowd/secure/email/lostpassword.php' );
		$_htmlContent = $_htmlView->render( false );
		$_mail        = new mail();
		$_mail->setSubject( 'ITCrowd . hu új jelszó' );
		$_mail->addTo( $record->getEmail() );
		$_mail->setBody( $_htmlContent );
		$_mail->send();
	}


	public function loginPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'user.login' );
		if ( $this->_form->check() ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->login( request::get( 'email' ), request::get( 'password' ) );
			if ( is_null( $frontusersContentRecord ) ) {
				$_result['message'] = 'nouser';
			} else {
				$this->session->setValue( 'frontuser', $frontusersContentRecord );
				$this->session->flash( 'message', 'Sikeresen belépés.' );
				$_result['result'] = 'ok';
			}
		} else {
			$_result['message'] = $this->_form->getError();
		}
		$this->view->renderJSON( $_result );
	}


	public function profileGet() {
		$this->render();
	}

	public function lostpasswordGet() {
		$this->render();
	}

	public function lostpasswordPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'user.lostpassword' );
		if ( $this->_form->check() ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->findEmail( request::get( 'email', '' ) );
			if ( $frontusersContentRecord instanceof frontusersContentRecord ) {


				$_key = $frontusersContentRecord->createKey();
				$frontusersContentTable->update( $frontusersContentRecord );

				$this->_sendLostPassword( $frontusersContentRecord );
				$_result['result'] = 'ok';
			} else {
				$_result['message'] = 'nouser';
			}

		}
		$this->view->renderJSON( $_result );
		die();
	}

	public function profilePost() {
		$_result                 = array(
			'result'  => 'error',
			'message' => ''
		);
		$frontusersContentTable  = new frontusersContentTable();
		$frontusersContentRecord = $frontusersContentTable->find( $this->currentUser->getID() );
		$frontusersContentRecord->setTitle( request::get( 'name' ) );
		if ( request::get( 'password', '' ) != '' ) {
			$frontusersContentRecord->setPassword( request::get( 'password' ) );
		}
		$frontusersContentTable->update( $frontusersContentRecord );
		$this->session->setValue( 'frontuser', $frontusersContentRecord );
		$_result['result'] = 'ok';
		$this->view->renderJSON( $_result );
		die();
	}

	public function logoutGet() {
		$this->session->remove( 'frontuser' );
		$this->session->flash( 'message', 'Sikeres kilépés.' );
		header( 'Location: /' );
		die();
	}


	public function subscribeconfirmstep2Get() {
		$_key   = $this->session->getValue( 'flash.newpassword_key', '' );
		$_error = true;
		if ( $_key != '' ) {
			$frontusersContentTable   = new frontusersContentTable();
			$_frontusersContentRecord = $frontusersContentTable->findKey( $_key );
			if ( $_frontusersContentRecord instanceof frontusersContentRecord ) {
				$_error = false;
			}
		}
		$this->view->addValue( 'error', $_error );
		$this->render();
	}

	public function subscribeconfirmstep2Post() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'user.subscribeconfirmstep2' );
		if ( $this->_form->check() ) {
			$_key = $this->session->getValue( 'flash.newpassword_key', '' );
			if ( $_key != '' ) {
				$frontusersContentTable   = new frontusersContentTable();
				$_frontusersContentRecord = $frontusersContentTable->findKey( $_key );
				if ( $_frontusersContentRecord instanceof frontusersContentRecord ) {
					if ( $_frontusersContentRecord->getEmail() == request::get( 'email' ) ) {
						$_frontusersContentRecord->setRegkey( '' );
						$_frontusersContentRecord->setPassword( request::get( 'newpassword' ) );
						$frontusersContentTable->update( $_frontusersContentRecord );
						$_result['result'] = 'ok';
					} else {
						\finger\log::save( 'no_user_email' );
					}
				} else {
					\finger\log::save( 'no_user_key' );
				}
			} else {
				\finger\log::save( 'no_key' );
			}
		} else {
			\finger\log::save( 'form_valid_error' );
		}
		$this->view->renderJSON( $_result );
	}
}