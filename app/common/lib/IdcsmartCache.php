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

/**
 * @desc
 * @author zyj
 * @time 2025-02-13
 * @use app\common\lib\IdcsmartCache
 */
// 引入 RedisPool 类
use app\common\lib\RedisPool;
class IdcsmartCache
{
    public static function cache($key,$value='',$timeout=null)
    {
        // 判断是否安装redis扩展
        if (extension_loaded('redis')){
            $Redis = RedisPool::getRedis('redis');
            if (is_null($value)){
                return $Redis->del($key);
            }elseif($value===''){
                return $Redis->get($key);
            }else{
                if (empty($timeout) || $timeout<0){
                    return $Redis->set($key,$value);// 永不不过期
                }else{
                    return $Redis->set($key,$value,(float)$timeout);
                }
            }
        }else{
            return cache($key,$value,$timeout);
        }
    }
}
