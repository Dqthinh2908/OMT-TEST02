<?php
namespace app\model;

class Product
{
    public function getListProducts()
    {
        return[
            [
                'id'=>1,
                'name'=>'iPhone13',
                'price'=>2000
            ],
            [
                'id'=>3,
                'name'=>'iPhone12',
                'price'=>4000
            ],
            [
                'id'=>2,
                'name'=>'iPhone11',
                'price'=>5000
            ]

        ];
    }
}