<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetTopic
 *
 * @author zq
 */
class GetReply extends SnsBaseApi {

    public function doAct() {
        return "GetReply";
    }


    public function serverUrl() {
        return $this->urlService();
    }

}