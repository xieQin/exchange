<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExchangeQueryRequestData
 * 后台交易所信息查询接口
 * @author zq
 */
class ExchangeQueryService extends ZBaseService {

    /**
     * 后台点赞查询接口    
     * @param ExchangeQueryRequestData $data
     * @return array
     */
    public function act($data) {

        $facade = new CMSApiServiceFacade();
        return $facade->queryExchange($data);
    }

//put your code here
}

/**
 * 后台交易所信息查询接口请求参数
 */
class ExchangeQueryRequestData {

    /**
     * 当前页，必须传，从1开始
     * @var int 
     */
    public $Page;

    /**
     * 交易所id,必须传,如果不是条件传null
     * @var int 
     */
    public $ExchangeId;

    /**
     * 交易所代码,必须传,如果不是条件传null
     * @var string 
     */
    public $ExchangeCode;
}
