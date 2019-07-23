<?php
/**
 * Request.php
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-14 15:31:09
 */

namespace App\Decorator;
use SmileYi\Utils\ArrTool;

class Request {

    private $req;
    private $get = [];
    private $post = [];
    private $all = [];

    function __construct($req) {
        $this->req = $req;
        $this->get = $req->get ?? [];
        $this->post = $req->post ?? [];
        $this->input = array_merge($this->get, $this->post);
    }
    
    function input($keys = null, $default = null, $withNotExist = false) {
        if ($keys === null) {
            return $this->input;
        } else if (is_array($keys)) {
            return ArrTool::leach($this->input, $keys, $withNotExist, $default); 
        } else {
            return $this->input[$keys] ?? $default;
        }
    }

    function unEmpty($keys) {
        foreach ($keys as $key) {
            if (empty($this->input[$key])) {
                throw new \Exception('参数为空');
            }
        }

        return true;
    }
}
