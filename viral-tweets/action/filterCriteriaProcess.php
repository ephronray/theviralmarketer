<?php

require_once (__DIR__.'/../../_libs/twitterSetting.php');
if(isset($_POST['filterArray'])) {
$filterArray = json_decode($_POST['filterArray']);
$twitterFollowerIds = json_decode($_POST['twitterFollowerIds']);
$type= $_POST['type'];
$twitterLogs = json_decode($_POST['twitterLogs']);
$twitter = new TwitterSetting();

 $activeFollowUsersFollowersList = json_decode($_POST['activeFollowUsersFollowersList']);
  foreach($filterArray as $filter) {
  //if username filter
  if($filter->searchCriteria == 'user') {
      $activeFollowUsersFollowersList = filterUserName($activeFollowUsersFollowersList , $filter);
   }
  // //if username filter
  
  //if profileImage filter
  else if($filter->searchCriteria == 'profileImage') {
      $activeFollowUsersFollowersList = filterProfileImage($activeFollowUsersFollowersList , $filter);
   }
  // //if profileImage filter
  
    //if name filter
  else if($filter->searchCriteria == 'Name') {
      $activeFollowUsersFollowersList = filterName($activeFollowUsersFollowersList , $filter);
   }
  // //if Name filter
  
//if Bio filter
  else if($filter->searchCriteria == 'Bio') {
      $activeFollowUsersFollowersList = filterDescription($activeFollowUsersFollowersList , $filter);
  }
  //if Bio filter
  
  //if Location filter
  else if($filter->searchCriteria == 'Location') {
      $activeFollowUsersFollowersList = filterLocation($activeFollowUsersFollowersList , $filter);
       
  }
  //Followers Count
  else if($filter->searchCriteria == 'followersCount') {
      $activeFollowUsersFollowersList = filterFolowersCount($activeFollowUsersFollowersList , $filter);
       
  }
  //Followers Count
  //Friends Count
  else if($filter->searchCriteria == 'friendCount') {
      $activeFollowUsersFollowersList = filterFriendsCount($activeFollowUsersFollowersList , $filter);
       
  }
  //Friends Count

//status Count
 else if($filter->searchCriteria == 'statusesCount') {
      $activeFollowUsersFollowersList = filterStatusCount($activeFollowUsersFollowersList , $filter);
       
  }
//status Count

//URL
 else if($filter->searchCriteria == 'URL') {
      $activeFollowUsersFollowersList = filterUrl($activeFollowUsersFollowersList , $filter);
       
  }
  //URL
  
//Language
 else if($filter->searchCriteria == 'Language') {
      $activeFollowUsersFollowersList = filterLanguage($activeFollowUsersFollowersList , $filter);
       
 }
 //language
//varified
 else if($filter->searchCriteria == 'Verified') {
      $activeFollowUsersFollowersList = filterVerified($activeFollowUsersFollowersList , $filter);
       
 }
//verified

//Follow Back
 else if($filter->searchCriteria == 'followBack') {
      $activeFollowUsersFollowersList = filterFollowBack($activeFollowUsersFollowersList , $filter ,$twitterFollowerIds,$twitterLogs );
       
 }
//Folllow Back
//Last Activity
 else if($filter->searchCriteria == 'lastActivity') {
    $activeFollowUsersFollowersList = filterlastActivity($activeFollowUsersFollowersList , $filter , $twitterLogs);
  
 }
 else if($filter->searchCriteria == 'lastTweeted') {
    $activeFollowUsersFollowersList = filterlastTweeted($activeFollowUsersFollowersList , $filter );
  
 }

//Last Activity
  }
  


echo json_encode(normalizeArray($activeFollowUsersFollowersList , $twitterLogs ,$twitterFollowerIds)); 
  
  
} else {
    $array = array("success"=>false,"data"=>"");
    echo json_encode($array);

}




//filter username
function filterUserName($activeFollowUsersFollowersList , $filter) {
    $contain = $filter->isContain == 'contain'?true:false;
    $userName = $filter->username;
    if($userName == "" || $userName == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->screen_name) &&  stripos($user->screen_name, $userName) !== false && $contain) {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->screen_name) &&  stripos($user->screen_name, $userName) === false && !$contain) {
         $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain) {
  return $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
}
//filter username


//filter filterProfileImage
function filterProfileImage($activeFollowUsersFollowersList , $filter) {

    $contain = $filter->withAvatar;
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    $defaultUrlImage = "http://abs.twimg.com/sticky/default_profile_images/default_profile_normal.png";
  
   foreach($activeFollowUsersFollowersList as $user) {

     if(isset($user->profile_image_url) &&   getDefaultImageName($user->profile_image_url) != "default_profile_normal" && $contain) {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->profile_image_url) &&  getDefaultImageName($user->profile_image_url) == "default_profile_normal" && !$contain) {
         $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain) {
  return $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
 

}

//filter name
function filterName($activeFollowUsersFollowersList , $filter) {
    $contain = $filter->isContain == 'contain'?true:false;
    $name = $filter->name;
    if($name == "" || $name == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->name) &&  stripos($user->name, $name) !== false && $contain) {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->name) &&  stripos($user->name, $name) === false && !$contain) {
         $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain) {
  return $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
}
//filter name

//filter description
function filterDescription($activeFollowUsersFollowersList , $filter) {
    $contain = $filter->isContain;
    $description = $filter->bio;
    if($description == null &&  $contain != "empty" && $contain != "notEmpty") {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    $newEmptyUsersFollowersList = [];
    $newNotEmptyUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->description) &&  stripos($user->description, $description) != false && $contain == "contain") {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->description) &&  stripos($user->description, $description) == false && $contain == "notcontain") {
         $newNotContainUsersFollowersList[] = $user;
     }
     if(isset($user->description) && ($user->description == "" || $user->description == null )  && $contain == "empty") {
         $newEmptyUsersFollowersList[] = $user;
     }
     if(isset($user->description) &&  ($user->description != "" || $user->description != null ) && $contain == "notEmpty") {
         $newNotEmptyUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain == "contain") {
  return $newContainUsersFollowersList;
 } else if($contain == "notcontain") {
     return $newNotContainUsersFollowersList;
 } else if($contain == "empty") {
     return $newEmptyUsersFollowersList;
 } else if($contain == "notEmpty") {
     return $newNotEmptyUsersFollowersList;
 }
}
//filter description

//filter Location
function filterLocation($activeFollowUsersFollowersList , $filter) {
    $contain = $filter->isContain;
    $location = $filter->location;
 if($location == null &&  $contain != "empty" && $contain != "notEmpty") {
        return $activeFollowUsersFollowersList;
    }
    
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    $newEmptyUsersFollowersList = [];
    $newNotEmptyUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->location) &&  stripos($user->location, $location) != false && $contain == "contain") {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->location) &&  stripos($user->location, $location) == false && $contain == "notcontain") {
         $newNotContainUsersFollowersList[] = $user;
     }
     if(isset($user->location) && ($user->location == "" )  && $contain == "empty") {
         $newEmptyUsersFollowersList[] = $user;
     }
     if(isset($user->location)  &&   ($user->location != "" )  && $contain == "notEmpty") {
         $newNotEmptyUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain == "contain") {
  return $newContainUsersFollowersList;
 } else if($contain == "notcontain") {
     return $newNotContainUsersFollowersList;
 } else if($contain == "empty") {
     return $newEmptyUsersFollowersList;
 } else if($contain == "notEmpty") {
     return $newNotEmptyUsersFollowersList;
 }
}
//filter Location

//filter follower count
function filterFolowersCount($activeFollowUsersFollowersList , $filter) {
    $isGreaterThen = $filter->isGreaterThen;
    $followersCount = $filter->followersCount;
    if($followersCount == "" || $followersCount == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->followers_count) &&  ($user->followers_count > $followersCount)  && $isGreaterThen) {
          $newContainUsersFollowersList[] =  $user;
     }
     if(isset($user->followers_count) &&  ($user->followers_count < $followersCount) && !$isGreaterThen) {
        $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($isGreaterThen) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
}

//filter follower count

//friends Count
function filterFriendsCount($activeFollowUsersFollowersList , $filter)
{
        $isGreaterThen = $filter->isGreaterThen;
    $followersCount = $filter->friendsCount;
    if($followersCount == "" || $followersCount == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->friends_count) &&  ($user->friends_count > $followersCount)  && $isGreaterThen) {
          $newContainUsersFollowersList[] =  $user;
     }
     if(isset($user->friends_count) &&  ($user->friends_count < $followersCount) && !$isGreaterThen) {
        $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($isGreaterThen) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
}
// friends Count
function filterStatusCount($activeFollowUsersFollowersList , $filter)
{
    $isGreaterThen = $filter->isGreaterThen;
    $followersCount = $filter->statusCount;
    if($followersCount == "" || $followersCount == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->statuses_count) &&  ($user->statuses_count > $followersCount)  && $isGreaterThen) {
          $newContainUsersFollowersList[] =  $user;
     }
     if(isset($user->statuses_count) &&  ($user->statuses_count < $followersCount) && !$isGreaterThen) {
        $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($isGreaterThen) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
    
}
//url
function filterUrl($activeFollowUsersFollowersList , $filter)
{
 $contain = $filter->isContain;
    $location = $filter->url;
    if($location == "" &&  $contain != "empty" && $contain != "notEmpty" ) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    $newEmptyUsersFollowersList = [];
    $newNotEmptyUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
      if(isset($user->url) &&  stripos($user->url, $location) != false && $contain == "contain") {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->url) && stripos($user->url,$location) == false && $contain == "notcontain") {
         $newNotContainUsersFollowersList[] = $user;
     }
     if( $user->url == null  && $contain == "empty") {
         $newEmptyUsersFollowersList[] = $user;
     }
     if(  ($user->url != "" || $user->url != null ) && $contain == "notEmpty") {
         $newNotEmptyUsersFollowersList[] = $user;
     }
     
      
 }  
 if($contain == "contain") {
  return $newContainUsersFollowersList;
 } else if($contain == "notcontain") {
     return $newNotContainUsersFollowersList;
 } else if($contain == "empty") {
     return $newEmptyUsersFollowersList;
 } else if($contain == "notEmpty") {
     return $newNotEmptyUsersFollowersList;
 }
    
}
//url
//Language
function filterLanguage($activeFollowUsersFollowersList , $filter)
{
    $islanguage = $filter->islanguage;
    $language = $filter->language;
    if($language == "" || $language == null) {
        return $activeFollowUsersFollowersList;
    }
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
 foreach($activeFollowUsersFollowersList as $user) {
     if(isset($user->lang) &&  ($user->lang === $language)  && $islanguage) {
          $newContainUsersFollowersList[] =  $user;
     }
     if(isset($user->lang) &&  ($user->lang !== $language) && !$islanguage) {
        $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($islanguage) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
    
}
//Language

//verified
function filterVerified($activeFollowUsersFollowersList , $filter) {

    $isVerified = $filter->isVerified;
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    
   foreach($activeFollowUsersFollowersList as $user) {

     if(isset($user->verified) && ($user->verified == true) && $isVerified) {
         $newContainUsersFollowersList[] = $user;
     }
     if(isset($user->verified)  && ($user->verified == false)  && !$isVerified) {
         $newNotContainUsersFollowersList[] = $user;
     }
     
      
 }  
 if($isVerified) {
  return $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
 

}

//Verified
//FollowBack
function filterFollowBack($activeFollowUsersFollowersList , $filter , $twitterFollowerIds,$twitterLogs)
{

    $isfollowBack = $filter->isfollowBack;
   $followbackday = $filter->folowBack;
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];

   foreach($activeFollowUsersFollowersList as $user) {
// $newContainUsersFollowersList[] = twitterIds($user->id , $twitterFollowerIds);
    if($followbackday == "")
    {
         if(isset($user->id) && twitterIds($user->id , $twitterFollowerIds) && $isfollowBack  ) {
         $newContainUsersFollowersList[] = $user;
        }
     if(isset($user->id) &&  !twitterIds($user->id , $twitterFollowerIds) && !$isfollowBack ) {
         $newNotContainUsersFollowersList[] = $user;

     }

   }    
    
else 
{
    if(isset($user->id) && twitterIds($user->id , $twitterFollowerIds) && $isfollowBack && isfollowed($user->id , $twitterLogs) && (twitterActivitydate($user->id , $twitterLogs) <= $followbackday) ) {
         $newContainUsersFollowersList[] = $user;
        }
     if(isset($user->id) &&  !twitterIds($user->id , $twitterFollowerIds) && !$isfollowBack && isfollowed($user->id , $twitterLogs) && (twitterActivitydate($user->id , $twitterLogs) <= $followbackday)) {
         $newNotContainUsersFollowersList[] = $user;

     }
}     
      
 }  
 if($isfollowBack) {
  return $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
    
    
}

function filterlastActivity($activeFollowUsersFollowersList , $filter , $twitterLogs)
{
     $isGreaterThen = $filter->isFollowed;
    $lastActivity = $filter->lastActivity;
    if($lastActivity == "" || $lastActivity == null) {
        return $activeFollowUsersFollowersList;
    }

    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    
    
 foreach($activeFollowUsersFollowersList as $user) {
     
    
     //follow
     
     if(isset($user->id) && isfollowed($user->id, $twitterLogs)  && (twitterActivitydate($user->id , $twitterLogs) <= $lastActivity) && $isGreaterThen) {
          $newContainUsersFollowersList[] =  $user;
     }
     
     //unfollow
     if(isset($user->id) &&  !isfollowed($user->id , $twitterLogs) && (twitterActivitydate($user->id , $twitterLogs) < $lastActivity)  && !$isGreaterThen) {
        $newNotContainUsersFollowersList[] = $user;
     }

      
 }  
 if($isGreaterThen) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
    
}


function filterlastTweeted($activeFollowUsersFollowersList , $filter )
{
     $isGreaterThen = $filter->isNewerThen;
    $lastTweet = $filter->lastTweet;
    $newContainUsersFollowersList = [];
    $newNotContainUsersFollowersList = [];
    
    
 foreach($activeFollowUsersFollowersList as $user) {
     
    
     //isNewer
     if($type == 'hashtag') {
         retunr "hastag";
     if(isset($user->publihed_last_tweet) && dateFormatChageForLastAction($user->publihed_last_tweet) < $lastTweet &&  $isGreaterThen) {
          $newContainUsersFollowersList[] =  $user;
     }
     
     //isOlder
     if(isset($user->publihed_last_tweet)  && dateFormatChageForLastAction($user->publihed_last_tweet) >= $lastTweet && !$isGreaterThen) {
        $newNotContainUsersFollowersList[] = $user;
     }

    }else{
        $status = $user->status ;
        if(isset($user->status) && isset($status->created_at) && dateFormatChageForLastAction($status->created_at) < $lastTweet &&  $isGreaterThen) {
            $newContainUsersFollowersList[] =  $user;
       }
       
       //isOlder
       if(isset($user->status) && isset($status->created_at) && dateFormatChageForLastAction($status->created_at) >= $lastTweet && !$isGreaterThen) {
          $newNotContainUsersFollowersList[] = $user;
       }
    }
 }  
 if($isGreaterThen) {
  return  $newContainUsersFollowersList;
 } else {
     return $newNotContainUsersFollowersList;
 }
}


 function getDefaultImageName($defaultUrlImage) {
         
    $defaultImageExplode = explode("/",$defaultUrlImage);
    $defaultImageWithType =  $defaultImageExplode[count($defaultImageExplode)-1];
    $defaultImageExplodeName = explode(".",$defaultImageWithType);
    return $defaultImageExplodeName[0];
 }


//filter filterProfileImage

//follow back 
function twitterIds($user_id , $twitterFollowerIds) {
$status = "";
foreach($twitterFollowerIds as $twitterid )
{
    // echo $twitterid;
    if($twitterid == $user_id )
    {
    $status = true;
    } 
    else {
    $status = false;    
    }
    
    
}
return $status;
}
//Last Activity
function isfollowed($user_id , $twitterLogs) {
$status = false;
foreach($twitterLogs as $arrayitem ) {
    if($arrayitem->twitter_user_id == $user_id)  {
     $status = true;
     break;
    }
    
}
return $status;
}
//Last Activity
function twitterActivitydate($user_id , $twitterLogs) {
$dates = '';
foreach($twitterLogs as $arrayitem ) {
    
    if($arrayitem->twitter_user_id == $user_id ) 
    {
    $dates = dateFormatChageForLastAction($arrayitem->date);
    }
}
return $dates;
}

 function dateFormatChageForLastAction($valueDate) {
$date1=date_create($valueDate);
$date2=date_create();
$diff=date_diff($date1,$date2);
return $diff->format("%a");

 }
 
 function normalizeArray($activeFollowUsersFollowersList , $twitterLogs ,$twitterFollowerIds) {
     foreach($activeFollowUsersFollowersList as $user) {
         //$user->last_activity = twitterActivity($user->id , $twitterLogs);
         $user->last_activity = twitterActivity($user->id , $twitterLogs);
         $user->back_status = (twitterIds($user->id , $twitterFollowerIds) == true)?"Yes":"No";
         $user->created_at = date("Y", strtotime($user->created_at));
         if($user->status) {
              $status = $user->status;
              $status->created_at = dateFormatChange($status->created_at);
         }
         
         if($type == 'hashtag') {
             $status = $user->status;
             $status->created_at = dateFormatChange($user->publihed_last_tweet);
         }
         
     
         
     }
      return $activeFollowUsersFollowersList;
    
 }
 function dateFormatChange($valueDate) {
      if($valueDate) {
     $date1 = date("Y-m-d", strtotime($valueDate));
    $date2 = date("Y-m-d");
     if($date1 == $date2) {
        return "Today";
    }
 $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Never Tweeted");
}
}

function twitterActivity($user_id , $twitterLogs) {
$status = '';
foreach($twitterLogs as $arrayitem ) {
    
    if($arrayitem->twitter_user_id == $user_id ) {
    $status = $arrayitem->status. ' on '. changeDateFormatForLastAction($arrayitem->date);
    break;
        
    }
}
 return $status;
}
function changeDateFormatForLastAction($valueDate) {
    $date1 = date("Y-m-d", strtotime($valueDate));
    $date2 = date("Y-m-d");
  
 $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Today");

 }
?>





