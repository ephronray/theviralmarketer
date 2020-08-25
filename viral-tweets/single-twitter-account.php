
 <style>
    @import 'https://fonts.googleapis.com/css?family=Open+Sans:300,400';

 *, *:before, *:after {
	 box-sizing: border-box;
}
.follower-tweet-count{
    height: 62px;
    flex-direction: row;
    z-index: 2;
    position: relative;
    display: flex;

    
}
@media(max-width: 756px){
.follower-tweet-count{
  padding: 0px 23px;    

}
.single-data-count{
    padding: 0px 6px;
}
.tweetMedia{
    width:33%;
}
.content{
        padding: 0;
}
.backtoservicce{
    margin-bottom: 28px;
}
}
@media(min-width: 756px){
 .single-data-count{
    padding: 0px 12px;
}
    .follower-tweet-count{
 
    padding-left: 36px !important ;
}

    .border_right{
            height: 68px;
        border-right:1px solid #e4e4e4;
    }
}
 .content {
	 position: relative;
	 animation: animatop 0.9s cubic-bezier(0.425, 1.14, 0.47, 1.125) forwards;
}
.avetar_img{
    background: #fff;
    border-radius: 50%;
   height: 67px;
    width: 74px;
    padding: 10px;
}
 .userprofilecard {
	width: 100%;
    height: 153px;
    min-height: 100px;
    padding: 7px 20px;
    border-radius: 3px;
    background-color: white;
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    position: relative;
    overflow: hidden;
    border-radius: 10px;
}
 .userprofilecard:after {
	 content: '';
	 display: block;
	 width: 190px;
	 height: 300px;
	 background: #398bf7;
	 position: absolute;
	 animation: rotatemagic 0.75s cubic-bezier(0.425, 1.04, 0.47, 1.105) 1s both;
}
 .badgescard {
	 padding: 10px 20px;
	 border-radius: 3px;
	 background-color: #ececec;
	 width: 480px;
	 box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
	 position: absolute;
	 z-index: -1;
	 left: 10px;
	 bottom: 10px;
	 animation: animainfos 0.5s cubic-bezier(0.425, 1.04, 0.47, 1.105) 0.75s forwards;
}
 .badgescard span {
	 font-size: 1.6em;
	 margin: 0px 6px;
	 opacity: 0.6;
}
 .firstinfo {
	 flex-direction: row;
	 z-index: 2;
	 position: relative;
	 display: flex;
}
 .firstinfo img {
	 border-radius: 50%;
	 width: 48px;
	 height: 48px;
}
 .firstinfo .profileinfo {
     width:100%;
	 padding: 0px 17px;
}
 .firstinfo .profileinfo h1 {
	 font-size: 1.8em;
}
 .firstinfo .profileinfo h3 {
	 font-size: 1.2em;
	 color: #009688;
	 font-style: italic;
}
 .firstinfo .profileinfo p.bio {
	 padding: 10px 0px;
	 color: #5a5a5a;
	 line-height: 1.2;
	 font-style: initial;
}
 @keyframes animatop {
	 0% {
		 opacity: 0;
		 bottom: -500px;
	}
	 100% {
		 opacity: 1;
		 bottom: 0px;
	}
}
 @keyframes animainfos {
	 0% {
		 bottom: 10px;
	}
	 100% {
		 bottom: -42px;
	}
}
 @keyframes rotatemagic {
	 0% {
		 opacity: 0;
		 transform: rotate(0deg);
		 top: -24px;
		 left: -253px;
	}
	 100% {
		 transform: rotate(-30deg);
		 top: -24px;
		 left: -78px;
	}
}
 
 </style>

<div class="container">
    <div class="row">
           <div style="padding-top: 36px;" class="col-md-3 col-sm-12 col-xs-12 backtoservicce">
                <div >
                 <a class="servicelink"  href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">
                <i  class="serviceicon fa fa-arrow-left"></i>Go to Services
                </a> 
                </div>
                </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="content">

    <div class="userprofilecard">
        <div class="firstinfo">
            <div class="avetar_img"><img  src="<?php echo $twitterSingleDetail['avatar'];  ?>" /></div>
            <div class="profileinfo">
                <h1><?php echo $twitterSingleDetail['data_profile']->name;  ?></h1>
                
                    </div>
          
                        
        </div>
          <ul class="follower-tweet-count flexbox flex-justified  ">
                <li class="br-1 border-light">
                 <div style="display:flex;" class="single-data-count">
                    
                         <span class="ion ion-social-twitter" style="color: #fff;font-size: 35px;"></span>
                     <p style="padding: 0px 9px;font-size: 28px;font-weight: 700;margin-bottom:0;"  id="account-statuses-count" ><?php echo $twitterSingleDetail['data_profile']->statuses_count; ?></p>
                           </div>
                    <p style=" padding: 0px 13px; " class="text-muted">Tweets</p>
                </li>
                <li class="br-1 border-light">
                   <div style="display:flex;" class="single-data-count">
                            <i class="fa fa-signal" style="color: #8faae8;font-size: 35px;"></i>
     <p style="padding: 0px 9px;font-size: 28px;font-weight: 700;margin-bottom:0;" id="account-follower-count" ><?php echo $twitterSingleDetail['data_profile']->followers_count; ?></p>
                       
                        </div>
                                                <p style=" padding: 0px 13px; " class="text-muted">Followers</p>

                </li>
                <li>
                   <div style="display:flex;" class="single-data-count">
<i class="fa fa-heart" style="    color: #ff8298;font-size: 35px;"></i>     
                        <p style="padding: 0px 9px;font-size: 28px;font-weight: 700;margin-bottom:0;"  id="account-friends-count" ><?php echo $twitterSingleDetail['data_profile']->friends_count; ?></p>
                        </div>
                        
                        <p style=" padding: 0px 13px; " class="text-muted">Following</p>
                </li>
              </ul>
    </div>
   
</div>
        </div>
           <div class="col-md-3 col-sm-12 col-xs-12">
             
           </div>
    </div>
</div>

<style>
.servicelink
{
    text-decoration: none !important;
    color: #fff !important;
    border-radius: 5px;
    color: #fff;
    background: #85ce36;
    text-decoration: none;
    padding: 13px;
    box-shadow: -1px 6px 8px 0px rgba(50, 50, 50, 0.4);
   
}
.serviceicon
{
    color: #fff;
    padding-left: 4px;
    font-size: 18px;
    font-weight: 100;
    padding-right: 10px
}
.servicelink:hover
{
       box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    }
</style>