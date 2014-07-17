<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DSBusinessFactory
 *
 * @author zq
 */
class DSBusinessFactory {
    //put your code here

    /**
     * 
     * @return \BPraiseFacade
     */
    public static function getPraise() {
        return new BPraiseFacade();
    }

    /**
     * 
     * @return \BReplyFacade
     */
    public static function getReply() {
        return new BReplyFacade();
    }

    /**
     * 
     * @return \BTopicFacade
     */
    public static function getTopic() {
        return new BTopicFacade();
    }

    /**
     * 
     * @return \BTopicImgFacade
     */
    public static function getTopicImg() {
        return new BTopicImgFacade();
    }

    /**
     * 
     * @return \BUserInfoFacade
     */
    public static function getUserInfo() {
        return new BUserInfoFacade();
    }

    /**
     * 
     * @return \BBGFacade
     */
    public static function getBg() {
        return new BBGFacade();
    }

}

?>
