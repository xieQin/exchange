<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BGDNoticeFacade
 *
 * @author zq
 */
class BGDNoticeFacade extends BBaseFacade {
    //put your code here

    const GD_URL = 'http://www.pmec.com/channels/16.html';

    public function getNotice() {
//$html = new simple_html_dom();

            $key1 = MemcachedKeyFactory::gdNoticeKey();
        //$this->getCache()->delete($key1);
        $res = $this->getCache()->get($key1);
        if ($res !== FALSE && !empty($res)) {
            return $res;
        }

        $html = file_get_html(self::GD_URL);


        if ($html !== FALSE) {

            $arr = array();
            $res = $html->find('article', 0);
            //$ch = $res->children(0)->children(0)->find('table', 1);
            $list = $res->find('li');
            foreach ($list as $key => $item) {
                $entity = new TTNoticeEntity();
                $entity->Title = $item->find('a', 0)->text();
                $entity->Short = '';
                $entity->Time = $item->find('span', 0)->text();
                $entity->Url = 'http://www.pmec.com' . $item->find('a', 0)->getAttribute("href");
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


            $res = $html->find('article', 0);
            $title = $res->find('.title', 0)->text();
            $content = "";
            $nodes = $res->nodes;
            foreach ($nodes as $k => $n) {

                $class = $n->getAttribute("class");
//                if (empty()) {
//                    $content.=$n->outertext();
//                }
                if ($class === FALSE) {
                    $content.=$class = $n->outertext();
                }
            }
            $time = $res->find('.post-time', 0)->text();

//$detail = new NoticeDetailEntity();
            $detail->Content = $content;
            $detail->Title = $title;
            $detail->Time = $time;

            $this->getCache()->set($key, $detail, 36000);
        }

        return $detail;
    }

}

?>
