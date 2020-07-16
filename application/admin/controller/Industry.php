<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;

// 行业
class Industry extends Base
{

    // 列表
    public function lists()
    {
        $page = $this->request->post('page', 1);

        $size = $this->request->post('limit', 20);

        $keywords = $this->request->post('keywords', '');

        $where = [];
        $where[] = ['delete_at', 'eq', null];
        if (!empty($keywords)) $where[] = ['title', 'like', '%'.$keywords.'%'];
        $list = Db::name('industry')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有行业信息');

        $total = Db::name('industry')->where($where)->count();

        return $this->ajaxReturn(0, 'success', $list, $total);
    }

    // 信息
    public function info()
    {
        $id = $this->request->post('id', '');
        $info = Db::name('industry')->whereNull('delete_at')->find($id);
        if (empty($info)) return $this->ajaxReturn(300, '请联系管理员');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 编辑
    public function edit()
    {
        $post = $this->request->post();

        $validate = new \app\admin\validate\IndustryValidate;
        if (!$validate->check($post)) return $this->ajaxReturn(300, $validate->getError());


        if (isset($post['id']) && !empty($post['id']))
        {
            // 修改
            $had = Db::name('industry')->where([
                ['id', 'neq', $post['id']],
                ['title', '=', $post['title']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个行业了');

            $res = Db::name('industry')->where('id', $post['id'])->update([
                'title' => $post['title'],
                'update_at' => date('Y-m-d H:i:s')
            ]);

        }else{
            // 添加
            $had = Db::name('industry')->where([
                ['title', '=', $post['title']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个行业了');

            $res = Db::name('industry')->insert([
                'title' => $post['title'],
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

        $res = Db::name('industry')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }

}