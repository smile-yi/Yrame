<?php
/**
 * bootstrap.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 16:56:13
 */

// spl_autoload_register(function($className) {
//     echo "load class ".$className."\n";
//     $splice = explode('\\', $className);
//     $fileName = dirname(__FILE__) . '/';
//     foreach($splice as $k => $s) {
//         if ($k < count($splice) - 1) {
//             $fileName .= lcfirst($s) . '/';
//         } else {
//             $fileName .= $s . '.php';
//         }
//     }
//     echo "require file {$fileName}\n";
//     require_once($fileName);
// });

require_once './vendor/autoload.php';

use SmileYi\Utils\Config;

Config::set([
    'log' => [
        // 日志存储路径
        'dir' => './runtime/log/',
    ],
    'common' => [
        //加密盐值
        'salt' => '4ckNt8GrgvqXYg1u',
    ],
    'base64' => [
        // 编码表
        // 'map' => 'OBrsYZabgQRSTUtu3JnoPDChijklWApqKLM6Evw7Ncde45mxGHIfXyz012FV89+/',
        'map' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/',
    ],
    'upload' => [
        // 上传目录
        'dir' => dirname(__FILE__) . '/../extra/upload/',
        // 允许的文件类型
        'exts' => ['jpg', 'png', 'jpeg'], // 不限制: ['*']
        // 文件大小限制
        'size' => 1024 * 1024 * 2,
    ],
]);
