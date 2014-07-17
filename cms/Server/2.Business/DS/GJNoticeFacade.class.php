<?php
/**
 *
 * @author xieq
 * @date    2014-07-16 15:01:24
 */

class GJNoticeFacade extends BBaseFacade {

    const GJ_URL = "http://www.guojin.org/NewList.aspx?type=12";

    public function getNotice() {
    	$key1 = MemcachedKeyFactory::gjNoticeKey();
    	$res = $this->getCache()->get($key1);

    	if ($res !== FALSE && !empty($res)) {
            return $res;
        }

        $html = file_get_html(self::GJ_URL);

        if($html != FALSE) {
        	$arr = array();
            $res = $html->find('.news', 0);
            $list = $res->find('li');
            foreach ($list as $key => $item) {
                $entity = new TTNoticeEntity();
                $entity->Title = $item->find('a', 0)->text();
                // $entity->Short = '';
                $entity->Time = $item->find('span', 0)->text();
                $entity->Url = 'http://www.guojin.org/' . $item->find('a', 0)->getAttribute("href");
                $arr[] = $entity;
            }
            $this->getCache()->set($key1, $arr, 3600);

            return $arr;
        }

        return array();
    }

    public function getDetail($url) {

    	$key = md5($url);
        $this->getCache()->delete($key);
        $res = $this->getCache()->get($key);
        if ($res !== FALSE && !empty($res)) {
            return $res;
        }
        $detail = new NoticeDetailEntity();

        $html = file_get_html($url);

        if ($html !== FALSE) {


            $res = $html->find('.content .con', 0);
            //echo $res;
            $title = $res->find('.show_t span', 0)->text();
            $content = $res->find('.show_c',0)->innertext();
            $time = $res->find('.show_d span', 0)->text();

            $detail->Content = $content;
            $detail->Title = $title;
            $detail->Time = $time;

            $this->getCache()->set($key, $detail, 36000);
        }

        return $detail;

    }
}