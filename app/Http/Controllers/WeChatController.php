<?php

namespace App\Http\Controllers;

use Log;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Article;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;

class WeChatController extends Controller
{

    public function serve()
    {
        Log::info('request arrived.');
        $app = app('wechat.official_account');
        $app->server->push(function($message){
            // header('Content-Type: text/json');
            // print_r($message);
            switch ($message['MsgType']){
                case 'text':
                    switch ($message['Content']) {
                        case 'hello':
                            $userOpenID = $message['FromUserName'];
                            return "hello" . $userOpenID;
                            break;
                        case 'article':
                            $article = new Article([
                                'title'   => 'Ben Lau',
                                'author'  => 'Ben Lau',
                                'content' => '.. .......'
                            ]);
                            return $article;
                            break;
                        case 'items':
                        case 'Item':
                        $title = "ben";
                        $url = "http://www.orderlikepnv.com/";
                        $image = "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png";
                        $items = [
                            new NewsItem([
                                'title'       => $title,
                                'description' => '...',
                                'url'         => $url,
                                'image'       => $image,
                            ]),
                        ];
                        $news = new News($items);
                            break;

                        default:
                            return "hello Ben";
                            break;
                    }
                case 'image':
                    $mediaID = "rpxllVIKNM1p1UjXqePh--y5JDli2zYp9_1SXhS-SJWxW_6VstYv85FvC_9hLxb9";
                    $mediaID  = $message['MediaId'];
                    $image = new Image($mediaID);
                    return $image;
                default:
                    return "hello2";
            }
  //          return $image;
        });

        return $app->server->serve();
    }
}
