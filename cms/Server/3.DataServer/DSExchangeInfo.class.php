<?php

/**
 * Description of DSExchangeInfo
 *
 * @author zq
 */
class DSExchangeInfo extends ZDSBase {

    /**
     * @return DSExchangeInfo
     */
    static function share() {
        static $ins = null;
        if (!$ins) {
            $ins = new DSExchangeInfo();
        }
        return $ins;
    }

    protected function tableName() {
        return CMS_EXCHANGEINFO;
    }

    protected function tableId() {
        return CMS_EXCHANGEINFO_ID;
    }

    public function checkDataValid(&$data) {
        
    }

    /**
     * 
     * @param ExchangeInfoSearchParams $searchParams
     * @param type $page
     * @param type $pageSize
     * @param type $order
     * @param type $fields
     * @return PageEntity
     */
    public function getPageList(&$searchParams, $page = 1, $pageSize = 10, $order = null, $fields = null) {
        $where = $this->getParams($searchParams);
        $limit = null;
        if (!empty($page) || !empty($pageSize)) {
            $limit = ($page - 1) * $pageSize . ",{$pageSize}";
        }

        $rs = $this->getPageListWith($this->tableName(), $where['where'], $where['params'], $order, $limit, $fields);
        $entity = new PageEntity();

        $entity->Data = is_array($rs['d']) ? $rs['d'] : array();
        $entity->Total = $rs['c'];
        $entity->IsEnd = (empty($page) || empty($pageSize)) ? TRUE : $entity->Total <= $page * $pageSize;
        return $entity;
    }

    /**
     * 
     * @param ExchangeInfoSearchParams $searchParams
     * @return array
     */
    public function getParams(&$searchParams, $alias = "") {
        $where = '1=1';
        $data = array();
        if ($searchParams->ExchangeId !== null) {
            $where .= " and ExchangeId = ?";
            $data[] = $searchParams->ExchangeId;
        }
        if ($searchParams->ExchangeCode !== null) {
            $where .= " and ExchangeCode = ?";
            $data[] = $searchParams->ExchangeCode;
        }

        return array(
            'where' => $where,
            'params' => $data
        );
    }

}
