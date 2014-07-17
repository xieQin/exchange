<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetReply
 *
 * @author zq
 */
class GetTopic extends SnsBaseApi {

    public function doAct() {
        return "GetTopic";
    }


    public function serverUrl() {
        return $this->urlService();
    }

}