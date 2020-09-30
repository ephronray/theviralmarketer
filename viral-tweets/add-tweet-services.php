<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

include_once './../includes/main-header.php'; 

require_once (__DIR__.'/../_libs/twitterSetting.php');

$twitter = new TwitterSetting();
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
?>
<style>
h4.box-title{
    font-size: 17px;
}


.card-services
{
    padding-left: 9px;
    padding-right: 9px;
}
     .panel-group .panel {

        border-radius: 0;

        box-shadow: none;

        border-color: #EEEEEE;

    }
    .panel-default > .panel-heading {

        padding: 0;

        border-radius: 0;

        color: #212121;

        background-color: #85ce36;
        border-color: #EEEEEE;
    }
    .panel-title {
        font-size: 14px;
    }
    .panel-title > a {
    display: block;
    padding: 15px;
    font-size: 17px;
    font-weight: bold;
    color: white;
    text-decoration: none
    }
  .panel-title > a :hover{

    text-decoration: none !important;

    color: #eaebe8 !important;

  }

    .card-block{

        padding: 0px !important; 

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
    .card-area 
    {
        height: 286px;
    }
    .card-area:hover 
    {
         box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }
    @media(min-width:756px){
    ul.service-box-sub-list {
    font-size: 16px;
    padding-left: initial !important;
        height: 85px;
}}
</style>

    <div class="content-wrapper">
<section class="content-header">
      <h1>
      Add Tweet Services
      </h1>
       <p class="title-description">Add ,catagorize , View  /and schedule your tweets.   </p>
      <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item "><a href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">Viral Tweets Services</a></li>
             <li class="breadcrumb-item active">Add Tweet Services</li>
      </ol>
    </section>
    <article class="content grid-page">

        <section class="section">
 <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>

        <div class="container">
    <div class="row">
        
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Add <strong>Catagory</strong></h4>
                <ul class="box-controls pull-right">
                 
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-tag fa-2x"></i></h2>
			  <div class="service-box col-md-12">
                          <ul  class="service-box-sub-list">
                                <li>Add Catagory</li>
                                <li>View Catagory</li>
                            
                            </ul>
                    </div>
                    <div class="col-md-12">
                            <a href="add-tweets-category.php?id=<?= $_GET['id']?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
              </div>
            </div>
          </div>
      
        
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Add <strong>Tweet</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-plus-circle fa-2x"></i></h2>
			  <div class="col-md-12">
                          <ul  class="service-box-sub-list">
                                 <li>Add Schedule Tweets</li>
                                <li>Add Tweets</li>
                            
                            </ul>
                    </div>
           <div class="col-md-12">
                            <a href="add-tweet.php?id=<?= $_GET['id']?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
              </div>
            </div>
          </div>
          
           <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Schedule <strong>Tweets</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-calendar fa-2x"></i></h2>
			  <div class="col-md-12">
                        <ul class="service-box-sub-list">
                                <li>View Schedule Tweets</li>
                                <li>Add Schedule Tweets</li>
                                
                            </ul>
                    </div>
              <div class="col-md-12">
                            <a href="ScheduleTweets.php?id=<?= $_GET['id']?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
              </div>
            </div>
          </div>

   <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Tweet <strong>Library </strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-list-ul fa-2x"></i></h2>
			  <div class="col-md-12">
                        <ul class="service-box-sub-list">
                                <li>View All Tweets</li>
                                 <li>Add Tweets</li>
                                
                            </ul>
                    </div>
                 <div class="col-md-12">
                            <a href="tweets.php?id=<?= $_GET['id']?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
              </div>
            </div>
          </div>      
       
     
    </div>

    <!--<div class="row">-->
    <!--    <div class="col-md-3"></div>-->
       
    <!--    <div class="col-md-4"></div>-->
    <!--</div>-->
</div>
         <br/>
         <br/>

        </section>

    </article>
    </div>
    
<?php include_once './../includes/main_footer.php'; ?>
<script>
$(document).ready(function(){
console.log('asdasd');
});
</script>


