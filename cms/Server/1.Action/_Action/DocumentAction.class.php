<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentAction
 *
 * @author joy
 */
class DocumentAction extends Action {

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
                renderView("document", "apiList", $list);
            }
        }
    }

    private function getDocList() {
        $list = array();
        $list["ExchangeInfo"] = array("name" => "获取交易所列表", "path" => "/1.Action/_Service/ExchangeInfoService.class.php");
        $list["NoticeDetail"] = array("name" => "获得公告详情", "path" => "/1.Action/_Controller/NoticeDetailController.class.php");
        $list["NoticeList"] = array("name" => "获得交易所列表", "path" => "/1.Action/_Controller/NoticeListController.class.php");


        return $list;
    }

}
