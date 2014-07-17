<?php

/**
 * Description of TestAction
 *
 * @author joy
 */
class TestAction extends Action {

    function testParam() {

        global $q_h, $q_p;
        echo "h={$q_h},p={$q_p}";
    }

    function testDemoAct() {
        $header = new ApiHeader();
        $header->act = "DemoAct";
        $header->os = "ios";
        $header->dt = "iphone 5S";
        $header->dv = "ios7.0";
        $header->token = "123456";
        $header->ss = "1000*500";
        $header->uid = "12345";

        $h = MyDes::share()->encode(json_encode($header), DES_KEY);

        $data["name"] = "pxl";
        $data["age"] = 18;

        $p = MyDes::share()->encode(json_encode($data), DES_KEY);

        $url = UA("Api?h={$h}&p={$p}");
        echo "<a href='{$url}'>{$url}</a>";
    }

    function testDemoWeb() {
        $header = new ApiHeader();
        $header->act = "DemoWeb";
        $header->os = "ios";
        $header->dt = "iphone 5S";
        $header->dv = "ios7.0";
        $header->token = "123456";
        $header->ss = "1000*500";
        $header->uid = "12345";

        $h = MyDes::share()->encode(json_encode($header), DES_KEY);

        $data["name"] = "pxl";
        $data["age"] = 18;

        $p = MyDes::share()->encode(json_encode($data), DES_KEY);

        $url = UA("Api?h={$h}&p={$p}");
        echo "<a href='{$url}'>{$url}</a>";
    }

}