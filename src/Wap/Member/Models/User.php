<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/8/1 0001
 * Time: 下午 10:54
 */
namespace Zqeesoom\LaravelShop\Wap\Member\Models;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    protected $table = 'sys_user';

    //定义表的字段
    protected $fillable = ['nickname','weixin_openid','image_head'];
}
