<?php

include_once '_Common/ApiHeader.class.php';
include_once '_Common/BaseApi.class.php';
include_once '_Common/LogHandler.class.php';

/**
 * Description of ApiAction
 *
 * @author joy
 */
class ApiAction extends Action {

    const ERROR = 40400;
    const TOKEN_INVALID = 40500;
    const ACT_INEXIST = 40600;

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

    protected function checkValid($header) {
        //check token valid
        $valid_tokens = getC("tokens");
        if ($valid_tokens && !in_array($header->token, $valid_tokens)) {
            return false;
        }

        return true;
    }

    /**
     * 把请求的头数据反序列化成 ApiHeader 对象
     * @param string $requestHeaderString
     * @return ApiHeader
     */
    protected function formatRequestHeader($requestHeaderString) {
        if ($this->requestIsDes()) {

            $decode = MyDes::share()->decode($requestHeaderString, DES_KEY);

            $json = json_decode($decode);

            return $json;
        } else {

            $json = json_decode($requestHeaderString);
            return $json;
        }
    }

}