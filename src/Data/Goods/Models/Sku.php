<?php

namespace Zqeesoom\LaravelShop\Data\Goods\Models;



class Sku extends Model
{
    //创那id时，用商品ID+属性ID拼接起来
    public function buildId($ids = [])
    {
        // xxx 规则

        return '';
    }
}
