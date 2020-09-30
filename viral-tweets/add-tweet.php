<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

include_once './../includes/main-header.php'; 
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once(__DIR__.'/../_libs/dbConnect.php');
require_once (__DIR__.'/../_libs/contant.php');


$paid_levels = "SELECT * FROM  `subscribed_levels` WHERE  `sender_ibm` =  '".$_SESSION['user']['ibm']."' AND  `payment_status` =  '1'";
$all_level   = $newsifyObj->db_select($paid_levels);
$paid_levels =  $all_level->num_rows;
 $twitter = new TwitterSetting();
$db = new dbConnect();
$paid_facility_list = $db->paidmembers();
// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
}
// add tweeter account

//get all tweeter Accounts
if($_GET['tweetid'] && $_GET['id'] )
{
    $tweetid  = $_GET['tweetid'];
    $acountid = $_GET['id'];
    $tweetdata = $db->showSingleTweet($acountid ,$tweetid );
}
$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

//get single tweeter account 
if(isset($_GET['id'])) {
  $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
 
}
$record = array();

//get single tweeter account
$allcategroies = $db->showTweetCatagories($_GET['id']); 
$error= false;
$showalert = false;
if($_GET['error'] == 'true')
{   $error = true;

}
if($_GET['status'] == 'true')
{
$showalert = true;
$message = $_GET['message'];
    
}

?>
<style>
.modal-backdrop.show{

    display: none !important;
}
h2.heighlight-text {
  display: table;
  font-size: 30px;
    padding: 1px 10px;
    color: #9e9e9e;
  white-space: nowrap;
}
h2.heighlight-text:before,
h2.heighlight-text:after {
  border-top: 1px solid #b7b7b7;
  content: '';
  display: table-cell;
  position: relative;
  top: 0.5em;
  width: 46%;
}
h2.heighlight-text:before {
  right: 1.5%;
}
h2.heighlight-text:after {
  left: 1.5%;
}

[type=checkbox]:checked, [type=checkbox]:not(:checked) {
    position: absolute;
    left: 23px;
    opacity: 0;
    z-index: 999;
}

input#shedule {
    margin-left: 0;
}
.browse
{
    margin-bottom:0% !important;
}

.file {
  visibility: hidden;
  position: absolute;
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
    ul.typetabs
{
    display: flex;
    /*border: 1px solid #85ce3696;*/
    cursor:pointer;
}

ul.typetabs li
{
    padding: 6px;
    font-size:15px;
    padding-left:10px;
    padding-right:10px;
    border:1px solid #3c8bf7;
}
.tabs
{
   width:auto;
}
@media(min-width:756px)
{
ul.typetabs {
    width:auto;
    border-radius: 4px;
    border: 1px solid #3c8bf7;
}
}

ul.typetabs li.active
{
 background-color: #3c8bf7;
    color: #fff;   
}
</style>

    <div class="content-wrapper">
 <section class="content-header">
      <h1>
      Tweets
      </h1>
       <p class="title-description">Add New Tweet .  </p>
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
<?php
if($showalert == true && $error == true) {

?>
<div  class=" col-md-12 alert alert-error errormessage alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div > <?=  $message; ?></div>
  </div>
  <?php
}
?>
<div style="display:none;" id="file-size-error"class="col-md-12 alert errormessage alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="message"> </div>
  </div>
<div class="row col-md-12">   
<?php
if( $showalert == true && $error == false) {

?>
<div class="col-md-12 alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div > <?=  $message; ?></div>
  </div>
  <?php } ?>
      
  </div>
  </section>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div  class="box" >
             <?php if($_GET['tweetid']) { ?>        
   <div class="box-header with-border">
          <h3 class="box-title"><i  class="fa fa-edit"></i>Edit Tweet</h3>
          
          <div class="box-tools pull-right tabs">
            <ul class="nav  typetabs ">
  <li onClick="changeTab(this)" type="text" tab="text" class="<?php if($tweetdata['type'] == "text"){ echo 'active'; } ?>">Text</li>
  <li onClick="changeTab(this)" type="image" tab="Image" class="<?php  if($tweetdata['type'] == "image"){ echo 'active'; } ?>">Image</li>
  <li onClick="changeTab(this)" type="video" tab="Video" class="<?php if($tweetdata['type'] == "video"){ echo 'active'; } ?>" >Video</li>
</ul>
          </div>
        </div>
<div class="box-body">  
       <form method="POST" enctype="multipart/form-data"  id="updateForm"  action="action/UpdatetweetProcess.php?id=<?= $twitterSingleDetail['id'] ?>&Tweetid=<?= $tweetdata['id'] ?>">
        <input type="hidden" name="type" id="tweet-type" value="<?= $tweetdata['type'] ?>"/>
        <input type="hidden" name="currentdate" id="currentnameUpdate" value=""/>
         <input  type="hidden" id="unpublishedData"  name="unpublishedData" value="0"  class="unpublishedData" >
        <div style="position: relative;  " class="form-group" >
    
    <textarea class="form-control" name="caption" style="margin-top: 5%;" placeholder="Add a Caption" id="exampleFormControlTextarea1" rows="4" required><?php echo json_decode($tweetdata['data'])->caption ?></textarea>
     <?php  if($_SESSION['user']['ibm'] != 'IBM1') {
     if(!empty($paid_facility_list) ){
				foreach($paid_facility_list as $paid_item){
			 if((($paid_item['slug'] == MembershipConstant::WATERMARK_FOR_TWITTER ) && ($paid_item['is_show'] == 1)) || $paid_item['slug'] != MembershipConstant::WATERMARK_FOR_TWITTER ) {
			 ?>
			<span style=" color: #8e959b;position: absolute;bottom: 5px;right: 10px;">Powered By TheViralMarketer</span>
    <?php } else { ?>

    <?php }
  }}else{ ?>
			<span style=" color: #8e959b;position: absolute;bottom: 5px;right: 10px;">Powered By TheViralMarketer</span>
			<?php } }else { ?>

      <?php } ?>
  </div>
            <div class="form-group">
  <!--<label for="Catagory" class="col-sm-2 col-form-label">Catagory</label>-->
  <select name="catagory" class="form-control " required>
  <option value="">Choose Catagory</option>
  <?php foreach($allcategroies as $catagory) { 
  if($tweetdata['category_id'] == $catagory['id'])
  { ?>
  <option  value="<?= $catagory['id']; ?>" selected> <?= $catagory['name']; ?></option>
 <?php } else { ?> <option  value="<?= $catagory['id']; ?>"> <?= $catagory['name']; ?></option>
   <?php } } ?>
</select>
</div>
 <?php 
  $media = json_decode($tweetdata['data'])->media;
   $images = implode(', ', $media);?>
    <div id="photo" style="display:none" class="form-group">
    <input type="file"  name="Image[]" id="Image" class="file file-image" multiple/>
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-image" aria-hidden="true"></i> </span>
      <input type="text" class="text form-control input-lg" disabled placeholder="Upload Image" >
      <span class="input-group-btn">
        <button  class="browse btn btn-primary input-lg" type="button" ><i class="glyphicon glyphicon-search" ></i> Browse</button>
      </span>
    </div>
    <div class="gallery-image"></div>
    <div class="images-field field" >
 <?php foreach($media as $key=>$image){ ?>
  <img class="media mediakey<?= $key ?>" src="<?= $image ?>" height="70"  width="70"><i onclick="deleteMEdia(this)" id="<?= $key ?>" class="fa fa-minus deletemedia"></i>
  <?php } ?>
  </div>
  </div>

  <!--video-->
  <?php $media = json_decode($tweetdata['data'])->media; ?>
  <div id="video" style="display:none" class="form-group">   
    <input  type="file"id="videoshow"  name="video"  class="file file-video video" >
   
    
    <div class="input-group">
      <span class="input-group-addon"><i  class="fa fa-video-camera" aria-hidden="true"></i> </span>
      <input type="text" id="video-text"  class="text  form-control input-lg" disabled placeholder="Upload Video" >
      <span class="input-group-btn">
        <button  class="browse btn btn-primary input-lg" type="button" ><i class="glyphicon glyphicon-search" ></i> Browse</button>
      </span>
    </div>
 <div class="gallery-video"></div>
 <div class="video-field field" >
 <?php foreach($media as $key=>$video){ ?>
  <video class="media mediakey<?= $key ?>"  height="70" width="70">  <source src="<?= $video ?>" type="video/mp4"></video><i onclick="deleteMEdia(this)" id="<?= $key ?>" class="fa fa-minus deletemedia"></i>
<?php } ?>
 </div>
  </div>
  
  	<div class="form-group">
  	    <input type="checkbox" name="shedule" value="1" class="form-check-input <?php if($tweetdata['status'] == 0) { echo "timecheckbox"; } ?>" id="shedule" <?php if($tweetdata['status']  == 0) { echo "checked";} ?>>
    <label class="form-check-label schedule-label" for="Shedule">Do you want schedule?</label>
  	    
  	    </div>
    <div style="display:none;" class="form-group row schudele-tweet datepickerr">
				  <label for="example-datetime-local-input" >Time Post(Date and time)</label>
				  <div class="col-sm-12">
					<input class="form-control" style="margin-bottom: 14px;" name="datepicker" value="<?= $tweetdata['time_post'] ?>" type="datetime-local"  id="example-datetime-local-input">
				  </div>
	</div>
  

  


<input type="submit" name="submit"  style="width:100%" class="btn btn-primary update-tweet" value= "<?= ($tweetdata['result'] == 'Unpublished') ? "Tweet Now" : "Update Tweet";?>">
<?php 
if($tweetdata['result'] == 'Unpublished')
{ ?>
     <h2 class="heighlight-text"><span class="heighlight">OR</span></h2>
      <a  onclick="updateinTweetLibrary(this)" class="btn btn-primary savelibrary" style="width:100%;color:#fff;" >Update in Tweet Library</a>
<?php }?>
     </form>
     </div>
     <?php } 
     else { ?>
      <div class="box-header with-border">
           <h3 class="box-title"><i  class="fa fa-plus-circle"></i>Add New Tweet</h3>
           <div class="box-tools pull-right tabs">
            <ul class="nav typetabs ">
  <li onClick="changeTab(this)" type="text" tab="text" class="active">Text</li>
  <li onClick="changeTab(this)" type="image" tab="Image">Image</li>
  <li onClick="changeTab(this)" type="video" tab="Video">Video</li>
</ul>
            </div>    
          </div>
   <div class="box-body">
     <form method="POST" enctype="multipart/form-data"   action="action/addTweetProgress.php?id=<?= $twitterSingleDetail['id'] ?>">
        <input type="hidden" name="type" id="tweet-type" value="text"/>
         <input type="hidden" name="currentdate" id="currentdate" value=""/>
        <input type="hidden" class="saveinMediaLibrary" name="saveinMediaLibrary" value="0">
        <div style="position: relative;  " class="form-group" >
    
    <textarea class="form-control" name="caption" style="margin-top: 5%;" placeholder="Add a Caption" id="exampleFormControlTextarea1" rows="4" required></textarea>
			
    <?php  if($_SESSION['user']['ibm'] != 'IBM1') {
      if(!empty($paid_facility_list)){
				foreach($paid_facility_list as $paid_item){
			 if((($paid_item['slug'] == MembershipConstant::WATERMARK_FOR_TWITTER ) && ($paid_item['is_show'] == 1)) || $paid_item['slug'] != MembershipConstant::WATERMARK_FOR_TWITTER ) {
			 ?>
			<span style=" color: #8e959b;position: absolute;bottom: 5px;right: 10px;">Powered By TheViralMarketer</span>
    <?php }else{ ?>

    <?php }}}else{ ?>
			<span style=" color: #8e959b;position: absolute;bottom: 5px;right: 10px;">Powered By TheViralMarketer</span>
			<?php }  } else { ?>
      <?php } ?>
  </div>
            <div class="form-group">
  <!--<label for="Catagory" class="col-sm-2 col-form-label">Catagory</label>-->
  
  
  
  <select name="catagory"  class=" form-control select2 w-p100 " required>
  <option value="">Choose Catagory</option>
  <?php foreach($allcategroies as $catagory) { ?>
  <option value="<?= $catagory['id']; ?>"> <?= $catagory['name']; ?></option>
   <?php } ?>
</select>
</div>
    <div id="photo" style="display:none" class="form-group">
    <input  type="file"  name="Image[]" id="Image" class="file file-image" multiple/>
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-image" aria-hidden="true"></i> </span>
      <input type="text" class="text form-control input-lg" disabled placeholder="Upload Image" >
      <span class="input-group-btn">
        <button  class="browse btn btn-primary input-lg" type="button" ><i class="glyphicon glyphicon-search" ></i> Browse</button>
      </span>
    </div>
  <div class="gallery-image"></div>
  </div>

  <!--video-->
  <div id="video" style="display:none" class="form-group">
    <input type="file" id="videoshow" name="video"  class="file file-video video" >
    <div class="input-group">
      <span class="input-group-addon"><i  class="fa fa-video-camera" aria-hidden="true"></i> </span>
      <input type="text" id="video-text" class="text  form-control input-lg" disabled placeholder="Upload Video" >
      <span class="input-group-btn">
        <button  class="browse btn btn-primary input-lg" type="button" ><i class="glyphicon glyphicon-search" ></i> Browse</button>
      </span>
    </div>
     <div class="gallery-video"></div>

  </div>
	<div class="form-group">
    
    <input type="checkbox" name="shedule" value="1" class="form-check-input" id="shedule">
    <label class="form-check-label schedule-label" for="Shedule">Do you want schedule?</label>
  </div>
  <div style="display:none;" class="form-group row schudele-tweet datepickerr">
				  <label for="example-datetime-local-input" >Time Post(Date and time)</label>
				  <div class="col-sm-12">
					<input class="form-control" style="margin-bottom: 14px;" name="datepicker" type="datetime-local"  id="example-datetime-local-input">
				  </div>
	</div>
  
  


<input type="submit" name="submit" id="addTweet"  style="width:100%" class="btn btn-primary tweet-now" value= "Tweet Now">
    <h2 class="heighlight-text"><span class="heighlight">OR</span></h2>
     
     <a   onclick="saveinMediaLibrary(this)" class="btn btn-primary savelibrary" style="width:100%;color:#fff" >Save in Tweet Library</a>
     </form>
     </div>
     <?php } ?>
     </div>
 
            </div>
            </div>
       
      
      
      
       
         
    </article>
    </section>
    </div>
<?php include_once './../includes/main_footer.php'; ?>

<script type="text/javascript">

	$(function(){
		$('#videoshow').change(function(){
			var f=this.files[0]
			if(f.size > 30000000)
			{
			    $(".errormessage").css("display", "block");
			     $(".message").html("");
			    $(".message").html("Video Size should not greater than 3 MB ");
			    
			$("#videoshow").val('');
			$("#video-text").val('');
			  $(".alert-danger").fadeTo(2000, 600).slideUp(600, function(){
    $(".alert-danger").slideUp(600);

    });
			
			
			}

		})
	})
	</script>
<script>









$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
  //$('.field').css('display','none');
  $('.file').val("");
  $('.text').val("");
});
$(document).on('change', '.file', function(){
 // $(this).parent().find('.text').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  
});
function changeTab(attrubute) {
    
    $('.field').css('display','none');
  $('.file').val("");
  $('.text').val("");
    $('#tweet-type').val($(attrubute).attr('type'));
    $('.typetabs li').removeClass('active');
    if($(attrubute).attr('tab') == 'text') {
        $('#photo').css('display', 'none');
        $('#video').css('display', 'none');
        
            
        } else if ($(attrubute).attr('tab') == 'Image') {
            $('#image').css('display', 'block');
            $('#video').css('display', 'none');
            $('#photo').css('display', 'block');
           
        }
         else if ($(attrubute).attr('tab') == 'Video') {
            $('#photo').css('display', 'none');
            $('#video').css('display', 'block');
        }
        $(attrubute).addClass("active");

    }
    

</script>
<script>

  $('#shedule').click(function(){
      if ($(this).is(':checked'))
      {
          //$(".input-group schudele-tweet").show();
          //$('#datepickertext').show();
          $('#example-datetime-local-input').prop("required", "true");
          $('.datepickerr').show();
          $('.update-tweet').val('Update Schedule');
          $('.tweet-now').val('Schedule Tweet');
          $('.schedule-label').html('Scheduled');
      }
      else
      {
            $('#example-datetime-local-input').removeAttr('required');
          
         $('.datepickerr').hide(); 
          $('.update-tweet').val('Update Tweet');
          $('.tweet-now').val('Tweet Now');
          $('.schedule-label').html('Do you want schedule?');
      }
});
 
</script>
<script>
$(document).ready(function(){
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);

});
});

</script>
<script>
    $(document).ready(function(){
  status = '<?= $tweetdata['status'] ?>';
      if (status == '0')
      {
          $('#example-datetime-local-input').prop("required", "true");
          $('.datepickerr').show();
           $('.update-tweet').val('Update Schedule');
           $('.schedule-label').html('Scheduled');
          
      }
  
});
</script>

<script>
 var  typestatus = '<?php echo $tweetdata['type']; ?>';
$(document).ready(function(){
    $("#file-size-error").css("display","none");
    
       $(".alert-error").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-error").slideUp(500);
    

    });
});
$('document').ready(function(){
    type = '<?= $tweetdata['type']; ?>';
    if(type == 'text') {
        $('#photo').css('display', 'none');
        $('#video').css('display', 'none');
            
        } else if (type == 'image') {
            $('#image').css('display', 'block');
            $('#video').css('display', 'none');
            $('#photo').css('display', 'block');
           
        }
         else if (type == 'video') {
             console.log(type);
            $('#photo').css('display', 'none');
            $('#video').css('display', 'block');
        }
    
    
});
$(document).ready(function()
{
     type = '<?= $tweetdata['type']; ?>';
    if(type == 'image') {
        $('.images-field').css('display', 'block');
            
        } else if (type == 'video') {
        $('.video-field').css('display', 'block');
            
           
        }
    
})
 function deleteMEdia(attr){
            
     var dataArray = '<?= isset($_GET['tweetid'])?$_GET['tweetid']:null ?>';
     dataArray = JSON.stringify(dataArray);
   // console.log(dataArray);
    var mediaIndex = $(attr).attr('id');
    var tweetId = '<?= $tweetdata['id']; ?>';
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "action/deletetweetProcess.php",
      "method": "POST",
      "headers": {
        "cache-control": "no-cache",
        "postman-token": "8ba15e51-4987-fa06-634c-be9119623adf"
      },
      "data": {
        "dataArray": dataArray,
        "tweetId": tweetId,
        "mediaIndex": mediaIndex,
      }
    }
$.ajax(settings).done(function (response) {
  console.log(response);
  res = JSON.parse(response);
  if(res.success == true)
  {
      $('.mediakey'+mediaIndex).css("box-shadow","0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)");
      $('.mediakey'+mediaIndex).hide('slow');
      $('#'+mediaIndex).css("display","none");
  }
  
});
 }
 

$(function() {
   
     $('.file-image').on('change', function() {
         $('.gallery-image').html(''); 
        imagesPreview(this, 'div.gallery-image');
    });
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
                if(filesAmount < 4){
            for (i = 0; i < filesAmount; i++) {
                
                var reader = new FileReader();

                reader.onload = function(event) {
                   
                   $($.parseHTML('<img class="media showmedia'+i+'" height="70" width="70" >')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    $('.file-video').css('display','none');
                    
                   }

                reader.readAsDataURL(input.files[i]);
            
            
            }
                }
        }

    };

   
});

$(function() {
   
     $('.file-video').on('change', function() {
         $('.gallery-video').html('');
        imagesPreview(this, 'div.gallery-video');
    });
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;
                
            for (i = 0; i < filesAmount; i++) {
                
                var reader = new FileReader();

                reader.onload = function(event) {
                   $($.parseHTML(' <video class="media showmedia'+i+'" height="70" width="70" ></video>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                   $('.file-image').css('display','none');
                    
                }

                reader.readAsDataURL(input.files[i]);
            
            
            }
        }

    };

   
});

	$(function(){
		$('.file-image').change(function(){
			imagesPreview(this);
		})
		function imagesPreview(input)
		{
			var filesAmount = input.files.length;
			if(filesAmount > 4)
			{
			    $(".errormessage").css("display", "block");
			     $(".message").html("");
			    $(".message").html("Twitter allow maximum of 4 photos per tweet");
			    
			$(".file-image").val('');
			$('.gallery-image').html('');
			  $(".alert-danger").fadeTo(2000, 600).slideUp(600, function(){
    $(".alert-danger").slideUp(600);

    });
}}

		
	})
	function saveinMediaLibrary(attr){
	    $('.saveinMediaLibrary').val('1');
	    $('#addTweet').click();
	}
	
	$(document).ready(function(){
var d = new Date();
 $('#currentdate').val(d);    
});
	

$(document).ready(function(){
var d = new Date();
 $('#currentnameUpdate').val(d);    
});

function updateinTweetLibrary(attr)
{
    $('#unpublishedData').val('1');
    $('.update-tweet').click();    
}
	
</script>


