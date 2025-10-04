<?php
namespace app\admin\controller;

use app\admin\model\AuthRuleModel;
use think\facade\Cache;

/**
 * @title 后台基础控制器
 * @desc 所有后台的基类，负责权限验证和授权检查
 * @version v2.0
 */
class AdminBaseController extends BaseController
{
	// 初始化
    protected function initialize(): void
    {
        parent::initialize();
        //检查是否从clientarea地址访问,如果是就重定向
        $this->checkClientAreaRedirect();
        
    	if(!$this->checkAccess()){
            $module     = app('http')->getName();
            $controller = $this->request->controller();
            $action     = $this->request->action();
            $rule = 'app\\'.$module .'\\controller\\'. $controller .'Controller::'. $action;

            // 查找权限,未找到设置了则放行
            $AuthRuleModel = new AuthRuleModel();
    		$name = $AuthRuleModel->getAuthName($rule);
            if(!empty($name)){
                echo json_encode(['status'=>404, 'msg'=>lang('permission_denied')]);die;
            }
            
    	}

        if(empty(configuration('systemlicenseinfo'))){
            Cache::set('get_system_license', 1, 3600*6);
            if(mt_rand(0, 100)%2==1){
                $this->get_system_license2();
            }else{
                get_system_license();
            }
        }
        if(!Cache::has('get_system_license')){
            Cache::set('get_system_license', 1, 3600*6);
            if(mt_rand(0, 100)%2==1){
                $this->get_system_license2();
            }else{
                get_system_license();
            }
            
        }
    	
    }

    private function checkClientAreaRedirect()
    {
        // 获取配置中的前台域名
        $clientareaUrl = configuration('clientarea_url');

        // 如果配置了前台域名
        if (!empty($clientareaUrl)) {
            // 如果当前访问的域名和配置的前台域名一致
            if (request()->domain() == $clientareaUrl) {
                
                $adminApp = env('DIR_ADMIN', 'admin'); 
                
                // 拼接完整的、正确的后台URL
                $correctAdminUrl = request()->scheme() . '://' . request()->domain() . '/' . $adminApp;
                
                // 执行重定向并终止脚本
                header('Location: ' . $correctAdminUrl);
                exit();
            }
        }
    }

    // 获取管理员权限
    private function checkAccess(): bool
    {
    	$adminId = get_admin_id();
        if($adminId==1 || empty($adminId)){
            return true;
        }
        $module     = app('http')->getName();
        $controller = $this->request->controller();
        $action     = $this->request->action();
        $rule = 'app\\'.$module .'\\controller\\'. $controller .'Controller::'. $action;

        // 先获取缓存的权限
    	if(Cache::has('admin_auth_rule_'.$adminId)){
    		$auth = json_decode(Cache::get('admin_auth_rule_'.$adminId), true);
    		if(!in_array($rule, $auth)){
	    		return false;
	    	}else{
	    		return true;
	    	}
    	}

        // 获取数据库的权限
    	$AuthRuleModel = new AuthRuleModel();
    	$auth = $AuthRuleModel->getAdminAuthRule($adminId);
    	Cache::set('admin_auth_rule_'.$adminId, json_encode($auth),7200);
    	if(!in_array($rule, $auth)){
    		return false;
    	}
    	return true;
    }

    private function get_system_license2(): bool
    {
        $host = 'license.soft13.idcsmart.com';
        $path = '/app/api/auth_rc';
        $url = "https://{$host}{$path}";

        $license = configuration('system_license');
        if (empty($license)) {
            return false;
        }

        if (empty($_SERVER['SERVER_ADDR']) || empty($_SERVER['HTTP_HOST'])) {
            return false;
        }

        $ip = $_SERVER['SERVER_ADDR'];
        $arr = parse_url($_SERVER['HTTP_HOST']);
        $domain = $arr['host'] ?? $arr['path'];
        if (isset($arr['port'])) {
            $domain .= ':' . $arr['port'];
        }

        $data = [
            'ip'              => $ip,
            'domain'          => $domain,
            'type'            => 'finance',
            'license'         => $license,
            'install_version' => configuration('system_version'),
            'request_time'    => time(),
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 10,
            
            CURLOPT_SSL_VERIFYPEER => false, //原版代码里面没有开启ssl检查
            CURLOPT_SSL_VERIFYHOST => 2,
        ]);

        $response_body = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return false;
        }

        curl_close($ch);

        $result = json_decode($response_body, true);

        if (!is_array($result) || !isset($result['status'])) {
            return false;
        }

        $ConfigurationModel = new \app\common\model\ConfigurationModel();

        if ($result['status'] == 200) {
            $ConfigurationModel->saveConfiguration(['setting' => 'systemlicenseinfo', 'value' => $result['data']]);
            $ConfigurationModel->saveConfiguration(['setting' => 'idcsmart_service_due_time', 'value' => $result['due_time']]);
            $ConfigurationModel->saveConfiguration(['setting' => 'idcsmart_due_time', 'value' => $result['auth_due_time']]);
            return true;
        } else {
            $ConfigurationModel->saveConfiguration(['setting' => 'systemlicenseinfo', 'value' => '']);
            return false;
        }
    }
}