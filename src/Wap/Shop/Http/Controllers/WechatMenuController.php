<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/3 0003
 * Time: 下午 12:57
 */

namespace Zqeesoom\LaravelShop\Wap\Shop\Http\Controllers;



//同级别不需要 USE 引入类
class WechatMenuController extends Controller
{


    //微信菜单
    public function index(){
        $buttons = [
            [
                "type" => "click",
                "name" => "今日歌曲",
                "key"  => "V1001_TODAY_MUSIC"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        return app('wechat.official_account')->menu->create($buttons);
    }
}