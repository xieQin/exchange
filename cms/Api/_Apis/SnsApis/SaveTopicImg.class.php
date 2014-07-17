<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaveTopicImg
 *
 * @author zq
 */
class SaveTopicImg extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "SaveTopicImg";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
