<?php

namespace app\admin\validate;

use think\Validate;

class BusinessCardValidate extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
	    'name' => 'require',
	    'phone' => 'require|number',
        'corporate_name' => 'require',
        'company_industry_id' => 'require',
        'position' => 'require',
        'title' => 'require',
        'cover_img' => 'require',
        'editorValue' => 'require'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'name.require' => '请填写姓名',
        'phone.require' => '请填写电话',
        'phone.number' => '电话格式不对',
        'corporate_name.require' => '请填写公司名称',
        'company_industry_id.require' => '请选择行业',
        'position.require' => '请填写职位',
        'title.require' => '请填写头衔',
        'cover_img.require' => '请上传封面图',
        'editorValue.require' => '请填写详情',
    ];
}
