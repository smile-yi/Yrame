<?php
/**
 * Manager.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 19:51:21
 */

namespace App\Pool;

class Manager {

    public $map = [];
    public $config = [];

    //构造
    function __construct($config) {
        $this->config = $config;
    }

    /**
     * 获取连接池实例
     * @param   $classKey   类标志
     * @param   $new  新生成链接
     * @return  object
     */
    function get($classKey, $new = false) {
        if (!isset($this->config[$classKey])) {
            throw new Exception("not found classKey[$classKey] in pool config");
        }

        //变量声明
        $config = $this->config[$classKey];
        $class = $this->config[$classKey]['class'];

        if (!isset($this->map[$class])) {
            $this->map[$class] = [];
        }

        //是否新建链接
        if (!$new) {
            if (empty($this->map[$class])) {
                $this->map[$class][0] = $class::get($config);
            }
            return $this->map[$class][0];
        } else {
            $obj = $class::get($config, true);
            $this->map[$class][] = $obj;
            return $obj;
        }
    }

    // 析构函数
    function __destruct() {
        foreach ($this->map as $class => $objs) {
            foreach ($objs as $obj) {
                $class::put($obj);
            }
        }
    }
}
