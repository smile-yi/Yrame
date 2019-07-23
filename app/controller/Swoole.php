<?php
/*
 * Swoole.php
 * swoole控制器
 *
 * @author 王中艺 <wangzy_smile@qq.com>
 * @date 2019-07-22 18:17:19
 */

namespace App\Controller;
use App\Pool\Redis as RedisPool;
use App\Pool\Mysql as MysqlPool;

class Swoole extends Base {

    function info() {
        $this->res->json([
            'mysql_conn_count' => MysqlPool::count(),
            'redis_conn_count' => RedisPool::count(),
        ]);
    }
}