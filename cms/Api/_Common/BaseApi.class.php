<?php

/**
 * Description of BaseApi
 *
 * @author joy
 */
abstract class BaseApi {

    /**
     * 请求远程服务URL
     */
    abstract function serverUrl();

    /**
     * 请求远程服务token
     */
    abstract function serverToken();

    /**
     * 请求服务的deskey
     */
    abstract function serverDESKEY();

    /**
     * (返回结果)是否被des加密
     */
    abstract function isDES();

    /**
     * 服务端是否加密
     */
    abstract function serverIsDes();

    /**
     * 请求是否加密
     */
    abstract function requestIsDes();

    /**
     * 请求远程服务的方法
     */
    abstract function doAct();

    /**
     * 缓存时间，为0不缓存
     */
    abstract function cacheTimeLength();

    /**
     * 本接口服务的APPID
     */
    function appid() {
        return APPID;
    }

    function query($queryData, $isCache = true) {
        //缓存
        $isCache = $isCache && $this->cacheTimeLength() > 0;
        if ($isCache) {
            $mc = MC();
            $mk_d = $this->doAct() . "_" . md5($queryData);
            $mk_t = $mk_d . "_lasttime2";

            if ($mc->get($mk_t)) {
                $data = $mc->get($mk_d);
                if ($data) {
                    return $data;
                }
            } else {
                $mc->set2($mk_t, "1", $this->cacheTimeLength());
            }
        }

        $data = $this->post($this->serverUrl(), $this->formatQueryParam($queryData));
        if ($this->isDES()) {
            //先解密
            $data = MyDes::share()->decode($data, $this->serverDESKEY());
            //后加密
            $data = MyDes::share()->encode($data, DES_KEY);
        }

        if ($isCache) {
            //数据最长保存一小时（实际缓存时间为$mk_t的缓存时间）
            $mc->set($mk_d, $data, 60 * 60);
        }

        return $data;
    }

    function post($remote_server, $post_string) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $remote_server);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode == 200) {
            return $data;
        } else {
            return false;
        }
    }

    private function formatQueryParam($queryData) {
        $header = new ServerQueryHeander();
        $header->appId = $this->appid();
        $header->token = $this->serverToken();
        $header->act = $this->doAct();

        $params = array();
        if ($this->serverIsDes()) {
            //先解密
            $p = MyDes::share()->decode($queryData, DES_KEY);
            //后加密
            $p = MyDes::share()->encode($p, $this->serverDESKEY());

            $params['h'] = MyDes::share()->encode(json_encode($header), $this->serverDESKEY());

            $params['p'] = $p;
//            $h = MyDes::share()->encode(json_encode($header), $this->serverDESKEY());
//
//            //先解密
//            $p = MyDes::share()->decode($queryData, DES_KEY);
//            //后加密
//            $p = MyDes::share()->encode($p, $this->serverDESKEY());
        } else {
            $params['h'] = json_encode($header);
            $params['p'] = $queryData;
        }

        return $params;
    }

}

class ServerQueryHeander {

    public $appId;
    public $token;
    public $act;

}
