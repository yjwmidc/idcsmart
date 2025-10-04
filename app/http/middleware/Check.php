<?php
namespace app\http\middleware;

use app\admin\model\AdminLoginModel;
use app\common\model\ClientLoginModel;
use app\common\model\ApiModel;
use think\Request;
use think\facade\Cache;
use think\facade\Env; // 确保引入 Env

/**
 * @title 授权检查基类
 * @desc 授权检查基类
 * @use app\http\middleware\Check
 */
class Check
{
    public function handle($request, \Closure $next)
    {
        $result = $this->checkToken($request);

        if ($result['status'] == 200) {
            $jwtToken = $result['data']['jwt_token'];
            $request->client_id = $jwtToken['id'];
            $request->client_name = $jwtToken['name'];
            $request->client_remember_password = $jwtToken['remember_password'];

            if (isset($jwtToken['is_api']) && $jwtToken['is_api']) { // 兼容不需要登录的接口
                $request->is_api = $jwtToken['is_api'];
                $request->api_id = $jwtToken['api_id'] ?? 0;
                $request->api_name = $jwtToken['api_name'] ?? '';
            }
        }

        return $next($request);
    }

    /**
     * 校验token
     */
    public function checkToken(Request $request, $is_admin = false, $jwt = '')
    {
        if (!empty($jwt)) {
            $authorization = $jwt;
        } else {
            $authorization = get_header_jwt();
        }

        if (empty($authorization) || $authorization == 'null') {
            return ['status' => 401, 'msg' => lang('login_unauthorized')];
        }

        if (count(explode('.', $authorization)) != 3) {
            return ['status' => 401, 'msg' => lang('login_unauthorized')];
        }
        
        # 注销验证
        $id = Cache::get('login_token_' . $authorization);
        if (empty($id)) {
            return ['status' => 401, 'msg' => lang('login_unauthorized')];
        }
        $checkJWt = $this->verifyJwt($authorization, $id, $is_admin);
        if ($checkJWt['status'] != 200) {
            return $checkJWt;
        }

        $jwtToken = $checkJWt['data'];

        # 后台修改密码 登录失效(前台一样)
        $key = ($jwtToken['is_admin'] ?? false) ? 'admin_update_password_' . $id : 'home_update_password_' . $id;
        $updatePassword = Cache::get($key);
        if ($updatePassword && $jwtToken['nbf'] < $updatePassword) {
            return ['status' => 401, 'msg' => lang('password_is_change_please_login_again')];
        }

        # 登录用户ID不一致
        if ($id != $jwtToken['id']) {
            return ['status' => 401, 'msg' => lang('login_unauthorized') . ':' . lang('login_user_ID_is_inconsistent')];
        }

        return ['status' => 200, 'data' => ['jwt_token' => $jwtToken]];
    }

    /**
     * 验证 JWT
     * @param string $jwt      JWT 令牌
     * @param int    $id       用户/管理员 ID
     * @param bool   $is_admin 是否为管理员
     * @return array
     */
    protected function verifyJwt($jwt, $id, $is_admin = false)
    {
        // 首先从 .env 文件中获取 AUTHCODE
        $authCode = env('AUTHCODE');

        if ($is_admin) {
            // 使用从 .env 获取的 $authCode 来拼接密钥
            $key = config('idcsmart.jwt_key_admin') . $authCode;
        } else {
            // 使用从 .env 获取的 $authCode 来拼接密钥
            $key = config('idcsmart.jwt_key_client') . $authCode;
        }

        try {
            $jwtAuth = json_decode(json_encode(\Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key($key, 'HS256'))), true);

            if (empty($jwtAuth['info'])) {
                return ['status' => 401, 'msg' => lang('login_unauthorized')];
            }

            $info = $jwtAuth['info'];

            $data = [
                'id'                   =>  $info['id'],
                'name'                 =>  $info['name'],
                'remember_password'    =>  isset($info['remember_password']) ? $info['remember_password'] : 0, # 前台不需要就不传此值
                'nbf'                  =>  $jwtAuth['nbf'],
                'ip'                   =>  $jwtAuth['ip'],
                'is_admin'             =>  isset($info['is_admin']) ? $info['is_admin'] : false, # 是否后台验证
                'is_api'               =>  isset($info['is_api']) ? $info['is_api'] : false, #
                'api_id'               =>  isset($info['api_id']) ? $info['api_id'] : 0, #
                'api_name'             =>  isset($info['api_name']) ? $info['api_name'] : '', #
            ];

            return ['status' => 200, 'data' => $data];

        } catch (\Firebase\JWT\SignatureInvalidException $e) { # token无效
            return ['status' => 401, 'msg' => lang('login_unauthorized') . ':' . $e->getMessage()];
        } catch (\Firebase\JWT\ExpiredException $e) { # token过期
            return ['status' => 401, 'msg' => lang('login_unauthorized') . ':' . $e->getMessage()];
        } catch (\Exception $e) {
            return ['status' => 401, 'msg' => lang('login_unauthorized') . ':' . $e->getMessage()];
        }
    }
}
