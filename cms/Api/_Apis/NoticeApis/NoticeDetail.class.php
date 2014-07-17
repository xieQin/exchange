<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoticeDetail
 *
 * @author zq
 */
class NoticeDetail extends ZBaseApi {

    public function doAct() {
        return "NoticeDetail";
    }

    public function isDES() {
        return false;
    }

    public function serverUrl() {
        return $this->urlController();
    }

}
