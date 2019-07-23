<?php
/*
 * Mysql.php
 * mysql连接
 *
 * @author 王中艺 <wangzy_smile@qq.com>
 * @date 2019-07-22 17:04:37
 */

 namespace App\Pool;

 class Mysql extends Base {

    const CLASS_KEY = 'mysql';

    /** 
     * 创建新mysql连接
     * @param   $config
     * @return  resource
     */
    static function create($config = []) {
        echo "create new mysql connect!\n";
        if (empty($config)) {
            $config = [
                'host' => '127.0.0.1',
                'prot' => '3306',
                'user' => 'root',
                'password' => '',
                'database' => 'test'
            ];
        }

        $mysql = new \Swoole\Coroutine\MySQL();
        if (!$mysql->connect($config)) {
            echo "mysql connect error! msg: ".$mysql->error."\n";
            return false;
        }

        return $mysql;
    }
 }