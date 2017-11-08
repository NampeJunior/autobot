<?php

require_once('./vender/autoload.php');

use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token ='msQsghyzl7h5itNPKVJaobxU3BKL2yEOkUFL+WC/dQmYISGLOtzKvzWNBIoHiBtObbxUDe95yMQz8+3mNGWl0+CIxTjE/mkd6Ud0JjOk6DKLpSPsxbgOGQXNYhU5GSEXHy9LfH+nRF18VumdRSVQGgdB04t89/1O/w1cDnyilFU=';
$channel_secret = '6adcacc946099aae5bea724df661d102';

// Get message from Line API
$content = file_get_contents('php://input');

$events = json_decode($content, true);

if (!is_null($events['events'])) {
	// Loop through each event foreach ($events['events'] as $event
	foreach ($events['events'] as $event) { 

	// Line API send a lot of event type, we interested in message only.
		if ($event['type'] == 'message') {

			switch($event['message']['type'])

				 { case 'text': // Get

				 //Get replyToken
				 $replyToken = $event['replyToken'];

				 // Reply message
				 $respMessage = 'Hello, your message is '. $event['message']['text'];

				 $httpClient = new CurlHTTPClient($channel_token);

				 $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

				 $textMessageBuilder = new TextMessageBuilder($respMessage);

				 $response = $bot->replyMessage($replyToken, $textMessageBuilder);

				 break;
				}
			}
		}
	}

	echo "OK";

?>
