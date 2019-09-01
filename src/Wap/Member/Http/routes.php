<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/1 0001
 * Time: 下午 10:57
 */

//微信授权登陆的流程
Route::get('wechatStore','AuthorizationsController@wechatStore')->middleware('wechat.oauth');
//为什么使用这个middleware('wechat.oauth')中间件会陷入死循环
//wechat.oauthr把用户信息存在sessoion中
//laravel的session如何使用的问题

//laravel组件有个中间件，\Illuminate\Session\Middleware\StartSession::class,
//路径在：D:\laravel\vendor\laravel\framework\src\Illuminate\Session\Middleware\StartSession.php
//他的原理是用户请求执行完毕后，会话结束时，在存储cookie/session