<?php

error_reporting(0);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BTTNoticeFacade
 *
 * @author zq
 */
class BTTNoticeFacade extends BBaseFacade {
//put your code here

    const TT_URL = 'http://www.tjpme.com/index.php?id=105';

    public function getNotice() {
//$html = new simple_html_dom();

        $key1 = MemcachedKeyFactory::ttNoticeKey();
        //$this->getCache()->delete($key);
        $res = $this->getCache()->get($key1);
        if ($res !== FALSE && !empty($res)) {
            return $res;
        }

        $html = file_get_html(self::TT_URL);


        if ($html !== FALSE) {

            $arr = array();
            $res = $html->find('.mioc', 0);
            $ch = $res->children(0)->children(0)->find('table', 1);
            $tables = $ch->find('table');
            foreach ($tables as $key => $item) {
                $entity = new TTNoticeEntity();
                $entity->Title = $item->find('tr', 0)->find('td span b', 0)->text();
                $entity->Short = $item->find('tr', 1)->find('td span', 0)->text();
                $entity->Time = $item->find('tr', 0)->find('td span font', 0)->text();
                $entity->Url = 'http://www.tjpme.com' . $item->find('tr', 0)->find('td span a', 0)->getAttribute("href");
                $arr[] = $entity;
            }
            $this->getCache()->set($key1, $arr, 3600);

            return $arr;
        }



        return array();
    }

    /**
     * 
     * @param string $url
     */
    public function getDetail($url) {

        $key = md5($url);
        //$this->getCache()->delete($key);
        $res = $this->getCache()->get($key);
        if ($res !== FALSE && !empty($res)) {
            return $res;
        }
        $detail = new NoticeDetailEntity();

        $html = file_get_html($url);

        if ($html !== FALSE) {

           
            $res = $html->find('.mioc', 0);
            $title = $res->find('.news_title01 b', 0)->text();
            $content = $res->find('.contert', 0)->innertext();
            $time = $res->find('.channal_color01', 0)->text();

            $prep = '/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/';
            $matchs = array();
            $t = preg_match($prep, $time, $matchs);

//$detail = new NoticeDetailEntity();
            $detail->Content = $content;
            $detail->Title = $title;
            $detail->Time = $t ? $matchs[0] : $time;

            $this->getCache()->set($key, $detail, 36000);
        }

        return $detail;
    }

}

