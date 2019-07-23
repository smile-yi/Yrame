<?php
/**
 * Redis.php
 * 
 * 
 * @author  王中艺<wangzy_smile@qq.com>
 * @date    2019-06-13 17:03:35
 */

namespace App\Controller;
use App\Pool\Redis as RedisPool;
use App\Pool\Mysql as MysqlPool;
use App\Decorator\Request;
use App\Decorator\Response;
use Swoole\Coroutine;
use SmileYi\Utils\Log;

class User extends Base {

    function login() {
        $channel = new Coroutine\Channel(1);
        \Swoole\Coroutine::create(function() use ($channel) {
            $redis = $this->pool->get(RedisPool::CLASS_KEY);
            $redis2 = $this->pool->get(RedisPool::CLASS_KEY, true);
            $name = $redis->get('name');
            $channel->push("name:".$name.$redis2->get('name'));
        });

        $name = $channel->pop();

        $this->res->text($name);
    }

    function register() {
        $this->req->unEmpty(['username', 'password']);
        $input = $this->req->input(['username', 'password']);
        $redis = $this->pool->get(RedisPool::CLASS_KEY);
        $userKey = 'user:'.$input['username'];
        $isExt = $redis->type($userKey);
        if ($isExt) {
            $this->res->text('用户已存在');
            return true;
        }

        $info = [
            'username' => $input['username'],
            'password' => $input['password']
        ]; 
        $redis->hmset($userKey, $info);

        $this->res->json($info);
    }

    function index(Request $req, Response $res) {
        Log::getInstance()->put('test', ['name' => 'zhongyi', 'age' => 25]);
        $res->text("I am yframe!!!!\n");
    }

    function list() {
        $newConn = $this->req->input('new_conn', false);
        $mysql = $this->pool->get(MysqlPool::CLASS_KEY, $newConn);
        $users = $mysql->query('select * from ad_user;');
        $this->res->json($users);
    }
}
