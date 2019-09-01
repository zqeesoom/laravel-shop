<?php

namespace Zqeesoom\LaravelShop\Wap\Member\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    //执行命令输入参数  以{name}接收
    //protected $signature = 'wap-member:install {name}';

    protected $signature = 'wap-member:install';
    protected $description = '微信会员授权组件';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
       // echo '这个是测试wap-member安装的命令';
       // echo '接收的参数是:'.$this->argument('name');

        //执行数据库迁移
        $this->call('migrate');

        //执行组件配置文件加载到laravel
        $this->call('vendor:publish',[
            '--provider'=>'Zqeesoom\LaravelShop\Wap\Member\Providers\MemberServiceProvider'
        ]);

    }
}
