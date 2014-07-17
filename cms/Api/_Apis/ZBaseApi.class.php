<?php

/**
 * Description of ZBaseApi
 *
 * @author zq
 */
abstract class ZBaseApi extends BaseApi {

    public function cacheTimeLength() {
        return 0;
    }

    /**
     * (返回结果)是否被des加密
     */
    function isDES() {
        return FALSE;
    }

    /**
     * 服务端是否加密
     */
    function serverIsDes() {
        return FALSE;
    }

    /**
     * 请求是否加密
     */
    function requestIsDes() {
        return FALSE;
    }

    public function serverDESKEY() {
        return SNS_SERVER_DESKEY;
    }

    public function serverToken() {
        return SNS_SERVER_TOKEN;
    }

    protected function urlService() {
        return SNS_SERVER_URL . "/service";
    }

    protected function urlController() {
        return SNS_SERVER_URL . "/controller";
    }

}
