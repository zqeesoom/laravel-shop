<?php
namespace Zqeesoom\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;
use Illuminate\Support\Str;

class ModelMakeCommand extends Commad{

    use GeneratorCommand;
    //是写用官方框架的model写法，不是按ClassMakeCommand.php定义
    //protected $signature = 'shop-make:class {name}';

    protected $name = 'shop-make:model';

    protected $defaultNamespace = '\Models';

    //protected $description = '这是给laravel-shop创建model类的';

    //重写父类，定义创建文件的模板 不需要重写模板了。
   /* protected function getStub(){
        return __DIR__.'/stubs/Class.stub';
    }*/

    //定义命名空间，根据命名空间指定创建文件的地址,不能放在超类，那怎么放在超类里面呢？在定义一个变量$DefaultNamespace
    /*protected function getDefaultNamespace($rootNamespace) {
        //return $rootNamespace.'\Http\Controllers';定义这个就跑偏了
        //var_dump($this->getPackageInput());\\Data\Goods\

        //return $rootNamespace;
        //这定义是正常的是在直接写长路径支持命令： php artisan shop-make:controller Data\Goods\Http\Controllers\GoodsController

        return $rootNamespace.'\\'.$this->getPackageInput().'\Models';
    }*/

    //重写父类getOptions方法调中的createMigration方法,-m 触发。laravel框架本身就有-m功能，这里只不过改一下创建迁移文的路径
    protected function createMigration()
    {
        // var_dump('create--mi');
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('shop-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => $this->getPackageInput() //获取输入命令的参数比如Data\Googs
        ]);
    }
}