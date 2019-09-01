<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/23 0023
 * Time: 下午 7:52
 */
namespace Zqeesoom\LaravelShop\Extend\Artisan\Make;

use Illuminate\Routing\Console\ControllerMakeCommand as Commad;


class ControllerMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'shop-make:controller';

    protected $defaultNamespace = '\Http\Controllers';

    //定义命令空间,不能放在超类,那怎么放在超类，定义DefaultNamespacef放在超类
   /* protected function getDefaultNamespace($rootNamespace) {
        //return $rootNamespace.'\Http\Controllers';定义这个就跑偏了
        //var_dump($this->getPackageInput());\\Data\Goods\

        //return $rootNamespace;
        //这定义是正常的是在直接写长路径支持命令： php artisan shop-make:controller Data\Goods\Http\Controllers\GoodsController

        return $rootNamespace.'\\'.$this->getPackageInput().'\Http\Controllers';
    }*/

}