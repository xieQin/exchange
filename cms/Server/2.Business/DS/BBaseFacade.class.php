<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function filterNull($item) {
    if ($item === NULL) {
        return false;
    }
    return true;
}

/**
 * Description of BBaseFacade
 *
 * @author zq
 */
class BBaseFacade {

//put your code here
    /**
     * 
     * @return MyCache
     */
    public function getCache() {
        return MC();
    }

    public function mergeUpdateParams($data) {

        return array_filter($this->objectToArray($data), 'filterNull');
    }

    public function objectToArray($array) {
        if (is_object($array)) {
            $array = (array) $array;
        }
        return $array;
    }

}

?>
