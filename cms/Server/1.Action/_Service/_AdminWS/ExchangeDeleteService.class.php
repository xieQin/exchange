<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PraiseDeleteService
 * 后台点赞delete接口
 * @author zq
 */
class ExchangeDeleteService extends ZBaseService {

    /**
     * 后台点赞delete接口
     * @param ExchangeDeleteRequestData $data
     * @return int  4000-成功，4050-失败
     */
    public function act($data) {
        $this->checkParams($data);
        $facade = new CMSApiServiceFacade();
        return $facade->delExchange($data);
    }

    public function checkParams($data) {
        if ($data->ExchangeId == null || $data->ExchangeId == 0) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
        }
    }

//put your code here
}

/**
 * 后台点赞delete接口请求参数
 */
class ExchangeDeleteRequestData {

    /**
     * 点赞主键id，必须
     * @var long 
     */
    public $ExchangeId;

}
