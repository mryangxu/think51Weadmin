<?php

namespace app\admin\validate;

use think\Validate;

class ruleValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'title' => 'require',
        'icon' => 'require',
        'rule' => 'require',
        'type' => 'require',
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'title.require' => '请填写规则名称',
        'icon.require' => '请填写图标',
        'rule.require' => '请填写规则',
        'type.require' => '请选择规则类型',
    ];
}
