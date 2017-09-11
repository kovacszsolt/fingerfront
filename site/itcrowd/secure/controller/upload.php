<?php

namespace site\itcrowd\secure\controller;

use function Couchbase\defaultDecoder;
use model\rss\content\table as rssContentTable;
use model\newsrss\content\table as newsrssContentTable;
use model\newsrss\content\record as newsrssContentRecord;
use model\newsrss\language\table as newsrssLanguageTable;
use model\newsrss\language\record as newsrssLanguageRecord;
use model\newsrss\image\table as newsrssImageTable;
use model\newsrss\image\record as newsrssImageRecord;
use finger\request as request;
use finger\routing as routing;
use finger\rss\read as rssread;
use \model\newsrsstype\content\table as contentTypeTable;

class upload extends \site\itcrowd\secure\main
{

    public function indexGet()
    {

        $_contentTypeTable = new contentTypeTable();
        $_contentTypeRecords = $_contentTypeTable->query();
        $this->view->addValue('typeRecords', $_contentTypeRecords);
        $this->render();
    }


    public function previewGet()
    {
        $_utf8 = $this->session->getValue('preview_utf8', '0');
        $_url = $this->session->getValue('preview_url');
        $_type = $this->session->getValue('preview_type');
        $_data = $this->getPageData($_url, ($_utf8 == 1) ? true : false);
        $this->view->addValue('utf8', $_utf8);
        $this->view->addValue('url', $_url);
        $this->view->addValue('type', $_type);
        $this->view->addValue('data', $_data);
        $this->render();
    }

    public function savePost()
    {
        $_utf8 = request::get('utf8', '0');
        $_url = request::get('url');
        $_type = request::get('type');
        $_data = $this->getPageData($_url, ($_utf8 == 1) ? true : false);
        $this->savePage($_url, $_type, $_data);
        header('Location: /itcrowd/secure/upload/index/');
        die();
        exit;
    }

    public function indexPost()
    {
        $this->session->setValue('preview_utf8', request::get('utf8', '0'));
        $this->session->setValue('preview_url', request::get('url'));
        $this->session->setValue('preview_type', request::get('type'));
        header('Location: /itcrowd/secure/upload/preview/');
        die();
    }

    private function savePage($url, $type, $data)
    {
        $_url = routing::createSEOUrl($data['title']);
        $newsrssContentTable = new newsrssContentTable();
        $newsrssContentRecord = new newsrssContentRecord();
        $newsrssContentRecord->setTitle($data['title']);
        $newsrssContentRecord->setTypeid($type);
        $newsrssContentRecord->setIntro($data['title']);
        $newsrssContentRecord->setUrl($_url);
        $newsrssContentRecord->setLink($url);
        $_id = $newsrssContentTable->add($newsrssContentRecord);

        $newsrssLanguageTable = new newsrssLanguageTable();
        $_inorder = $newsrssLanguageTable->maxInorder() + 1;
        $newsrssLanguageRecord = new newsrssLanguageRecord();
        $newsrssLanguageRecord->setRootid($_id);
        $newsrssLanguageRecord->setTitle($data['title']);
        $newsrssLanguageRecord->setIntro($data['description']);
        $newsrssLanguageRecord->setUrl($_url);
        $newsrssLanguageRecord->setLangcode('hu');
        $newsrssLanguageRecord->setInorder($_inorder);
        $_languageID = $newsrssLanguageTable->add($newsrssLanguageRecord);
        if ($data['image'] != '') {
            $newsrssImageTable = new newsrssImageTable();
            $newsrssImageRecord = new newsrssImageRecord();
            $newsrssImageRecord->setRootid($_id);
            $newsrssImageRecord->setTmpFileName($data['image']);
            $newsrssImageRecord->setName('from_link');
            $newsrssImageRecord->setAlt($data['title']);
            $newsrssImageRecord->setExtension(substr($data['image'], -3));
            $newsrssImageRecord->setSize(0);
            $_image_id = $newsrssImageTable->add($newsrssImageRecord);
        }
    }

    private function getPageData($url, $convertUTF8 = false)
    {
        $_return = array(
            'title' => '',
            'descrition' => '',
            'image' => ''
        );
        $page_content = file_get_contents($url);

        $dom_obj = new \DOMDocument();
        $dom_obj->loadHTML($page_content);
        $meta_val = null;
        foreach ($dom_obj->getElementsByTagName('meta') as $meta) {
            switch ($meta->getAttribute('property')) {
                case 'og:title' :
                    $_return['title'] = ($convertUTF8) ? utf8_decode($meta->getAttribute('content')) : $meta->getAttribute('content');
                    break;
                case 'og:description' :
                    $_return['descrition'] = ($convertUTF8) ? utf8_decode($meta->getAttribute('content')) : $meta->getAttribute('content');
                    break;
                case 'og:image' :
                    $_return['image'] = ($convertUTF8) ? utf8_decode($meta->getAttribute('content')) : $meta->getAttribute('content');
                    break;
                case 'og:url':
                case 'og:site_name':
                case 'fb:app_id':
                case '':
                    break;
                default:
            }

        }
        return $_return;
    }

}