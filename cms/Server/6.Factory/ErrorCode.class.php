<?php

/**
 * Description of ErrorCode
 *
 * @author zq
 */
class ErrorCode {

    static function throwError($error) {
        $arr = explode("_", $error);
        throw new Exception($arr[1], $arr[0]);
    }

    const 请求对象不存在 = "300_请求对象不存在";
    const TOKEN无效 = "301_TOKEN无效";
    const IP无效 = "302_IP无效";
    const 用户名不能为空 = "401_用户不能为空";
    const 修改记录必须传主键 = "801_修改记录必须传主键";
    const 查询记录必须有查询参数对象 = "802_查询记录必须有查询参数对象";
    const 参数不全 = "803_参数不全";
    const 请求参数结构错误 = "804_请求参数结构错误";
    const 数据更新必须缺少主键 = "805_数据更新缺少主键";
    const 数据不存在 = "806_数据不存在";

}
