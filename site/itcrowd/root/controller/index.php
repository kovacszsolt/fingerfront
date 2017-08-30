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

}