<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ZDSBase
 *
 * @author zq
 */
abstract class ZDSBase extends DSBase {

    abstract function getParams(&$searchParams, $alias = "");

    //  abstract function getParamsWithAlias(&$searchParams, $alias = null);

    public function getCount(&$searchParams) {
        $where = $this->getParams($searchParams);
        $m = M($this->tableName());
        //$m->debugSql = true;
        $rl = $m->where($where['where'], $where['params'])->find(" count(0) as c ");

        $c = $rl["c"];
        return $c < 0 ? 0 : $c;
    }


    
    public function clearObjectCacheById( $id) {
        $this->clearTableObjectCacheById($this->tableName(), $id);
    }

}

?>
