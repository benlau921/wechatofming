<?php

namespace App\Http\Controllers;

use Log;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Article;


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
                    switch ($message('content')) {
                        case 'hello':
                            $userOpenID = $message['FromUserName'];
                            return "hello" . $userOpenID;
                            break;
                        case 'article':
                            $article = new Article([
                                'title'   => 'Ben Lau',
                                'author'  => 'Ben Lau',
                                'content' => '.. .......',
                            ]);
                            return $article;
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
