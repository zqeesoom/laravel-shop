<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/1 0001
 * Time: 下午 10:57
 */

//定义路由添加微信公众号菜单
Route::get('/wechat-menu','WechatMenuController@index');


Route::get('/','IndexController@index',function(){

    //打印配置静态资源有没有配置对
   // return dd(app('view')->getFinder()->getHints());

    //访问静态资源，结果是http://zqeesoom.natapp1.cc/js/app.js
    //return asset('js/app.js');

    //测试助手函数
    return shop_asset('js/app.js');
});

//注意：上面的写法是错的，get方法只接收两个参数 ，第三个参数是不会执行，但也不会报错