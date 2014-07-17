<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiServiceFacade
 *
 * @author zq
 */
class ApiServiceFacade extends BBaseFacade {

    public function getBg() {
        $bgFacade = DSBusinessFactory::getBg();
        $res = $bgFacade->getBg();


        return empty($res) ? "" : $res['ImgUrl'];
    }

    //put your code here
    /**
     * 绑定用户
     * @param BindUserRequestData $data
     * @return array
     */
    public function bindUser($data) {
        $userFacade = DSBusinessFactory::getUserInfo();
        $res = $userFacade->getSNSUser($data->userid, $data->safetycode);

        $r = array();
        $r['result'] = isset($res['userid']) && isset($res['safecode']);
        $r['userinfo'] = array(
            'avatar' => $res["avatar"],
            'nickname' => $res['nickname'],
            'bg' => $res['bg']
        );
        return $r;
    }

    /**
     * 
     * @param ModifyUserBgRequestData $data
     */
    public function modifyUserBg($data){
        $by = base64_decode(str_replace(" ", "+", $data->avatar64));
        if ($by === FALSE || empty($by)) {
            return array(
                "result" => FALSE,
                "msg" => "base64解析失败",
                "url" => ''
            );
        }
        $file_url = UploadImgHandler::upImg($by, $data->type);
        $res = array(
        );
        if (empty($file_url)) {
            return array(
                "result" => FALSE,
                "msg" => "上传头像失败",
                "url" => ''
            );
        }

        $userFacade = DSBusinessFactory::getUserInfo();
        if ($userFacade->modifyUserBg($data->userid, $file_url)) {
            $res['result'] = TRUE;
            $res['msg'] = "保存头像成功";
            $res['url'] = $file_url;
        } else {
            return array(
                "result" => FALSE,
                "msg" => "保存头像失败",
                "url" => ''
            );
        }

        return $res;
    }
    
    /**
     * 
     * @param ModifyAvatarRequestData $data
     * @return array
     */
    public function modifyAvatar($data) {

        $by = base64_decode(str_replace(" ", "+", $data->avatar64));
        if ($by === FALSE || empty($by)) {
            return array(
                "result" => FALSE,
                "msg" => "base64解析失败",
                "url" => ''
            );
        }
        $file_url = UploadImgHandler::upImg($by, $data->type);
        $res = array(
        );
        if (empty($file_url)) {
            return array(
                "result" => FALSE,
                "msg" => "上传头像失败",
                "url" => ''
            );
        }

        $userFacade = DSBusinessFactory::getUserInfo();
        if ($userFacade->modifyAvatar($data->userid, $file_url)) {
            $res['result'] = TRUE;
            $res['msg'] = "上传成功";
            $res['url'] = $file_url;
        } else {
            return array(
                "result" => FALSE,
                "msg" => "上传头像失败",
                "url" => ''
            );
        }

        return $res;
    }

    /**
     * 
     * @param SendImgRequestData $data
     * @return array
     */
    public function saveTopicImg($data) {
        $topicFacade = DSBusinessFactory::getTopic();
        $topic = $topicFacade->queryTopicByTopicId($data->topicid);
        $res = array(
        );
        if (is_array($topic)) {
            if ($data->userid == $topic['CreateUserId']) {

                $by = base64_decode(str_replace(" ", "+", $data->img64));

                if ($by === FALSE || empty($by)) {
                    return array(
                        "result" => FALSE,
                        "msg" => "base64解析失败",
                    );
                }
                $file_url = UploadImgHandler::upImg($by, $data->type);

                if ($file_url === FALSE || empty($file_url)) {
                    return array(
                        "result" => FALSE,
                        "msg" => "上传失败",
                    );
                }
                $topicImgFacade = DSBusinessFactory::getTopicImg();

                if ($topicImgFacade->createNew($data->topicid, $data->index, $file_url) > 0) {
                    $res['result'] = TRUE;
                    $res['msg'] = "保存主题图片成功";
                } else {
                    $res['result'] = FALSE;
                    $res['msg'] = "保存主题图片失败";
                }
            }
        }
        return $res;
    }

    /**
     * 
     * @param DeleteTopicRequestData $data
     * @return ResultTF
     */
    public function delTopic($data) {

        $topicFacade = DSBusinessFactory::getTopic();

        $topic = $topicFacade->queryTopicByTopicId($data->topicid);
        if (!is_array($topic)) {

            return ResultCode::RESULT_FALSE;
        } else {
            $userFacade = DSBusinessFactory::getUserInfo();
            $user = $userFacade->queryUserByUid($data->userid);
            if (!isset($topic["CreateUserId"]) || $topic["CreateUserId"] != $data->userid || $user["SafeCode"] != $data->safetycode) {
                return ResultTF::RESULT_FALSE;
            } else {
                if ($topicFacade->deleteTopic($data->topicid)) {
                    return ResultCode::RESULT_TRUE;
                }
            }
        }
        return ResultCode::RESULT_FALSE;
    }

    /**
     * 发布主题
     * @param PublishTopicRequestData $data
     * @return array
     */
    public function publishTopic($data) {
        $topicFacade = DSBusinessFactory::getTopic();
        $res = $topicFacade->createNew($data->userid, $data->content);

        $imgs = $data->imgs;

        if (!empty($imgs)) {
            $topicImgFacade = DSBusinessFactory::getTopicImg();
            $i = 0;
            foreach ($imgs as $key => $value) {
                $topicImgFacade->createNew($res, $i++, $value);
            }
        }

        return array(
            'res' => $res > 1 ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE,
            'id' => $res
        );
    }

    /**
     * 
     * @param GetTopicRequestData $data
     * @return type
     */
    public function getSingleTopic($data) {


        $key = MemcachedKeyFactory::iGetSingeTopicCache($data->topicid);
//$this->getCache()->delete($key);
        $res = $this->getCache()->get($key);

        $praiceFacade = DSBusinessFactory::getPraise();
        if ($res === FALSE) {

            $topicFacade = DSBusinessFactory::getTopic();
            $replyFacade = DSBusinessFactory::getReply();
            $topicImgFacade = DSBusinessFactory::getTopicImg();
            $topic = $topicFacade->queryTopicByTopicId($data->topicid);


            $replys = $replyFacade->queryAllReplyOfTopic($data->topicid, 20, 1);

            $replyCount = $replyFacade->countReply($data->topicid);
            $praiseCount = $praiceFacade->countPraise($data->topicid);

            $topicImgs = $topicImgFacade->queryImgOfTopic($data->topicid);



            $res = array(
                'topic' => $topic,
                'imgs' => $topicImgs,
                'replys' => $replys,
                'replycount' => (string) $replyCount,
                'praisecount' => (string) $praiseCount,
                    // 'avatar' => $userAvatar['AvatarUrl']
            );

            $this->getCache()->set($key, $res, 3600);
        }


        if (isset($data->userid) && !empty($data->userid)) {

            $hasPraise = $praiceFacade->hasPraised($data->topicid, $data->userid);
            $userAvatar = DSUserInfo::share()->getById($data->userid);
        } else {

            $hasPraise = FALSE;
            $userAvatar = '';
        }

        $res['haspraise'] = $hasPraise;
        $res['avatar'] = $userAvatar['AvatarUrl'];

        return $res;
    }

    /**
     * 
     * @param GetReplyRequestData $data
     * @return null
     */
    public function getReplyByTopicId($data) {

        $replyFacade = DSBusinessFactory::getReply();

        $replys = $replyFacade->queryAllReplyOfTopic($data->topicid, 10, $data->page);


        return $replys;
    }

    /**
     * 获得全部主题分页
     * @param GetAllTopicRequestData $data
     */
    public function getAllTopic($data) {

        $key = MemcachedKeyFactory::iGetAllTopicCache();
        // $this->getCache()->delete($key);
        $map = $this->getCache()->get($key);

        if ($map != FALSE) {
            if (isset($map[$data->page])) {
                return $map[$data->page];
            }
        } else {
            $map = array();
        }


        //$userFacade = DSBusinessFactory::getUserInfo();
        $topicFacade = DSBusinessFactory::getTopic();
        $praiceFacade = DSBusinessFactory::getPraise();
        $replyFacade = DSBusinessFactory::getReply();
        $topicImgFacade = DSBusinessFactory::getTopicImg();

        $topic = $topicFacade->queryAllTopic(20, $data->page);
        $res = array();

        $topics = $topic->Data;

        foreach ($topics as $item) {

//            //当前话题是被屏蔽的，并且发布者不是当前用户，则必须屏蔽
//            if ($topic["IsForbidUser"] && $topic["CreateUserId"] != $data->userid) {
//                continue;
//            }
            $topicId = $item['TopicId'];
            $replyCount = $replyFacade->countReply($topicId);
            $praiseCount = $praiceFacade->countPraise($topicId);
            if (isset($data->userid) && !empty($data->userid)) {

                $hasPraise = $praiceFacade->hasPraised($topicId, $data->userid);
            } else {

                $hasPraise = FALSE;
            }
            //$userInfo = $userFacade->queryUserByUid($item['CreateUserId']);
//            $replys = $replyFacade->queryAllReplyOfTopic($topicId, 10, 1);
//            //过滤屏蔽回复
//            $replys3 = $replyFacade->filterReply($replys, $data->userid);
            $replys3 = $replyFacade->getSmallReplyByTopicId($topicId, 3);


            $topicImgs = $topicImgFacade->queryImgOfTopic($topicId);

            $res[] = array(
                //'avatar' => $userInfo['AvatarUrl'],
                'topic' => $item,
                'replycount' => (string) $replyCount,
                'praisecount' => (string) $praiseCount,
                'haspraise' => $hasPraise,
                'replys3' => $replys3,
                'imgs' => $topicImgs,
            );
        }

        $topic->Data = $res;

        $map[$data->page] = $topic;
        $this->getCache()->set($key, $map, 3600);

        return $topic;
    }

    /**
     * 
     * @param HasNewMsgRequestData $data
     * @return int
     */
    public function getNewMsgCount($data) {
        $count = UserMsgFacade::share()->getNewMsgCount($data->userid);

        if ($count > 0) {
            UserMsgFacade::share()->delNewMsgCount($data->userid);
        }

        return $count;
    }

    /**
     * 获得我的主题分页
     * @param GetUserTopicRequestData $data
     */
    public function getUserTopic($data) {


        $key = MemcachedKeyFactory::iGetUserTopicCache($data->userid);

        $map = $this->getCache()->get($key);
        $this->getCache()->delete($key);
        if ($map != FALSE) {
            if (isset($map[$data->page])) {
                return $map[$data->page];
            }
        } else {
            $map = array();
        }


        $topicFacade = DSBusinessFactory::getTopic();

        $topic = $topicFacade->queryTopicByUid($data->userid, 10, $data->page);

        $topicImgFacade = DSBusinessFactory::getTopicImg();

        $topics = $topic->Data;
        $res = array();

        foreach ($topics as $item) {

//            //当前话题是被屏蔽的，并且发布者不是当前用户，则必须屏蔽
//            if ($topic["IsForbidUser"] && $topic["CreateUserId"] != $data->userid) {
//                continue;
//            }
            $topicId = $item['TopicId'];
            $topicImgs = $topicImgFacade->queryImgOfTopic($topicId);

            $res[] = array(
                'topic' => $item,
                'imgs' => $topicImgs,
            );
        }

        $topic->Data = $res;
        $map[$data->page] = $topic;
        $this->getCache()->set($key, $map, 3600);

        return $topic;
    }

    /**
     * 获得用户回复消息
     * @param GetUserMsgRequestData $data
     */
    public function getUserMsg($data) {

        $key = MemcachedKeyFactory::iGetUserMsgCache($data->userid);
        //$this->getCache()->delete($key);
        $map = $this->getCache()->get($key);

        if ($map != FALSE) {
            if (isset($map[$data->page])) {
                return $map[$data->page];
            }
        } else {
            $map = array();
        }

        $replyFacade = DSBusinessFactory::getReply();
        $topicFacade = DSBusinessFactory::getTopic();

        $reply = $replyFacade->queryReplyedToUserId($data->userid, 20, $data->page);

        $replys = $reply->Data;

        $res = array();
        foreach ($replys as $item) {

            $topic = $topicFacade->queryTopicByTopicId($item["TopicId"]);

            $res[] = array(
                'topicid' => $topic['TopicId'],
                'topiccontent' => $topic['Content'],
                'replytime' => $item['CreateTime'],
                'replyuserid' => $item['ReplyUserId'],
                'replycontent' => $item['ReplyType'] == ReplyType::PRAISEREPLY ? "{$item['ReplyUser']}赞了你一下！" : $item['Content'],
                'replyuser' => $item['ReplyUser'],
                'replyavatar' => $item['AvatarUrl'],
                'replytype' => $item['ReplyType'],
                'isforbidden' => $item['IsForbidUser']
            );
        }

        $reply->Data = $res;

        $map[$data->page] = $reply;
        $this->getCache()->set($key, $map, 3600);

        return $reply;
    }

    /**
     * 
     * @param ReplyRequestData $data
     * @return array
     */
    function reply($data) {
        $replyFacade = DSBusinessFactory::getReply();
        $res = $replyFacade->createNew($data->topicid, $data->topicuserid, $data->userid, $data->touserid, $data->content, $data->replyid);

        return $res > 1 ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param PraiseRequestData $data
     * @return int
     */
    function praise($data) {
        $praiseFacade = DSBusinessFactory::getPraise();
        $replyFacade = DSBusinessFactory::getReply();
        $res = $praiseFacade->createNew($data->userid, $data->topicid);
        if ($res) {
            $res = $replyFacade->createNewPraise($data->topicid, $data->topicuserid, $data->userid);
        }

        return $res > 1 ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

}

?>
