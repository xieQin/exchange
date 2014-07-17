<?php

/**
 * 掌金用户服务操作类
 * 
 * 修改：2013-11-7
 */
class ZjUserHandler {

    private $app_key = "";
    private $service = "";

    const DESKEY = "JiwLYG=-";
    const OS = "android";

    function __construct() {
        $c = getC("ZJUSER_SERVICE");
        $this->app_key = $c["appkey"];
        $this->service = $c["url"];
    }

    private static $instance = null;

    /**
     * 
     * @return ZjUserHandler
     */
    public static function share() {
        if (self::$instance == null) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

    private function query($query) {
        $url = $this->service . $query . "&appkey=" . $this->app_key;
        $get = CURLHandler::share()->query($url);
        $des = DES::share(self::OS);
        return json_decode($des->decode($get, self::DESKEY));
    }

    private function error($responseData) {
        $error["s"] = $responseData->s;
        $error["d"] = $responseData->d;
        return $error;
    }

    /**
     * 取用户帐户信息
     * @param type $uid 用户ID
     * @param type $safycode 用户安全码
     * 
     * @return object array("cash"=>现金,"freeze_cash"=>冻结资金,"bonus"=>赠送资金,"credits"=>积分);
     */
    public function getUserAccountInfo($uid, $safycode, &$error) {
        $query = "account?uid={$uid}&safetycode={$safycode}&os=" . self::OS;
        $data = $this->query($query);

        if ($data->s == "200") {
            $d = $data->d;
            return array(
                "cash" => $d->cash,
                "freeze_cash" => $d->freeze_cash,
                "bonus" => $d->bonus,
                "credits" => $d->credits,
                "nick_name" => $d->nick_name
                    );
        }
        $error = $this->error($data);
        return false;
    }

    /**
     * 加（减）用户积分
     * @param type $uid 用户ID
     * @param type $safycode 用户安全码
     * @param type $credit 操作的积分，“正数”添加，“负数”减少
     * @param type $explain 操作说明
     * 
     * @return long|false 返回操作后的积分，操作失败返回 false. 
     */
    public function addUserCredits($uid, $safycode, $credit, $explain, &$error) {
        $query = "forShop?uid={$uid}&safetycode={$safycode}&credits={$credit}&info={$explain}&os=" . self::OS;
        $data = $this->query($query);

        if ($data->s == "200") {
            return true;
        }
        $error = $this->error($data);
        return false;
    }

}

?>
