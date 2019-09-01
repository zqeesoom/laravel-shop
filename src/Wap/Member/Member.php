<?php
namespace Zqeesoom\LaravelShop\Wap\Member;
use Illuminate\Support\Facades\Auth;

class Member{

    public function guard(){
        //下面的三这种方法都可以
        //return Auth::guard(config('wap.member.guard'));
        //return Auth::guard(config('wap.member.auth.guard'));

       return Auth::guard('member');
    }

    //魔术方法封装（守卫），不用member::guard()->login($user);当我们这个调用了不存在的方法 就会执行
    public function __call($method, $arguments)
    {
       return $this->guard()->$method(...$arguments);
    }
}