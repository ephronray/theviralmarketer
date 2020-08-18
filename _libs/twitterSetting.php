<?php 

require_once (__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/twitterApi/Twitterapi.php');

class TwitterSetting 
{
	private $db;
	private $commonHelper;
	private $twitter;
	private $consumerKey = "pnNkATXHOgwHt9EAwzaZrENN6";
	private $consumerSecretKey = "fVrkfRlBJDz6q40TWL4ZOnBc1ZDqlJPfz2KkQkKaaxbg0YFuPR";
	private $tokenAccessKey = "19438656-Af2zYaBwlZsJlf0DmaPOuyK7Nr37JYeWaLJBnEXQO"; 
	private $tokenSecretKey = "2OTth9KKlN841TJ63HFbie1V5hGLHVtYIFAFBkHjcdFjy";
	
	
	public function __construct()  
	{  
		$this->db = new dbConnect();
		$this->commonHelper = new CommonHepler();
		$this->twitter = new TwitterAPI($this->consumerKey, $this->consumerSecretKey);
		
	}
	
	public function oauth(){
		//redirect($this->twitter->login_url());
		return $this->twitter->login_url();
	}
	

	function saveNewTwitterAccount() {
		
		$access_token = (object)$this->twitter->get_access_token();
		$this->twitter->getConnectionWithAccessToken($access_token);
		$data_tw = $this->twitter->get_request('users/show',['screen_name'=> $access_token->screen_name]);
        //get list-data
        $createdListDetail =  $this->twitter->newListCreate();
       $createdListDetail = array('id'=> $createdListDetail->id,
	   'name'=>$createdListDetail->name , 'uri'=>$createdListDetail->uri, 'slug'=>$createdListDetail->slug);
	   
	   //get followed list data
	     $createdFollowedListDetail =  $this->twitter->newFollowListCreate();
	   	 $createdFollowedListDetail = array('id'=> $createdFollowedListDetail->id ,
	   'name'=>$createdFollowedListDetail->name , 'uri'=>$createdFollowedListDetail->uri, 'slug'=>$createdFollowedListDetail->slug);
	   


		$data_profile = array(
			"followers_count" => (isset($data_tw->followers_count))?$data_tw->followers_count:"",
			"friends_count"   => (isset($data_tw->friends_count))?$data_tw->friends_count:"",
			"statuses_count"  => (isset($data_tw->statuses_count))?$data_tw->statuses_count:"",
			"name"            => (isset($data_tw->name))?$data_tw->name:"",
			"following"       => (isset($data_tw->following))?$data_tw->following:""
		);

		// get data
		if($access_token->user_id == null || $access_token->user_id  == "") {
		unset($_SESSION["twitter_oauth_token"]);
		unset($_SESSION["twitter_oauth_token_secret"]);
		return;
		}
		
		$data = array(
			"uid"             => $_SESSION['user']["u_id"],
			"pid"             => $access_token->user_id,
			"screen_name"     => $access_token->screen_name,
			"avatar"          => (isset($data_tw->profile_image_url_https))?$data_tw->profile_image_url_https:"",
			"access_token"    => json_encode($access_token),
			"created"         => date("Y-m-d h:i:sa"),
			"status"          => 1,
			"data_profile"    => json_encode($data_profile),
			"list_data" => json_encode($createdListDetail),
			"followed_list_data" => json_encode($createdFollowedListDetail)
		);
		if($data["pid"] !== null || $data["pid"] !== "" )
		$response = $this->db->addTweeterAccounts($data);
		if($response['success']==1) {
		    header("Location: viral-tweets/viral-tweet-services.php?id=".$response['id']);
		}
		
	}
	
	function refreshTwitterAccount($id , $isRedirect=true) {
	    
	      $account_item =  $this->getSingleAccountDetail($id);
	      if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $access_token=json_decode($account_item['access_token']);
	   
	   $data_tw = $this->twitter->get_request('users/show',['screen_name'=> $access_token->screen_name]);
	   
	    
	      if(isset($data_tw->errors[0])){
				return array(
	            	"status"      => "error",
	            	"message"     => $data_tw->errors[0]->message,
	            );
			}
			
			$data_profile = array(
			"followers_count" => (isset($data_tw->followers_count))?$data_tw->followers_count:"",
			"friends_count"   => (isset($data_tw->friends_count))?$data_tw->friends_count:"",
			"statuses_count"  => (isset($data_tw->statuses_count))?$data_tw->statuses_count:"",
			"name"            => (isset($data_tw->name))?$data_tw->name:""
			);
			
			$data = array(
				"avatar"       => (isset($data_tw->profile_image_url_https))?$data_tw->profile_image_url_https:"",
				"data_profile" => json_encode($data_profile),
			    
			);
			if(!empty($data_profile)) { 
			    
			  $response =  $this->db->updateTwitterAccount($data , $id);
			    	if($response['success']==1 && $isRedirect == true) {
			    	    
		    header("Location: /../viral-tweets/viral-tweet.php");
		}
			}
			
			
	          
	      }
	    
	}
	
	
	function searchTweets($data) {
	    $keywords = $data['keywords'];
	     $account_item =  $this->getSingleAccountDetail($data['id']);
	      if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $access_token=json_decode($account_item['access_token']);
	   $data_tw = $this->twitter->get_request('search/tweets',['q'=> $keywords,'count'=> 100,'result_type' => 'recent', 'include_entities'=>true]);
	      if(isset($data_tw->errors[0])){
				return array(
	            	"status"      => "error",
	            	"message"     => $data_tw->errors[0]->message,
	            );
			}
			if(is_array($data_tw->statuses)){
			    return $data_tw->statuses;
			}
			
	      }
	    
	}
	
	
	
	function getAccountDetails() {
	   return $this->db->getTweeterAccountDetails();
	   
	   
	}
	
	function getFollowersByUsersOrTags($data) {
	    $account_item =  $this->getSingleAccountDetail($data['accountId']);
	   if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	    if($data['type'] == "username") {
	        $followerstwitterAccounts = [];
	        $users = [];
	       $allUserNames = explode(",",$data['usernames']);
	       foreach ($allUserNames as $key => $user) {
	          $screenName = trim($user,"@");
	          $count = 150;
	          $singleUserResponse = $this->twitter->get_request('users/show',['screen_name'=> $screenName]);
	          $users[] = $singleUserResponse;
	          $followerstwitterAccounts[$singleUserResponse->id] = $this->twitter->get_followersList($data['cursor'], $screenName, $count);
	       }
            
	   return  array('users'=>$users , 'followersList'=>$followerstwitterAccounts) ;

	      }
	    
	    if($data['type'] == "hashtag") {
	        $tagsUsers = [];
	        $allTags =  explode(",",$data['tags']);
	        foreach ($allTags as $key => $tag) {
	        $allTweets = $this->twitter->get_tweet_by_keyword($tag, 300, "hashtag");
	       if(count($allTweets) > 0) {
	        foreach($allTweets as $key => $tweet)  {
	            
	            $user = $tweet->user;
	            $user->publihed_last_tweet = $tweet->created_at;
	            $tagsUsers[] = $user;
    	           
    	        }
	       }
	    }

	    return $tagsUsers;
	    }
	   }
	}
	
	function getSelfFriends($data) {
	    $account_item =  $this->getSingleAccountDetail($data['accountId']);
	   if(!empty($account_item)) {
	    //$count = 50;
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   return $this->twitter->getSelfFriendsList($data['cursor'], $account_item['screen_name'], 200); 
	   
	   }   
	   
	}
	
	function getSingleTweet($data) {
	    $account_item =  $this->getSingleAccountDetail($data['accountId']);
	   if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $url = "https://twitter.com/".$data['screen_name']."/status/".$data['id'];
	   return $this->twitter->getSingleTweetEmbed($url); 
	   }   
	   
	}
	
		function getRecentTweetByUser($data) {
	    $account_item =  $this->getSingleAccountDetail($data['accountId']);
	   if(!empty($account_item)) {
	   $count = 1000;
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   return $this->twitter->get_tweet_by_user($account_item['screen_name'], $count); 
	   }   
	   
	}
	
	//statuses/show/:id
	
	function getFollowersIds($data) {
	   $account_item =  $this->getSingleAccountDetail($data['accountId']);
	   if(!empty($account_item)) {
	  $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	  $data_tw = $this->twitter->get_request('users/show',['screen_name'=> $account_item['screen_name']]);
	  if(isset($data_tw->followers_count)) {
        $count = $data_tw->followers_count + 1;
	    return $this->twitter->get_followers($account_item['screen_name'], $count);
        }
    }   
	   
	}
	
	function addFollow($data) {
	        $account_item =  $this->getSingleAccountDetail($data['account-id']);
	   if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $action = $this->twitter->follow($data['user-id']);
			if(isset($action->errors)) {
				$error  = $action->errors[0];
				return array(
					'success'=>false,
					"message" => $error->message,
					
				);
	   } 
	   $this->refreshTwitterAccount($data['account-id'] , false);
	  				$data['status'] = "Followed";
				
	   return array(
					'success'=>true,
					"message" => $this->db->addTwitterLogs($data),
					
				);

	   
	   }
	}
	
	function unFollow($data) {
	        $account_item =  $this->getSingleAccountDetail($data['account-id']);
	   if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $action = $this->twitter->unfollow($data['user-id']);
			if(isset($action->errors)) {
				$error  = $action->errors[0];
				return array(
					'success'=>false,
					"message" => $error->message,
					
				);
	   } 
	   
	   $this->refreshTwitterAccount($data['account-id'] , false);
	   $data['status'] = "Unfollow";
	   return array(
					'success'=>true,
					"message" => $this->db->addTwitterLogs($data),
					
				);
	   
	   }
	}
	
	
	function addNewMamberInList($data) {
	    $account_item =  $this->getSingleAccountDetail($data['account-id']);
	   if(!empty($account_item)) {
	   $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	   $response =  $this->twitter->addNewMamberInList($data['list-id'], $data['slug'] , $data['user-id']  , $data['screen-name']);
	    
	   // if($response) {
	   //     return array('success'=>true, 'message'=>'successfully added in list');
	   // }
	   return $response;
	       
	   }
	}
	
	function reweetTweet($data) {
	    $account_item =  $this->getSingleAccountDetail($data['account-id']);
	   if(!empty($account_item)) {
	    $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	    $this->refreshTwitterAccount($data['account-id'] , false);
	   return $this->twitter->reweet($data['tweet_id']);
	   }
	    
	}
	
	function postTweet($data) {
	    $account_item =  $this->getSingleAccountDetail($data['account_id']);
	   if(!empty($account_item)) {
	    $this->twitter->getConnectionWithAccessToken($account_item['access_token']);
	    $this->refreshTwitterAccount($data['account_id'] , false);
	    return $this->twitter->postMedia($data);
	   }
	}
	
	function getSingleAccountDetail($tweeterAccountId) {
	    return $this->db->getSingleTweeterAccountDetailForTweet($tweeterAccountId);
	}

}

?>