<?php
namespace app\admin\controller;
use think\response\Json;
use app\admin\model\AdminModel;
use app\admin\validate\AdminValidate;
use app\common\logic\VerificationCodeLogic;
use app\common\model\SystemLogModel;
use think\facade\Db;
use think\facade\Cache;

/**
 * @title 后台开放类
 * @desc 后台开放类,不需要授权
 */
class PublicController extends BaseController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->validate = new AdminValidate();
    }

    /**
     * 时间 2022-5-18
     * @title 登录信息
     * @desc 登录信息
     * @url /admin/v1/login
     * @method  get
     * @param string name - 管理员用户名
     * @return int captcha_admin_login - 管理员登录图形验证码开关:1开启,0关闭
     * @return int captcha_admin_login_error - 客户登录失败图形验证码开关:1开启，0关闭
     * @return string website_name 智简魔方 网站名称
     * @return string lang_admin - 语言
     * @return int admin_allow_remember_account - 后台是否允许记住账号:1开启0关闭
     * @return int captcha_admin_login_error_3_times 1 管理员登录失败3次
     * @author wyh
     * @version v1
     */
    public function loginInfo(): Json
    {
        $param = $this->request->param();

        $setting = [
            'captcha_admin_login',
            'captcha_admin_login_error',
            'website_name',
            'lang_admin',
            'admin_allow_remember_account',
            'admin_second_verify',
        ];
        $data = configuration($setting);

        $name = $param['name']??'';
        # 登录3次失败
        if ($name){
            $ip = get_client_ip();
            $key = "admin_password_login_times_{$name}_{$ip}";
            if (Cache::get($key)>3){
                $data = array_merge($data,['captcha_admin_login_error_3_times'=>1]);
            }else{
                $data = array_merge($data,['captcha_admin_login_error_3_times'=>0]);
            }
        }else{
            $data = array_merge($data,['captcha_admin_login_error_3_times'=>0]);
        }

        $result = [
            'status' => 200,
            'msg' => lang('success_message'),
            'data' => [
                'captcha_admin_login' => isset($data['captcha_admin_login']) ? (int)$data['captcha_admin_login'] : 0,
                'captcha_admin_login_error' => isset($data['captcha_admin_login_error']) ? (int)$data['captcha_admin_login_error'] : 0,
                'website_name' => $data['website_name'] ?? '',
                'lang_admin' => $data['lang_admin'] ?? '',
                'admin_allow_remember_account' => isset($data['admin_allow_remember_account']) ? (int)$data['admin_allow_remember_account'] : 1,
                'admin_second_verify' => isset($data['admin_second_verify']) ? (int)$data['admin_second_verify'] : 0,
                'captcha_admin_login_error_3_times' => isset($data['captcha_admin_login_error_3_times']) ? (int)$data['captcha_admin_login_error_3_times'] : 0,
            ]
        ];

        return json($result);
    }

    /**
     * 时间 2022-5-13
     * @title 后台登录
     * @desc 后台登录
     * @url /admin/v1/login
     * @method  post
     * @param string name 测试员 用户名 required
     * @param string password 123456 密码 required
     * @param string remember_password 1 是否记住密码(1是,0否) required
     * @param string token d7e57706218451cbb23c19cfce583fef 图形验证码唯一识别码
     * @param string captcha 12345 图形验证码
     * @param string code - 验证码
     * @return object data - 返回数据
     * @return string data.jwt - jwt:登录后放在请求头Authorization里,拼接成如下格式:Bearer+空格+yJ0eX.test.ste
     * @return int data.second_verify - 二次验证0否1是
     * @return string data.method - 二次验证方式sms短信email邮件totp
     * @version v1
     * @author wyh
     */
    public function login(): Json
    {
        $param = $this->request->param();

        //参数验证
        if (!$this->validate->scene('login')->check($param)) {
            return json(['status' => 400, 'msg' => lang($this->validate->getError())]);
        }
        // 是否允许记住密码
        $adminAllowRememberAccount = configuration('admin_allow_remember_account') ?: 1;
        if($adminAllowRememberAccount != 1){
            $param['remember_password'] = 0;
        }

        hook_one('before_admin_login', ['name' => $param['name'] ?? '', 'password' => $param['password'] ?? '', 'remember_password' => $param['remember_password'] ?? '',
            'token' => $param['token'] ?? '', 'captcha' => $param['captcha'] ?? '', 'customfield' => $param['customfield'] ?? []]);

        $result = (new AdminModel())->login($param);

        return json($result);
    }

    /**
     * 时间 2022-5-19
     * @title 图形验证码
     * @desc 图形验证码
     * @url /admin/v1/captcha
     * @method  get
     * @return string html - html文档
     * @version v1
     * @author wyh
     */
    public function captcha(): Json
    {
        $result = [
            'status' => 200,
            'msg' => lang('success_message'),
            'data' => [
                'html' => get_captcha(true)
            ]
        ];

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 发送手机验证码
     * @desc 发送手机验证码
     * @author theworld
     * @version v1
     * @url /admin/v1/phone/code
     * @method  POST
     * @param string action - 验证动作admin_login登录admin_verify验证手机admin_update修改手机
     * @param string name - 管理员用户名 登录和验证手机时需要
     * @param int phone_code - 国际电话区号 修改手机时需要
     * @param string phone - 手机号 修改手机时需要
     */
    public function sendPhoneCode(): Json
    {
        //接收参数
        $param = $this->request->param();

        // 参数验证
        $PublicValidate = new \app\admin\validate\PublicValidate();
        if (!$PublicValidate->scene('sened_phone_code')->check($param)){
            return json(['status' => 400 , 'msg' => lang($PublicValidate->getError())]);
        }

        $result = (new VerificationCodeLogic())->sendPhoneCode($param);

        return json($result);

    }

    /**
     * 时间 2025-04-02
     * @title 发送邮件验证码
     * @desc 发送邮件验证码
     * @author theworld
     * @version v1
     * @url /admin/v1/email/code
     * @method  POST
     * @param string action - 验证动作admin_login登录admin_verify验证邮箱admin_update修改邮箱
     * @param string name - 管理员用户名 登录和验证邮箱时需要
     * @param string email - 邮箱 修改邮箱时需要
     */
    public function sendEmailCode(): Json
    {
        //接收参数
        $param = $this->request->param();

        // 参数验证
        $PublicValidate = new \app\admin\validate\PublicValidate();
        if (!$PublicValidate->scene('sened_email_code')->check($param)){
            return json(['status' => 400 , 'msg' => lang($PublicValidate->getError())]);
        }

        $result = (new VerificationCodeLogic())->sendEmailCode($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 获取二次验证方式
     * @desc 获取二次验证方式
     * @author theworld
     * @version v1
     * @url /admin/v1/second/verify/method
     * @method  POST
     * @param string name - 管理员用户名 required
     * @return string method - 二次验证方式sms短信email邮件totp
     */
    public function getSecondVerifyMethod(): Json
    {
        $param = $this->request->param();

        //参数验证
        if (!$this->validate->scene('second')->check($param)) {
            return json(['status' => 400, 'msg' => lang($this->validate->getError())]);
        }

        $result = (new AdminModel())->getSecondVerifyMethod($param);

        return json($result);
    }

}