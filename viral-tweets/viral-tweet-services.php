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
ul.service-box-sub-list {
    padding-top: 14px;
    padding-left: 0;
}
.viral-card:hover
{
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}
@media(min-width:756px){
ul.service-box-sub-list {
    font-size:15px;
    height: 121px;
}}
.servicelink
{
    display:none !important;
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
</style>

   <div class="content-wrapper">
<section class="content-header">
      <h1>
       Viral Tweets Services
      </h1>
       <p class="title-description">Follow/unfollow your tweets. and schedule your tweets.  </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
         <li class="breadcrumb-item active">Viral Tweets Services</li>
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
                <h4 class="box-title">Add <strong>Followers</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-user-plus fa-2x"></i></h2>
			 <div class="col-md-12">
			     
                            <ul class="service-box-sub-list">
                                <li>Find the targeted users and then follow them</li>
                                <li>auto add followers</li>
                                
                            </ul>
                    </div>
                    <div class="col-md-12">
                            <a href="add-followers.php?id=<?= $twitterSingleDetail['id']; ?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>	
              </div>
            </div>
          </div>
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title"><strong>Unfollow</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-user-times fa-2x"></i></h2>
			  <div class="col-md-12">
                            <ul class="service-box-sub-list">
                                <li>Unfollow twitter users that does not follow back</li>
                                <li>Set criteria to unfollow</li>
                                
                            </ul>
                    </div>
                    <div class="col-md-12">
                            <a href="unfollow.php?id=<?= $twitterSingleDetail['id']; ?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
              </div>
            </div>
          </div>
      
         <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Search <strong>Tweets</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-search fa-2x"></i></h2>
		<div class="col-md-12">
                            <ul class="service-box-sub-list">
                                <li>Find Tweets</li>
                                
                            </ul>
                    </div>
                    <div class="col-md-12">
                            <a href="search.php?id=<?= $twitterSingleDetail['id']; ?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
		
		      </div>
            </div>
          </div>
      
            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <h4 class="box-title">Add <strong>Tweets</strong></h4>
                <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
              </div>

              <div class="box-body">
			  <h2 style="    text-align: center;"><i class="fa fa-twitter fa-2x"></i></h2>
	 <div class="col-md-12">
                            <ul class="service-box-sub-list">
                                <li>Add New Tweet</li>
                                <li>Schedule Tweet</li>
                                <li>Retweet Tweet</li>
                                
                            </ul>
                    </div>
                    <div class="col-md-12">
                            <a href="add-tweet-services.php?id=<?= $twitterSingleDetail['id']; ?>" Class="btn btn-primary btn-lg btn-block"/>Click Here</a>
                    </div>
		
		      </div>
            </div>
          </div>
       
       
    
      
    </div>

    <!--<div class="row">-->
    <!--    <div class="col-md-4"></div>-->
        
    <!--    <div class="col-md-4"></div>-->
    <!--</div>-->
</div>
         <br/>
         <br/>

        </section>

    </article>
</div>
<?php include_once './../includes/main_footer.php'; ?>


