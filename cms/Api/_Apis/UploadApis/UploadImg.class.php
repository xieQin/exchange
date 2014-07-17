<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadImg
 *
 * @author zq
 */
class UploadImg extends SnsBaseApi {

    /**
     * 
     * @param type $queryData img,type
     * @param type $isCache
     */
    function query($queryData, $isCache = true) {

        $entity = json_decode($queryData);


        $by = base64_decode(str_replace(" ", "+", $entity->img));

        if ($by === FALSE) {
            return json_encode(array("s" => ApiAction::ERROR, "d" => $file_url));
        }

        $file_url = UploadImgHandler::upImg($by, $entity->type);
        //  echo json_encode(array("s" => 200, "d" => $file_url));
        //return $file_url;
        if ($this->isURL($file_url)) {
            return json_encode(array("s" => 200, "d" => $file_url));
        }
        return json_encode(array("s" => ApiAction::ERROR, "d" => $file_url));
    }

    public function doAct() {
        return "UploadImg";
    }

    public function serverUrl() {
        return $this->urlService();
    }

    protected function isURL($value) {
        $match = '/^(http:)?.+$/';
        $v = strtolower(trim($value));
        if (empty($v))
            return false;
        return preg_match($match, $v);
    }

}
