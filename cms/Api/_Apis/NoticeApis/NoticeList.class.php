<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class NoticeList extends ZBaseApi {

    public function doAct() {
        return "NoticeList";
    }

    public function isDES() {
        return false;
    }

    public function serverUrl() {
        return $this->urlController();
    }

}

