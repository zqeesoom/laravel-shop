<?php
namespace Zqeesoom\LaravelShop\Extend\Artisan;

use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{
    // 这是命令的注册注册地点
    protected $command = [
        Make\ClassMakeCommand::class,//php artisan shop-make:class 文件路径
        Make\ModelMakeCommand::class,//php artisan shop-make:model Data/Goods Goods
        Make\ControllerMakeCommand::class,//php artisan shop-make:controller Data/Goods Goods
        Make\MigrateMakeCommand::class,//php artisan shop-make:migration GoodsTable --path=Data\Goods
        //或者php artisan shop-make:model -m Data\Goods Goods 同时创建数据库迁移文件
        Make\SeederMakeCommand::class,//注册数据填充命令
        //创建Category模型的观察者
        Make\ObserverMakeCommand::class//php artisan shop-make:observer Data\Goods CategoryObserver --model=Category

    ];

    public function register()
    {
       // echo 1;exit;
        $this->commands($this->command);
    }

    public function boot()
    {
    }
}