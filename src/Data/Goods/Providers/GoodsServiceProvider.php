<?php

namespace Zqeesoom\LaravelShop\Data\Goods\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;

//原始的方法用这个调用分类模型的观察者
//use Zqeesoom\LaravelShop\Data\Goods\Observers\CategoryObserver;
//use Zqeesoom\LaravelShop\Data\Goods\Models\Category;

//用老师的组件的方法调用
use Zqeesoom\LaravelShop\Data\Goods\Models\Model;


class GoodsServiceProvider extends ServiceProvider{

    public function register()
    {


        $this->mergeConfigFrom(__DIR__.'/../Config/goods.php','data.goods');
    }

    public function boot()
    {
        //数据库表迁移
        $this->loadMigrations();

        //加载配置文件
        $this->loadMemberAuthConfig();

        // 观察者注册事件监听
        // Illuminate\Database\Eloquent\Concerns\HasEvents::observe();

        // 所有注册的事件绑定 Illuminate\Events\Dispatcher 中的 $listeners属性

        // 查找并执行
        // Illuminate\Database\Eloquent\Concerns\HasEvents::fireModelEvent();

        // 监听分类模型的观察者
        //Category::observe(CategoryObserver::class);
        //再用一个用户表的观察者
        //Category::observe(UserObserver::class);

        //另外一种办法批量注册观察者，通过配置文件来，监听分类模型的观察者
        Model::observes();
    }

    //定义数据库表迁移配置文件在那
    public function loadMigrations(){
        if($this->app->runningInConsole()) {// 判断是否在命令行中运行
            $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
            //php artisan migrate 执行迁移
        }
    }


    //加载配置文件，能够auth引用
    public function loadMemberAuthConfig(){
        //根据框架database.php默认连接的MYSQL配置信息。放到容器标识'goods'配置文件中
        config(
            Arr::dot(
                config('database.connections.'.config('data.goods.database.connection.type'), []),
                'database.connections.'.config('data.goods.database.connection.name').'.')
        );

        // 再把放到容器标识‘goods’配置信息，用当前goods组件的配置信息变量覆盖
        config(
            Arr::dot(
                config('data.goods.database.'.config('data.goods.database.connection.name'), []),
                'database.connections.'.config('data.goods.database.connection.name').'.')
        );

    }

}