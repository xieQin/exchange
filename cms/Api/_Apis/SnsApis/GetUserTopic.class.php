<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetUserTopic
 *
 * @author zq
 */
class GetUserTopic extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "GetUserTopic";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}