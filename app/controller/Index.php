<?php
namespace App\Controller;

class Index extends Base {
    
    function index() {
        $this->res->text("It is ok\n");
    }
}
