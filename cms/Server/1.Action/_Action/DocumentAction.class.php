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
        $list["BindUser"] = array("name" => "绑定用户信息（包括背景、头像）", "path" => "/1.Action/_Service/BindUserService.class.php");
        $list["DeleteTopic"] = array("name" => "删除主题", "path" => "/1.Action/_Service/DeleteTopicService.class.php");
        $list["GetAllTopic"] = array("name" => "获得所有主题分页", "path" => "/1.Action/_Service/GetAllTopicService.class.php");
        $list["GetTopic"] = array("name" => "获得主题详情", "path" => "/1.Action/_Service/GetTopicService.class.php");
        $list["GetUserMsg"] = array("name" => "获得用户消息列表分页", "path" => "/1.Action/_Service/GetUserMsgService.class.php");
        $list["GetUserTopic"] = array("name" => "获得用户主题分页", "path" => "/1.Action/_Service/GetUserTopicService.class.php");
        $list["HasNewMsg"] = array("name" => "是否有新消息", "path" => "/1.Action/_Service/HasNewMsgService.class.php");
        $list["ModifyAvatar"] = array("name" => "修改头像", "path" => "/1.Action/_Service/ModifyAvatarService.class.php");
        $list["Praise"] = array("name" => "点赞", "path" => "/1.Action/_Service/PraiseService.class.php");
        $list["PublishTopic"] = array("name" => "发布主题", "path" => "/1.Action/_Service/PublishTopicService.class.php");
        $list["Reply"] = array("name" => "回复主题或回复他人", "path" => "/1.Action/_Service/ReplyService.class.php");
        //$list["SaveTopicImg"] = array("name" => "保存主题图片", "path" => "/1.Action/_Service/SaveTopicImgService.class.php");
        $list["GetReply"] = array("name" => "获得主题的回复分页", "path" => "/1.Action/_Service/GetReplyService.class.php");
        //$list["GetBg"] = array("name" => "获得背景", "path" => "/1.Action/_Service/GetBgService.class.php");
        $list["ModifyUserBg"] = array("name" => "修改用户背景", "path" => "/1.Action/_Service/ModifyUserBgService.class.php");


        return $list;
    }

}
