<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadImgAction
 *
 * @author zq
 */
class UploadImgAction extends ApiAction{
    //put your code here
    
    function index() {
        global $q_h, $q_p;
        $header = $this->formatRequestHeader($q_h);
        if (!$this->checkValid($header)) {
            echo self::TOKEN_INVALID;
            return;
        }
        @LogHandler::logQuery($header);

        try {
            if (isset($header->act)) {
                $actClass = $header->act;

                if (class_exists($actClass)) {
                    //my_log($actClass);exit;
                    $o = new $actClass();
                    if (($o instanceof BaseApi)) {
                        echo $o->query($q_p);
                        return;
                    }
                }
            }
        } catch (Exception $exc) {
            echo self::ERROR;
            return;
        }

        echo self::ACT_INEXIST;
        return;
    }
    
    public function requestIsDes() {
        return FALSE;
    }
}

?>
