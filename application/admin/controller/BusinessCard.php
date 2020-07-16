<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Db;

// 名片
class BusinessCard extends Base
{

    // 列表
    public function lists()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('limit', 20);

        $keywords = $this->request->post('keywords', '');
 
        $where = [];
        $where[] = ['delete_at', 'eq', null];
        if (!empty($keywords)) $where[] = ['name|corporate_name|id', 'like', '%'.$keywords.'%'];
        
        $list = Db::name('business_card')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有名片信息');
        
        foreach($list as $k => $v)
        {
            $list[$k]['company_industry'] = Db::name('industry')->where('id', $v['company_industry_id'])->value('title');
        }

        $total = Db::name('business_card')->where($where)->count();

        return $this->ajaxReturn(0, 'success', $list, $total);
    }

    // 信息
    public function info()
    {
        $id = $this->request->post('id', '');
        $info = Db::name('business_card')->whereNull('delete_at')->find($id);
        if (empty($info)) return $this->ajaxReturn(300, '请联系管理员');
        return $this->ajaxReturn(200, 'success', $info);
    }

    // 编辑
    public function edit()
    {
        $post = $this->request->post();

        $validate = new \app\admin\validate\BusinessCardValidate;
        if (!$validate->check($post)) return $this->ajaxReturn(300, $validate->getError());


        if (isset($post['id']) && !empty($post['id']))
        {
            // 修改

            $res = Db::name('business_card')->where('id', $post['id'])->update([
                'name' => $post['name'],
                'phone' => $post['phone'],
                'corporate_name' => $post['corporate_name'],
                'company_industry_id' => $post['company_industry_id'],
                'position' => $post['position'],
                'title' => $post['title'],
                'cover_img' => $post['cover_img'],
                'background_img' => !empty($post['background_img']) ? $post['background_img'] : Db::name('system_conf')->where('id', 1)->value('default_background_img'),
                'details' => $post['editorValue'],
                'update_at' => date('Y-m-d H:i:s')
            ]);

        }else{
            // 添加

            $res = Db::name('business_card')->insert([
                'name' => $post['name'],
                'phone' => $post['phone'],
                'corporate_name' => $post['corporate_name'],
                'company_industry_id' => $post['company_industry_id'],
                'position' => $post['position'],
                'title' => $post['title'],
                'cover_img' => $post['cover_img'],
                'background_img' => !empty($post['background_img']) ? $post['background_img'] : Db::name('system_conf')->where('id', 1)->value('default_background_img'),
                'details' => $post['editorValue'],
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

        $res = Db::name('business_card')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }
    
    // 留言列表
    public function msg_lists()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('size', 20);
        $id = $this->request->post('id', '');
        
        if (empty($id)) return $this->ajaxReturn(0, '没有名片信息');
        
 
        $where = [];
        $where[] = ['delete_at', 'eq', null];
        $where[] = ['business_card_id', 'eq', $id];
        
        $list = Db::name('message')->where($where)->limit( ($page-1) * $size, $size)->select();

        if (empty($list)) return $this->ajaxReturn(0, '没有名片信息');
        
        $total = Db::name('message')->where($where)->count();

        return $this->ajaxReturn(0, 'success', $list, $total);
    }
    
    // 留言删除
    public function msg_del()
    {
        $id = $this->request->post('id', '');
        if (empty($id)) return $this->ajaxReturn(300, '请联系管理员');

        $res = Db::name('message')->whereIn('id', $id)->update(['delete_at' => date('Y-m-d H:i:s')]);

        if ($res) return $this->ajaxReturn(200, '删除成功');
        return $this->ajaxReturn(300, '删除失败');
    }
    
    
    // 修改默认背景
    public function up_defaults()
    {
        $url = $this->request->post('img');
        $res = Db::name('system_conf')->where('id', 1)->update(['default_background_img' => $url]);
        if ($res) return $this->ajaxReturn(200, '修改成功');
        return $this->ajaxReturn(300, '请重试');
        
    }

}