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
        $facade = new BGJNoticeFacade();
        echo json_encode($facade->getNotice());
    }

    public function getdetail() {
        $facade = new BGJNoticeFacade();
        $res = $facade->getDetail('http://www.guojin.org/NewInfo.aspx?type=12&Id=1107');
        
        echo $res->Content;
    }

}

?>
