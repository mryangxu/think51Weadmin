<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{

    public function index()
    {
        return '首页';
    }


    // 行业
    public function industry()
    {
        $all = Db::name('industry')->select();
        return json( ['code' => 200, 'message' => 'success', 'data' => $all]);
    }

    // 名片列表
    public function business_card()
    {
        $page = $this->request->post('page', 1);
        $size = $this->request->post('size', 10);
        $industry = $this->request->post('industry', '');
        $keywords = $this->request->post('keywords', '');

        $where = [];
        $where[] = ['delete_at', '=', null];
        if ( !empty($industry) ) $where[] = ['company_industry_id', '=', $industry];
        if (!empty($keywords)) $where[] = ['name', 'like', '%'.trim($keywords).'%'];


        $list = Db::name('business_card')
            ->where($where)
            ->limit(($page-1) * $size, $size)
            ->order('sort, id')
            ->select();
        if (empty($list)) return json(['code'=>400, 'message'=>'没有数据了']);
        $total = Db::name('business_card')->where($where)->count();
        return json(['code' => 200, 'message' => 'success', 'data' => $list, 'total' => $total]);
    }

    // 名片详情
    public function card_detail()
    {
        $id = $this->request->post('id', '');

        $info = Db::name('business_card')->find($id);
        $info['cover_img'] = config('domain'). $info['cover_img'];
        $info['background_img'] = config('domain'). $info['background_img'];

        if (empty($info)) return $this->redirect('/');

        return json(['code' => 200, 'message' => 'success', 'data' => $info]);
    }

    // 留言
    public function leaving_message()
    {
        $id = $this->request->post('id', '');

        if (empty($id)) return $this->redirect('/');
        $content = $this->request->post('message', '');
        if (empty($content)) return json(['code' => 300, 'message' => '请输入留言内容']);
        $res = Db::name('message')->insert(
            [
                'content' => $content,
                'business_card_id' => $id,
                'create_at' => date('Y-m-d H:i:s'),
            ]
        );

        if ($res) return json(['code' => '200', 'message' => '感谢您的留言']);
        return json(['code' => '300', 'message' => '请重试']);

    }

    // 商会信息
    public function introduce()
    {
        $info = Db::name('system_conf')->where('id', 1)->value('introduce');
        return json(['code' => 200, 'message' => 'success', 'data' => $info]);
    }

    // 浏览递增
    public function putVisit()
    {
        $id = $this->request->post('id', '');
        $res = Db::name('business_card')->where('id', $id)->setInc('visit');
        if ($res) return json(['code' => 200, 'message' => 'success']);
        return json(['code' => 300, 'message' => 'error']);

    }
}
