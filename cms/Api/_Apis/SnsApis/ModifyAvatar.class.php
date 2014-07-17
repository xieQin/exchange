<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModifyAvatar
 *
 * @author zq
 */
class ModifyAvatar extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "ModifyAvatar";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
