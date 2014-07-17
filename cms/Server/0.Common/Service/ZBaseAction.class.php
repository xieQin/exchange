<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ZBaseAction
 *
 * @author joy
 */
abstract class ZBaseAction extends Action {

    protected function checkValid($header) {
        //check token valid
        $valid_tokens = getC("tokens");
        if ($valid_tokens && !in_array($header->token, $valid_tokens)) {
            ErrorCode::throwError(ErrorCode::TOKEN无效);
        }

        //check ip valid
        $valid_ips = getC("ips");
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($valid_ips && !in_array($ip, $valid_ips)) {
            ErrorCode::throwError(ErrorCode::IP无效);
        }
        return true;
    }

    public function isDES() {
        return false;
    }

    /**
     * 把请求的头数据反序列化成 ZRequestHeader 对象
     * @param string $requestHeaderString
     * @return ZRequestHeader
     */
    protected function formatRequestHeader($requestHeaderString) {
        if ($this->isDES()) {
            $decode = MyDes::share()->decode($requestHeaderString, DES_KEY);
            $json = json_decode($decode);
        } else {
            $json = json_decode($requestHeaderString);
        }
        return $json;
    }

    /**
     * 反序列化请求数据
     * @param string $requestJsonData
     * @return mixed
     */
    protected function formatRequestData($requestDataString) {
        if ($this->isDES()) {
            $decode = MyDes::share()->decode($requestDataString, DES_KEY);
            $json = json_decode($decode);
        } else {
            $json = json_decode($requestDataString);
        }

        return $json;
    }

    /**
     * 返回操作错误，状态400未知类型错误，非400为已知类型错误。
     * @param string $msg 错误信息
     * @param int $code 错误状态
     */
    protected function responseFail($msg = "操作失败", $code = 400, $des = true) {
        $response = array();
        $response["s"] = is_int($code) ? $code : 400;
        $response["d"] = !$msg ? "" : $msg;
        $this->responseJson($response, $des);
    }

    /**
     * 返回操作成功，状态为200，
     * @param mixed $data 返回的操作结果数据，为任意类型。
     */
    protected function responseSuccess($data, $des = true) {
        $response = array();
        $response["s"] = 200;
        $response["d"] = $data === null ? "" : $data;
        $this->responseJson($response, $des);
    }

    protected function responseJson($response, $des = true) {
        //$des = false;
        $json = json_encode($response);
        if (!$this->isDES()) {
            echo $json;
        } else {
            echo MyDes::share()->encode($json, DES_KEY);
        }
    }

}
