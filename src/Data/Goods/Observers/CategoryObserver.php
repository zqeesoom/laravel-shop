<?php

namespace Zqeesoom\LaravelShop\Data\Goods\Observers;

use Zqeesoom\LaravelShop\Data\Goods\Models\Category;

class CategoryObserver
{

    //ed结尾均是在动作发生之后执行的
    public function created(Category $category)
    {
        //
    }

    // ing结尾均是在动作发生之前执行的
    //添加一个分类，用户不会自己添加paht路径吧，要观察者监听来操作
    public function creating  (Category $category)
    {
        //模型创建之后，触发creating 报错了Trying to get property of non-object
        // dd(1);
        //如果创建的是一个根类目
        if(is_null($category->pid) || $category->pid == 0){
            //将层级设为0
            $category->level=0;
            //将path设为-
            $category->path = '-';
        }else{
            //将层级设为父类目的层级+1
            $category->level = $category->parent->level+1;
            //将path值设为父类目的path 追加父类目ID以及最后跟上一个-分隔符
            $category->path =$category->parent->path.$category->pid.'-';
        }
    }

    public function updated(Category $category)
    {
        //
    }

    public function updating (Category $category){

        dd($category);
       dd('updating');
    }


    public function deleted(Category $category)
    {
        //
    }


    public function restored(Category $category)
    {
        //
    }


    public function forceDeleted(Category $category)
    {
        //
    }
}
