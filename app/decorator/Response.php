<?php
/**
 * Response.php
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-14 15:30:09
 */

namespace App\Decorator;

class Response {

    private $res;

    function __construct($res) {
        $this->res = $res;
    }

    function text($string) {
        $this->end($string);
    }

    function json($info) {
        $this->header('Content-Type', 'application/json');
        $this->text(json_encode($info));
    }

    function __call($name, $args) {
        call_user_func_array([$this->res, $name], $args);
    }
}
