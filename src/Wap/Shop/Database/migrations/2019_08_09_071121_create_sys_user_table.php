<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysUserTable extends Migration
{

    public function up()
    {
        Schema::create('sys_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nickname',90);
            $table->char('weixin_openid',90)->nullable();
            $table->string('image_head',255);
            $table->char('password',64)->nullable();
            $table->timestamps();
        });
    }

    //回滚
    public function down()
    {
       // Schema::dropIfExists('sys-user');
    }
}
