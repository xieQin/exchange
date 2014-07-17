<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExchangeInsertService
 * 后台交易所insert接口
 * @author zq
 */
class ExchangeInsertService extends ZBaseService {

    /**
     * 
     * @param ExchangeInsertRequestData $data
     * @return int  4000-成功，4050-失败
     */
    public function act($data) {
        $this->checkParams($data);
        $facade = new CMSApiServiceFacade();
        return $facade->createNewExchange($data);
    }

    /**
     * 
     * @param ExchangeInsertRequestData $data
     */
    public function checkParams($data) {
        if ($data->ExchangeCode == null || $data->ExchangeName == NULL || $data->Desc == null || $data->Url == null || $data->ImgUrl == null) {
            ErrorCode::throwError(ErrorCode::参数不全);
        }
    }

//put your code here
}

/**
 * 后台交易所insert接口请求参数
 */
class ExchangeInsertRequestData {

    /**
     * 必须传 ,交易所代码 
     * @var string 
     */
    public $ExchangeCode;

    /**
     * 名称，该字段必须传
     * @var string 
     */
    public $ExchangeName;

    /**
     * 描述，该字段必须传
     * @var string 
     */
    public $Desc;

    /**
     * 交易所详情地址，该字段必须传
     * @var string 
     */
    public $Url;

    /**
     * 图片URL, 必须传
     * @var string 
     */
    public $ImgUrl;

}
