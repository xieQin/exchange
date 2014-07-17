<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HasNewMsg
 *
 * @author zq
 */
class HasNewMsg extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "HasNewMsg";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
