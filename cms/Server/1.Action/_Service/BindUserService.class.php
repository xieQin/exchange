<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BindUserService
 * 绑定用户接口
 * @author zq
 */
class BindUserService extends ZBaseService {
    //put your code here

    /**
     * 返回数组对象格式
     * array(
     *  result:获取结果，boolean, true成功，false失败
     *  userinfo：数组，array(
     *                          nickname: 昵称 string
     *                       avatar：头像地址  string
     *                 )
     *  )
     * @param BindUserRequestData $data
     * @return array
     */
    public function act($data) {
        $facade = new ApiServiceFacade();
        return $facade->bindUser($data);
    }

}

/**
 * 绑定用户信息请求参数
 */
class BindUserRequestData {

    /**
     * 用户id
     * @var long 
     */
    public $userid;

    /**
     * 安全码 
     * @var string 
     */
    public $safetycode;

}