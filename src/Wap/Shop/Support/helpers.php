<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/22 0022
 * Time: 下午 8:44
 */

//因为定义静态路径太长，'{{asset('vendor/shineyork/laravel-wap-shop/js/jquery.js')}}'，能
//不能省事呢?下面的方法就是省事的。
if (! function_exists('shop_asset')) {
    /**
     * Generate an shop_asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function shop_asset($path, $secure = null)
    {
        $path = "vendor/zqeesoom/laravel-wap-shop/". $path;
        return asset($path, $secure);
    }
}