<?php

/**
 * Description of ServiceAction
 *
 * @author joy
 */
class ServiceAction extends ZBaseAction {

    function index() {
        global $q_h, $q_p;
        try {
            $header = $this->formatRequestHeader($q_h);
            $data = $this->formatRequestData($q_p);
            //验证访问有效性
            $this->checkValid($header);
            if (isset($header->act)) {
                $actClass = $header->act . "Service";
                if (class_exists($actClass)) {
                    $o = new $actClass();
                    if (($o instanceof ZBaseService)) {
                        $rl = $o->act($data);
                        if ($rl !== false) {
                            $this->responseSuccess($rl);
                            return;
                        } else {
                            $this->responseFail();
                            return;
                        }
                    }
                }
            }

            ErrorCode::throwError(ErrorCode::请求对象不存在);
        } catch (Exception $exc) {
            $this->responseFail($exc->getMessage(), $exc->getCode());
        }
    }

    public function isDES() {
        return FALSE;
    }

}
