<?php
return [
    'database' => [
        //批量定义模型的观察者
        'observes'=>[
            'Category' =>'CategoryObserver',
            'User'=>'GoodsObserver'
        ],
        //这是goods组件的默认连接属性
        'connection'=>[
            'name'=>'goods',
            //这个是定义数据库类型
            'type'=>'mysql',//可能会改变oracle,sqlserver
        ],

        //这是连接属性
        'goods'=>[
            'prefix'=>'data_',
           //'host'=>'192.0.0.1' 数据库连接用框架默认的。如果想跨库查询打开这个
        ]
    ]
];