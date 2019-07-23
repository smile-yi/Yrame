<?php
/**
 * Redis.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 19:22:28
 */

namespace App\Pool;

class Redis extends Base {
    
    const CLASS_KEY = 'redis';
    
    /**
     * 创建新redis链接
     * @param   $config
     * @return  resource
     */
    static function create($config = []) {
        if (empty($config)) {
            $config = [
                'host' => '127.0.0.1',
                'port' => 6379
            ];
        }

        echo "create new redis connect\n";

        $redis = new \Swoole\Coroutine\Redis();
        $redis->connect($config['host'], $config['port']);

        //redis密码录入
        if (isset($config['password'])) {
            $redis->auth($config['password']);
        }

        return $redis;
    }
}