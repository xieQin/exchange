<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExchangeInfoService
 * 获得交易所列表接口
 * @author zq
 */
class ExchangeInfoService extends ZBaseService {
    //put your code here

    /**
     * 返回数组对象格式
     * array(
     *  result:获取结果，boolean, true成功，false失败
     *  userinfo：数组，array(
     *                          nickname: 昵称 string
     *                       avatar：头像地址  string
     *                 )
     *  )
     * @param ExchangeInfoRequestData $data
     * @return array
     */
    public function act($data) {
        $facade = new CMSApiServiceFacade();
        return $facade->getExchangeList($data);
    }

}

/**
 * 获得交易所列表请求参数
 */
class ExchangeInfoRequestData {
    
}