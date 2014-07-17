<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Demo，一个请求Web页面的方法（DemoWeb）
 * @author joy
 */
class DemoWebController extends ZBaseController {

    /**
     * @param RequestData $data
     */
    public function act($data) {
        renderView("demo", "demoweb");
    }
}

/**
 * DemoWeb的请求参数
 */
class DemoWebRequestData {

    /**
     * @var string 名称
     */
    public $name;

    /**
     * @var 年龄 
     */
    public $age;

}
