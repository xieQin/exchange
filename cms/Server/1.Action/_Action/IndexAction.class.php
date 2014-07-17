<?php

/**
 * Description of IndexAction
 *
 * @author Joy
 */
class IndexAction extends Action {
    
    public function index() {
        echo "working...";
    }
    
    public function t1(){
        renderView("index", "t1");
    }
}
