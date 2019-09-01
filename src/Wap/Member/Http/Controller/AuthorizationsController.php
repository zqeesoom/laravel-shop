<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/3 0003
 * Time: 下午 12:57
 */

namespace Zqeesoom\LaravelShop\Wap\Member\Http\Controllers;

use Illuminate\Http\Request;
use Zqeesoom\LaravelShop\Wap\Member\Models\User;
use Zqeesoom\LaravelShop\Wap\Member\Facades\Member;



class AuthorizationsController extends Controller
{


    //微信授权登陆的流程
    public function wechatStore(Request $request){

        $wechatUser = session('wechat.oauth_user.default'); // 拿到授权用户资料

        $user = User::where("weixin_openid",$wechatUser->id)->first();

        if (!$user) {
        //用户不存在，记录信息
            $user = User::create([
                'nickname' =>$wechatUser->name,
                'weixin_openid' =>$wechatUser->id,
                'image_head' =>$wechatUser->avatar
            ]);

        }

        //改变用户的状态设置为登入,1.怎么操作，2.我们的路由中间件
        //wechat.oauth定义到laravel的kernel.php文件中的。怎么迁移中间件定义到组件来。3.
       //怎么定义组到的中间件的标识名; 我们看到kernel.php定义了中间件，是在父类执行的，把父类执
      //  行的代码，放到组件的服务提供者那里复制粘贴代码，这样就可以注册组件的路由中间件。
       //这里是使用laravel框架config/auth.php中的定义的守卫
        // Auth::login($user);

         //这里是引用组件中定义的守卫
        // 这个可以用，但是我们封装了门面类Member，以后不用Auth::guard('member')每次写标识
        //Auth::guard('member')->login($user);

        //用我们封装了门面类Member，但是这个有个问题总是写 Member::guard()麻烦，又升级成魔术方法调用
        //Member::guard()->login($user);

        //魔术方法调用
         Member::login($user);

        //校验是不是登陆
       /* if(Auth::check()) //。为什么我这里检验用户，显示的false呢

             return '通过';
        else
            return 'NO';*/

        //具体用哪个守卫进行登录  就要用哪个守卫去检查登录状态
       /* if(Auth::guard('member')->check())
            return '通过';
        else
            return 'NO';*/
        /*if(Member::guard()->check())
            return '通过';
        else
            return 'NO';*/
        //又升级版魔术方法调用
        if(Member::check())
            return '通过';
        else
            return 'NO';


       // return redirect()->route('wap.member.index');
    }
}