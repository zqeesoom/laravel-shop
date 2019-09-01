<?php
return [
    'wechat'=>[
        'official_account' => [
            'default' => [
                'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'wx462f24cd2001100d'),
                'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'db0c310877465b8d1425b370dc208796'),
                'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'dFbzvsEHAAzE6PfTTrop'),

                /*
                 * OAuth 配置
                 *
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
                 */
                'oauth' => [
                    'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
                ],
            ],
        ]
    ],
    'auth'=>[
        //为了以后用，先定义
        'controller'=>Zqeesoom\LaravelShop\Wap\Member\Http\Controllers\AuthorizationsController::class,

        //定义守卫,用户权限校验方式为member
        'guard'=>'member',

        //传统方式是这样找变量，config('member')['guards']['member']，你喜欢这样吗，
        //在底层也是不是这样找的。
        //定义守卫组
        'guards' => [
            'member' => [
                'driver' => 'session',
                'provider' => 'member',
            ]
        ],
        'providers' => [
            'member' => [
                'driver' => 'eloquent',
                'model' => Zqeesoom\LaravelShop\Wap\Member\Models\User::class

            ],
        ],
    ]
];