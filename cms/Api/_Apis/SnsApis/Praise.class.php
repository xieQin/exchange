<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Praise
 *
 * @author zq
 */
class Praise extends SnsBaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    public function doAct() {
        return "Praise";
    }

    public function serverUrl() {
        return $this->urlService();
    }

}
