<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMSTestAction
 *
 * @author zq
 */
class CMSTestAction extends ZBaseAction {

    //put your code here

    public function test() {
        $facade = new BGDNoticeFacade();
        echo json_encode($facade->getNotice());
    }

    public function getdetail() {
        // globale $url;
        $facade = new BGDNoticeFacade();
        $res = $facade->getDetail("http://www.pmec.com/contents/16/10356.html");

        echo $res->Content;
    }

    public function getD() {
        $facade = new GJNoticeFacade();
        // $res = $facade->getDetail('http://www.guojin.org/NewInfo.aspx?type=12&Id=1107');
        // echo 1;
        // echo $res->Content;
        echo json_encode($facade->getNotice());
    }

}

?>
