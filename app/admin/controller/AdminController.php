<?php
namespace app\admin\controller;
use think\response\Json;
use app\admin\model\AdminModel;
use app\admin\validate\AdminValidate;

/**
 * @title 管理员
 * @desc 管理员管理
 * @use app\admin\controller\AdminController
 */
class AdminController extends AdminBaseController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->validate = new AdminValidate();
    }

    /**
     * 时间 2022-5-10
     * @title 管理员列表
     * @desc 管理员列表
     * @url /admin/v1/admin
     * @method  GET
     * @author wyh
     * @version v1
     * @param string keywords - 关键字:ID,名称,用户名,邮箱
     * @param string status - 状态0:禁用,1:正常
     * @param int page - 页数
     * @param int limit - 每页条数
     * @param string orderby - 排序 id,nickname,name,email
     * @param string sort - 升/降序 asc,desc
     * @return array list - 管理员列表
     * @return int list[].id - ID
     * @return int list[].nickname - 名称
     * @return int list[].name - 用户名
     * @return int list[].email - 邮箱
     * @return int list[].roles - 分组名称
     * @return int list[].status - 状态;0:禁用,1:正常
     * @return int list[].phone_code - 国际电话区号
     * @return string list[].phone - 手机号
     * @return int list[].lock - 锁定0=否1=是
     * @return int list[].lock_time - 锁定到期时间
     * @return int list[].totp_bind - 是否绑定totp(0=否1=是)
     * @return int count - 管理员总数
     */
    public function adminList(): Json
    {
        # 合并分页参数
        $param = array_merge($this->request->param(),['page'=>$this->request->page,'limit'=>$this->request->limit,'sort'=>$this->request->sort]);
        
        $result = [
            'status'=>200,
            'msg'=>lang('success_message'),
            'data' =>(new AdminModel())->adminList($param)
        ];
       return json($result);
    }

    /**
     * 时间 2022-5-10
     * @title 获取单个管理员
     * @desc 获取单个管理员
     * @url /admin/v1/admin/:id
     * @method  GET
     * @author wyh
     * @version v1
     * @param int id - 管理员分组ID required
     * @return object admin - 管理员
     * @return int admin.id - ID
     * @return string admin.nickname - 名称
     * @return string admin.name - 用户名
     * @return string admin.email - 邮箱
     * @return string admin.role_id - 分组ID
     * @return string admin.roles - 所属分组,逗号分隔
     * @return string admin.status - 状态;0:禁用;1:正常
     * @return int phone_code - 国际电话区号
     * @return string phone - 手机号
     */
    public function index(): Json
    {
        $param = $this->request->param();

        $result = [
            'status'=>200,
            'msg'=>lang('success_message'),
            'data' =>[
                'admin' => (new AdminModel())->indexAdmin(intval($param['id']))
            ]
        ];
        return json($result);
    }

    /**1
     * 时间 2022-5-10
     * @title 添加管理员
     * @desc 添加管理员
     * @url /admin/v1/admin
     * @method  post
     * @author wyh
     * @version v1
     * @param string name 测试员 用户名 required
     * @param string password 123456 密码 required
     * @param string repassword 123456 重复密码 required
     * @param string email 123@qq.com 邮箱 required
     * @param string nickname 小华 名称 required
     * @param string role_id 1 分组ID required
     * @param int phone_code - 国际电话区号
     * @param string phone - 手机号
     */
    public function create(): Json
    {
        $param = $this->request->param();

        //参数验证
        if (!$this->validate->scene('create')->check($param)){
            return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
        }

        $result = (new AdminModel())->createAdmin($param);

        return json($result);
    }

    /**
     * 时间 2022-5-10
     * @title 修改管理员
     * @desc 修改管理员
     * @url /admin/v1/admin/:id
     * @method  put
     * @author wyh
     * @version v1
     * @param string id 1 管理员ID required
     * @param string name 测试员 用户名 required
     * @param string password 123456 密码 required
     * @param string repassword 123456 重复密码 required
     * @param string email 123@qq.com 邮箱 required
     * @param string nickname 小华 名称 required
     * @param string role_id 1 分组ID required
     * @param int phone_code - 国际电话区号
     * @param string phone - 手机号
     */
    public function update(): Json
    {
        $param = $this->request->param();
        //参数验证
        if (!$this->validate->scene('update')->check($param)){
            return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
        }
		if(!empty($param['password']) || !empty($param['repassword'])){
			//密码验证
			if (!$this->validate->scene('update_password')->check($param)){
				return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
			}
		}
        $result = (new AdminModel())->updateAdmin($param);

        return json($result);
    }

    /**
     * 时间 2022-5-10
     * @title 删除管理员
     * @desc 删除管理员
     * @url /admin/v1/admin/:id
     * @method  delete
     * @author wyh
     * @version v1
     * @param int id 1 管理员ID required
     */
    public function delete(): Json
    {
        $param = $this->request->param();

        $result = (new AdminModel())->deleteAdmin($param);

        return json($result);
    }

    /**
     * 时间 2022-5-10
     * @title 管理员状态切换
     * @desc 管理员状态切换
     * @url /admin/v1/admin/:id/status
     * @method  put
     * @author wyh
     * @version v1
     * @param int id 1 管理员ID required
     * @param int status 1 状态:0禁用,1启用 required
     */
    public function status(): Json
    {
        $param = $this->request->param();

        $result = (new AdminModel())->status($param);

        return json($result);
    }

    /**
     * 时间 2022-5-13
     * @title 注销
     * @desc 注销
     * @url /admin/v1/logout
     * @method  post
     * @author wyh
     * @version v1
     */
    public function logout(): Json
    {
        $param = $this->request->param();

        $result = (new AdminModel())->logout($param);

        return json($result);
    }

    /**
     * 时间 2022-9-7
     * @title 修改管理员密码
     * @desc 修改管理员密码
     * @url /admin/v1/admin/password/update
     * @method  put
     * @author wyh
     * @version v1
     * @param string origin_password - 原密码 required
     * @param string password 123456 密码 required
     * @param string repassword 123456 重复密码 required
     */
    public function updatePassword(): Json
    {
        $param = $this->request->param();
        //参数验证
        if (!$this->validate->scene('password')->check($param)){
            return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
        }

        $result = (new AdminModel())->updateAdminPassword($param);

        return json($result);
    }

    /**
     * 时间 2024-05-21
     * @title 获取当前管理员信息
     * @desc  获取当前管理员信息
     * @url /admin/v1/login_info
     * @method  GET
     * @author hh
     * @version v1
     * @return  string name - 用户名
     * @return  string nickname - 姓名
     * @return  bool set_operate_password - 是否设置了操作密码
     * @return  bool totp_bind - 是否绑定totp(0=否1=是)
     * @return  string email - 邮箱
     * @return  string phone_code - 国际电话区号
     * @return  string phone - 手机号
     * @return  string admin_role_name - 管理组名称
     * @return  int prohibit_admin_bind_phone - 禁止后台用户自助绑定手机号:1是0否
     * @return  int prohibit_admin_bind_email - 禁止后台用户自助绑定邮箱:1是0否
     */
    public function currentAdmin(): Json
    {
        $result = (new AdminModel())->currentAdmin();
        return json($result);
    }

    /**
     * 时间 2024-05-21
     * @title 修改管理员操作密码
     * @desc  修改管理员操作密码
     * @url /admin/v1/admin/operate_password
     * @method  PUT
     * @author  hh
     * @version v1
     * @param   string origin_operate_password - 原操作密码 已有操作密码必传
     * @param   string operate_password - 新操作密码
     * @param   string re_operate_password - 重复操作密码
     */
    public function updateAdminOperatePassword(): Json
    {
        $param = $this->request->param();
        //参数验证
        if (!$this->validate->scene('operate_password')->check($param)){
            return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
        }

        $result = (new AdminModel())->updateAdminOperatePassword($param);

        return json($result);
    }

    /**
     * 时间 2024-05-21
     * @title 修改管理员姓名
     * @desc  修改管理员姓名
     * @url /admin/v1/admin/nickname
     * @method  PUT
     * @author  theworld
     * @version v1
     * @param   string nickname - 姓名
     */
    public function updateAdminNickname(): Json
    {
        $param = $this->request->param();
        //参数验证
        if (!$this->validate->scene('nickname')->check($param)){
            return json(['status' => 400 , 'msg' => lang($this->validate->getError())]);
        }

        $result = (new AdminModel())->updateAdminNickname($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 验证原手机
     * @desc 验证原手机
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/verify_old_phone
     * @method  POST
     * @param string code - 验证码 required
     */
    public function verifyOldPhone(): Json
    {
        $param = $this->request->param();
        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('verify_old_phone')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->verifyOldPhone($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 修改手机
     * @desc 修改手机
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/phone
     * @method  PUT
     * @param int phone_code - 国际电话区号 required
     * @param string phone - 手机号 required
     * @param string code - 验证码 required
     * @return int status - 状态码,200成功,400失败
     * @return string msg - 提示信息
     */
    public function updatePhone(): Json
    {
        $param = $this->request->param();
        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('update_phone')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->updatePhone($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 验证原邮箱
     * @desc 验证原邮箱
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/verify_old_email
     * @method  POST
     * @param string code - 验证码 required
     * @return int status - 状态码,200成功,400失败
     * @return string msg - 提示信息
     */
    public function verifyOldEmail(): Json
    {
        $param = $this->request->param();
        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('verify_old_email')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->verifyOldEmail($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 修改邮箱
     * @desc 修改邮箱
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/email
     * @method  PUT
     * @param string email - 邮箱 required
     * @param string code - 验证码 required
     * @return int status - 状态码,200成功,400失败
     * @return string msg - 提示信息
     */
    public function updateEmail(): Json
    {
        $param = $this->request->param();
        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('update_email')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->updateEmail($param);

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 获取TOTP密钥
     * @desc 获取TOTP密钥
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/totp
     * @method  GET
     * @return string secret - TOTP密钥
     * @return string url - 二维码地址
     */
    public function getTotp(): Json
    {
        $param = $this->request->param();

        $result = (new AdminModel())->getTotp();

        return json($result);
    }

    /**
     * 时间 2025-04-02
     * @title 绑定TOTP
     * @desc 绑定TOTP
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/totp
     * @method  PUT
     * @param string code - 验证码 required
     */
    public function bindTotp(): Json
    {
        $param = $this->request->param();

        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('bind_totp')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->bindTotp($param);

        return json($result);
    }

    /**
     * 时间 2025-04-22
     * @title 解绑TOTP
     * @desc 解绑TOTP
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/totp
     * @method  DELETE
     * @param string method - 验证方式totp,phone,email required
     * @param string code - 验证码 required
     */
    public function unbindTotp(): Json
    {
        $param = $this->request->param();

        //参数验证
        $AdminBindValidate = new \app\admin\validate\AdminBindValidate();
        if (!$AdminBindValidate->scene('unbind_totp')->check($param)){
            return json(['status' => 400 , 'msg' => lang($AdminBindValidate->getError())]);
        }

        $result = (new AdminModel())->unbindTotp($param);

        return json($result);
    }

    /**
     * 时间 2025-04-22
     * @title 管理员解绑其他管理员TOTP
     * @desc 管理员解绑其他管理员TOTP
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/:id/totp
     * @method  DELETE
     * @param int id - 管理员ID required
     */
    public function adminUnbindTotp(): Json
    {
        $param = $this->request->param();


        $result = (new AdminModel())->adminUnbindTotp($param['id']);

        return json($result);
    }

    /**
     * 时间 2025-04-22
     * @title 管理员解锁其他管理员
     * @desc 管理员解锁其他管理员
     * @author theworld
     * @version v1
     * @url /admin/v1/admin/:id/lock
     * @method  DELETE
     * @param int id - 管理员ID required
     */
    public function adminUnlock(): Json
    {
        $param = $this->request->param();


        $result = (new AdminModel())->adminUnlock($param['id']);

        return json($result);
    }
}

