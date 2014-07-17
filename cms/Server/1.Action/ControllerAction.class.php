<?php

/**
 * Description of ControllerAction
 *
 * @author joy
 */
class ControllerAction extends ZBaseAction {

    function index() {
        global $q_h, $q_p;
        try {
            $header = $this->formatRequestHeader($q_h);
            $data = $this->formatRequestData($q_p);
            //验证访问有效性
            $this->checkValid($header);
            if (isset($header->act)) {
                $actClass = $header->act . "Controller";
                if (class_exists($actClass)) {
                    $o = new $actClass();
                    if (($o instanceof ZBaseController)) {
                        $o->act($data);
                        return;
                    }
                }
            }

            renderString(ErrorCode::请求对象不存在);
        } catch (Exception $exc) {
            $code = $exc->getCode() ? $exc->getCode() : 400;
            $msg = $exc->getMessage();
            renderString($code . "_" . $msg);
        }
    }

}
