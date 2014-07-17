<?php

require_once 'ds.define.php';

/**
 * Description of 0
 *
 * @author joy
 */
abstract class DSBase {

    /**
     * 返回单例
     */
    abstract static function share();

    /**
     * 分页查询
     */
    abstract function getPageList(&$param, $page = 1, $pageSize = 10);

    /**
     * 添加 和 修改时，验证数据的有效性
     */
    abstract function checkDataValid(&$data);

    /**
     * 添加对象，操作成功返回新纪录的id值。
     * @param array $data
     * @return int
     */
    public function add(&$data) {
        $this->checkDataValid($data);
        $m = M($this->tableName());
        return $m->add($data);
    }

    /**
     * 修改对象，返回 true|false 
     * @param array $data 修改属性，其中应该包括id定义（修改该id指定记录）
     * @param bool $check 指定操作前是否进行有效性验证；
     * @return boolean
     */
    public function modify(&$data, $check = true) {
        if ($check) {
            $this->checkDataValid($data);
        }

        $tableName = $this->tableName();
        $tableId = $this->tableId();
        $m = M($tableName);

        if ($m->where("{$tableId}=?", array($data[$tableId]))->update($data)) {
            $this->clearTableObjectCacheById($tableName, $data[$tableId]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除指定记录
     * @param int $id
     * @return boolean
     */
    public function deleteById($id) {
        $tableName = $this->tableName();
        $tableId = $this->tableId();

        $m = M($tableName);
        $m->where("{$tableId}=?", array($id))->delete();
        $this->clearTableObjectCacheById($tableName, $id);
        return true;
    }

    /**
     * 取指定id的记录
     * @param int $id
     * @return object
     */
    public function getById($id) {

        $tableId = $this->tableId();
        return $this->getTableObjectById($this->tableName(), $id, $tableId);
    }

    /**
     * 清楚指定记录的Cache
     * @param string $table 指定表
     * @param int $id 指定id
     */
    public function clearTableObjectCacheById($table, $id) {
        $mkey = TABLE_CACHE_PRE . "_OBJECT_WITH_ID_{$table}_{$id}";
        $mc = MC();

        $mc->delete($mkey);
    }

    /* --- private ----------- */

    /**
     * 返回操作的表名
     */
    abstract protected function tableName();

    /**
     * 返回表的主键定义，如果不是“id”，要重载该方法。
     * @return string
     */
    protected function tableId() {
        return "id";
    }

    /**
     * 取指定表指定id的数据记录
     * @param string $table 指定的表
     * @param int $id 指定的id值
     * @param string $idName 表主键的命名
     * @return object
     */
    protected function getTableObjectById($table, $id, $idName = "id") {
        $id = trim($id);
        $mkey = TABLE_CACHE_PRE . "_OBJECT_WITH_ID_{$table}_{$id}";
        $mc = MC();
        $obj = $mc->get($mkey);
        if (!$obj) {
            $m = M("$table");
            //$m->debugSql = true;
            $obj = $m->where("{$idName}=?", array($id))->find();

            if ($obj) {
                $mc->set($mkey, $obj, 60 * 60 * 24);
            }
        }
        return $obj;
    }

    /**
     * 分页查询，返回 array("c"=>"总数", "d"=>"列表数据")
     * @param string $table 数据表名
     * @param string $where where条件
     * @param array $wData where参数
     * @param string $order order by 条件
     * @param string $limit limit条件
     * @param string $fields 返回的字段
     */
    protected function getPageListWith($table, $where, $wParam, $order, $limit, $fields = null) {
        $m = M($table);
        //$m->debugSql = true;
        $rl = $m->where($where, $wParam)->find(" count(0) as c ");
        $c = $rl["c"];
        if ($c <= 0) {
            return array("c" => 0, "d" => array());
        }
        //$m->debugSql = true;
        $rl = $m->where($where, $wParam)->order($order)->limit($limit)->select($fields);
        return array("c" => $c, "d" => $rl);
    }

}

