<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiTestAction
 *
 * @author zq
 */
class ApiTestAction extends ZBaseAction {

    //put your code here
    function index() {
        global $q_param_act, $q_param_p, $q_param_ctrl;
        try {

            if (isset($q_param_act) && !empty($q_param_act)) {
                //$q_param_p= array('age'=>22);
                // $aa = json_encode($q_param_p);
                $data = json_decode($q_param_p);
                if (class_exists($q_param_act)) {
                    $o = new $q_param_act();
                    if (($o instanceof ZBaseService)) {
                        $rl = $o->act($data);
                        if ($rl !== false) {
                            $this->responseSuccess($rl, false);
                            return;
                        } else {
                            $this->responseFail("操作失败", 400, false);
                            return;
                        }
                    }
                }
            } else if (isset($q_param_ctrl) && !empty($q_param_ctrl)) {
                $data = json_decode($q_param_p);
                if (class_exists($q_param_ctrl)) {
                    $o = new $q_param_ctrl();
                    if (($o instanceof ZBaseController)) {
                        $o->act($data);
                        return;
                    }
                }
            }

            ErrorCode::throwError(ErrorCode::请求对象不存在);
        } catch (Exception $exc) {
            $this->responseFail($exc->getMessage(), $exc->getCode(), false);
        }
    }

}

?>
