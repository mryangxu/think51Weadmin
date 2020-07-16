<?php

namespace app\admin\controller;
use think\Db;

class System extends Base
{
    // 获取菜单列表
    public function get_menu()
    {
        $role_id = session('manage')['role_id'];
        if ($role_id === 1)
        {
            $list = Db::name('rule')->where([
                ['delete_at', '=', null],
                ['type', '=', 'menu']
            ])->field('id, pid, title as name, rule as url, icon')->select();
        }else{
            $rule_ids = Db::name('role_rule')->where('role_id', $role_id)->column('rule_id');
            $list = Db::name('rule')->where([
                ['delete_at', '=', null],
                ['type', '=', 'menu'],
                ['id', 'in', $rule_ids]
            ])->field('id, pid, title as name, rule as url, icon')->select();
        }



        $data = $this->generateTree($list);
        return json([
            'status' => 0,
            'msg' => 'ok',
            'data' => $data
        ]);


    }

    // 图片上传
    public function uploads()
    {
        $file = $this->request->file('file');
        $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move( 'uploads/img');
        if($info){
            return $this->ajaxReturn(200, 'success', '/uploads/img/'.$info->getSaveName());
        }else{
            return $this->ajaxReturn(300, 'error', $file->getError());
        }
    }

    // 商会介绍
    public function introduce()
    {
        $info = Db::name('system_conf')->where('id', 1)->value('introduce');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 修改商会介绍
    public function up_introduce()
    {
        $info = $this->request->post('editorValue');
        $res = Db::name('system_conf')->where('id', 1)->update(['introduce' => $info]);
        if($res) return $this->ajaxReturn(200, '修改成功');
        return $this->ajaxReturn(300, '未发生修改');

    }

    // 修改密码
    public function update_pass()
    {
        $id = session('manage')['id'];
        $old = $this->request->post('old_pass');
        $new = $this->request->post('new_pass');
        $re_new_pass = $this->request->post('re_new_pass');

        $pass = Db::name('manage_user')->where('id', $id)->value('password');

        if(_authcode($pass) != $old) return $this->ajaxReturn(300, '旧密码不对');

        if($new != $re_new_pass) return $this->ajaxReturn(300, '两次密码不一致');

        $res = Db::name('manage_user')->where('id', $id)->update(['password' => _authcode($new, 'ENCODE')]);

        if($res) return $this->ajaxReturn(200, '修改成功');
        return $this->ajaxReturn(200, '请联系管理员');


    }

    // 所有菜单
    public function all_menu()
    {
        // 角色id
        $id = $this->request->post('id', '');

        $list = Db::name('rule')->where([
            ['delete_at', '=', null],
//            ['type', '=', 'menu']
        ])->field('id, pid, title, rule as field')->select();

        $role_rules = [];
        if (!empty($id))
        {
            // 获取角色对应

            // 规则id
            $rule_ids = Db::name('rule')->where([
                ['delete_at', '=', null],
                ['level', 'neq', 0]
            ])->column('id');

            // 规则的父级id
            $rule_pids = Db::name('rule')->where([
                ['delete_at', '=', null],
                ['level', 'neq', 0]
            ])->column('pid');

            // 角色对应的规则id
            $role_rules = Db::name('role_rule')->where([
                ['role_id', '=', $id],
                ['rule_id', 'in', $rule_ids]
            ])->column('rule_id');

            // 获取选中的id，排除有子元素的id（layui树型会全选所有子元素）
            if (!empty($role_rules))
            {
                foreach ($list as $v)
                {
                    if(in_array($v['id'], $rule_pids) && in_array($v['id'], $role_rules))
                    {
                        // 获取元素对应的key
                        $key = array_search($v['id'], $role_rules);

                        // 执行截取
                        if ($key !== false)
                            array_splice($role_rules, $key, 1);
                    }
                }
            }
//            var_dump($list);die;
        }

        $data = $this->generateTree($list);

        return json([
            'code' => 200,
            'msg' => 'ok',
            'data' => $data,
            'check' => $role_rules
        ]);

    }


    private function generateTree($data)
    {
        $items = array();
        foreach ($data as $v) {
            $items[$v['id']] = $v;
        }
        $tree = array();
        foreach ($items as $k => $item) {
            if (isset($items[$item['pid']])) {
                $items[$item['pid']]['children'][] = &$items[$k];
            } else {
                $tree[] = &$items[$k];
            }
        }
        return $tree;
    }





}