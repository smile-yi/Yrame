<?php
/**
 * server.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 16:35:59
 */


require_once 'bootstrap.php';

use Swoole\Http\Server;
use Swoole\Runtime;
use App\Pool\Manager as PoolManager;
use App\Decorator\Request as Request;
use App\Decorator\Response as Response;
use App\Util\Ioc;
use SmileYi\Utils\Log;

Runtime::enableCoroutine();

$config = require('config/index.php');

$http = new Server('0.0.0.0', 2358);
$http->on('request', function($req, $res) use ($config) {
    try {
        //变量声明
        $pool = new PoolManager($config['pool']);
        $request = new Request($req);
        $response = new Response($res);

        //注册到IOC
        Ioc::set($pool, $request, $response);

        //路由配置
        $route = $config['route'];
        $uri = $req->server['request_uri'];
        if (isset($route[$uri])) {
            //解析路由配置
            list($controller, $method) = explode('@', $route[$uri]);
            //Ioc调用
            Ioc::run($controller, $method);
        } else {
            //未配置uri，返回404
            $res->end('404');
        }
    } catch (\Exception $e) {
        $error = [
            'msg' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace()
        ];
        Log::getInstance()->put('exception', $error);
        $res->end('500');
    }
});

$http->start();
    
