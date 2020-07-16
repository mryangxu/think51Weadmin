<?php

namespace app\admin\validate;

use think\Validate;

class ManageUserValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'username' => 'require',
        'nickname' => 'require',
        'role_id' => 'require',
        'password' => 'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'username.require' => '请填写用户名',
        'nickname.require' => '请填写昵称',
        'role_id.require' => '请选择角色',
        'password.require' => '请填写密码',
    ];
}
