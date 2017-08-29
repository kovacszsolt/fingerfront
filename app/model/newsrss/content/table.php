<?php

namespace model\newsrss\content;

/**
 * NewsRSS Class table
 * @package model\item\content
 */
class table extends \finger\model\table {

	/**
	 * Table name
	 * @var string
	 */
	public $tableName = 'newsrss';

	/**
	 * Export tables
	 * @var array
	 */
	protected $_export_tables = array(
		'newsrss',
		'newsrssimage',
		'newsrsslanguage',
	);

	/**
	 * this table
	 * @var string
	 */
	public $className = __CLASS__;

	/**
	 * Table fields
	 * @var array
	 */
	public $fields = array(
		'typeid' => array( 'type' => 'int(10)' ),
		'link'   => array( 'type' => 'varchar(200)' ),
		'title'  => array( 'type' => 'varchar(200)' ),
		'intro'  => array( 'type' => 'longtext' ),
		'urlid'  => array( 'type' => 'int(10)' ),
		'url'    => array( 'type' => 'varchar(200)' ),
		'status' => array( 'type' => 'integer(10)' ),
	);

	public function joins() {
		$this->addJoin( 'newsrsstype', 'id', 'typeid' );
	}

	/**
	 * Find Type
	 *
	 * @param number $typeID
	 *
	 * @return array|mixed|null
	 */
	public function findType( number $typeID ) {
		$this->addWhere( 'typeid', $typeID );
		$_return = $this->query();

		return $_return;
	}

	/**
	 * Find Type only Active
	 * @param $typeID
	 *
	 * @return array|null
	 */
	public function findTypeActive(  $typeID ) {
		$this->addWhere( 'typeid', $typeID );
		$this->addWhere( 'status', 1 );
		$_return = $this->query();

		return $_return;
	}

	/**
	 * Get All only Active
	 * @return array|null
	 */
	public function queryActive() {
		$this->addWhere( 'status', 1 );
		$_return = $this->query();

		return $_return;
	}

	/**
	 * Find via ID
	 * only ACtive
	 * @param $id
	 *
	 * @return mixed|null
	 */
	public function findActive( $id ) {
		$_return = null;
		$this->addWhere( 'status', 1 );
		$_records = $this->query();
		if ( is_array( $_records ) ) {
			$_return = $this->find( $id );
		}

		return $_return;
	}

	/**
	 * Find link in database
	 *
	 * @param string $link
	 *
	 * @return array|mixed|null
	 */
	public function findLink( string $link ) {
		$_return = null;
		$this->addWhere( 'link', $link );
		$_tmp = $this->query();
		if ( is_array( $_tmp ) ) {
			$_return = $_tmp[0];
		}

		return $_return;
	}

	/**
	 * Add URL to database
	 *
	 * @param string $url
	 * @param number $type
	 *
	 * @return bool
	 */
	public function addUrl( $url, $type ) {
		$_return           = false;
		$_domain           = \finger\parser\url::getDomain( $url );
		$_rssContentTable  = new \model\rss\content\table();
		$_rssContentRecord = $_rssContentTable->findDomain( $_domain );
		if ( is_null( $_rssContentRecord ) ) {
			$newsrssContentTable  = new $this();
			$newsrssContentRecord = new \model\newsrss\content\record();
			$newsrssContentRecord->setTypeid( $type );
			$newsrssContentRecord->setLink( $url );
			$newsrssContentRecord->setStatus( - 1 );
			$_id = $newsrssContentTable->add( $newsrssContentRecord );
		} else {
			$_pageData            = \finger\parser\html::getFacebookData( $url, $_rssContentRecord->getUtf8() );
			$_urlSEO              = \finger\routing::createSEOUrl( $_pageData['title'] );
			$newsrssContentTable  = new $this();
			$newsrssContentRecord = new \model\newsrss\content\record();
			$newsrssContentRecord = $this->addUrlCreateRecord( $newsrssContentRecord, $_pageData, $type, $_urlSEO, $url );
			$_id                  = $newsrssContentTable->add( $newsrssContentRecord );
			$newsrssContentRecord = new \model\newsrss\content\record();
			$this->addUrlLanguage( $_id, $_pageData, $_urlSEO );
			if ( $_pageData['image'] != '' ) {
				$this->addUrlImage( $_id, $_pageData );
			}
			$_return = true;
		}
		$this->_lastInsertID = $_id;

		return $_return;
	}

	public function updateUrl( $id ) {
		$_return           = false;
		$_record           = $this->find( $id );
		$_url              = $_record->getLink();
		$_type             = $_record->getTypeid();
		$_domain           = \finger\parser\url::getDomain( $_url );
		$_rssContentTable  = new \model\rss\content\table();
		$_rssContentRecord = $_rssContentTable->findDomain( $_domain );
		if ( ! is_null( $_rssContentRecord ) ) {
			$_pageData            = \finger\parser\html::getFacebookData( $_url, $_rssContentRecord->getUtf8() );
			$_urlSEO              = \finger\routing::createSEOUrl( $_pageData['title'] );
			$newsrssContentTable  = new $this();
			$newsrssContentRecord = new \model\newsrss\content\record();
			$_record              = $this->addUrlCreateRecord( $_record, $_pageData, $_type, $_urlSEO, $_url );
			$newsrssContentTable->update( $_record );
			$newsrssContentRecord = new \model\newsrss\content\record();
			$this->addUrlLanguage( $id, $_pageData, $_urlSEO );

			if ( $_pageData['image'] != '' ) {
				$this->addUrlImage( $id, $_pageData );
			}
			$_return = true;
		}

		return $_return;
	}

	private function addUrlCreateRecord( $newsrssContentRecord, $_pageData, $type, $_urlSEO, $url ) {
		$newsrssContentRecord->setTitle( $_pageData['title'] );
		$newsrssContentRecord->setTypeid( $type );
		$newsrssContentRecord->setIntro( $_pageData['title'] );
		$newsrssContentRecord->setUrl( $_urlSEO );
		$newsrssContentRecord->setLink( $url );
		$newsrssContentRecord->setStatus( 1 );

		return $newsrssContentRecord;
	}

	private function addUrlLanguage( $_id, $_pageData, $_urlSEO ) {
		$newsrssLanguageTable  = new \model\newsrss\language\table();
		$_inorder              = $newsrssLanguageTable->maxInorder() + 1;
		$newsrssLanguageRecord = new \model\newsrss\language\record();
		$newsrssLanguageRecord->setRootid( $_id );
		$newsrssLanguageRecord->setTitle( $_pageData['title'] );
		$newsrssLanguageRecord->setIntro( $_pageData['descrition'] );
		$newsrssLanguageRecord->setUrl( $_urlSEO );
		$newsrssLanguageRecord->setLangcode( 'hu' );
		$newsrssLanguageRecord->setInorder( $_inorder );
		$_languageID = $newsrssLanguageTable->add( $newsrssLanguageRecord );

		return $_languageID;
	}

	private function addUrlImage( $_id, $_pageData ) {
		$newsrssImageTable  = new \model\newsrss\image\table();
		$newsrssImageRecord = new \model\newsrss\image\record();
		$newsrssImageRecord->setRootid( $_id );
		$newsrssImageRecord->setTmpFileName( $_pageData['image'] );
		$newsrssImageRecord->setName( 'from_link' );
		$newsrssImageRecord->setAlt( $_pageData['title'] );
		$newsrssImageRecord->setExtension( substr( $_pageData['image'], - 3 ) );
		$newsrssImageRecord->setSize( 0 );
		$_image_id = $newsrssImageTable->add( $newsrssImageRecord );

		return $_image_id;
	}

}
