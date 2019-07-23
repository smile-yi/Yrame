<?php
/*
 * Ioc.php
 * 依赖注入工具
 *
 * @author 王中艺 <wangzy_smile@qq.com>
 * @date 2019-07-23 16:47:06
 */

namespace App\Util;

class Ioc {

    // 加载类容器  className => object
    static private $classContainer = [];

    /** 
     * 执行依赖注入动作
     * @param   $class
     * @param   $method
     * @return  mix result
     */
    static function run($class, $method) {
        var_dump($class); var_dump($method);
        //执行方法调用
        $reflect = new \ReflectionClass($class);
        if (!$reflect->hasMethod($method)) {
            throw new \Exception('未找到方法');
        }
        $refMethod = $reflect->getMethod($method);
        $metParams = [];
        foreach ($refMethod->getParameters() as $param) {
            var_dump($param->getClass()->name);
            $metParams[] = self::make($param->getClass()->name);
        }

        return call_user_func_array([self::make($class), $method], $metParams);
    }

    /** 
     * 获取类对象
     * @param   $class
     * @return  obj
     */
    static function make($class) {
        echo "make class[{$class}]...\n";
        // 若之前实例化，则直接返回
        if (isset(self::$classContainer[$class])) {
            return self::$classContainer[$class];
        }
        echo "make class[{$class}]...\n";
        //根据类反射工具实例化对象
        $reflect = new \ReflectionClass($class);
        $construct = $reflect->getConstructor();
        if ($construct) {
            //存在构造函数
            $consParams = [];
            //遍历所有构造参数，并实例化
            foreach ($construct->getParameters() as $param) {
                $consParams[] = self::make($param->getClass()->name);
            }
            //实例化
            return $reflect->newInstanceArgs($consParams);
        } else {
            return $reflect->newInstance();
        }
    }

    /** 
     * 设置声明对象
     * @param   $obj1, $obj2, $obj3
     * @return  null
     */
    static function set() {
        //动态参数获取
        $objs = func_get_args();
        foreach ($objs as $obj) {
            if (!is_object($obj)) {
                continue;
            }
            //注册
            $class = get_class($obj);
            echo "Ioc set class[{$class}]...\n";
            self::$classContainer[$class] = $obj;
        }
    }
}