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
    public function createMenu(){
        $buttons = [
        [
        "type" => "click",
        "name" => "今日歌曲",
        "key"  => "items"
        ],
        [
        "name"       => "菜单",
        "sub_button" => [
        [
        "type" => "view",
        "name" => "搜索",
        "url"  => "http://www.soso.com/"
        ],
        [
        "type" => "view",
        "name" => "视频",
        "url"  => "http://v.qq.com/"
        ],
        [
        "type" => "click",
        "name" => "benlau921",
        "key" => "ben"
        ],
        ],
        ],
        ];
        return $buttons;
    }
}