<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

include_once './../includes/main-header.php'; 
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/dbConnect.php');
$twitter = new TwitterSetting();
$db = new dbConnect();
// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
}
// add tweeter account

//get all tweeter Accounts

$alltwitterAccountDetail = $twitter->getAccountDetails();
$data = $_GET['id'] ;
//get all tweeter accounts
$response =$db->showTweets($data);
//get single tweeter account 
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
 
}

//get single tweeter account
 

?>
<style>
.table_head .filter-search{
        margin: 0;
}
.icon_crud{
    font-size: 17px;
    margin-left: 5%;
}
.icon_crud i.fa-pencil{
    color: #2fafd8;
}
.icon_crud i.fa-eye{
   color: #0cce0c;
}
.icon_crud i.fa-trash{
      color: #f72020;
}

.filter-search{
        padding: 10px 10px !important;
    height: 2.1rem;
}
#example_length label {
    font-weight: 300;
    font-size: 17px;
}
input[type=search]{
    height: 2.3rem;
}
#example_filter label {
    font-weight: 300;
    font-size: 17px;
}
select.form-control:not([size]):not([multiple]) {
    height: calc(1.9rem + 2px);
}

.modal-backdrop.in{
    display:none;
}
.modal-backdrop.show {
    display: none;
}
.table-hover tbody tr:hover {
    background-color: #fff;
    box-shadow: 0 2px 30px #dee2e5;
    -webkit-transform: translateY(-3px);
    transform: translateY(-3px);
    opacity: 1;
}
.bg-yellow th{
  text-align: inherit;
    color: #fff !important;
    font-size: 1.1rem;
}
.table tbody tr td {
    vertical-align: middle;
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
      Tweets 
      </h1>
       <p class="title-description">Add New Tweet / category / Schedule Tweet / Reweet Tweet.   </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item "><a href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">Viral Tweets Services</a></li>
         <li class="breadcrumb-item "><a href="add-tweet-services.php?id=<?= $_GET['id'] ?>">Add Tweet Services</a></li>
          <li class="breadcrumb-item active">Tweets</li>
      </ol>
    </section>
 <section class="content-body">


    <article class="content grid-page">

      

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>

        <div style="margin-bottom: 18px;" class="row">
            <div class="col-md-6">
                <a href="add-tweet-services.php?id=<?= $twitterSingleDetail['id']; ?>" class="btn btn-primary"><i class="serviceicon fa fa-arrow-left"></i>Back to tweet services</a>
            </div>
            <div class="col-md-6">
                <a style="float: right;margin: 4px;" href="add-tweets-category.php?id=<?= $twitterSingleDetail['id']; ?>" class="btn btn-primary">Add New Catetory</a>
                  <a style="float: right;margin: 4px;" href="add-tweet.php?id=<?= $twitterSingleDetail['id']; ?>" class="btn btn-primary">Add New Tweet</a>
            </div>
        </div>
        
         <div class="box box-solid bg-black">
	     	<div class="box-header with-border">
	     	      <h3 class="box-title">Schedule Tweets</h3>
	     	      <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
	     	    </div>
	     	    	<div class="box-body">
	     	      	   	<div class="table-responsive">
	     	      	   	    <table id="example"  class="table twitter-account-table table-bordered table-striped no-margin  ">
				                  <thead >
							<tr >
					  <th class="table_head">Tweet type </th>
                <th class="table_head">Category</th>
                <th class="table_head">Caption</th>
                <th class="table_head">Created On</th>
                <!--<th>Published On</th>-->
                <th  class="table_head">Status</th>
                <th  class="table_head">Action</th>   
							</tr>
						  </thead>
						 <tbody class="twitter-account-table-body">
             <?php foreach($response as $value)
             {      if($value['status'] == 1) {
                 ?>
              <tr id="twitter-detail-<?= $value['id'] ?>" class="twitter_body_details" >
                  <td><?= $value['type'] ?></td>
                  <td><?= $value['name']?></td>
                  <?php $data = json_decode($value['caption']); ?>
                  
                  <td>
                      <?php echo (strlen($data->caption) >=20)?substr($data->caption,0,20).'...':$data->caption; ?></td>
                  <?php $date = date_create($value['time_post']);
                  if(checkdate(date_format($date,"m"),date_format($date,"d"),date_format($date,"Y")) == true) {  ?>
                  <td>
                  <?= date_format($date,"F j, Y, g:i a"); ?>
                  </td>
                  <?php }
                  else {?>
                  <td></td>
                  <?php } ?>
                  <td><?= $value['result']; ?></td>
                  
                  <td><a href="#" class="icon_crud icon-edit" row-id="<?= $value['id'] ?>" tweet-id="<?= $value['tweet_id'] ?>" data-toggle="modal" data-target="#tweet-details" data-toggle="tooltip" onclick="tweetDetail(this)" data-placement="top" title="View Details"><i class="fa fa-eye" aria-hidden="true"></i></a>
                             <a href="add-tweet.php?id=<?= $_GET['id'] ?>&tweetid=<?= $value['id'] ?>"  class="icon_crud icon-edit"  data-toggle="tooltip" data-placement="top" title="Edit Post"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <!--trash-->
                       <a id="<?= $value['id']; ?>"  class="icon_crud icon-delete"  data-toggle="tooltip" data-placement="top" onclick="deletePost(this)" title="Delete Post"><i  class="fa fa-trash"></i></a>
                  </td>
              </tr>
              <?php
             }
                 
             }
             ?>
         </tbody> 
						 
						 </table> 
              <div class="modal" id="tweet-details" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onClick="onClose()">&times;</button>
                <h4 class="modal-title">Tweet content</h4> </div>
             <div style="min-height:300px;" class="modal-body ">
                <div class=" model-body-data">
                <div  class="col-md-12 alert alert-success alert-model" style="display:none; padding-top: 7px;padding-bottom: 14px;"role="alert">
  <strong>Retweeted Successfully!  </strong> 
  <div style="float: right;">
  <a  screenname="<?php echo $twitterSingleDetail['screen_name'];  ?>" target="_blank" onclick="viewTweetDetail(this)" style="width: 101px;color: #85ce36 !important;background: #fff;font-weight: 600;" class="btn-modal btn-view-detail btn-views btn btn-default btn-sm btn-rounded">View in Twiter</a>
  <a  onclick="viewedit(this)" target="_blank" style="width: 101px;color: #85ce36 !important;background: #fff;font-weight: 600;"  class="btn-modal btn-view-detail btn-edit btn btn-default btn-sm btn-rounded">Edit retweet</a>
 </div>
</div>
                <div class="col-md-12 alert alert-danger alert-dang" style="display:none;"><strong>You Already Retweeted</strong></div>
                <div class="row col-md-12">
                    <div  style='min-height: 176px;border: 1px solid #85ce36;border-radius: 7px;padding: 20px;display:none;width: 100%;'  class="tweet-saved-details col-md-12">
                        <div style="display:flex">
                        <img style="border-radius:50%;" src="<?php echo $twitterSingleDetail['avatar'];  ?>"   />
                         <div style="margin-left:2%;color: #6b7886b5;"><b><?php echo $twitterSingleDetail['data_profile']->name;  ?></b>
                         <br/>
                         
                         <span><?= $twitterSingleDetail['screen_name']; ?></span>
                         </div>
                         </div>
                         <div class="show-tweetdata-details ">
                             
                         </div>
                    </div>
                <div class="show-tweet-details col-md-10 col-sm-10 col-xs-10 ">
                </div>
                <div class="col-md-2 col-sm-2 col-xs-2 " style="padding: 0;padding-top: 10px;float:right;" >
                    <a style="width: 101px;color: #fff !important;margin-bottom:6px;" onclick="retweet(this)" id="reTweetid" class="btn-modal btn btn-primary btn-sm btn-rounded btn-view-detail"><i class="fa fa-retweet" style="margin-right: 6px;" aria-hidden="true"></i>Retweet</a>
                    <a style="width: 101px;color: #fff !important;" id="viewTweet" target="_blank" class="btn-modal btn btn-primary btn-sm btn-rounded">View in Twiter</a>
                    
                </div>
            </div>
            </div>
            </div>
            <div style="border-top: none;" class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="onClose()">Close</button>
            </div>
        </div>
    </div>
</div>
                    </div>
                </div>
        
     

        </section>

    </article>
    </section>
    </div>
<?php include_once './../includes/main_footer.php'; ?>
<script>
function deletePost(attr)
{
    id = $(attr).attr('id');
//    console.log(id);
  accountid = <?= $_GET['id']; ?>;
  var settings = {
  "url": "action/deletePostProcess.php?id="+id+"&account_id="+accountid,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
};

$.ajax(settings).done(function (response) {
 
  response = JSON.parse(response);
  if(response.success == true)
  {
    		
			  $('#twitter-detail-'+id).hide("slow");
    
  }
});
    
}
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
     if(title != "Action") 
     {   
        $(this).html( '<input class="form-control filter-search" type="text" placeholder="Search '+title+'"  />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    }
    else{
         $(this).html( '' );
 
    }
    } );
    
 
    var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );
function tweetDetail(attr)
{
      $('.alert-dang').css("display","none");
    $(".alert-model").css("display","none");
    $('.model-body-data').css("display","none");
    $('.tweet-saved-details').css("display","none");
    $('.show-tweet-details').css("display","none");
    var tweetId =  $(attr).attr('tweet-id');
    var id =  $(attr).attr('row-id');
    var accountId = "<?= $_GET['id']; ?>" ;
  var screenName = "<?= $twitterSingleDetail['screen_name']; ?>";
     $('#reTweetid').attr("retweet_id",tweetId);
     $('#retweet-icon').attr("retweet_id",tweetId);
  var settings = {
  "url": "action/viewTweetDetailProcess.php?tweetid="+tweetId+"&account-id="+accountId+"&screenName="+screenName+"&postid="+id,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
};

$.ajax(settings).done(function (response) {
    data = JSON.parse(response);
    html="";
    if(tweetId != 0){
         html = data.html;
        url = data.url;
        $('#viewTweet').attr("href",url);
        $('.show-tweet-details').css('display','block');
        $('.show-tweet-details').html(html);
        $('#reTweetid').css('display','block');
        $('#viewTweet').css('display','block');
         $('.model-body-data').css("display","block");
         $('#viewTweet').attr("href",url);
    }
    else
    {
    $('.tweet-saved-details').css("display","block");   
        datailmedia = data.data;
        datailmedia =JSON.parse(datailmedia);
        html += "<div  class='container'>";
        html += "<div style='margin-top:4%;'><span style='margin-left:1%;'>"+datailmedia.caption+"</span></div>";
        html += "<div style='display:flex;' class='col-md-12'>";
    //   console.log(data.type);
       if(data.type == "video")
        {
            html += "<video class='col-md-12' src='"+datailmedia.media+"' controls></video>";
        }
        else if(data.type == "image") {
        if(datailmedia.media.length != 0)
        {
        $.each(datailmedia.media, function(index,value) {
        html += "<div><img class='img-fluid img-thumbnail' src='"+value+"'></div>";
    
        });
        }
        }
        html += "</div>";
        html+="</div>";
        //console.log(html);
            $('#reTweetid').css('display','none');
            $('#viewTweet').css('display','none');
             $('.model-body-data').css("display","block");
        $('.show-tweetdata-details').css('display','block');
    $('.show-tweetdata-details').html(html);
        }
    
});
}
 function retweet(attr) {
      var tweetId =  $(attr).attr('retweet_id');
     var accountId = "<?= $_GET['id']; ?>" ;
  console.log(tweetId);
  console.log(accountId);

var settings = {
  "url": "action/retweetProcess.php?account-id="+accountId+"&tweet-id="+tweetId,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
};

$.ajax(settings).done(function (response) {
 console.log(response);
  data = JSON.parse(response);
    if(data.success == true) {
    $('alert-dang').css("display","none");
    $(".alert-model").css("display","block");
    lastid = data.data.data.last_id;
    id = data.data.data.tweet_account_id;
    $('.btn-views').attr("acount_id",id);
    $('.btn-edit').attr("lastid",lastid);
     //   console.log(id);
        
    } else if(data.success == false){
        $(".alert-model").css("display","none");
        $('.alert-dang').css("display","block");
        //console.log(data.message);
    }
});
    
}
function viewedit(attr)
{
    account_id = "<?php echo $_GET['id']; ?>"
     id = $(attr).attr('lastid');
     url = "add-tweet.php?id="+account_id+"&tweetid="+id;
     
     $(attr).attr('href',url);
    
}
function viewTweetDetail(attr)
{
    screenName = $(attr).attr('screenname');
     id = $(attr).attr('acount_id');
     url = "https://twitter.com/"+screenName+"/status/"+id;
     $(attr).attr('href',url);
    
}
function onClose() {
    $('#tweet-details').css('display' , 'none');  
 }
</script>
