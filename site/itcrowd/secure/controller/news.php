<?php

namespace site\itcrowd\secure\controller;

use finger\request as request;
use finger\session as session;
use finger\mail\mail as mail;
use \model\newsrsstype\content\table as contentTypeTable;
use \model\newsrss\content\table as contentTable;
use \model\newsrss\content\record as contentRecord;
use finger\parser\url as url;
use finger\parser\html as html;

/**
 * User News Class
 * @package site\itcrowd\secure\controller
 */
class news extends \site\itcrowd\secure\main {

	/**
	 * Add news URL Form Page
	 */
	public function addGet() {
		$_contentTypeTable   = new contentTypeTable();
		$_contentTypeRecords = $_contentTypeTable->query();
		$this->view->addValue( 'contentTypeRecords', $_contentTypeRecords );
		$this->render();
	}


	/**
	 * Add news process page
	 * AJAX Call
	 */
	public function addPost() {
		$_result = array(
			'result'  => 'error',
			'message' => ''
		);
		$this->_form->init( 'news.add' );
		if ( $this->_form->check() ) {
			$_url      = request::get( 'url' );
			$_pageData = html::getFacebookData( $_url );
			if ( $_pageData['title'] == '' ) {
				$_result['message'] = 'nodatafound';
			} else {
				$_userId = 0;
				if ( ! is_null( $this->currentUser ) ) {
					$_userId = $this->currentUser->getId();
				}
				$_contentTable  = new contentTable();
				$_contentRecord = $_contentTable->findLink( $_url );
				if ( $_contentRecord instanceof contentRecord ) {
					$_result['message'] = 'duplicateurl';
				} else {
					$_result['result'] = 'ok';
					$_type             = request::get( 'type' );
					$_url              = request::get( 'url' );
					$_contentTable     = new contentTable();
					$_contentTable->addUrl( $_url, (int) $_type, $_userId );

					$this->sendMail( $_contentTable->_lastInsertID, $_pageData );
				}
			}
		} else {
			\finger\log::save( 'form_valid_error' );
		}
		$this->view->renderJSON( $_result );
		die();
	}

	/**
	 * Send mail to admin
	 *
	 * @param $_contentID
	 * @param $pageData
	 */
	private function sendMail( $_contentID, $pageData ) {
		$_contentTable  = new contentTable();
		$_contentRecord = $_contentTable->find( $_contentID );
		$_htmlView      = new \finger\view\render();
		$_htmlView->addValue( 'currentUser', $this->currentUser );
		$_htmlView->addValue( 'record', $_contentRecord );
		$_htmlView->addValue( 'pageData', $pageData );
		if (is_null($this->currentUser )) {
			$_htmlView->setFile( 'site/itcrowd/secure/email/newsaddanno.php' );
		} else {
			$_htmlView->setFile( 'site/itcrowd/secure/email/newsadd.php' );
		}
		$_htmlContent = $_htmlView->render( false );
		$_mail        = new mail();
		$_mail->setSubject( 'ITCrowd . hu link beküldés' );
		//$_mail->addTo( $record->getEmail() );
		$_mail->addTo( 'smith.zsolt@gmail.com' );
		$_mail->setBody( $_htmlContent );
		$_mail->send();
	}
}