<?php
/**
 * route.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 16:47:27
 */

return [
    '/user/login' => 'App\Controller\User@login',
    '/user/register' => 'App\Controller\User@register',
    '/user/index' => 'App\Controller\User@index',
    '/user/list' => 'App\Controller\User@list',
    '/swoole/info' => 'App\Controller\Swoole@info',
    '/' => 'App\Controller\Index@index',
];
