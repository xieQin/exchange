<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetUserMsg
 *
 * @author zq
 */
class GetUserMsg extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "GetUserMsg";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}