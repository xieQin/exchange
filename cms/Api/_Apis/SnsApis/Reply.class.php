<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reply
 *
 * @author zq
 */
class Reply extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "Reply";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
