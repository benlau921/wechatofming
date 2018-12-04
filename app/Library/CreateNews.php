<?php
/**
 * Created by PhpStorm.
 * User: benlau
 * Date: 11/28/2018
 * Time: 3:23 PM
 */

namespace App\Library;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\News;


class CreateNews
{
    public static function createNews(){
        $title = "ben";
        $url = "http://www.orderlikepnv.com/";
        $image = "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png";
        $items = [
            new NewsItem([
                'title'       => $title,
                'description' => 'halo halo',
                'url'         => $url,
                'image'       => $image,
            ]),
            new NewsItem([
                'title'       => $title,
                'description' => 'Thanks for your attention',
                'url'         => $url,
                'image'       => $image,
            ]),
            new NewsItem([
                'title'       => $title,
                'description' => 'Love you and see you.',
                'url'         => $url,
                'image'       => $image,
            ])

        ];
        $news = new News($items);
        return $news;
    }
}