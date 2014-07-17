<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MemcachedKeyFactory
 *
 * @author zq
 */
class MemcachedKeyFactory {

    public static function ttNoticeKey() {
        return 'tt_notice';
    }

    public static function gdNoticeKey() {
        return 'gd_notice';
    }

    public static function gjNoticeKey() {
        return 'gj_notice';
    }
    
    public static function exchangeInfoKey(){
        return 'zj_exchangeinfo';
    }

}

?>
