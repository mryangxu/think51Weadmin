<?php

Route::group('admin', function(){
    // 规则
    Route::group('rule', function() {
        Route::post('lists', 'admin/Rule/lists'); // 列表
        Route::post('edit', 'admin/Rule/edit'); // 编辑
        Route::post('del', 'admin/Rule/del'); // 编辑
    });
    // 角色
    Route::group('role', function() {
        Route::post('lists', 'admin/Role/lists'); // 列表
        Route::post('edit', 'admin/Role/edit'); // 编辑
        Route::post('del', 'admin/Role/del'); // 编辑
    });
    // 名片
    Route::group('business_card', function() {
        Route::post('lists', 'admin/BusinessCard/lists'); // 列表
        Route::post('edit', 'admin/BusinessCard/edit'); // 编辑
        Route::post('del', 'admin/BusinessCard/del'); // 删除
        Route::post('up_defaults', 'admin/BusinessCard/up_defaults'); # 修改默认背景
    });

    // 系统
    Route::group('system', function() {
        Route::post('uploads', 'admin/System/uploads'); # 图片文件
    });

});

