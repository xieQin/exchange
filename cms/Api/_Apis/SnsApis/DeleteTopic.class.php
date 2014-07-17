<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DeleteTopic
 *
 * @author zq
 */
class DeleteTopic extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "DeleteTopic";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
