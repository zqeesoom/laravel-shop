<?php

namespace Zqeesoom\LaravelShop\Extend\Artisan\Make;

use Illuminate\Console\GeneratorCommand as Command;
use Illuminate\Support\Str;

class ClassMakeCommand extends Command
{

    protected $signature = 'shop-make:class {name}';

    protected $type = 'class';//类型

    protected $description = '这是给laravel-shop创建类的';

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

    //重写父类，定义创建文件的模板
    protected function getStub(){
        return __DIR__.'/stubs/Class.stub';
    }

}
