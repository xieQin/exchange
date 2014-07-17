<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DSCMSBusinessFactory
 *
 * @author zq
 */
class DSCMSBusinessFactory {

    //put your code here

    /**
     * 
     * @return \BExchangeInfoFacade
     */
    public static function getExchange() {
        return new BExchangeInfoFacade();
    }

}

?>
