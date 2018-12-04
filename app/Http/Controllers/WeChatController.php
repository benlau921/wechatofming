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

        //$menu = new CreateNewMenu();

        $app->menu->delete(); // 全部

        $app->menu->create(CreateNewMenu::createMenu());
        //$rawxml = "'<xml><ToUserName><![CDATA[ oF2FF0TLLu_P2X0suR0X9iL63wBc ]]></ToUserName><FromUserName><![CDATA[ gh_0382299d76d0 ]]></FromUserName><MsgType><![CDATA[ text ]]></MsgType><Content><![CDATA[ hello world ]]></Content></xml>'";

        Log::info('request arrived.');

        $app->server->push(function($message){
        /*
            $matchRule = [
                "tag_id" => "2",
                "sex" => "1",
                "country" => "中国",
                "province" => "广东",
                "city" => "广州",
                "client_platform_type" => "2",
                "language" => "zh_CN",
                "user" => $message['FromUserName']
            ];

            $app->menu->create(CreateNewMenu::createMenu(), $matchRule);
         */
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
                        case 'raw':
                            $mess = new Raw('<xml>
<ToUserName><![CDATA[oF2FF0TLLu_P2X0suR0X9iL63wBc]]></ToUserName>
<FromUserName><![CDATA[gh_0382299d76d0]]></FromUserName>
<CreateTime>1543481824</CreateTime>
<MsgType><![CDATA[ text ]]></MsgType>
<Image>
<MediaId><![CDATA[ hello ]]></MediaId>
</Image>
</xml>');

                            return $mess;
                            break;
                        case 'user':
                            //return "Hello ".$user.". Thank you for your subscription";
                            return $user->get('nickname');
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
