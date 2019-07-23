<?php
/**
 * Base.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 17:13:48
 */

namespace App\Controller;

class Base {

    protected $req = null;
    protected $res = null;
    protected $get = [];
    protected $post = [];
    protected $request = [];
    protected $pool = null;

    // function __construct($req, $res, $pool) {
    //     $this->req = $req;
    //     $this->res = $res;
    //     $this->pool = $pool;
    // }
}
