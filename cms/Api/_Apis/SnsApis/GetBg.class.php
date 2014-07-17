<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetBg
 *
 * @author zq
 */
class GetBg extends SnsBaseApi {

    
    
    public function doAct() {
        return "GetBg";
    }


    public function serverUrl() {
        return $this->urlService();
    }

    
}
