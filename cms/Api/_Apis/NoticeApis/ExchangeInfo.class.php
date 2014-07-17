<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExchangeInfo
 *
 * @author zq
 */
class ExchangeInfo extends ZBaseApi {
    public function doAct() {
        return "ExchangeInfo";
    }


    public function serverUrl() {
        return $this->urlService();
    }
    
}

?>
