<?php

namespace Zqeesoom\LaravelShop\Data\Goods\Models;

use Illuminate\Database\Eloquent\Model as  laravelModel;
//引入超类，重写了事件修改，删除的观察者。以便在模型批量update和delete操作时，观察者能够监听
use ShineYork\LaravelExtend\Database\Eloquent\SEvents;


class Model extends laravelModel
{
    use SEvents;
    public function __construct(array $attributes = []) {

        //使用组件的配置信息，配置信息可以配置前缀，数据库连接方式类型等等，跨库查询也可以用。
        $this->setConnection(config('data.goods.database.connection.name'));
        parent::__construct( $attributes);

    }
}


