  <?php 
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/dbConnect.php');


$twitter = new TwitterSetting();
$db = new dbConnect();
$data = array('accountId'=>$_GET['id']);
//$twitterLogs = $db->showTwitterLogs($data);
$db = new dbConnect();



?>
<style>
    .delete-field{
        margin: 4%;
    padding: 5px 10px;
    background: #00000024;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 600;
    cursor:pointer;
    }
    .delete-field:hover
    {
        background: #ff00007a;
    }
</style>

<div style="background-color: #04a9f3 !important; padding: 17px 4px; " class="box  bg-primary search-criteria">
  <div class="row">
	<?php 
    if($currentpage == "follow") { 
      if($_GET['type'] == "hashtag") {
  
	?>
	
	
        <div style="display:flex;" class="col-md-4 ">
  <i style="margin: 10px;font-size: 19px;" class="fa fa-search" aria-hidden="true"></i>   
        <input class="form-control " value="Filter users by creteria..." disabled />
        </div>
        
    <?php  }  if($_GET['type'] == "username") { ?>
	
    <div style="display:flex;" class="col-md-3 ">
  <i style="margin: 10px;font-size: 19px;" class="fa fa-search" aria-hidden="true"></i>   
    
        <input class="form-control " value="Followers Of " disabled />
        </div>
        
        <?php }  } ?>
     <?php if($currentpage == "unfollow") { ?>
        <div style="display:flex;" class="col-md-4 ">
  <i style="margin: 10px;font-size: 19px;" class="fa fa-search" aria-hidden="true"></i>   
 <input class="form-control " value="Filter followings by criteria.." disabled />
        </div>
            <?php } ?>
<div class="col-md-3 search-inputs ">
    <?php if($currentpage == "follow" && $_GET['type'] == "username") { ?>
<select class="form-control select-follow-user">
<?php foreach($followusers as $user) { ?>
  <option value="<?= $user->screen_name; ?>" <?= $user->screen_name == $_GET['usernames']?"selected=selected":""; ?>    ><?= $user->name; ?></option>
  <?php } ?>
</select>
<?php } ?>
</div>
	</div>
<!--        <div class="col-md-2 search-inputs ">-->
<!--<button id="addcriteria"  class="btn btn-primary criteria-btn add-one" > Add Criteria</button>-->

<!--</div>-->
<br/>

<div class="form-group dynamic-element" style="display:none;margin-bottom:2px;">
  <div style="margin: 10px 0px;" class="row">
    
  <!-- Replace these fields -->
  <!--<div class="col-md-1">-->
      
  <!--  </div>-->
  <div style="display: flex;    " class="col-md-3 search">
      <p class="delete delete-field">x</p>
    <select  class="form-control findCriteria" onChange="filter(this)" title="Choose field to filter by" style="">
    <option value="">Select filter criteria</option>
    <option value="user" >@user</option>
    <option value="profileImage" >Profile Image</option>
    <option value="Name" >Name</option>
    <option class="bioUnFollowpage" value="Bio" >Bio</option>
    <option value="Location">Location</option>
    <option value="lastTweeted" >Last tweeted</option>
    <option value="followersCount" >Followers count</option>
    <option value="friendCount" >Friends count</option>
    <option value="statusesCount" >Statuses count</option>
    <option value="Verified" >Verified?</option>
    
    <!--<option value="memberSince" >Member since</option>-->
    <option value="URL" >URL</option>
    <option class="followBackFollowpage" value="followBack">Follow Back</option>
    <option value="lastActivity">Last Activity</option>
</select>
  </div>
   
  <!--@userdata-->
  <div class="col-md-5 user filter-type" style="display:none">
      <div style="display:flex;">
     <select name="user" class="form-control userContain " onChange="searchforUsername(this)" style="margin-right: 2%;" >
         <option value=" " ></option>
          <option value="contain" selected="selected">Contains</option>
          <option value="notcontain">Does not contain</option>
          
        </select>
         <input class="form-control" id="username" onkeyup="searchUsername(this , event)" name="username" type="text"/>
    </div>  
  </div>
  <!-- end @userdata-->
 <!-- start @profile-->
  <div class="col-md-3 profile filter-type" style="display:none">
      <div style="display:flex;">
    <select name="profileImage" onChange="profileCriteria(this)" style="margin-right: 2%;" class="form-control"  >
        <option value="" > </option>
    <option value="0" >users without avatars (eggs)</option>
    <option value="1" >users with avatars</option>
</select>
         
    </div>  
  </div>
  <!-- end @profile-->
  <!--@Name-->
  <div class="col-md-5 name filter-type" style="display:none">
      <div style="display:flex;">
     <select name="name-select" class="form-control " onChange="searchforName(this)" style="margin-right: 2%;">
         
          <option value="contain" selected="selected">Contains</option>
          <option value="notcontain">Does not contain</option>
          
        </select>
         <input class="form-control " onkeyup="searchName(this , event)" name="name" type="text"/>
    </div>  
  </div>
  <!-- end name-->
  <!--bio-->
  <div class="col-md-5 bio filter-type" style="display:none">
      <div style="display:flex;">
     <select name="bio-select" onChange="searchforBio(this)" class="form-control " style="margin-right: 2%;" >
          <option value="contain" selected="selected">Contains</option>
          <option value="notcontain">Does not contain</option>
          <option value="empty">is empty</option>
          <option value="notEmpty">is not empty</option>
    </select>
         <input class="form-control " onkeyup="searchBio(this , event)"  name="bio" type="text"/>
    </div>  
  </div>
  <!-- end bio-->
  <!--location-->
  <div class="col-md-5 location filter-type" style="display:none">
      <div style="display:flex;">
     <select name="location-select" onChange="searchforLocation(this)" class="form-control " style="margin-right: 2%;" >
         
          <option value="contain">Contains</option>
          <option value="notcontain">does not contain</option>
          <option value="empty">is empty</option>
          <option value="notEmpty">is not empty</option>
          
        </select>
         <input class="form-control " onkeyup="searchLocation(this , event)" name="location" type="text"/>
    </div>  
  </div>
  <!-- end location-->
  <!--last tweeted-->
  <div class="col-md-5 lastTweeted filter-type" style="display:none">
      <div style="display:flex;">
     <select name="lastTweeted-select" class="form-control " onChange="searchforlastTweet(this)" style="margin-right: 2%;" >
         
          <option value="0">Is older than</option>
          <option value="1">Is newer than</option>
          
          
        </select>
         <input class="form-control" onkeyup="searchlastTweet(this , event)" name="lastTweeted" type="text"/>
         <span style=" width: auto; " class="input-group-addon">days ago</span>
    </div>  
  </div>
  <!-- end last tweet-->
  <!--Followers count-->
  <div class="col-md-5 followersCount filter-type" style="display:none">
      <div style="display:flex;">
     <select name="followersCount-select" onChange="searchforFollowerCount(this)" class="form-control " style="margin-right: 2%;" >
         
          <option value="1">is greater than</option>
          <option value="0">is less than</option>

        </select>
         <input class="form-control followers" onkeyup="searchFollowersCount(this,event)" name="followersCount" type="number"/>
         
    </div>  
  </div>
  <!-- Followers count-->
  <!--Friends count-->
  <div class="col-md-5 friendsCount filter-type" style="display:none">
      <div style="display:flex;">
     <select name="friendsCount-select" onChange="searchforFriendCount(this)" class="form-control " style="margin-right: 2%;" >
         
        <option value="1">is greater than</option>
          <option value="0">is less than</option>
        </select>
         <input class="form-control "  onkeyup="searchFriendsCount(this ,event)" name="friendsCount" type="text"/>
         
    </div>  
  </div>
  <!-- Friends count-->
  <!--Follow ratio-->
  <div class="col-md-5 followratio filter-type" style="display:none">
      <div style="display:flex;">
     <select name="followratio-select"  class="form-control " style="margin-right: 2%;" >
         
          <option value="true">is greater than</option>
          <option value="false">is less than</option>

        </select>
         <input class="form-control " name="followratio" type="text"/>
         
    </div>  
  </div>
  <!-- Follow ratio-->
  <!-- Statuses Count-->
  <div class="col-md-5 statusCount filter-type" style="display:none">
      <div style="display:flex;">
     <select name="statusCount-select" onChange="searchforStatsusCount(this)" class="form-control " style="margin-right: 2%;" >
          <option value="1">Is greater than</option>
          <option value="0">is less than</option>
    </select>
         <input class="form-control " onkeyup="searchStatusCount(this , event)"  name="statusCount" type="number"/>
         
    </div>  
  </div>
  <!-- Statuses Count-->
  <!-- Listed Count-->
  <div class="col-md-5 listedCount filter-type" style="display:none">
      <div style="display:flex;">
     <select name="listedCount-select" class="form-control " style="margin-right: 2%;" >
         
          <option value="true">is greater than</option>
          <option value="false">is less than</option>

        </select>
         <input class="form-control "  name="listedCount" type="text"/>
         
    </div>  
  </div>
  <!-- Listed Count-->
  <!-- Protected-->
  <div class="col-md-2 protected filter-type" style="display:none">
      <div style="display:flex;">
     <select name="protected-select"   class="form-control " style="margin-right: 2%;" >
         
          <option value="true">Yes</option>
          <option value="false">No</option>

        </select>

    </div>  
  </div>
  <!--Protected-->
    <!-- Verified-->
  <div class="col-md-2 verified filter-type" style="display:none">
      <div style="display:flex;">
     <select name="verified-select" class="form-control"  onChange="searchVerified(this)" style="margin-right: 2%;" >
         <option value=""></option>
          <option value="1">Yes</option>
          <option value="0">No</option>

        </select>

    </div>  
  </div>
  <!--varified-->
   <!-- Language-->
  <div class="col-md-5 language filter-type" style="display:none">
      <div style="display:flex;">
     <select name="islanguage-select" onChange="searchforLanguage(this)" class="form-control " style="margin-right: 2%;" >
         
          <option value="1">is</option>
          <option value="0">is not</option>

        </select>
        

    </div>  
  </div>
 <!-- Language-->
  
  <!--Members Since-->
  <div class="col-md-5 memberSince filter-type" style="display:none">
      <div style="display:flex;">
     <select name="memberSince-select" class="form-control " style="margin-right: 2%;" >
         
          <option value="0">is older than</option>
          <option value="1">is newer than</option>
          
          
        </select>
         <input class="form-control " onkeyup="searchMemberSince(this , event)" name="memberSince" type="text"/>
         <span style=" width: auto; " class="input-group-addon">days ago</span>
    </div>  
  </div>
  <!--Members Since-->
  <!--url-->
  <div class="col-md-5 url filter-type" style="display:none">
      <div style="display:flex;">
     <select name="url-select" onChange="searchforUrl(this)" class="form-control " style="margin-right: 2%;" >
         
          <option value="contain">contains</option>
          <option value="notcontain">does not contain</option>
          <option value="empty">is empty</option>
          <option value="notEmpty">is not empty</option>
          
        </select>
         <input class="form-control " onkeyup="searchUrl(this , event)" name="url" type="text"/>
    </div>  
  </div>
  <!-- end url-->
  <!--Friends or Followers-->
  <div class="col-md-3 friendorfollower " style="display:none">
      <div style="display:flex;">
    <select name="friendorFollower-selected"  class="form-control ">
    <option  value=""></option>
    <option  value="Following you">Following you</option>
    <option  value="You are following">You are following</option>
    <option  value="Mutual friendship">Mutual friendship</option>
    <option  value="Neither">Neither</option>
    <option  value="Not following you">Not following you</option>
    <option  value="You are not following">You are not following</option>
</select>

    </div>  
  </div>
  <!-- end Friends or Followers--> 
  <!--Satisfied-->
  <div class="col-md-2 safeListed filter-type" style="display:none">
      <div style="display:flex;">
    <select  name="satisfied-selected" class="form-control ">
    <option value="true"  label="">Yes</option>
    <option value="false" >No</option>
   
</select>

    </div>  
  </div>
   <!--end safe Listed-->
   
   <!--followBack-->
  <div class="col-md-5 followBack filter-type" style="display:none">
      <div style="display:flex;">
    <select  name="followBack-selected" onChange="searchfollowBack(this)" class="form-control ">
    <option value="" ></option>
    <option value="1" >Yes</option>
    <option value="0" >No</option>
   </select>
 <input class="form-control " onkeyup="searchforFollowBack(this , event)"  name="followback" type="text"/>
         <span style=" width: auto; " class="input-group-addon">days ago</span>
    </div>  
  </div>
   <!--end followBack-->
  <!--last Activity-->
  <div class="col-md-5 lastActivity filter-type" style="display:none">
      <div style="display:flex;">
     <select name="lastActivity-select" onChange="searchforlastActivity(this)" class="form-control " style="margin-right: 2%;" >
         <option value=""></option>
          <option value="true">Follow</option>
          <option value="false">Unfollow</option>
          
        </select>
         <input class="form-control " onkeyup="searchlastActivity(this , event)" name="lastActivity" type="number"/>
         <span style=" width: auto; " class="input-group-addon">days ago</span>
    </div>  
  </div>
  <!-- end last Activity-->
  
   <!--  End of fields-->
     
  </div>

</div> 

 <div class="dynamic-stuff">
    <!-- Dynamic element will be cloned here -->
    <!-- You can call clone function once if you want it to show it a first element-->
  </div>
     <div class="row container">
         <div class="col-md-9" style="margin-left:30px">
<button id="addcriteria"  class="btn btn-success criteria-btn add-one" >+ Add Criteria</button>

</div>
     </div>
    </div>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
var filterCriteria = [];
var numbers;
var count = 11;
//@user
function searchUsername(attr , event)
 {
     if (event.keyCode === 13) {
     if($(attr).attr( 'random-value-array')) {
     var randomStoredValue = $(attr).attr( 'random-value-array');
    var contain = $(attr).parent('div').children('select').val();
    var username = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "username": username };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
    var username = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "username": username };
    filterCriteria.push(filterData);
    var rendomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , rendomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , rendomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
     }
}

//avatar
function profileCriteria(attr)
{
     if($(attr).attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).attr( 'random-value-array');
    var avatar = $(attr).val();
   avatar = (avatar == 1)?true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria , "withAvatar": avatar };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     }
    else {
    var avatar = $(attr).val();
   avatar = (avatar == 1)?true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria , "withAvatar": avatar };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
        
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria); 
}
//name
function searchName(attr , event)
{
    if (event.keyCode === 13) {
    if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
    var contain = $(attr).parent('div').children('select').val();
    var name = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "name": name };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
        var name = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "name": name };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
        filterCriteriaAction(filterCriteria); 
}
}
//bio
function searchBio(attr , event)
{
    if (event.keyCode === 13) {
    if($(attr).attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).attr( 'random-value-array');
    var contain = $(attr).parent('div').children('select').val();
    var bio = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "bio": bio};
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
    var bio = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "bio": bio };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
}
}
//location
function searchLocation(attr , event)
{
    if (event.keyCode === 13) {
     if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
        var contain = $(attr).parent('div').children('select').val();
    var location = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "location": location };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
    var location = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "location": location };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
}
}
//last tweet
function searchlastTweet(attr , event)
{
    if (event.keyCode === 13) {
         if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
        var contain = $(attr).parent('div').children('select').val();
    var lastTweet = $(attr).val();
    contain = contain  == 1? true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isNewerThen" : contain  ,  "lastTweet": lastTweet  };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
    contain = contain  == 1? true:false;
    var lastTweet = $(attr).val()
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isNewerThen" : contain  , "lastTweet": lastTweet };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
    
    }
}
// Follower Count
function searchFollowersCount(attr , event)
{
    if(event.keyCode === 13)
    {
      if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
        var contain = $(attr).parent('div').children('select').val();
        contain = contain  == 1? true:false;
    var FollowersCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "followersCount": FollowersCount };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var contain = $(attr).parent('div').children('select').val();
    contain = contain  == 1? true:false;
    var FollowersCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "followersCount": FollowersCount };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
}
}
//friends Count
function searchFriendsCount(attr , event)
{
    if (event.keyCode === 13) {
          if($(attr).attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).attr( 'random-value-array');
    var contain = $(attr).parent('div').children('select').val();
    contain = contain  == 1? true:false;
    var FriendsCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  ,"friendsCount": FriendsCount };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
    var contain = $(attr).parent('div').children('select').val();
    contain = contain  == 1? true:false;
    var FriendsCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData ={ "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  ,"friendsCount": FriendsCount };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
}
}

//status Count
function searchStatusCount(attr , event)
{
    if (event.keyCode === 13) {
    if($(attr).attr( 'random-value-array')) {
         
                  var randomStoredValue = $(attr).attr( 'random-value-array');
        var isGreater = $(attr).parent('div').children('select').val();
        isGreater = isGreater  == 1? true:false;
        var statusCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : isGreater  , "statusCount": statusCount  };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
    var isGreater = $(attr).parent('div').children('select').val();
    isGreater = isGreater  == 1? true:false;
    var statusCount = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : isGreater  ,  "statusCount": statusCount  };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
    
}
}


//Verified
function searchVerified(attr) {
    
      if($(attr).attr( 'random-value-array')) {
     
         var randomStoredValue = $(attr).attr( 'random-value-array');
     var verified = $(attr).val();
     verified = verified  == 1? true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,"isVerified": verified  };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
    var verified = $(attr).val();
    verified = verified  == 1? true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria , "isVerified": verified  };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);

    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
}
//language
// url
function searchUrl(attr , event)
{
    if (event.keyCode === 13) {
        if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
        var contain = $(attr).parent('div').children('select').val();
     var url = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  ,"url": url};
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
    var contain = $(attr).parent('div').children('select').val();
    var url = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "url": url};
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
}
}
//followBack
function searchfollowBack(attr)
{
    
       if($(attr).attr( 'random-value-array')) {
     
         var randomStoredValue = $(attr).attr( 'random-value-array');
     var followBack = $(attr).val();
    var followBackdays = $(attr).parent('div').children('input').val();
    followBack = followBack == 1? true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,"isfollowBack": followBack , "folowBack" : followBackdays };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
         var followBackdays = $(attr).parent('div').children('input').val();
    var followBack = $(attr).val();
    followBack = followBack == 1?true:false;
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria , "isfollowBack": followBack, "folowBack" : followBackdays  };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);

    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
    filterCriteriaAction(filterCriteria);
    
    
}

//LastActivity
function searchlastActivity(attr)
{
    if (event.keyCode === 13) {
        if($(attr).attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).attr( 'random-value-array');
        var isFollowed = $(attr).parent('div').children('select').val();
     var lastActivity = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isFollowed" : isFollowed  ,"lastActivity": lastActivity };
    $(attr).attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
    var isFollowed = $(attr).parent('div').children('select').val();
    var lastActivity = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,  "isFollowed" : isFollowed  ,"lastActivity": lastActivity };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    
    $(attr).attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     
     filterCriteriaAction(filterCriteria);
}
}
//search for bio
function searchforBio(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var bio = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria , "isContain" : contain  , "bio": bio};
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var bio = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "bio": bio };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}
//search for location
function searchforLocation(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var location = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "location": location };
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var location = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "location": location };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}
//Follower Count
function searchforFollowerCount(attr)
{
   
    if($(attr).parent('div').children('input.followers').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input.followers').attr( 'random-value-array');
    var contain = $(attr).val();
    contain = contain  == 1? true:false;
    var FollowersCount = $(attr).parent('div').children('input.followers').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "followersCount": FollowersCount };
     $(attr).parent('div').children('input.followers').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
  var contain = $(attr).val();
    contain = contain == 1? true:false;
    var FollowersCount = $(attr).parent('div').children('input.followers').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "followersCount": FollowersCount };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input.followers').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}

function searchforFriendCount(attr)
{
   
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    contain = contain  == 1? true:false;
    var FriendsCount = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  ,"friendsCount": FriendsCount } ;
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
  var contain = $(attr).val();
    contain = contain == 1? true:false;
    var FriendsCount = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  ,"friendsCount": FriendsCount };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}

function searchforStatsusCount(attr)
{
   
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    contain = contain  == 1? true:false;
    var statusCount = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "statusCount": statusCount  } ;
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
  var contain = $(attr).val();
    contain = contain == 1? true:false;
    var statusCount = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isGreaterThen" : contain  , "statusCount": statusCount  };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}

// search for url
function searchforUrl(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var url = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  ,"url": url};
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var url = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  ,"url": url};
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}

//search for Username
function searchforUsername(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var username = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "username": username };
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var username = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "username": username }
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}
//seach  for name
function searchforName(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var name = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "name": name };
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var name = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isContain" : contain  , "name": name };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}
//Last Tweeted
function searchforlastTweet(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var contain = $(attr).val();
    var lastTweet = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isNewerThen" : contain  ,  "lastTweet": lastTweet  };
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var contain = $(attr).val();
    var lastTweet = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isNewerThen" : contain  ,  "lastTweet": lastTweet  };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     filterCriteriaAction(filterCriteria);
    
}
//Search for last Activity
function searchforlastActivity(attr)
{
    if($(attr).parent('div').children('input').attr( 'random-value-array')) {
         
    var randomStoredValue = $(attr).parent('div').children('input').attr( 'random-value-array');
    var isFollowed  = $(attr).val();
    var lastActivity = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,  "isFollowed" : isFollowed  ,"lastActivity": lastActivity };
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
        count = count + 2;
   var isFollowed  = $(attr).val();
    var lastActivity = $(attr).parent('div').children('input').val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData =  { "searchCriteria" : searchCriteria ,  "isFollowed" : isFollowed  ,"lastActivity": lastActivity };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
     $(attr).parent('div').children('input').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     
     filterCriteriaAction(filterCriteria);
    
}

//search for follow back
function searchforFollowBack(attr , event)
{
   
    if (event.keyCode === 13) {
        if($(attr).parent('div').children('select').attr( 'random-value-array')) {
         
         var randomStoredValue = $(attr).parent('div').children('select').attr( 'random-value-array');
        var followBack = $(attr).parent('div').children('select').val();
     var followBackdays = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    filterCriteria[randomStoredValue] = { "searchCriteria" : searchCriteria ,"isfollowBack": followBack , "folowBack" : followBackdays };
    $(attr).parent('div').children('select').attr( 'random-value-array' , randomStoredValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomStoredValue );     
    
     } else {
    var followBack = $(attr).parent('div').children('select').val();
    var followBackdays = $(attr).val();
    var searchCriteria = $(attr).parent('div').parent('div').parent('div').children('div.search').children('select.findCriteria').val();
    var filterData = { "searchCriteria" : searchCriteria ,"isfollowBack": followBack , "folowBack" : followBackdays };
    filterCriteria.push(filterData);
    var randomArrayValue = filterCriteria.indexOf(filterData);
    
    $(attr).parent('div').children('select').attr( 'random-value-array' , randomArrayValue );
    $(attr).parent('div').parent('div').parent('div').children('div.search').children('p.delete').attr( 'random-value-array' , randomArrayValue );
        
     }
     
     filterCriteriaAction(filterCriteria);
}
}



  $('.add-one').click(function() {
  $('.dynamic-element').first().clone().appendTo('.dynamic-stuff').show();
  attach_delete();
});
// function removeSearch(){
    
// }


//Attach functionality to delete buttons
function attach_delete(){
  $('.delete').off();
  $('.delete').click(function(){
    $(this).closest('.form-group').remove();
  if($(this).attr( 'random-value-array')) {
      
    delete filterCriteria[$(this).attr( 'random-value-array')];
    filterCriteria = $.grep(filterCriteria ,function(n){ return n == 0 || n });
    
        filterCriteriaAction(filterCriteria);
        
  }

  });
}




</script>
	<script src="<?= $newsifyObj->base_url;; ?>/js/viral-tweet/filterChange.js"></script>
