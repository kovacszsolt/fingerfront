<?php

namespace site\itcrowd\root\controller;

use finger\server;
use finger\storage;
use model\newsrss\content\table as newsrssContentTable;
use finger\request as request;


class index extends \site\itcrowd\main {


	public function indexGet() {
		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->queryActive();
		$this->view->addValue( 'newsrssContentRecords', $_newsrssContentRecords );
		$this->render();
	}

	public function rssGet() {

		$xml      = new \SimpleXMLElement( '<rss version="2.0"/>' );
		$_channel = $xml->addChild( 'channel' );
		$_channel->addChild( 'title', 'IT Crowd az Internet Közepe' );
		$_channel->addChild( 'link', 'https://itcrowd.hu' );
		$_channel->addChild( 'description', 'ez3' );

		$_newsrssContentTable   = new newsrssContentTable();
		$_newsrssContentRecords = $_newsrssContentTable->query();
		foreach ( $_newsrssContentRecords as $_newsrssContentRecord ) {
			$_newsrssContentImageRecord = $_newsrssContentRecord->getImages();
			$_newsrssContentImageRecord = $_newsrssContentImageRecord[0];
			$_item                      = $_channel->addChild( 'item' );
			$_item->addChild( 'title', $_newsrssContentRecord->getTitle() );
			$_item->addChild( 'link', request::_getProtocol() . '://' . request::_getServerName() . '/' . $_newsrssContentRecord->getUrl() );
			$_item->addChild( 'description', $_newsrssContentRecord->getIntro() );
			$_item->addChild( 'pubDate', $_newsrssContentRecord->getCreatedate() );
			if ( ! is_null( $_newsrssContentImageRecord ) ) {
				$_enclosure = $_item->addChild( 'enclosure' );
				$_enclosure->addAttribute( 'url', 'https://' . server::host() . '/itcrowd/root/index/read/newsrss/' . $_newsrssContentImageRecord->getId() . '.' . $_newsrssContentImageRecord->getExtension() );
				$_enclosure->addAttribute( 'length', $_newsrssContentImageRecord->getSize() );
				$_enclosure->addAttribute( 'type', 'image/png' );
			}

		}
		echo $xml->asXML();
		exit;
	}

	public function rssreadGet() {
		$_xml         = simplexml_load_file( 'https://www.gamestar.hu/site/rss/rss.xml' );
		$json_string  = json_encode( $_xml );
		$result_array = json_decode( $json_string, true );
		print_r( $result_array['channel']['item'] );
		exit;
	}

	private function rssreadGamestar( $result_array ) {

	}

	public function aboutGet() {
		$this->render();
	}

	public function policyGet() {
		$this->render();
	}

	public function tesztGet() {

		$_table        = new \model\qqq\content\table();
		$_table->order = 'createdate DESC';
		$_table->addWhere('id',1225,'>');
		$_records      = $_table->query();
		$_export       = array();
		foreach ( $_records as $_record ) {
			$_tmp  = array(
				'id'         => $_record->getId(),
				'maintype'   => $_record->getMaintype(),
				'type'       => $_record->getType(),
				'name1'      => '',
				'email1'     => '',
				'address1'   => '',
				'phone1'     => '',
				'name2'      => '',
				'email2'     => '',
				'phone2'     => '',
				'address2'   => '',
				'createdate' => $_record->getCreatedate()
			);
			$_data = json_decode( $_record->getData(), true );
			if ( isset( $_data['name1'] ) ) {
				$_tmp['name1'] = $_data['name1'];
			} else {
				$_tmp['name1']    = $_data['name'];
			}
			if ( isset( $_data['email1'] ) ) {
				$_tmp['email1'] = $_data['email1'];
			} else {
				$_tmp['email1']    = $_data['email'];
			}
			if ( isset( $_data['phone1'] ) ) {
				$_tmp['phone1'] = $_data['phone1'];
			} else {
				$_tmp['phone1']    = $_data['phone'];
			}
			if ( isset( $_data['address1'] ) ) {
				$_tmp['address1'] = $_data['address1'];
			} else {
				$_tmp['address1']    = $_data['address'];
			};

			if ( isset( $_data['name2'] ) ) {
				$_tmp['name2'] = $_data['name2'];
			}
			if ( isset( $_data['email2'] ) ) {
				$_tmp['email2'] = $_data['email2'];
			}
			if ( isset( $_data['phone2'] ) ) {
				$_tmp['phone2'] = $_data['phone2'];
			}
			if ( isset( $_data['address2'] ) ) {
				$_tmp['address2'] = $_data['address2'];
			}
			$_export[] = $_tmp;
		}
		$fp = fopen($_SERVER['DOCUMENT_ROOT'].'/file.csv', 'w');
		fputcsv($fp, array_keys($_export[0]));
		foreach ($_export as $_data) {
			fputcsv($fp, $_data);
			//echo implode(';',$_data);exit;
		}
		echo 'rf';
		exit;
	}

	public function xxxGet() {
		$a=\finger\parser\html::getFacebookData('http://bitport.hu/magyar-it-szakemberek-kalandjai-kulfoldon-1-resz');
		echo \finger\routing::createSEOUrl($a['title']);exit;
		print_r($a);exit;
		echo 'w';exit;
	}
}