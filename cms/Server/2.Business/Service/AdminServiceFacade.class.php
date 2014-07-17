<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminServiceFacade
 *
 * @author zq
 */
class AdminServiceFacade extends BBaseFacade {
    //put your code here


    /**
     * 点赞操作
     */

    /**
     * 
     * @param PraiseUpdateRequestData $data
     * @return int
     */
    public function updatePraise($data) {
        if (!isset($data->PraiseId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSPraise::share()->getById($data->PraiseId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }
        $d = $this->mergeUpdateParams($data);
        $res = DSPraise::share()->modify($d);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::userHasPraise($data['TopicId'], $data['PraiseUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::topicPraiseCount($data['TopicId']));

            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::iGetSingeTopicCache($data['TopicId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param PraiseDeleteRequestData $data
     * @return int
     */
    public function delPraise($data) {
        if (!isset($data->PraiseId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSPraise::share()->getById($data->PraiseId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }

        $res = DSPraise::share()->deleteById($data->PraiseId);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::userHasPraise($data['TopicId'], $data['PraiseUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::topicPraiseCount($data['TopicId']));

            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::iGetSingeTopicCache($data['TopicId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param TopicUpdateRequestData $data
     * @return int
     */
    public function updateTopic($data) {
        if (!isset($data->TopicId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSTopic::share()->getById($data->TopicId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }
        $d = $this->mergeUpdateParams($data);
        $res = DSTopic::share()->modify($d);
        if ($res) {

            $this->getCache()->delete(MemcachedKeyFactory::userOwnTopic($data['CreateUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::allTopic());

            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::cleariGetUserTopicCache($data['CreateUserId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param TopicDeleteRequestData $data
     * @return int
     */
    public function delTopic($data) {
        if (!isset($data->TopicId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSTopic::share()->getById($data->TopicId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }

        $res = DSTopic::share()->deleteById($data->TopicId);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::userOwnTopic($data['CreateUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::allTopic());

            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::cleariGetUserTopicCache($data['CreateUserId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param ReplyUpdateRequestData $data
     * @return int
     */
    public function updateReply($data) {
        if (!isset($data->ReplyId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSReply::share()->getById($data->ReplyId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }
        $d = $this->mergeUpdateParams($data);
        $res = DSReply::share()->modify($d);
        if ($res) {

            $this->getCache()->delete(MemcachedKeyFactory::userBeReplyed($data['ToUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::allTopicReply($data['TopicId']));

            $this->getCache()->delete(MemcachedKeyFactory::topicReplyCount($data['TopicId']));


            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::cleariGetUserMsgCache($data['ToUserId']);
            MemcachedKeyFactory::cleariGetSingeTopicCache($data['TopicId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param ReplyDeleteRequestData $data
     * @return int
     */
    public function delReply($data) {
        if (!isset($data->ReplyId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }

        $data = DSReply::share()->getById($data->ReplyId);

        if (!is_array($data)) {
            ErrorCode::throwError(ErrorCode::数据不存在);
            return FALSE;
        }

        $res = DSReply::share()->deleteById($data->ReplyId);
        if ($res) {

            $this->getCache()->delete(MemcachedKeyFactory::userBeReplyed($data['ToUserId']));

            $this->getCache()->delete(MemcachedKeyFactory::allTopicReply($data['TopicId']));

            $this->getCache()->delete(MemcachedKeyFactory::topicReplyCount($data['TopicId']));


            MemcachedKeyFactory::cleariGetAllTopicCache();
            MemcachedKeyFactory::cleariGetUserMsgCache($data['ToUserId']);
            MemcachedKeyFactory::cleariGetSingeTopicCache($data['TopicId']);
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param UserUpdateRequestData $data
     * @return int
     */
    public function updataUser($data) {
        if (!isset($data->UserId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }
        $d = $this->mergeUpdateParams($data);

        $res = DSUserInfo::share()->modify($d);
        if ($res) {
            $this->getCache()->delete(MemcachedKeyFactory::userInfo($data->UserId));
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 
     * @param BgAddOrUpdateRequestData $data
     */
    public function bgAddOrUpdate($data) {
        $by = base64_decode(str_replace(" ", "+", $data->bg));
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
                "msg" => "上传失败",
                "url" => ''
            );
        }
        $bg_res = DSBusinessFactory::getBg()->addOrUpdateBg($file_url);
        if ($bg_res) {
            $res['result'] = TRUE;
            $res['msg'] = "上传成功";
            $res['url'] = $file_url;
        } else {
            return array(
                "result" => FALSE,
                "msg" => "上传失败",
                "url" => ''
            );
        }

        return $res;
    }

    /**
     * 
     * @param TopicImgDeleteRequestData $data
     * @return int
     */
    public function delTopicImg($data) {
        if (!isset($data->TopicImgId)) {
            ErrorCode::throwError(ErrorCode::数据更新必须缺少主键);
            return FALSE;
        }


        $res = DSTopicImg::share()->deleteById($data->TopicImgId);


        if ($res > 0) {
            $this->getCache()->delete(MemcachedKeyFactory::imgOfTopic($data->TopicImgId));
        }
        return $res ? ResultCode::RESULT_TRUE : ResultCode::RESULT_FALSE;
    }

    /**
     * 下面全是query
     */

    /**
     * 查询点赞记录
     * @param PraiseQueryRequestData $data
     */
    public function queryPraise($data) {

        $searchParams = new PraiseSearchParams();

        $searchParams->TopicId = $data->TopicId;
        $searchParams->PraiseId = $data->PraiseId;
        $searchParams->PraiseUserId = $data->PraiseUserId;
        $searchParams->IsForbid = $data->IsForbid;
        $searchParams->StartTime = $data->StartTime;
        $searchParams->EndTime = $data->EndTime;


        $res = DSBusinessFactory::getPraise()->queryBySearchParams($searchParams, 10, $data->Page);

        return $res;
    }

    /**
     * 
     * @param TopicQueryRequestData $data
     */
    public function queryTopic($data) {
        $searchParams = new TopicSearchParams();
        $searchParams->TopicId = $data->TopicId;
        $searchParams->UserId = $data->UserId;
        $searchParams->TopicType = $data->TopicType;
        $searchParams->StartTime = $data->StartTime;
        $searchParams->EndTime = $data->EndTime;
        $searchParams->IsForbid = $data->IsForbid;
        $res = DSBusinessFactory::getTopic()->queryBySearchParams($searchParams, 10, $data->Page);

        return $res;
    }

    /**
     * 
     * @param ReplyQueryRequestData $data
     */
    public function queryReply($data) {
        $searchParams = new ReplySearchParams();


        $searchParams->ReplyId = $data->ReplyId;
        $searchParams->TopicId = $data->TopicId;
        $searchParams->ThisReplyId = $data->ThisReplyId;
        $searchParams->ReplyUserId = $data->ReplyUserId;
        $searchParams->TopicUserId = $data->TopicUserId;
        $searchParams->ToUserId = $data->ToUserId;
        $searchParams->ReplyType = $data->ReplyType;
        $searchParams->NReplyType = $data->NReplyType;
        $searchParams->StartTime = $data->StartTime;
        $searchParams->EndTime = $data->EndTime;
        $searchParams->IsForbid = $data->IsForbid;

        $res = DSBusinessFactory::getReply()->queryBySearchParams($searchParams, 10, $data->Page);

        return $res;
    }

    /**
     * 
     * @param UserQueryRequestData $data
     * @return mixed
     */
    public function queryUser($data) {
        $searchParams = new UserInfoSearchParams();


        $searchParams->UserId = $data->UserId;
        $searchParams->SocialUserStatus = $data->SocialUserStatus;
        $searchParams->StartTime = $data->StartTime;
        $searchParams->EndTime = $data->EndTime;

        $res = DSBusinessFactory::getUserInfo()->queryBySearchParams($searchParams, 10, $data->Page);
        $data = $res->Data;
        $d = array();

        if (!empty($data)) {

            foreach ($data as $value) {
                $d[] = array(
                    'UserId' => $value['UserId'],
                    'AvatarUrl' => $value['AvatarUrl'],
                    'CreateTime' => $value['CreateTime'],
                    'SocialUserStatus' => $value['SocialUserStatus'],
                );
            }
            $res->Data = $d;
        }
        return $res;
    }

    /**
     * 
     * @param TopicImgQueryRequestData $data
     */
    public function queryTopicImg($data) {
        $searchParams = new TopicImgSearchParams();
        $searchParams->TopicId = $data->TopicId;
        $res = DSBusinessFactory::getTopicImg()->queryBySearchParams($searchParams);

        return $res;
    }

}