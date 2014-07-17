<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BindUser
 *
 * @author zq
 */
class PublishTopic extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "PublishTopic";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
