<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

$currentpage = "unfollow";

require_once (__DIR__.'/../includes/main-header.php');
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/dbConnect.php');
$db = new dbConnect();

$twitter = new TwitterSetting();
 $common = new CommonHepler();
// //FollowBack status
  $data = array('accountId'=>$_GET['id']);
  $twitterLogs = $db->showTwitterLogs($data);
 $twitterFollowerIds =  $twitter->getFollowersIds($data);

function twitterActivity($user_id , $twitterLogs) {
$status = '';
foreach($twitterLogs as $arrayitem ) {
    
    if($arrayitem['twitter_user_id'] == $user_id ) {
   // $status = $arrayitem['status']. ' on '. dateFormatChageForLastAction($arrayitem['date']);
    $status = $arrayitem['status']. ' on '. dateFormatChageForLastAction($arrayitem['date']);
    }
}
return $status;
}
function twitterIds($user_id , $twitterFollowerIds) {
$status = "";
foreach($twitterFollowerIds as $twitterid )
{
    // echo $twitterid;
    if($twitterid == $user_id )
    {
    $status = "Yes";
    
    } 
    else {
    $status = "No";    
    }
    
}
return $status;
}


// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
}
// add tweeter account

//get all tweeter Accounts

$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

$previousCursor = 0;
$nextCursor = 0;
$page = isset($_GET['page'])?$_GET['page']:1;
$currentActiveUserFollowers;
//get single tweeter account
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
$cursor = isset($_GET['cursor']) ? $_GET['cursor'] :-1;
 $data = array('accountId'=>$_GET['id'],'cursor'=>$cursor );
  $allfriendsList =  $twitter->getSelfFriends($data); 
  $allActiveFrindListUser = $allfriendsList->users;
  $nextCursor     =  $allfriendsList->next_cursor;
  $previousCursor =  $allfriendsList->previous_cursor;
}

//get single tweeter account
 
function dateFormatChage($valueDate) {
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
 
 function dateFormatChageForLastAction($valueDate) {
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
<style>
	#unfollow-table input {
	width:auto;
	}
    .table-pagination-text {
    min-width: 250px;
    border: 1px solid #04a9f3 ;
    padding: 5px;
    text-align: center;
    margin-right: 3px;
}
	.table-pagination-arrows {
    width: 30px;
    border: 1px solid #04a9f3 ;
    padding: 5px;
    margin-right: 3px;
}
	#unfollow-table_length select.form-control:not([size]):not([multiple]) {
    height: calc(2.5rem + 2px);
}
</style>

 <div class="content-wrapper">
 <section class="content-header">
      <h1>
      Unfollow 
      </h1>
       <p class="title-description">Find the targeted users and then unfollow them.    </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item active"><a href="#">Unfollow Tweets</a></li>

      </ol>
    </section>
    
     <section class="content-body">


    <article class="content grid-page">

      
 <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>


    <?php if(count($allfriendsList->users) > 0) { 
   require_once (__DIR__.'/../viral-tweets/search-critaria.php'); 
         }
   ?>
      <div class="box box-solid bg-black memberlist" >
	<div class="box-header with-border">
	     	      <h3 class="box-title">Followers List:</h3>
	     	       <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
	     	    </div>
      <div class="box-body pb-3">
    <?php if(count($allfriendsList->users) > 0) { 
    ?>
    <div class="table-responsive">
        
        <table class="table table-striped loader-table twitter-account-table twitter-follower-table" style="display:none;width: 100%;">
          <thead>
              <tr>
                <th>@User </th>
                
                <th>Location</th>
                <th>Last Tweeted</th>
                <th>Follow Back Satatus</th>
                <th>Last Activity</th>
                <th>Followers</th>
                <th>Tweet Count</th>
                <th>Followings</th>
                <th>Varified?</th>
                <th>Member since</th>
              </tr>
          </thead>
          <tbody class="twitter-account-table-body">
            <tr>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
              <tr style="height: 300px;" >
                  <td> </td>
                <td></td>
                <td ></td>
                <td></td>
                <td> </td>
                <td class="loader-img" ><img  style="padding:100px 0px" src="../../images/loader.gif" style="width:80px"></td>
               
				  <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                  
                     
                  
              </tr>
          </tbody>
           </table>
    </div>
      <div class="table-responsive" id="unfollow-table-container">
        <table id="unfollow-table" class="table table-striped table-bordered twitter-account-table table-filter twitter-follower-table" style="width: 100%;">
          <thead>
            <tr>
              <th>@User </th>
              <th>Location</th>
              <th>Last Tweeted</th>
              <th>Follow Back Status</th>
              <th>Last Activity</th>
              <th>Followers</th>
              <th>Followings</th>
              <th>Tweet Count</th>
              
              <th>Varified?</th>
              <th>Member since</th>
              
            </tr>
          </thead>

          <tbody class="twitter-account-table-body">

            <!--// created_at-->
            
            <?php foreach($allfriendsList->users as $user) { ?>
              <tr id="user-<?= $user->id; ?>">
                <td>
                  
                  <div style="display:flex;" >
                    <div >
                     <img src="<?= $user->profile_image_url; ?>"  style="min-width: 67px;border-radius: 50%;margin-right: 10px;"  class="tweeter-avatar"> 
                   </div>
                   <div  style="    text-align: left !important;" class="follower-user-name">
                    
                    <b style=" font-size: 15px; ">@<?= $user->screen_name; ?></b><br/> <span style="color:#a4a4a4"> <?= $user->name; ?><img class="loader-img-<?= $user->id; ?>" style="display:none;width:28px"; src="../../images/loader.gif" style="width:28px"></span>
                    <div style="display:flex">
                      
                      <button style="margin-right:2px" onClick="unfollowAction(this)"   user-id="<?= $user->id; ?>"  account-id="<?= $_GET['id']; ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-minus"></i> 
                        Unfollow 
                      </button>
                    </div>
                  </div>
                </div>
              </td>
              <td><?= $user->location; ?></td>
              <?php $status = $user->status; ?>
              <td>
                <?php echo  ($status  && $status->created_at) ?dateFormatChage($status->created_at):"Never Tweeted"; ?>
              </td>
              <td><?php echo twitterIds($user->id , $twitterFollowerIds); ?></td>
              <td><?php echo twitterActivity($user->id , $twitterLogs); ?></td>
              <td><?= $user->followers_count; ?></td>
              <td><?= $user->friends_count; ?></td>
              <td><?= $user->statuses_count; ?></td>
            <td><?= ($user->verified == true)?"Yes":"No"; ?></td>
              <td><?= date("Y", strtotime($user->created_at)); ?> </td>
              
            </tr>
          <?php } ?>
        </tbody>
      </table>
      
    </div>
  <?php } ?>

</div>
</div>


         <br/>
         <br/>
         <?php if(count($allfriendsList->users) > 0) { ?>
<div class="row">
    <div class="col-md-4 "></div>
    <div style="display:flex" class="col-md-4 col-sm-12 tweeter-follower-table-pagination">
        <?php 
       $previouspage = $page-1;
       $nextpage = $page+1;
        ?>
        <div class="table-pagination-arrows">
            <?php if($previousCursor != 0) { ?>
            <a href="<?php echo $common->getUrl($common->getUrl($_SERVER['REQUEST_URI'], 'cursor' , $previousCursor , '') , 'page', $previouspage ); ?>" >
                <i class="fa fa-backward"></i>
            </a>
            <?php } else { ?>
            <i class="fa fa-backward" style="color:#d4d4d4" data-toggle="tooltip" data-placement="top" title="No Previous Page"></i>
            <?php } ?>
            </div>
        <div class="table-pagination-text">Page <?= $page; ?> - <?= $page * count($allfriendsList->users); ?></div>
        <div class="table-pagination-arrows">
            <?php if($nextCursor != 0) { ?>
            <a href="<?php echo $common->getUrl($common->getUrl($_SERVER['REQUEST_URI'], 'cursor' , $nextCursor , ''), 'page' , $nextpage ); ?>">
                <i class="fa fa-forward "></i>
                </a>
                <?php } else { ?>
                <i class="fa fa-forward" style="color:#d4d4d4" data-toggle="tooltip" data-placement="top" title="No Next Page" ></i>
                <?php } ?>
                </div>
    </div>
    <div class="col-md-4 "></div>
</div>
<?php } ?>
        </section>
     
     
         </article>
              </section>
    </div>
<script src="<?= $baseUrl; ?>/js/viral-tweet/filterChange.js"></script>
<script>
     function unfollowAction(attr) {
        var $this = attr;
        var userId = $(attr).attr('user-id');
        var accountId = $(attr).attr('account-id');
        var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/unfollowUserProcess.php?user-id="+userId+"&account-id="+accountId,
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
  }
}
$('.loader-img-'+userId).html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">'); 

$.ajax(settings).done(function (response) {
    var resp = JSON.parse(response);
    if(resp.success == true) {
             $('.loader-img-'+userId).html('<strong>Not Found</strong>'); 
            refreshAccountDetail(accountId);
             $('#user-'+userId).hide('slow');

    } else {
        alert('There is issue.  please try agian');
    }

});
}


function refreshAccountDetail(userId) {
        var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/showAccountProcess.php?id="+userId,
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
  }
}

$.ajax(settings).done(function (response) {
    var resp = JSON.parse(response);
    $('#account-statuses-count').html(resp.statuses_count);
    $('#account-follower-count').html(resp.followers_count);
    $('#account-friends-count').html(resp.friends_count);
   
}); 
}




 $(document).ready(function(){
     //$('.table-responsive').doubleScroll();
});
//search criter

        
$(document).ready(function() {
    
    // Setup - add a text input to each footer cell
    $('#unfollow-table thead tr').clone(true).appendTo( '#unfollow-table thead' );
    $('#unfollow-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#unfollow-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

 $('#unfollow-table_filter').css('display', 'none');
} );



<!-- this filterchange.js is used when  filter change occur and show different filter fields accordingly-->

    //search criter
function filterCriteriaAction(filterArray) {
$('.table-filter').css('display','none');
$('.loader-table').css('display','');
$('.loader-img').html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">');
$('#unfollow-table_length').css('display','none');
var filterListingArray = JSON.stringify(filterArray);
var activeFollowUsersFollowersList = <?php echo json_encode($allActiveFrindListUser); ?>;
activeFollowUsersFollowersList = JSON.stringify(activeFollowUsersFollowersList);

var twitterFollowerIds = <?php echo json_encode($twitterFollowerIds); ?>;
twitterFollowerIds = JSON.stringify(twitterFollowerIds);

var twitterLogs = <?php echo json_encode($twitterLogs); ?>;
twitterLogs = JSON.stringify(twitterLogs);

var table = $('#unfollow-table').DataTable();
    table.clear();

var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/filterCriteriaProcess.php",
  "method": "POST",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
  },
  "data": {
    "filterArray": filterListingArray,
    "activeFollowUsersFollowersList": activeFollowUsersFollowersList,
    "twitterFollowerIds":twitterFollowerIds,
    "twitterLogs" : twitterLogs
  }
}
$.ajax(settings).done(function (response) {
   $('.loader-table').css('display','none');
    var resp = JSON.parse(response);
   if(resp && resp.length > 0) {
    
     var html = '';
     
        html += "<table id='unfollow-table' class='table table-striped table-bordered table twitter-account-table table-filter twitter-follower-table' style='width: 100%;'>";
        html += "<thead>";
        html += "<tr>";
        html += "<th>@User </th>";
        html += "<th>Location</th>";
        html += "<th>Last Tweeted</th>";
        html += "<th>Follow Back Status</th>";
        html += "<th>Last Activity</th>";
        html += "<th>Followers</th>";
        html += "<th>Followings</th>";
        html += "<th>Tweet Count</th>";
        html += "<th>Varified?</th>";
        html += "<th>Member since</th>";
              
        html += "</tr>";
        html += "</thead>";

        html += "<tbody class='twitter-account-table-body'>";
        
    $.each( resp, function( index, user ) {
       html += "<tr id='user-"+user.id +"'>";
       html += "<td><div style='display:flex;' ><div ><img src="+user.profile_image_url+"  style='min-width: 67px;border-radius: 50%;margin-right: 10px;' class='tweeter-avatar'> </div> <div style='text-align:left;' class='follower-user-name'><b style=' font-size: 15px; '>@"+user.screen_name+"</b> <span style='color:#a4a4a4'>"+user.name+" <img class='loader-img-"+user.id +"' style='display:none;width:28px;' src='../../images/loader.gif' style='width:28px;'></span><div style='display:flex'><button style='margin-right:2px' onClick='unfollowAction(this)'   user-id='"+user.id+"'  account-id='<?= $_GET['id']; ?>' class='btn btn-primary btn-sm'> <i class='fa fa-minus'></i> Unfollow </button></div></div></div></td>";
    
       html += "<td>"+user.location+"</td>";
      var status = user.status;
        html += "<td>";
        if(status) {
        html += status.created_at; 
        } else {
            html += 'Never Tweeted'; 
        }
        html += "</td>";

        html += "<td>"+user.back_status+"</td>";
        html +="<td>"+user.last_activity+"</td>";
        html += "<td>"+user.followers_count+"</td>";
        html += "<td>"+user.friends_count+"</td>";
        html +="<td>"+user.statuses_count+"</td>";
       
        if(user.verified) {
        html += "<td>Yes</td>";
        } else {
             html += "<td>No</td>";
        }
        html += "<td> "+user.created_at+"</td>";
       
       html += "</tr>";
 
}); 
html += "</tbody>";
html += "</table>";


 $('#unfollow-table-container').html("");
    $('#unfollow-table-container').html(html);
    //data table

  // Setup - add a text input to each footer cell
    $('#unfollow-table thead tr').clone(true).appendTo( '#unfollow-table thead' );
    $('#unfollow-table thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input class="form-control datatable-input" type="text" placeholder="Search '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 
    var table = $('#unfollow-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

 $('#unfollow-table_filter').css('display', 'none');
//data table    
$('#unfollow-table_length').css('display','');
    $('.loader-table').css('display','none');
    $('.table-filter').css('display','');
    $('#unfollow-table').DataTable();
       
   } else {
    $('.loader-table').css('display','');
    $('.loader-img').html("");
    $('.loader-img').html("<strong>Not Found</strong>");
    
}

  });
}
$('document').ready(function()
{
    $('.datatable-input').css("width","auto");
     var fontSize = '13px';
    var styleContent = '.datatable-input:-moz-placeholder {font-size:' + fontSize + ';} .datatable-input::-webkit-input-placeholder {font-size:' + fontSize + ';}';
    var styleBlock = '<style id="placeholder-style">' + styleContent + '</style>';
    $('head').append(styleBlock);
});
</script>
<?php include_once './../includes/main_footer.php'; ?>
