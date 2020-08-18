<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

require_once (__DIR__.'/../includes/header.php');
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once(__DIR__.'/../_libs/dbConnect.php');

$twitter = new TwitterSetting();
$db = new dbConnect();
// add tweeter account
 if(isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])){ 
    $twitter->saveNewTwitterAccount();
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
$allcategroies = $db->showTweetCatagories(); 
  if(isset($_POST['submit']))    {
        $record = array('caption' => $_POST["caption"] , 'catagory' => $_POST["catagory"] , 'type' => $_POST["type"] );
        
        
        // $response = $db->saveTweetCategry($record);
        
        // if($response['success']== true) {
        //     $showalert = true;
        //   $message = $response['message'];
           
        // } else {
        //       $showalert = true;
        //   $message = 'There is something  issue, please try again.';
            
        }

?>
<style>
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
</style>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <article class="content grid-page">

        <div class="title-block">

            <h3 class="title">Tweets </h3>

                        <p class="title-description">Add New Tweet .  </p>

            <div class="blnc_res">
                <?php require_once (__DIR__.'/../includes/balance_amount.php');
                ?>
            </div>

        </div>

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div style="padding:20px !important;box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.1);" class="card " >
  <div class="card-body">
   
   <div class="card-title row" >  <h5  class="col-md-6 col-sm-6"><i style="margin-right:2% " class="fa fa-plus-circle"></i>Add New Tweet</h5>
    <div class="col-md-6 tabs">
    <ul class="nav nav-tabs typetabs ">
  <li onClick="changeTab(this)" type="text" tab="text" class="active">Text</li>
  <li onClick="changeTab(this)" type="image" tab="Image">Image</li>
  <li onClick="changeTab(this)" type="video" tab="Video">Video</li>
</ul>
</div>
</div>
    <hr/>
    
        <form method="POST" id="addTweet" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $twitterSingleDetail['id'] ?>">
        <input type="hidden" name="type" id="tweet-type" value="text"/>
        <div class="form-group" >
    
    <textarea class="form-control" name="caption" style="margin-top: 5%;" placeholder="Add a Caption" id="exampleFormControlTextarea1" rows="4" required></textarea>
  </div>
            <div class="form-group">
  <!--<label for="Catagory" class="col-sm-2 col-form-label">Catagory</label>-->
  <select class="form-control " required>
  <option name="catagory" value="">Choose Catagory</option>
  <?php foreach($allcategroies as $catagory) { ?>
  <option value="<?= $catagory['id']; ?>"> <?= $catagory['name']; ?></option>
   <?php } ?>
</select>
</div>
    <div id="image" style="display:none" class="form-group">
    <input type="file"  name="files[]" class="file" multiple/>
    <div class="input-group">
      <span class="input-group-addon"><i id="photo" class="fa fa-image" aria-hidden="true"></i><i id="video" style="display:none;" class="fa fa-video-camera" aria-hidden="true"></i> </span>
      <input type="text" class="form-control input-lg" disabled placeholder="Upload Image" >
      <span class="input-group-btn">
        <button class="browse btn btn-primary input-lg" type="button" ><i class="glyphicon glyphicon-search" ></i> Browse</button>
      </span>
    </div>
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="shedule">
    <label class="form-check-label" for="Shedule">Shedule</label>
  </div>
  
<div style="display:none;" class="input-group schudele-tweet" id = "datepickerr">
    <label>Time Post(Date and time)</label>
<input type="text" id="datepicker">
 </div>

<input type="submit" style="width:100%" class="btn btn-outline-primary" value= "Tweet Now">
     </form> </div>
            </div>
            </div>
        </div>
      
         <br/>
         <br/>

        </section>

    </article>
    
    <?php 

 if(isset($_POST['submit']))
 {
     echo $_POST['caption'];
     echo "<br/>";
     echo $_POST['catagory'];
     echo "<br/>";
     
 }
    
     
    // $shedule =$_POST['checkbx'];
    // echo "this", $shedule;
    
     
     


?>
    
    
    
<script>
// 
$(document).ready(function () {
if($("#checkbox").prop("checked", true) )
{
  $('.schudele-tweet').css('display', 'block');
    
}
else if($("#checkbox").prop("checked", false))
{
  $('.schudele-tweet').css('display', 'none');
    
}
    
});

$( function() {
    $( "#datepicker" ).datepicker();
  } );
$(document).on('click', '.browse', function(){
  var file = $(this).parent().parent().parent().find('.file');
  file.trigger('click');
});
$(document).on('change', '.file', function(){
  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});
function changeTab(attrubute) {
    
    $('#tweet-type').val($(attrubute).attr('type'));
    $('.typetabs li').removeClass('active');
    if($(attrubute).attr('tab') == 'text') {
        $('#image').css('display', 'none');
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
          $('#datepickerr').show();
          
      }
      else
      {
          // $(".input-group schudele-tweet").hide();
        //$('#datepickertext').show();
         $('#datepickerr').hide(); 
      }
});
 
</script>



<?php require_once (__DIR__.'/../includes/footer.php'); ?>


