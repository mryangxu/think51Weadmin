<?php


namespace app\admin\controller;
use think\Db;

// 负责页面渲染
class Index extends Base
{

    public function index()
    {
        return $this->fetch('', ['nickname' => session('manage')['nickname']]);
    }


    /**
     * 权限管理
     */
    // 规则管理
    public function rule()
    {
        return $this->fetch();
    }
    // 规则编辑
    public function rule_edit()
    {
        // 所有菜单
        $list = Db::name('rule')->where([
            ['delete_at', '=', null],
            ['type', '=', 'menu'],
        ])->field('id, title, level')->select();

        foreach ($list as $k => $v)
        {
            switch ($v['level']){
                case 1:
                    $list[$k]['title'] = '|---' . $v['title'];
                    break;
                case 2:
                    $list[$k]['title'] = '|---|---' . $v['title'];
                    break;
                case 3:
                    $list[$k]['title'] = '|---|---|---' . $v['title'];
                    break;
                default:
                    break;
            }
        }

        $data = [
            'rules' => $list
        ];
        $id = $this->request->get('id','');
        if(!empty($id))
        {
            $info = Db::name('rule')->find($id);
            $data['info'] = $info;
        }


        return $this->fetch('', $data);
    }

    // 管理员管理
    public function manage_user()
    {
        return $this->fetch();
    }
    // 管理员编辑
    public function manage_user_edit()
    {
        // 所有角色
        $list = Db::name('role')->where([
            ['delete_at', '=', null],
        ])->field('id, name')->select();
        $data = [
            'roles' => $list
        ];
        $id = $this->request->get('id','');
        if(!empty($id))
        {
            $info = Db::name('manage_user')->find($id);
            $info['password'] = _authcode($info['password']);
            $data['info'] = $info;
        }

        return $this->fetch('', $data);
    }

    // 角色管理
    public function role()
    {
        return $this->fetch();
    }
    // 角色编辑
    public function role_edit()
    {

        $id = $this->request->get('id','');
        // 所有角色
        $list = Db::name('role')->where([
            ['delete_at', '=', null],
            ['id', 'neq', $id]
        ])->field('id, name')->select();

        $data = [
            'roles' => $list
        ];

        if(!empty($id))
        {
            $info = Db::name('role')->find($id);
            $data['info'] = $info;
        }

        return $this->fetch('', $data);
    }
    
    /**
     * 名片管理
     */
    // 名片列表
    public function business_card()
    {
        return $this->fetch();
    }
    
    // 名片编辑
    public function business_card_edit()
    {

        $id = $this->request->get('id','');
        
        // 所有行业
        $list = Db::name('industry')->where([
            ['delete_at', '=', null],
        ])->field('id, title')->select();

        $data = [
            'industrys' => $list,
        ];

        if(!empty($id))
        {
            $info = Db::name('business_card')->find($id);
            $data['info'] = $info;
        }
        return $this->fetch('', $data);
    }

    // 留言列表
    public function message_list()
    {
        $id = $this->request->post('id', '');
        $page = $this->request->post('page', 1);
        $size = $this->request->post('limit', 10);

        if (empty($id)) return $this->ajaxReturn(0, '没有名片信息');


        $where = [];
        $where[] = ['delete_at', 'eq', null];
        $where[] = ['business_card_id', 'eq', $id];

        $list = Db::name('message')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(400, '没有名片信息');

        $total = Db::name('message')->where($where)->count();

        return $this->ajaxReturn(200, 'success', $list, $total);

    }
    
    // 名片留言
    public function business_card_msg()
    {
        $id = $this->request->get('id','');
        
       
       
        return $this->fetch('', ['id' => $id]);
    }
    
    // 默认背景
    public function defaults()
    {
        $img = Db::name('system_conf')->where('id', 1)->value('default_background_img');
        return $this->fetch('', ['img' => $img]);
    }

    /**
     * 行业管理
     */
    // 行业列表
    public function industry()
    {
        return $this->fetch();
    }

    // 行业编辑
    public function industry_edit()
    {
        $id = $this->request->get('id','');


        $data = [];

        if(!empty($id))
        {
            $info = Db::name('industry')->find($id);
            $data['info'] = $info;
        }

        return $this->fetch('', $data);
    }

    /**
     * 商会介绍
     */

    // 商会介绍
    public function introduce()
    {
        $info = Db::name('system_conf')->where('id', 1)->value('introduce');
        return $this->fetch('', ['info' => $info]);
    }

    /**
     * 个人设置
     */
    // 修改密码
    public function update_pass()
    {
        return $this->fetch();
    }

    
    
    
    
    
    
    
    
    
    
    
}