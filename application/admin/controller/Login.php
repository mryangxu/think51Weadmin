<?php


namespace app\admin\controller;

use think\Controller;
use think\Db;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
        $post = $this->request->post();

        if (empty($post['username'])) return json(['code' => 300, 'message' => '请填写用户名']);
        if (empty($post['password'])) return json(['code' => 300, 'message' => '请填写密码']);

        $info = Db::name('manage_user')->where('username', $post['username'])->find();

        if(empty($info)) return json(['code' => 300, 'message' => '没有这个管理员']);

        if(_authcode($info['password']) != $post['password']) return json(['code' => 300, 'message' => '密码错误']);

        // 记录时间/ip
        Db::name('manage_user')->where('id', $info['id'])->update([
            'prev_login_at' => date('Y-m-d H:i:s'),
            'prev_login_ip' => $_SERVER['REMOTE_ADDR']
        ]);

        session('manage', $info);

        return json(['code' => 200, 'message' => '登录成功']);
        // 重定向跳转
//        $this->redirect('/admin');

    }

    public function logout()
    {
        session('manage', null);

        return $this->redirect('/admin');
//        return json(['code' => 200, 'message' => '退出成功']);
    }
}