<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BExchangeInfoFacade
 *
 * @author zq
 */
class BExchangeInfoFacade extends BBaseFacade {

    //put your code here
    public function getExchangeList() {

        $key = MemcachedKeyFactory::exchangeInfoKey();

        $res = $this->getCache()->get($key);
        if ($res !== FALSE) {
            return $res;
        }

        $searchParams = new ExchangeInfoSearchParams();
        $searchParams->ExchangeCode = null;
        $searchParams->ExchangeId = null;
        $res = DSExchangeInfo::share()->getPageList($searchParams);

        if ($res) {

            $this->getCache()->set($key, $res, 60000);
        }

        return $res;
    }

    public function queryByParams($searchParams, $pageSize = 10, $page = 1) {
        if ($searchParams == null) {
            ErrorCode::throwError(ErrorCode::查询记录必须有查询参数对象);
            return FALSE;
        }

        $res = DSExchangeInfo::share()->getPageList($searchParams, $page, $pageSize, null, null);
        return $res;
    }

    /**
     * 
     * @param ExchangeInsertRequestData $exchangeEntity
     */
    public function createNew($exchangeEntity) {

        $entity = array(
            "ExchangeCode" => $exchangeEntity->ExchangeCode,
            "ExchangeName" => $exchangeEntity->ExchangeName,
            "Description" => $exchangeEntity->Desc,
            "Url" => $exchangeEntity->Url,
            'Img' => $exchangeEntity->ImgUrl
        );

        $res = DSExchangeInfo::share()->add($entity);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::exchangeInfoKey());
        }
        return $res > 0;
    }

    public function modifyExchangeInfo($exchangeEntity) {
        if (!isset($exchangeEntity['ExchangeId'])) {
            ErrorCode::throwError(ErrorCode::修改记录必须传主键);
            return FALSE;
        }
        $res = DSExchangeInfo::share()->modify($exchangeEntity);
        if ($res) {

            $this->getCache()->delete(MemcachedKeyFactory::exchangeInfoKey());
        }
        return $res;
    }

    public function deleteExchangeInfo($exchangeId) {

        $res = DSExchangeInfo::share()->deleteById($exchangeId);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::exchangeInfoKey());
        }
        return $res;

        return FALSE;
    }

}
