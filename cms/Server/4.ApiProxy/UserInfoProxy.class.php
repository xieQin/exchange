<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfoProxy
 *
 * @author zq
 */
class UserInfoProxy {
    //put your code here

    /**
     * 
     * @staticvar null $ins
     * @return \UserInfoProxy
     */
    static function share() {
        static $ins = null;
        if (!$ins) {
            $ins = new UserInfoProxy();
        }
        return $ins;
    }

    /**
     * 获得用户昵称
     * @param type $userId
     * @param type $safeCode
     * @return type
     */
    public function getUserNickName($userId, $safeCode) {

        $c = MC();
        $key = MemcachedKeyFactory::userNickName($userId);

        $res = $c->get($key);
        if ($res !== FALSE) {

            return $res;
        }
        $error = '';
        $r = ZjUserHandler::share()->getUserAccountInfo($userId, $safeCode, $error);
        if ($r) {
            $res = $r["nick_name"];
            $c->set(key, $res);
        }
        return $res === FALSE ? "" : $res;
    }

}

?>
