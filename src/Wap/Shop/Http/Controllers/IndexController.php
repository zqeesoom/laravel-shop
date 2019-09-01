<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/21 0021
 * Time: 下午 7:37
 */
namespace Zqeesoom\LaravelShop\Wap\Shop\Http\Controllers;





class IndexController extends Controller
{

    public function index() {


        return view('wap.shop::index.index');
    }
}