<?php

namespace site\itcrowd\secure\controller;

use model\frontusers\content\table as frontusersContentTable;
use model\frontusers\content\record as frontusersContentRecord;
use finger\request as request;
use finger\mail\mail as mail;
use finger\session as session;

/**
 * User functions
 * @package site\itcrowd\secure\controller
 */
class user extends \site\itcrowd\secure\main {

	/**
	 * Lost password page
	 */
	public function lostpasswordconfirmGet() {
		$_key   = request::getParam( 0 );
		$_error = true;
		if ( $_key != '' ) {

		}
		$this->render();
	}

	/**
	 * Lost password form process
	 * AJAX call
	 */
	public function lostpasswordconfirmPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$_key    = request::getParam( 0 );
		$_error  = true;
		// check the key
		if ( $_key != '' ) {
			$frontusersContentTable = new frontusersContentTable();
			// find user with key
			$_frontusersContentRecord = $frontusersContentTable->findKey( $_key );
			if ( $_frontusersContentRecord instanceof frontusersContentRecord ) {
				// check e-mail address
				if ( request::get( 'email', '' ) == $_frontusersContentRecord->getEmail() ) {
					$_frontusersContentRecord->setPassword( request::get( 'newpassword' ) );
					$_frontusersContentRecord->setRegkey( '' );
					$frontusersContentTable->update( $_frontusersContentRecord );
					$_result['result'] = 'ok';
					session::flash( 'message', 'A jelszavadat frissítettük.' );
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
				session::flash( 'message', 'A regisztrációdat sikeresen megerősítetted.' );
				request::redirect( '/' );
			}
		}
		request::redirect( '/' );
	}

	/**
	 * Login page
	 */
	public function loginGet() {
		$this->view->addValue( 'google_login', $this->_googleClass->getRedirectURL( request::_getFullHost().'/itcrowd/secure/user/registrationgoogle/' ) );
		$this->view->addValue( 'facebook_login', $this->_facebookClass->getLoginURL( '/itcrowd/secure/user/loginfacebook/' ) );
		$this->render();
	}

	/**
	 * Registration Page
	 */
	public function registrationGet() {
		// delete facebook from session
		$this->_facebookClass->logout();
		session::remove( 'googlesession' );
		$this->view->addValue( 'facebook_login', $this->_facebookClass->getLoginURL( '/itcrowd/secure/user/registrationfacebook/' ) );
		$this->view->addValue( 'google_login', $this->_googleClass->getRedirectURL( request::_getFullHost().'/itcrowd/secure/user/registrationgoogle/' ) );
		$this->render();
	}


	/**
	 * Registration page process
	 * AJAX Call
	 */
	public function registrationPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		// form validation
		$this->_form->init( 'user.registration' );
		if ( $this->_form->check() ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->findEmail( request::get( 'email' ) );
			// check email address if exits
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
				// send comfirmation e-mail
				$this->_sendConfirm( $frontusersContentRecord );
				$_result['result'] = 'ok';
			}
		} else {
			$_result['message'] = $this->_form->getError();
		}
		$this->view->renderJSON( $_result );
		die();
	}

	/**
	 * Send confirmation e-mail
	 *
	 * @param $record
	 */
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

	/**
	 * Send lostpassword e-mail
	 *
	 * @param $record
	 */
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

	/**
	 * Login page process
	 * AJAX Call
	 */
	public function loginPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		// form validation
		$this->_form->init( 'user.login' );
		if ( $this->_form->check() ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->login( request::get( 'email' ), request::get( 'password' ) );
			if ( is_null( $frontusersContentRecord ) ) {
				$_result['message'] = 'nouser';
			} else {
				session::set( 'frontuser', $frontusersContentRecord );
				session::flash( 'message', 'Sikeresen belépés.' );
				$_result['result'] = 'ok';
			}
		} else {
			$_result['message'] = $this->_form->getError();
		}
		$this->view->renderJSON( $_result );
	}

	/**
	 * User profile Page
	 */
	public function profileGet() {
		$this->render();
	}

	/**
	 * Lost password page
	 */
	public function lostpasswordGet() {
		$this->render();
	}

	/**
	 * Process lost passsword page
	 * AJAX Call
	 */
	public function lostpasswordPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		// form validation
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

	/**
	 * Profile Page process
	 * AJAX Call
	 */
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
		session::set( 'frontuser', $frontusersContentRecord );
		$_result['result'] = 'ok';
		$this->view->renderJSON( $_result );
		die();
	}

	/**
	 * User logout
	 */
	public function logoutGet() {
		$this->_facebookClass->logout();
		$this->_googleClass->logout();
		session::remove( 'frontuser' );
		session::flash( 'message', 'Sikeres kilépés.' );
		request::redirect( '/' );
	}


	/**
	 * Registration step 2
	 */
	public function subscribeconfirmstep2Get() {
		$_key   = session::get( 'flash.newpassword_key', '' );
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

	/**
	 * Registration confirm page process
	 * AJAX Call
	 */
	public function subscribeconfirmstep2Post() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'user.subscribeconfirmstep2' );
		if ( $this->_form->check() ) {
			$_key = session::get( 'flash.newpassword_key', '' );
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

	/**
	 * Google Registration
	 */
	public function registrationgoogleGet() {

		if ( request::get( 'code', '' ) != '' ) {
			$this->_googleClass->setRedirectUri( request::_getFullHost().'/itcrowd/secure/user/registrationgoogle/' );
			$_token = $this->_googleClass->getToken();
			session::set( 'googlesession', $_token );
			request::redirect( '/itcrowd/secure/user/registrationgoogle/' );
		} elseif ( session::get( 'googlesession', '' ) != '' ) {
			$_attributes = $this->_googleClass->getAttributes();
			$_userTable  = new \model\frontusers\content\table();
			$_userRecord = $_userTable->findEmail( $_attributes['email'] );
			if ( is_null( $_userRecord ) ) {
				$_userRecord = new \model\frontusers\content\record();
				$_userRecord->setTitle( substr( $_attributes['email'], 0, strpos( '@', $_attributes['email'] ) ) );
				$_userRecord->setEmail( $_attributes['email'] );
				$_userRecord->setPassword( \finger\random::char( 12 ) );
				$_userRecord->setStatus( 1 );
				$_userId           = $_userTable->add( $_userRecord );
				$_userSocialRecord = new \model\frontusers\social\record();
				$_userSocialRecord->setUserid( $_userId );
				$_userSocialRecord->setType( 'google' );
				$_userSocialRecord->setSocialid( $_attributes['aud'] );
				$_userSocialTable = new \model\frontusers\social\table();
				$_userSocialTable->add( $_userSocialRecord );
				$_userRecord = $_userTable->find( $_userId );

			} else {
				$_userId           = $_userRecord->getId();
				$_userSocialTable  = new \model\frontusers\social\table();
				$_userSocialRecord = $_userSocialTable->findUserFacebookId( $_userId );
				if ( is_null( $_userSocialRecord ) ) {
					$_userSocialRecord = new \model\frontusers\social\record();
					$_userSocialRecord->setUserid( $_userId );
					$_userSocialRecord->setType( 'google' );
					$_userSocialRecord->setSocialid( $_attributes['aud'] );
					$_userSocialTable = new \model\frontusers\social\table();
					$_userSocialTable->add( $_userSocialRecord );
				} elseif ( $_userSocialRecord->getSocialid() != $_attributes['aud'] ) {
					$_userSocialRecord->setSocialid( $_attributes['aud'] );
					$_userSocialTable->update( $_userSocialRecord );
				}
			}
			session::set( 'frontuser', $_userRecord );
			session::flash( 'message', 'Sikeresen regisztráció.' );
			request::redirect( '/hirbekuldes/' );
		}
		exit;
	}

	/**
	 * Facebook registration
	 */
	public function registrationfacebookGet() {
		$_me = $this->_facebookClass->getMe();
		if ( is_null( $_me ) ) {
			session::flash( 'message', 'Nem sikerült a facebook azonosítás.' );
			request::redirect( '/hirbekuldes/' );
		}
		$_userTable  = new \model\frontusers\content\table();
		$_userRecord = $_userTable->findEmail( $_me['email'] );
		if ( is_null( $_userRecord ) ) {
			$_userRecord = new \model\frontusers\content\record();
			$_userRecord->setTitle( $_me['name'] );
			$_userRecord->setEmail( $_me['email'] );
			$_userRecord->setPassword( \finger\random::char( 12 ) );
			$_userRecord->setStatus( 1 );
			$_userId           = $_userTable->add( $_userRecord );
			$_userSocialRecord = new \model\frontusers\social\record();
			$_userSocialRecord->setUserid( $_userId );
			$_userSocialRecord->setType( 'facebook' );
			$_userSocialRecord->setSocialid( $_me['id'] );
			$_userSocialTable = new \model\frontusers\social\table();
			$_userSocialTable->add( $_userSocialRecord );
			$_userRecord = $_userTable->find( $_userId );
			session::set( 'frontuser', $_userRecord );
			session::flash( 'message', 'Sikeresen regisztráció.' );
			request::redirect( '/hirbekuldes/' );

		} else {
			$_userId           = $_userRecord->getId();
			$_userSocialTable  = new \model\frontusers\social\table();
			$_userSocialRecord = $_userSocialTable->findUserFacebookId( $_userId );
			if ( $_userSocialRecord->getSocialid() != $_me['id'] ) {
				$_userSocialRecord->setSocialid( $_me['id'] );
				$_userSocialTable->update( $_userSocialRecord );
			}
		}
		echo 'ok';
		exit;

	}

	/**
	 * Facebook Login
	 */
	public function loginfacebookGet() {
		$_me               = $this->_facebookClass->getMe();
		$_userSocialTable  = new \model\frontusers\social\table();
		$_userSocialRecord = $_userSocialTable->findFacebookId( $_me['id'] );
		if ( ! is_null( $_userSocialRecord ) ) {
			$frontusersContentTable  = new frontusersContentTable();
			$frontusersContentRecord = $frontusersContentTable->find( $_userSocialRecord->getUserid() );
			session::set( 'frontuser', $frontusersContentRecord );
			session::flash( 'message', 'Sikeresen belépés.' );
			request::redirect( '/' );
		}
	}
}