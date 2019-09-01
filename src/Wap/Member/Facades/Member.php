<?php
namespace Zqeesoom\LaravelShop\Wap\Member\Facades;

use Illuminate\Support\Facades\Facade;

class Member extends Facade
{
    protected static function getFacadeAccessor(){
        return  \Zqeesoom\LaravelShop\Wap\Member\Member::class;
    }

   /* static function guard(){

        return  \Zqeesoom\LaravelShop\Wap\Member\Member::class;
    }*/
}