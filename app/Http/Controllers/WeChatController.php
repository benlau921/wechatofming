<?php

namespace App\Http\Controllers;

use Log;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages;
use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\Image;
use EasyWeChat\Kernel\Messages\Article;
// use App\Library\CreateNewMenu;
// use App\Library\CreateNews;
use EasyWeChat\Kernel\Messages\NewsItem;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\Raw;

class WeChatController extends Controller {
	public function serve() {
		$app = app("wechat.official_account");
		
		// $app->menu->delete();
		$app->menu->create([
	    [ 
	    	"name" => "Keying", 
	    	"sub_button" => [
	      	[ "type" => "click", "name" => "Key B", "key" => "jrn-process-b" ],
	      	[ "type" => "click", "name" => "Key D", "key" => "jrn-process-d" ],
	      	[ "type" => "click", "name" => "Key E", "key" => "jrn-process-e" ],
	      	[ "type" => "click", "name" => "Key F", "key" => "jrn-process-f" ],
	      ],
	    ],
	    [ 
	    	"name" => "Linking",
	    	"sub_button" => [
	      	[ "type" => "view", "name" => "Link B", "url"  => "http://www.orderlikepnv.com/wp-external/journaling.php?process=b" ],
	      	[ "type" => "view", "name" => "Link D", "url"  => "http://www.orderlikepnv.com/wp-external/journaling.php?process=d" ],
	      	[ "type" => "view", "name" => "Link E", "url"  => "http://www.orderlikepnv.com/wp-external/journaling.php?process=e" ],
	      	[ "type" => "view", "name" => "Link F", "url"  => "http://www.orderlikepnv.com/wp-external/journaling.php?process=f" ],
	      ],
	    ],
	    [ 
	    	"name" => "Others",
	    	"sub_button" => [
	      	[ "type" => "click", "name" => "Orderlike", "key" => "orderlike" ],
	      	[ "type" => "pic_sysphoto", "name" => "Take a photo", "key" => "take-a-photo" ],
	      ],
	    ],
	  ]);

		Log::info("request arrived.");

		$app->server->push(function($message) {
			if ( $message["MsgType"] == "text" ) {
				switch ( strtolower($message["Content"]) ) {
					case "hello":
					case "from":
						$fromUserName = $message["FromUserName"];
						return $fromUserName;

					case "halo":
					case "hello2":
					case "whom":
						$toUserName = $message["ToUserName"];
						return $toUserName;

					case "article":
						$article = new Article([
							"title"   => "Ben Lau",
							"author"  => "Ben Lau",
							"content" => ".. ......."
						]);
						return $article;
						
          case "raw":
						$fromUserName = $message["FromUserName"];
						$toUserName = $message["ToUserName"];
          	return new Raw(
							'{"touser":"'.$fromUserName.'","msgtype":"text","text":{"content":"Hello World"}}'
						);

					case "user":
						return new Text(json_encode($user));
						// return $user->get("nickname");

					case "item":
					case "items":
						return new News([
							new NewsItem([
								"title" => "OrderlikePnV",
								"description" => "OrderlikePnV",
								"url" => "http://www.orderlikepnv.com",
								"image" => "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png",
							])
        		]);

					case "json":
					default:
						return json_encode($message);
				}
			}
			
			if ( $message["MsgType"] == "image" ) {
				// $mediaId = "rpxllVIKNM1p1UjXqePh--y5JDli2zYp9_1SXhS-SJWxW_6VstYv85FvC_9hLxb9";
				$mediaId  = $message["MediaId"];
				$image = new Image($mediaId);
				return $image;
			}

			if ( $message["MsgType"] == "event" ) {
				switch ( $message["EventKey"] ) {
					case "items":
					case "orderlike":
					case "jrn-process-a":
					case "jrn-process-b":
						return "<a href = \"http://www.orderlikepnv.com/wp-external/wechat-show-jrn.php?ref=300015&jrntax=process-selfiemov-borrow\">Journal B</a>"."diu nei";
						break;
					case "jrn-process-c":
					case "jrn-process-d":
					case "jrn-process-e":
					case "jrn-process-f":
					case "jrn-process-g":
						$fromUserName = $message["FromUserName"];
						$toUserName = $message["ToUserName"];
						
						return new News([
							new NewsItem([
								"title" => "OrderlikePnV",
								"description" => "OrderlikePnV",
								"url" => "http://www.orderlikepnv.com",
								"image" => "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png",
							]),
							new NewsItem([
								"title" => "Link D",
								"description" => "OrderlikePnV",
								"url" => "http://www.orderlikepnv.com/wp-external/journaling.php?process=d&wechatid=".$fromUserName,
								"image" => "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png",
							]),
							new NewsItem([
								"title" => "Link E",
								"description" => "OrderlikePnV",
								"url" => "http://www.orderlikepnv.com/wp-external/journaling.php?process=e&wechatid=".$fromUserName,
								"image" => "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png",
							]),
							new NewsItem([
								"title" => "Link F",
								"description" => "OrderlikePnV",
								"url" => "http://www.orderlikepnv.com/wp-external/journaling.php?process=f&wechatid=".$fromUserName,
								"image" => "http://www.orderlikepnv.com/wp-content/uploads/2017/06/transparent-background-Orderlike-black1.png",
							])
        		]);

					case "ben":
					default:
						return json_encode($message);
				}
			}
			
			// default
			return json_encode($message);
		});
		
		return $app->server->serve();
	}
}
?>
