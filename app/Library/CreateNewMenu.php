<?php
/**
 * Created by PhpStorm.
 * User: benlau
 * Date: 11/28/2018
 * Time: 2:30 PM
 */

namespace App\Library;


class CreateNewMenu
{
    public static function createMenu(){
        $buttons = [
            [
                "type" => "click",
                "name" => "Orderlike",
                "key"  => "items"
            ],
            [
                "name"       => "Testing",
                "sub_button" => [
                    [
                    "type" => "view",
                    "name" => "Order",
                    "url"  => "http://www.soso.com/"
                    ],
                    [
                    "type" => "view",
                    "name" => "What",
                    "url"  => "http://v.qq.com/"
                    ],
                    [
                    "type" => "click",
                    "name" => "benlau921",
                    "key" => "ben"
                    ],
                    [
                    "type" => "pic_sysphoto",
                    "name" => "Take a photo",
                    "key" => "ben"
                    ],
                ],
            ],
        ];
        return $buttons;
    }
}