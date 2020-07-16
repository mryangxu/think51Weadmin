<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;

// 管理员
class ManageUser extends Base
{

    // 列表
    public function lists()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('limit', 20);

        $keywords = $this->request->post('keywords', '');



        $where = [];
        $where[] = ['delete_at', 'eq', null];
        $where[] = ['id', 'neq', 1];
        if (!empty($keywords)) $where[] = ['username|nickname|id', 'like', '%'.$keywords.'%'];

        $list = Db::name('manage_user')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有管理员信息');

        foreach ($list as $k => $v)
        {
            $list[$k]['role'] = Db::name('role')->where('id', $v['role_id'])->value('name');
        }

        $total = Db::name('manage_user')->where($where)->count();

        return $this->ajaxReturn(0, 'success', $list, $total);
    }

    // 信息
    public function info()
    {
        $id = $this->request->post('id', '');
        $info = Db::name('manage_user')->whereNull('delete_at')->find($id);
        if (empty($info)) return $this->ajaxReturn(300, '请联系管理员');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 编辑
    public function edit()
    {
        $post = $this->request->post();

        $validate = new \app\admin\validate\ManageUserValidate;
        if (!$validate->check($post)) return $this->ajaxReturn(300, $validate->getError());

        if (isset($post['id']) && !empty($post['id']))
        {
            // 修改
            $had = Db::name('manage_user')->where([
                ['id', 'neq', $post['id']],
                ['username', '=', $post['username']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个管理员了');


            $res = Db::name('manage_user')->where('id', $post['id'])->update([
                'username' => $post['username'],
                'nickname' => $post['nickname'],
                'role_id' => $post['role_id'],
                'password' => _authcode($post['password'], 'ENCODE'),
                'update_at' => date('Y-m-d H:i:s')
            ]);

        }else{
            // 添加
            $had = Db::name('manage_user')->where([
                ['username', '=', $post['username']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个管理员了');

            $res = Db::name('manage_user')->insert([
                'username' => $post['username'],
                'nickname' => $post['nickname'],
                'role_id' => $post['role_id'],
                'password' => _authcode($post['password'], 'ENCODE'),
                'create_at' => date('Y-m-d H:i:s'),
                'update_at' => date('Y-m-d H:i:s')
            ]);

        }

        if ($res) return $this->ajaxReturn(200, '操作成功');
        return $this->ajaxReturn(300, '操作失败');
    }

    // 删除
    public function del()
    {
        $id = $this->request->post('id', '');
        if (empty($id)) return $this->ajaxReturn(300, '请联系管理员');

        $res = Db::name('manage_user')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }

}