<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModifyUserBg
 *
 * @author zq
 */
class ModifyUserBg extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "ModifyUserBg";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
