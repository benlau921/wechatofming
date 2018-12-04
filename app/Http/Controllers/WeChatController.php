<?php

namespace App\Http\Controllers;

use Log;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Article;
use App\Library\CreateNewMenu;
use App\Library\CreateNews;
use EasyWeChat\Kernel\Messages\Raw;

class WeChatController extends Controller
{
    public function serve()
    {
        $app = app('wechat.official_account');
        $app->menu->delete(); // 全部
        $app->menu->create(CreateNewMenu::createMenu());
        Log::info('request arrived.');

        $app->server->push(function($message){
            switch ($message['MsgType']){
                case 'text':
                    switch ($message['Content']) {
                        case 'hello':
                            $userOpenID = $message['FromUserName'];
                            return $userOpenID;
                            break;
                        case 'hello2':
                            return $message['ToUserName'];
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
                            $news = createNews::createNews();
                            return $news;
                            break;

                        default:
                            return "hello Ben";
                            break;
                    }
                case 'image':
//                    $mediaID = "rpxllVIKNM1p1UjXqePh--y5JDli2zYp9_1SXhS-SJWxW_6VstYv85FvC_9hLxb9";
                    $mediaID  = $message['MediaId'];
                    $image = new Image($mediaID);
                    return $image;
                case 'event':
                    switch($message['EventKey']){
                        case 'items':
                            $news = createNews::createNews();
                            return $news;
                        case 'ben':
                            return "ben";
                    }

                default:
                    return
                        "Thank you for your subscription 1234567";
            }
        });

        return $app->server->serve();
    }
}


/*
 *
 *
 *                         case 'raw':
                            $mess = new Raw('<xml>
<ToUserName><![CDATA[oF2FF0TLLu_P2X0suR0X9iL63wBc]]></ToUserName>
<FromUserName><![CDATA[gh_0382299d76d0]]></FromUserName>
<CreateTime>1543481824</CreateTime>
<MsgType><![CDATA[ text ]]></MsgType>
<Image>
<MediaId><![CDATA[ hello ]]></MediaId>
</Image>
</xml>');

                        case 'user':
                            //return "Hello ".$user.". Thank you for your subscription";
                            return $user->get('nickname');


 * */