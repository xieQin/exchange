<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMSApiServiceFacade
 *
 * @author zq
 */
class CMSApiServiceFacade extends BBaseFacade {

    public function getExchangeList() {
        $facade = DSCMSBusinessFactory::getExchange();

        return $facade->getExchangeList();
    }

    /**
     * 
     * @param ExchangeQueryRequestData $data
     * @return mixed
     */
    public function queryExchange($data) {
        $facade = DSCMSBusinessFactory::getExchange();

        $searchParams = new ExchangeInfoSearchParams();
        $searchParams->ExchangeCode = $data->ExchangeCode;
        $searchParams->ExchangeId = $data->ExchangeId;
        return $facade->queryByParams($searchParams, 10, $data->Page);
    }

    /**
     * 
     * @param ExchangeInsertRequestData $data
     */
    public function createNewExchange($data) {
        $facade = DSCMSBusinessFactory::getExchange();
        $res = $facade->createNew($data);
        return $res > 0 ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param ExchangeDeleteRequestData $data
     * @return int
     */
    public function delExchange($data) {
        if (!isset($data->ExchangeId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $facade = DSCMSBusinessFactory::getExchange();

        $res = $facade->deleteExchangeInfo($data->ExchangeId);

        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param ExchangeUpdateRequestData $data
     * @return int
     */
    public function updateExchange($data) {
        if (!isset($data->ExchangeId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

       
        $d = $this->mergeUpdateParams($data);
        
        $facade = DSCMSBusinessFactory::getExchange();
        $res = $facade->modifyExchangeInfo($d);
     
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

}

?>
