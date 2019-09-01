<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/1 0001
 * Time: 下午 10:57
 */
namespace Zqeesoom\LaravelShop\Wap\Shop\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}