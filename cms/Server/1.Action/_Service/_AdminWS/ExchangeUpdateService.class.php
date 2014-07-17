<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExchangeUpdateService
 * 后台交易所update接口
 * @author zq
 */
class ExchangeUpdateService extends ZBaseService {

    /**
     * 后台点赞update接口
     * @param ExchangeUpdateRequestData $data
     * @return int  4000-成功，4050-失败
     */
    public function act($data) {
        $this->checkParams($data);
        $facade = new CMSApiServiceFacade();
        return $facade->updateExchange($data);
    }

    /**
     * 
     * @param ExchangeUpdateRequestData $data
     */
    public function checkParams($data) {
        if ($data->ExchangeId == null || $data->ExchangeId == 0) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
        }
    }

//put your code here
}

/**
 * 后台交易所update接口请求参数
 */
class ExchangeUpdateRequestData {

    /**
     * 交易所主键id，必须
     * @var long 
     */
    public $ExchangeId;

    /**
     * 交易所代码 ，如果不修改传null
     * @var string 
     */
    public $ExchangeCode;

    /**
     * 名称，如果不修改传null
     * @var string 
     */
    public $ExchangeName;

    /**
     * 描述，如果不修改传null
     * @var string 
     */
    public $Desc;

    /**
     * 交易所详情地址，如果不修改传null
     * @var string 
     */
    public $Url;

    /**
     * 图片URL，如果不修改传null
     * @var string 
     */
    public $ImgUrl;

}
