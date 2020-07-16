<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::post('industry/lists', 'index/Index/industry'); // 行业列表
Route::post('business_card/lists', 'index/Index/business_card'); // 名片列表
Route::post('business_card/detail', 'index/Index/card_detail'); // 名片详情
Route::post('leaving_message', 'index/Index/leaving_message'); // 留言
Route::post('introduce', 'index/Index/introduce'); // 商会详情
Route::post('putVisit', 'index/Index/putVisit'); // 商会详情


return [

];
