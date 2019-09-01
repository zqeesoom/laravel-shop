<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/23 0023
 * Time: 下午 7:52
 */
namespace Zqeesoom\LaravelShop\Extend\Artisan\Make;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

//定义超类
trait GeneratorCommand{

    //定义组件包的地址返回到起始位置src下
    Protected $packagePath = __DIR__.'/../../..';

    //重写命名空间
    protected function rootNamespace(){
        return "Zqeesoom\LaravelShop";
    }

    //重写getPath定义保存那里去
    protected function getPath($name)
    {
        // 进行命名空间的完善 自动添加前
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        //如：php artisan shop-make:class Class\oo；$name是输入的参数=Class\oo

        return  $this->packagePath.'/'.str_replace('\\', '/', $name).'.php';
    }

    //重写解决控制器生成的use Zqeesoom\LaravelShopHttp\Controllers\Controller;问题
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), $this->rootNamespace().'\\'.$this->getPackageInput().'\\', $this->userProviderModel()],
            $stub
        );
        return $this;
    }

    //定义控制台参个数
    protected function getArguments(){
        return [
            // 定义参数顺序php artisan shop-make:controller Data\Goods GoodsController
            ['package',InputArgument::REQUIRED,''], //package = Data\Goods\
            ['name',InputArgument::REQUIRED,'']// name = GoodsController2
        ];
    }

    //获取控制台package参数,斜杠是/还是\个有点分不清。所以要处理一下
    protected function getPackageInput(){
        // return trim($this->argument('package'));
        return  str_replace('/', '\\', trim($this->argument('package')));
    }

    //根据命名空间指定创建文件的地址
    protected function getDefaultNamespace($rootNamespace) {
        //return $rootNamespace.'\Http\Controllers';定义这个就跑偏了
        //var_dump($this->getPackageInput());\\Data\Goods\

        //return $rootNamespace;
        //这定义是正常的是在直接写长路径支持命令： php artisan shop-make:controller Data\Goods\Http\Controllers\GoodsController

        return $rootNamespace.'\\'.$this->getPackageInput().$this->defaultNamespace;
    }

}