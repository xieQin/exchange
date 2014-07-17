<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetAllTopic
 *
 * @author zq
 */
class GetAllTopic extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "GetAllTopic";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
