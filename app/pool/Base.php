<?php
/**
 * Base.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 19:14:54
 */

namespace App\Pool;

class Base {

    static $pool = null;

    /**
     * 获取新实例
     * @param   $config 实例配置
     * @param   $new 创建新链接
     * @return  object
     */
    static function get($config = [], $new = false) {
        echo "get a ".__CLASS__." connect\n";
        if (self::$pool === null) {
            self::$pool = new \SplQueue();
        }

        if (!static::$pool->isEmpty() && !$new) {
            return static::$pool->dequeue();
        }

        return static::create($config);
    }

    static function put($obj) {
        echo "recovery a " . __CLASS__ . " connect\n";
        static::$pool->enqueue($obj);
    } 

    static function count() {
        return static::$pool->count();
    }
}
