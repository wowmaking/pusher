
# Pusher

PHP library for push-notification service


# Installation

To install run:
```
    composer require "wowmaking/pusher"
```
Or add this line to  _require_  section of composer.json:
```
    "wowmaking/pusher": "dev-master"
```
## Usage
Initial:

    <?php 
    
    use Wow\Pusher;
    
    //project key
    $key = "fae5004db602b860844bc1fd6e566538d971ceead03e14d1e29dad31592246a5";
    $host = "http://localhost"; //optional parameter
    
    $push = new Pusher($key,$host);
Add new user:

    //add new user
    $push->addToken("EMAWf6FJzZAhEKLus23hYXbhdEA1voK7O0kx3XERUnQr85ZB6SPaChZAKwi89eWbwx2wE1ZCh99HQ5MXZAegLNQcIAhcyttmylUA1NTn0JZBwSDsoFiktZBSxAzpA9pfDcrudTZCNeZCzkZCyxOWNKE74gW20WhMJnrCleAZD","user_id_1","+03:00","en-GB"));



Send message:
    
    //send push message
    $params = [
	    "notification"=>[
		    "sound"=>"default"
		    //see other fields for "notification" parameter on https://firebase.google.com/docs/cloud-messaging/admin/send-messages
	    ],
	    "variables"=>[
		    "count"=>100
	    ],
	    "additional_params"=>[
		    //can be additional params: topic, condition ... (https://firebase.google.com/docs/cloud-messaging/admin/send-messages)
	    ]
    ];
    $push->sendMessage("code.message.cat","user_id_1",$params);

Send message to users:
    
    //send push messages to users
    $users = [
	    [
		    "user_id"=>"user_id_1",
		    "params"=>[
			    "variables"=>[
				    "count"=>200
			    ]
		    ]
	    ],
	    [
		    "user_id"=>"user_id_2",
		    "params"=>[
			    "variables"=>[
				    "count"=>150
			    ]
		    ]
	    ]
    ];
    $push->sendMessages("code.message.cat",$users);
    
Remove tokens by user:
    
    $push->removeUser("user_id");
    
Remove token:
    
    $push->removeToken("EMAWf6FJzZAhEKLus23hYXbhdEA1voK7O0kx3XERUnQr85ZB6SPaChZAKwi89eWbwx2wE1ZCh99HQ5MXZAegLNQcIAhcyttmylUA1NTn0JZBwSDsoFiktZBSxAzpA9pfDcrudTZCNeZCzkZCyxOWNKE74gW20WhMJnrCleAZD");