<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentForAdminAction
 *
 * @author joy
 */
class DocumentForAdminAction extends Action {

    function index() {
        global $q_tag, $q_type;

        $enable = getC("document_enable");
        if ($enable !== true) {
            echo "document disabled";
            return;
        }

        $list = $this->getDocList();
        if (isset($q_type)) {
            if (isset($list[$q_tag])) {
                $doc = TestGen::generateDoc(getC("APP_PATH") . $list[$q_tag]["path"]);
                echo $doc;
            } else {
                echo 'No Test';
            }
        } else {
            if (isset($list[$q_tag])) {
                $doc = ApiDocHandler::generateDoc(getC("APP_PATH") . $list[$q_tag]["path"]);
                echo $doc;
            } else {
                renderView("document", "adminWsList", $list);
            }
        }
    }

    private function getDocList() {
        $list = array();
        $list["ExchangeInsert"] = array("name" => "新增交易所信息", "path" => "/1.Action/_Service/_AdminWS/ExchangeInsertService.class.php");
        $list["ExchangeDelete"] = array("name" => "删除交易所信息", "path" => "/1.Action/_Service/_AdminWS/ExchangeDeleteService.class.php");
        $list["ExchangeUpdate"] = array("name" => "更新交易所信息", "path" => "/1.Action/_Service/_AdminWS/ExchangeUpdateService.class.php");
        $list["ExchangeQuery"] = array("name" => "查询交易所信息", "path" => "/1.Action/_Service/_AdminWS/ExchangeQueryService.class.php");


        return $list;
    }

}
