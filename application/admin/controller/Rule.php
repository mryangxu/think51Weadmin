<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;

// 规则
class Rule extends Base
{

    // 列表
    public function lists()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('limit', 20);
        $keywords = $this->request->post('keywords', '');

        $where = [];
        $where[] = ['delete_at', 'eq', null];
        if (!empty($keywords)) $where[] = ['title|rule|id', 'like', '%'.$keywords.'%'];
        $list = Db::name('rule')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有规则');

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

        $total = Db::name('rule')->where($where)->count();


        return $this->ajaxReturn(0, 'success', $list, $total);
    }

    // 信息
    public function info()
    {
        $id = $this->request->post('id', '');
        $info = Db::name('rule')->whereNull('delete_at')->find($id);
        if (empty($info)) return $this->ajaxReturn(300, '请联系管理员');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 编辑
    public function edit()
    {
        $post = $this->request->post();

        $validate = new \app\admin\validate\RuleValidate;
        if (!$validate->check($post)) return $this->ajaxReturn(300, $validate->getError());

        // 父级的层级
        $p_level = !empty($post['pid']) ? Db::name('rule')->where('id', $post['pid'])->value('level') : -1;

        if (isset($post['id']) && !empty($post['id']))
        {
            // 修改
            $had = Db::name('rule')->where([
                ['id', 'neq', $post['id']],
                ['rule', '=', $post['rule']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个规则了');

            $res = Db::name('rule')->where('id', $post['id'])->update([
                'title' => $post['title'],
                'icon' => $post['icon'],
                'pid' => !empty($post['pid']) ? $post['pid'] : 0,
                'level' => $p_level + 1,
                'rule' => $post['rule'],
                'sort' => isset($post['sort']) ? $post['sort'] : 1,
                'type' => $post['type'],
                'update_at' => date('Y-m-d H:i:s')
            ]);

        }else{
            // 添加
            $had = Db::name('rule')->where([
                ['rule', '=', $post['rule']],
                ['delete_at', '=', null]
            ])->find();
            if($had) return $this->ajaxReturn(300, '已经存在这个规则了');

            $res = Db::name('rule')->insert([
                'title' => $post['title'],
                'icon' => $post['icon'],
                'pid' => !empty($post['pid']) ? $post['pid'] : 0,
                'level' => $p_level + 1,
                'rule' => $post['rule'],
                'sort' => isset($post['sort']) ? $post['sort'] : 1,
                'type' => $post['type'],
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

        $res = Db::name('rule')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }

}