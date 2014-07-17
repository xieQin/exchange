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
        $list["PraiseInsert"] = array("name" => "新增点赞", "path" => "/1.Action/_Service/_AdminWS/PraiseInsertService.class.php");
        $list["PraiseDelete"] = array("name" => "删除点赞", "path" => "/1.Action/_Service/_AdminWS/PraiseDeleteService.class.php");
        $list["PraiseUpdate"] = array("name" => "更新点赞", "path" => "/1.Action/_Service/_AdminWS/PraiseUpdateService.class.php");
        $list["PraiseQuery"] = array("name" => "查询点赞", "path" => "/1.Action/_Service/_AdminWS/PraiseQueryService.class.php");



        $list["TopicInsert"] = array("name" => "新增主题", "path" => "/1.Action/_Service/_AdminWS/TopicInsertService.class.php");
        $list["TopicDelete"] = array("name" => "删除主题", "path" => "/1.Action/_Service/_AdminWS/TopicDeleteService.class.php");
        $list["TopicUpdate"] = array("name" => "更新主题", "path" => "/1.Action/_Service/_AdminWS/TopicUpdateService.class.php");
        $list["TopicQuery"] = array("name" => "查询主题", "path" => "/1.Action/_Service/_AdminWS/TopicQueryService.class.php");


        $list["ReplyInsert"] = array("name" => "新增回复", "path" => "/1.Action/_Service/_AdminWS/ReplyInsertService.class.php");
        $list["ReplyDelete"] = array("name" => "删除回复", "path" => "/1.Action/_Service/_AdminWS/ReplyDeleteService.class.php");
        $list["ReplyUpdate"] = array("name" => "更新回复", "path" => "/1.Action/_Service/_AdminWS/ReplyUpdateService.class.php");
        $list["ReplyQuery"] = array("name" => "查询回复", "path" => "/1.Action/_Service/_AdminWS/ReplyQueryService.class.php");


        $list["UserUpdate"] = array("name" => "更新用户", "path" => "/1.Action/_Service/_AdminWS/UserUpdateService.class.php");
        $list["UserQuery"] = array("name" => "查询用户", "path" => "/1.Action/_Service/_AdminWS/UserQueryService.class.php");


        $list["TopicImgDelete"] = array("name" => "删除主题图片", "path" => "/1.Action/_Service/_AdminWS/TopicImgDeleteService.class.php");
        $list["TopicImgQuery"] = array("name" => "查询主题图片", "path" => "/1.Action/_Service/_AdminWS/TopicImgQueryService.class.php");


        $list["BgAddOrUpdate"] = array("name" => "添加或更新背景图", "path" => "/1.Action/_Service/_AdminWS/BgAddOrUpdateService.class.php");
        $list["GetBg"] = array("name" => "获得背景图", "path" => "/1.Action/_Service/GetBgService.class.php");


        return $list;
    }

}
