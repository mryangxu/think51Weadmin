<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;

// 角色
class Role extends Base
{

    // 列表
    public function lists()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('limit', 20);
        $keywords = $this->request->post('keywords', '');

        $where = [];
        $where[] = ['delete_at', 'eq', null];
        if (!empty($keywords)) $where[] = ['name|id', 'like', '%'.$keywords.'%'];
        $list = Db::name('role')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有角色');

        $total = Db::name('role')->where($where)->count();

        return $this->ajaxReturn(0, 'success', $list, $total);
    }

    // 信息
    public function info()
    {
        $id = $this->request->post('id', '');
        $info = Db::name('role')->whereNull('delete_at')->find($id);
        if (empty($info)) return $this->ajaxReturn(300, '请联系管理员');
        $info['rules'] = Db::name('role_rule')->where('role_id', $id)->column('rule_id');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 编辑
    public function edit()
    {
        $post = $this->request->post();

        $validate = new \app\admin\validate\RoleValidate;
        if (!$validate->check($post)) return $this->ajaxReturn(300, $validate->getError());

        if(empty($post['rules'])) return $this->ajaxReturn(300, '请选择规则');

        // 组装规则id
        $rule_ids = $this->get_all_id($post['rules']);

        // 父级的层级
        $p_level = !empty($post['pid']) ? Db::name('role')->where('id', $post['pid'])->value('level') : -1;

        Db::startTrans();

        try{
            if (isset($post['id']) && !empty($post['id']))
            {
                // 修改
                $had = Db::name('role')->where([
                    ['id', 'neq', $post['id']],
                    ['name', '=', $post['name']],
                    ['delete_at', '=', null]
                ])->find();
                if($had) return $this->ajaxReturn(300, '已经存在这个角色了');

                Db::name('role')->where('id', $post['id'])->update([
                    'name' => $post['name'],
                    'pid' => !empty($post['pid']) ? $post['pid'] : 0,
                    'level' => $p_level + 1,
                    'update_at' => date('Y-m-d H:i:s')
                ]);
                $role_id = $post['id'];

            }else{
                // 添加
                $had = Db::name('role')->where([
                    ['name', '=', $post['name']],
                    ['delete_at', '=', null]
                ])->find();
                if($had) return $this->ajaxReturn(300, '已经存在这个角色了');

                $role_id = Db::name('role')->insertGetId([
                    'name' => $post['name'],
                    'pid' => !empty($post['pid']) ? $post['pid'] : 0,
                    'level' => $p_level + 1,
                    'create_at' => date('Y-m-d H:i:s'),
                    'update_at' => date('Y-m-d H:i:s')
                ]);
            }

            $temp = [];
            // 组装数组
            foreach ($rule_ids as $v)
            {
                $temp[] = ['role_id' => $role_id, 'rule_id' => $v];
            }

            // 删除之前的关联
            Db::name('role_rule')->where('role_id', $role_id)->delete();

            //新建关联
            Db::name('role_rule')->insertAll($temp);

            $res = 1;
            Db::commit();
        }catch (\Exception $e)
        {
            $res = 0;
            Db::rollback();
        }


        if ($res) return $this->ajaxReturn(200, '操作成功');

        return $this->ajaxReturn(300, '操作失败');
    }

    // 删除
    public function del()
    {
        $id = $this->request->post('id', '');
        if (empty($id)) return $this->ajaxReturn(300, '请联系管理员');

        $res = Db::name('role')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }

    // 递归获取所有id
    private function get_all_id($data, $ids = [])
    {
        foreach ($data as $v)
        {
            // 装入临时数组
            $ids[] = $v['id'];

            // 有孩子 获取孩子的id
            if (!empty($v['children']))
            {
                // 这里是一直以来临时数据，直接赋值
                $ids = $this->get_all_id($v['children'], $ids);
            }
        }

        return $ids;


    }

}