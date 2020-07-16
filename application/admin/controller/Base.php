<?php
namespace app\admin\controller;

use think\App;
use think\Controller;

class Base extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);

        $manage_user = session('manage');
        if (  empty( $manage_user )  ) {
            $this->redirect('/admin/login');
        }
    }

    protected function ajaxReturn($code, $msg, $data=[], $total=0)
    {
        $arr = [
            'code' => $code,
            'message' => $msg,
        ];

        if (!empty($data)) $arr['data'] = $data;
        if (!empty($total)) $arr['count'] = $total;

        return json($arr);
    }
}