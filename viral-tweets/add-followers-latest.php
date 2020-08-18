<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');
$currentpage = "follow";
require_once (__DIR__.'/../includes/main-header.php');
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/dbConnect.php');

$db = new dbConnect();
$twitter = new TwitterSetting();
$common = new CommonHepler();
// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
}
$data = array('accountId'=>$_GET['id']);
$twitterLogs = $db->showTwitterLogs($data);
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

function dateFormatChageForLastAction($valueDate) {
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

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Today");

 }
// add tweeter account

//get all tweeter Accounts

$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

//get single tweeter account 
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
 
}

//get single tweeter account
 
 //search followers
 
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

 //search followers

?>
<style>


.followBackFollowpage
{
    display:none;
}
td
{
    text-align:center;
}
 th {
    padding: 0.9rem;
}    

    @media only screen and (max-width: 600px) {
        .blnc_res {
            width: 60%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }

    @media only screen and (max-width: 320px) {
        .blnc_res {
            width: 80%;
            margin-left: 5%;
            margin-bottom: 40px;
        }
        .btn_ref{
            margin-right: 37%;
        }
    }
</style>


     <div class="content-wrapper">
 <section class="content-header">
      <h1>
      Add Followers 
      </h1>
      
       <p class="title-description">Find the targeted users and then follow them.   </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item active"> Add Followers</li>
      </ol>
    </section>
 <section class="content-body">
     
         <article class="content grid-page">

      

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>
         
         
                 <h5>Select what you want to do:</h5>
<ul class="nav nav-tabs followers-tabs search-tabs followers-tabs ">
  <li onClick="changeTab(this)" tab="hashtag" class="nav-item">
       <span class="nav-link <?= (isset($_GET['type']) && $_GET['type']=='hashtag')?'active': (isset($_GET['type']) && $_GET['type']=='username')?'':'active' ?>">#Hashtag</span> </li>
  <li onClick="changeTab(this)" class="nav-item" tab="username"><span class="nav-link <?= (isset($_GET['type']) && $_GET['type']=='username')?'active':'' ?>">User Name</span></li>
</ul>

<div class="row">
    <div class="box box-link-pop text-center">
				<div class="box-body py-25">
                <form action="" method="GET">
                     <input type="hidden"  name="id" value="<?= $_GET['id'] ?>" />
  <input type="hidden"  name="type" id="follower-search-type" value="hashtag" />
  
                        <div style="margin-top:12px;" class="form-group col-md-12">
                        
                         <div class="form-group" id="hashtag-follower-search"  <?= (isset($_GET['type']) && $_GET['type']=='hashtag')?'':(isset($_GET['type']) && $_GET['type']=='username')?'style="display:none;"':''; ?> >
                <!--<label>Keywords (returns a collection of relevant Tweets matching a specified query.</label>-->
                <div class="input-group">
                <input type="text" value="<?php  if($_GET['type'] =='hashtag'){echo  $_GET['tags'];} ?>" class="form-control" name="tags" data-role="tagsinput" placeholder ="eg: #happybirthday"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" style="border-radius: 0px; color: white; padding: 8px 16px;">
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  
  
  
  <!--user name search-->
    <div class="form-group" id="username-follower-search" <?= (isset($_GET['type']) && $_GET['type']=='username')?'':(isset($_GET['type']) && $_GET['type']=='hashtag')?'style="display:none;"':'style="display:none;"'; ?>  >

                <div class="input-group">
                <input type="text" class="form-control" name="usernames" data-role="tagsinput" placeholder ="eg: @barackobama"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" style="border-radius: 0px; color: white; padding: 8px 16px;">
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  <!--user name search end-->
 
                            <!--<label>Keywords (returns a collection of relevant Tweets matching a specified query.</label>-->
                            <!--<div class="input-group">-->
                            <!--    <input name="id" type="hidden" value="<?php echo $twitterSingleDetail['id']; ?>" class="form-control">-->
                            <!--    <input name="keywords" type="text" value="<?php echo $keywords; ?>" class="form-control">-->

                            <!--    <span class="input-group-btn" style="font-size: 20px;">-->
                            <!--        <button class="btn btn-primary btnActionTwitterSearch" style="border-radius: 0px; color: white; padding: 8px 16px;">-->
                            <!--            <i class="fa fa-search"></i>-->
                            <!--        </button>-->
                            <!--    </span>-->
                            <!--</div>-->
                        </div>
                    </form>
				</div>
			</div>


</div>













<!--hashag form-->
<div class="row">
    <div class="col-md-12">
<br/>
<form action="" method="GET">
 <input type="hidden"  name="id" value="<?= $_GET['id'] ?>" />
  <input type="hidden"  name="type" id="follower-search-type" value="hashtag" />

  
  <div class="form-group" id="hashtag-follower-search"  <?= (isset($_GET['type']) && $_GET['type']=='hashtag')?'':(isset($_GET['type']) && $_GET['type']=='username')?'style="display:none;"':''; ?> >
                <!--<label>Keywords (returns a collection of relevant Tweets matching a specified query.</label>-->
                <div class="input-group">
                <input type="text" value="<?php  if($_GET['type'] =='hashtag'){echo  $_GET['tags'];} ?>" class="form-control" name="tags" data-role="tagsinput" placeholder ="eg: #happybirthday"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" style="border-radius: 0px; color: white; padding: 8px 16px;">
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  
  
  
  <!--user name search-->
    <div class="form-group" id="username-follower-search" <?= (isset($_GET['type']) && $_GET['type']=='username')?'':(isset($_GET['type']) && $_GET['type']=='hashtag')?'style="display:none;"':'style="display:none;"'; ?>  >

                <div class="input-group">
                <input type="text" class="form-control" name="usernames" data-role="tagsinput" placeholder ="eg: @barackobama"/>
                  <span class="input-group-btn" style="font-size: 20px;">
                      <button class="btn btn-primary btnActionTwitterSearch" type="submit" name="submit" style="border-radius: 0px; color: white; padding: 8px 16px;">
                        <i class="fa fa-search"></i>
                     </button>
                  </span>
                </div>
              </div>
  <!--user name search end-->
        </form>
    </div>
</div>
<!--hashag form-->
         
      </section>
      </article>
     </section>
     </div>
     



<?php require_once (__DIR__.'/../includes/footer.php'); ?>
<script>
    function changeTab(attrubute) {
        $('.followers-tabs li').removeClass('active');
        $('#follower-search-type').val($(attrubute).attr('tab'))
        if($(attrubute).attr('tab') == 'hashtag') {
            $('#hashtag-follower-search').css('display', 'block');
            $('#username-follower-search').css('display', 'none');
            
        } else if ($(attrubute).attr('tab') == 'username') {
            $('#hashtag-follower-search').css('display', 'none');
            $('#username-follower-search').css('display', 'block');
        }
        $(attrubute).addClass("active");

    }
    $(document).ready(function(){
    // $('.table-responsive').doubleScroll();
     
});
   
</script>


<script>
    function addFollowAction(attr) {
        var $this = attr;
        var userId = $(attr).attr('user-id');
        var accountId = $(attr).attr('account-id');
        var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/followUserProcess.php?user-id="+userId+"&account-id="+accountId,
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
        //$(attr).parent().closest('tr').css('display', 'none');
        addFollowList($this , "followed")
    } else {
        alert('There is issue.  please try agian');
    }

});
    }
    
    function addFollowList(attr , type="Added") {
 

          var listId =  $(attr).attr('list-id');
     var slug = $(attr).attr('slug');
     var userId = $(attr).attr('user-id');
     var userName = $(attr).attr('user-name');
     var screenName = $(attr).attr('screen-name');
     var accountId = $(attr).attr('account-id');
     var listUrl = $(attr).attr('list-url');
            $('.loader-img-'+userId).html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">'); 
            $('.loader-img-'+userId).css('width', '28px'); 
    var settings = {
  "async": true,
  "crossDomain": true,
  "url": "action/addMamberInlistProcess.php?account-id="+accountId+"&list-id="+listId+"&slug="+slug+"&user-id="+userId+"&screen-name="+screenName,
  "method": "GET",
  "headers": {
    "cache-control": "no-cache",
    "postman-token": "e07095b9-ad0a-050c-397b-7dcbaf25defd"
  }
}
    $.ajax(settings).done(function (response) {
     var resp = JSON.parse(response);
     $('#twitter-member-user').append(resp.member_count);
     
     $('#user-'+userId).hide('slow');
    $('.loader-img-'+userId).html('<strong>Not Found</strong>');    
     $('body').cornerpopup({
    'variant': 9,
    shadow: 1,
    timeout: 5000000000,
    delay: 10,
    colors:"#85ce36",
    header: userName+ " has been "+type,
    button3:"View list on twitter",
     // link for other popups
    link2:"https://twitter.com"+listUrl+"/members",

    
    text2:'Added '+resp.member_count+'  @users to Twitter list',


});
setTimeout(function(){ $('.corner-btn-close').attr('target','_blank'); }, 0);
    });
     
 }
   
   function onClose() {
    $('#follow-list-text').css('display' , 'none');  
 }
</script>

<script>
    var url = '';
    $("select.select-follow-user").change(function(){
        var screen_name = $(this).children("option:selected").val();
        url = new URL(window.location.href);
        url.searchParams.set('usernames',screen_name);
        $(location).attr('href',url.href);

    });
</script>

<script>
    $(document).ready(function(){
    //    $('.corner-btn-close').attr('target','_blank');
    })
</script>


<script>

//search criter
</script>
<script>
$(document).ready(function() {
    
    // Setup - add a text input to each footer cell
    $('#follow-user-table thead tr').clone(true).appendTo( '#follow-user-table thead' );
    $('#follow-user-table thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#follow-user-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

 $('#follow-user-table_filter').css('display', 'none');
} );
    $(document).ready(function() {
        
         $('#follow-tags-table thead tr').clone(true).appendTo( '#follow-tags-table thead' );
    $('#follow-tags-table thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#follow-tags-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );
    $('#follow-tags-table_filter').css('display', 'none');
} );
</script>
<script>
    
//search criter
function filterCriteriaAction(filterArray) {
$('.table-filter').css('display','none');
$('.loader-table').css('display','block');
$('.loader-img').html('<img  style="width:80px;" src="../../images/loader.gif" style="width:80px">');
$('#follow-user-table_length').css('display','none');
$('#follow-tags-table_length').css('display','none');
var filterListingArray = JSON.stringify(filterArray);
var type = "<?= $_GET['type']; ?>";
if(type == "username") {
var activeFollowUsersFollowersList = <?php echo json_encode($activeFollowUsersFollowersList); ?>;
activeFollowUsersFollowersList = JSON.stringify(activeFollowUsersFollowersList);

    
}
if(type == "hashtag") {
var activeFollowUsersFollowersList = <?php echo json_encode($tagsUsers); ?>;
activeFollowUsersFollowersList = JSON.stringify(activeFollowUsersFollowersList);
}

var twitterLogs = <?php echo json_encode($twitterLogs); ?>;
twitterLogs = JSON.stringify(twitterLogs);

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
    "twitterLogs" : twitterLogs,
    "type":type
  }
}
$.ajax(settings).done(function (response) {
   var resp = JSON.parse(response);
     if(resp && resp.length > 0) {

    var html = '';
        if(type == "username") {
        html += "<table id='follow-user-table' class='table twitter-account-table twitter-follower-table' style='width: 100%;'>";
        }
        if(type == "hashtag") {
        html += "<table id='follow-tags-table' class='table twitter-account-table twitter-follower-table' style='width: 100%;'>";
        }
        html += "<thead>";
        html += "<tr>";
        html += "<th>@User </th>";
        html += "<th>Bio</th>";
        html += "<th>Location</th>";
        html += "<th>Last Tweeted</th>";
        html += "<th>Last Activity</th>";
        html += "<th>Followers</th>";
        html += "<th>Followings</th>";
        html += "<th>Tweet Count</th>";
       
        html += "<th>Varified?</th>";
        html += "<th>Member since</th>";
        html += "</tr>";
        html += "</thead>";
        html += "<tbody class='twitter-account-table-body-username'>";
        
   $.each( resp, function( index, user ) {
       html += "<tr id='user-"+user.id +"'>";
       html += "<td><div style='display:flex;' ><div ><img src="+user.profile_image_url+" style='min-width:70px;' class='tweeter-avatar'> </div> <div class='follower-user-name'><b>@"+user.screen_name+"</b> <span style='color:#a4a4a4'>"+user.name+" <img class='loader-img-"+user.id +"' style='display:none;width:28px;' src='../../images/loader.gif' style='width:28px;'></span><div style='display:flex'><button style='margin-right:2px' onClick='addFollowAction(this)' list-id='<?= $twitterSingleDetail['followed_list_data']->id; ?>' list-url='<?= $twitterSingleDetail['followed_list_data']->uri; ?>' slug='<?= $twitterSingleDetail['followed_list_data']->slug; ?>'   user-name="+user.name+" user-id="+user.id+" screen-name="+user.screen_name+" account-id='<?= $_GET['id']; ?>' class='btn btn-primary btn-sm'><i class='fa fa-plus'></i> Follow </button><button onCLick='addFollowList(this)' list-id='<?= $twitterSingleDetail['list_data']->id; ?>' slug='<?= $twitterSingleDetail['list_data']->slug; ?>'  list-url='<?= $twitterSingleDetail['list_data']->uri; ?>'  user-name="+user.name+" user-id="+user.id+" screen-name="+user.screen_name+" account-id='<?= $_GET['id']; ?>' class='btn btn-primary btn-sm'><i class='fa fa-plus'></i> Follow List</button></div></div></div></td>";
       html += "<td>"+user.description+"</td>";
       html += "<td>"+user.location+"</td>";
        var status = user.status;
        html += "<td>";
        if(status) {
        html += status.created_at; 
        } else {
            html += 'Never Tweeted'; 
        }
        html += "</td>";
        html +="<td>"+user.last_activity+"</td>";
        html += "<td>"+user.followers_count+"</td>";
        html += "<td>"+user.friends_count+"</td>";
        html += "<td>"+user.statuses_count+"</td>";
        
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
if(type == "username") {

     $('#follow-user-table-container').html("");
    $('#follow-user-table-container').html(html);
    $('#follow-user-table thead tr').clone(true).appendTo( '#follow-user-table thead' );
    $('#follow-user-table thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#follow-user-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );

    $('#follow-user-table_filter').css('display', 'none');
    $('.loader-table').css('display','none');
$('#follow-user-table_length').css('display','block');

    $('.table-filter.username').css('display','block');
} else if(type == "hashtag"){
        $('#follow-tags-table-container').html("");
        $('#follow-tags-table-container').html(html);
        //data table
             $('#follow-tags-table thead tr').clone(true).appendTo( '#follow-tags-table thead' );
    $('#follow-tags-table thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#follow-tags-table').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
         "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
    } );
         //data table
        $('#follow-tags-table_filter').css('display', 'none');
        $('.table-filter.hashtag').css('display','block');
        $('.loader-table').css('display','none');
        $('#follow-tags-table_length').css('display','block');

}
}
else {
    $('.table-filter.hashtag').css('display','none');
        $('.table-filter.username').css('display','none');
  $('.loader-table').css('display','block');
    $('.loader-img').html('<strong>Not Found</strong>');
    }
    
  });
  

}
$('document').ready(function()
{
    $('.datatable-input').css("width","auto");
     var fontSize = '13px';
    var styleContent = '.datatable-input:-moz-placeholder {font-size:' + fontSize + ';} .datatable-input::-webkit-input-placeholder {font-size:' + fontSize + ';}';
    var styleBlock = '<style id="placeholder-style-addfollower">' + styleContent + '</style>';
    $('head').append(styleBlock);
});
</script>
<!-- this filterchange.js is used when  filter change occur and show different filter fields accordingly-->
<script src="<?= $baseUrl; ?>/js/viral-tweet/filterChange.js"></script>

