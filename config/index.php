<?php
/**
 * index.php
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-07-22 15:30:09
 */

return [
    'route' => require_once(dirname(__FILE__) . '/route.php'),
    'pool' => [
        'mysql' => [
            'class' => 'App\Pool\Mysql',
            'host' => 'yi.dev',
            'port' => 3306,
            'database' => 'u9faq',
            'user' => 'root',
            'password' => '4NLoe6GFiIQ7BUw6'
        ],
        'redis' => [
            'class' => 'App\Pool\Redis',
            'host' => 'yi.dev',
            'port' => 6380,
            'password' => 'jqtvUSCpbsumgbuu'
        ]
    ]
];
