<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2021 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace app\common\lib;
//引入框架
use think\facade\Config;
/**
 * @author 赵yj
 * @time 2025-09-12
 * @use app\common\lib\RedisPool
 */
class RedisPool
{
    // 定义连接池
    private static $connections = [];
    public static function getRedis($alias = 'redis', $select = 0)
    {
        $connectionName = $alias . ':' . $select; 
        if (!isset(self::$connections[$connectionName])) {
            // 从框架配置 config('cache.stores.redis') 中读取设置
            $config = Config::get('cache.stores.' . $alias);
            if (empty($config)) {
                throw new \Exception("Redis configuration '{$alias}' not found in config/cache.php");
            }
            $redis = new \Redis();
            $redis->pconnect($config['host'], (int)$config['port']);  // host port password
            if (!empty($config['password'])) {
                // 在这里进行认证
                if (!$redis->auth($config['password'])) {
                    throw new \RedisException('Redis authentication failed.');
                }
            }
            self::$connections[$connectionName] = $redis;
        }
        self::$connections[$connectionName]->select($select);
        return self::$connections[$connectionName];
    }
}