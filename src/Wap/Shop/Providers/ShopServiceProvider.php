<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/28 0028
 * Time: 下午 1:50
 */
namespace Zqeesoom\LaravelShop\Wap\Shop\Providers;
//继承laravel服务提供者
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class ShopServiceProvider extends ServiceProvider
{

    //组件需要注入的中间件
   /* protected $routeMiddleware = [
        //微信登陆的路由中间件
        'wechat.oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class
    ];
    protected $middlewareGroups = [];*/

    // 这是命令的注册注册地点
    protected $commands = [
        \Zqeesoom\LaravelShop\Wap\Member\Console\Commands\InstallCommand::class
    ];

    //注册路由的中间件方法,这里的代码是从kernel.php定义了中间件的父类执行的代码复制过来
    /*protected function registerRouteMiddleware(){

        foreach ($this->middlewareGroups as $key => $middleware) {
            //D:\laravel\vendor\laravel\framework\src\Illuminate\Foundation\Application.php中有router定义类
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }*/

    //定义发布组件的配置文件的方法
    //执行命令：php artisan vendor:publish --provider="Zqeesoom\LaravelShop\Wap\Member\Providers\MemberServiceProvider"
    public function registerPublishing($value=''){
        //判断是否在命令行中运行
        if ($this->app->runningInConsole()) {
        //参数1.当前组件的配置文件路径=>复制到那个目录，3.标识
        //config_path（）里面不填参数，默认发布在config目录，发布配置文件名不会改变；
        //不带后缀就是一个文件夹，有后缀就是一个文件
           // $this->publishes([__DIR__.'/../Config'=> config_path('wap')],'laravel-shop-wap-member');
            //这里执行后会在laravel框架的config目录下生成wap/member.php

            //配置shop组件的静态资源assets目录下的JS,CSS,图片都放到根目录的public目录下的vendor/zqeesoom/laravel-wap-shop目录中
            $this->publishes(
                [__DIR__.'/../Resources/assets' => public_path('vendor/zqeesoom/laravel-wap-shop')],
                'laravel-shop-wap-shop' );
            //执行命令：php artisan vendor:publish --provider="Zqeesoom\LaravelShop\Wap\Shop\Providers\ShopServiceProvider"

        }
    }

    //先执行注册
    public function register()
    {
        //echo '这是一个Sjunit服务提供者';exit();
        //注册路由
        $this->registerRoutes();

        //怎么加载自定义的config配置文件,第二个参数是别名标识，这里加载之后，就到laravel框架了
        //在laravel，web.php路由 里测试。dd(config());
       // $this->mergeConfigFrom(__DIR__.'/../Config/member.php','wap.member');

        //可以通过在框架路由处，打印dd（app('view')）
        //第二个参数代表,该组件的名称，自定义的资源目录地址在那
        $this->loadViewsFrom( __DIR__.'/../Resources/views', 'wap.shop');

        //__DIR__.‘/../../’注意查找目录，是从当前服务的组件位置为锚点开始找。

        //调用自定义的中间件
       // $this->registerRouteMiddleware();

        //发布配置组件的文件
        $this->registerPublishing();
    }


    //加载配置文件，能够auth引用
    /*public function loadMemberAuthConfig(){
        //把wechat的配置文件组合起来
        config( Arr::dot ( config('wap.member.wechat',[]),'wechat.' ) );

        //调用laravel,dot方法，作用是把参数一的参数值，合并到指定的数组中,这里写了个空数组
        //[]作用是万一wap.member.auth值没有，可以传个空数组做默认。

        config( Arr::dot ( config('wap.member.auth',[]),'auth.' ) );

    }*/

    //最后执行
    public function boot()
    {
        //$this->loadMemberAuthConfig();

        //数据库表迁移
        $this->loadMigrations();

        //执行命令注册
        $this->commands($this->commands);
    }

    private function routeConfiguration()
    {
        return [
            //定义访问路由的域名
            // 'domain' => config('telescope.domain',null),
            //定义路由的命名空间
            'namespace' => 'Zqeesoom\LaravelShop\Wap\Shop\Http\Controllers',
            //这是路由前缀,自己定义
            'prefix' => 'wap/shop',
            //开启了web中间件,laravel的session就启动了
            'middleware'=> 'web'
        ];
    }
    private function registerRoutes()
    {
        //定义路由
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../Routes/shop.php');
        });//../这里路由可能会报错。
    }

    //定义数据库表迁移配置文件在那
    public function loadMigrations(){

        if($this->app->runningInConsole()) {// 判断是否在命令行中运行
            $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        }
    }


}