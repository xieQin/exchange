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
class BindUser extends SnsBaseApi {

    
    
    public function doAct() {
        return "BindUser";
    }


    public function serverUrl() {
        return $this->urlService();
    }

    
}
