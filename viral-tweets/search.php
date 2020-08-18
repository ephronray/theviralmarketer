<?php
session_start();
$menu = array('tab' => 4, 'option' => 'viral-tweet');

require_once(__DIR__ . '/../includes/main-header.php');
require_once(__DIR__ . '/../_libs/twitterSetting.php');

$twitter = new TwitterSetting();
// add tweeter account
if (isset($_SESSION["twitter_oauth_token"]) && isset($_SESSION["twitter_oauth_token_secret"])) {
    $twitter->saveNewTwitterAccount();
}
// add tweeter account

//get all tweeter Accounts
$AccountRecentTweet = $twitter->getRecentTweetByUser($_GET['id']);
$alltwitterAccountDetail = $twitter->getAccountDetails();

//get all tweeter accounts

//get single tweeter account 
if (isset($_GET['id'])) {
    $twitterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
}

//get single tweeter account

$keywords = "";
if (isset($_GET['keywords']) && isset($_GET['id'])) {
    $keywords = $_GET['keywords'];
    $data = array('id' => $_GET['id'], 'keywords' => $_GET['keywords']);
    $searchTweetsResult = $twitter->searchTweets($data);
}
?>
<style>
    @media only screen and (max-width: 600px) {
        .blnc_res {
            width: 60%;
            margin-bottom: 40px;
        }

        .btn_ref {
            margin-right: 37%;
        }
    }

    @media only screen and (max-width: 320px) {
        .blnc_res {
            width: 80%;
            margin-left: 5%;
            margin-bottom: 40px;
        }

        .btn_ref {
            margin-right: 37%;
        }
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Search tweets
        </h1>
        <p class="title-description">Search a collection of relevant Tweets matching a specified query. . </p>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
            <li class="breadcrumb-item "><a href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">Viral Tweets Services</a></li>
            <li class="breadcrumb-item active"><a href="#"> Search tweets </a></li>
        </ol>
    </section>
    <section class="content-body">

        <article class="content grid-page">

            <section class="section">
                <?php require_once(__DIR__ . '/../viral-tweets/single-twitter-account.php'); ?>

                
                <ul class="nav nav-tabs followers-tabs search-tabs " role="tablist">
                    <li tab="SearchKeyword" onclick="changeTab(this)" class="nav-item">
                    <span class="nav-link active"> Search Keyword <span> </li>
                    <li tab="AccountDetail" onclick="changeTab(this)" class="nav-item">
                    
                    <span class="nav-link">My Tweets</span> </li>
                </ul>

               
                
                <div class="keyword">
                  

            <div class="box box-link-pop text-center">
				<div class="box-body py-25">
                <form action="search.php" method="GET">
                        <div style="margin-top:12px;" class="form-group col-md-12">
                            <label>Keywords (returns a collection of relevant Tweets matching a specified query.</label>
                            <div class="input-group">
                                <input name="id" type="hidden" value="<?php echo $twitterSingleDetail['id']; ?>" class="form-control">
                                <input name="keywords" type="text" value="<?php echo $keywords; ?>" class="form-control">

                                <span class="input-group-btn" style="font-size: 20px;">
                                    <button class="btn btn-primary btnActionTwitterSearch" style="border-radius: 0px; color: white; padding: 8px 16px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
				</div>
			</div>



                    <br />
                    <br />
                    <?php if (count($searchTweetsResult) > 0) {
                    ?>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="box box-solid bg-black">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Search Tweets</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fa fa-minus"></i></button>
                                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                                <i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table id="search-table" class="table table-striped table-bordered twitter-account-table" style="width: 100%;">
                                                <thead>
                                                    <tr>

                                                        <th>Recent Tweets content</th>
                                                        <th>Basic informations</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="twitter-account-table-body">
                                                    <?php foreach ($searchTweetsResult as $key => $row) { ?>
                                                        <tr>

                                                            <td twitter-text="<?= $row->text; ?>" screen-name="<?php echo $row->user->screen_name; ?>" tweet-id="<?= $row->id; ?>" onclick="moreDetail(this)" data-toggle="modal" data-target="#tweet-details"><?php echo (strlen($row->text) >= 40) ? substr($row->text, 0, 40) . '...' : $row->text; ?></td>


                                                            <td>
                                                                <a style="text-decoration: none;" href="https://twitter.com/<?php echo $row->user->screen_name; ?>" target="_blank">
                                                                    <div style="display:flex;">
                                                                        <div><img style="width: 95px;border: 1px solid #d4d4d4;padding: 5px;" src="<?php echo $row->user->profile_image_url; ?>"></div>
                                                                        <div style="text-align: left;    margin-left: 5%;">
                                                                            <small>
                                                                                <strong>Followers</strong>: <?= $row->user->followers_count ?>
                                                                                <br>
                                                                                <strong>Followings</strong>: <?= $row->user->friends_count ?>
                                                                                <br>
                                                                                <strong>Tweets:</strong> <?= $row->user->statuses_count ?>
                                                                                <br>
                                                                                <strong>Location</strong>: <?= $row->user->location ?>
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <a style="color: #fff;" data-toggle="modal" data-target="#tweet-details" screen-name="<?php echo $row->user->screen_name; ?>" class="btn btn-primary" tweet-id="<?= $row->id; ?>" onclick="moreDetail(this)">View Details</a>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    <?php } ?>

                </div>



        
                <br />
                 <br />
        <div style="display:none" class="accountDetails">
            <div class="row">
                <div class="col-md-12">


                        
         <div class="box box-solid bg-black">
	     	<div class="box-header with-border">
	     	      <h3 class="box-title">My Tweets</h3>
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
                        <table id="search-table" class="table table-striped table-bordered twitter-account-table" style="width: 100%;">
                            <thead>
                                <tr>

                                    <th>Recent Tweets content</th>
                                    <th>Basic informations</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="twitter-account-table-body">
                                <?php foreach ($AccountRecentTweet as $key => $row) { ?>
                                    <tr>

                                        <td twitter-text="<?= $row->text; ?>" screen-name="<?php echo $row->user->screen_name; ?>" tweet-id="<?= $row->id; ?>" onclick="moreDetail(this)" data-toggle="modal" data-target="#tweet-details"><?php echo (strlen($row->text) >= 40) ? substr($row->text, 0, 40) . '...' : $row->text; ?></td>


                                        <td>
                                            <a style="text-decoration: none;" href="https://twitter.com/<?php echo $row->user->screen_name; ?>" target="_blank">
                                                <div style="display:flex;">
                                                    <div><img style="width: 95px;border: 1px solid #d4d4d4;padding: 5px;" src="<?php echo $row->user->profile_image_url; ?>"></div>
                                                    <div style="text-align: left;    margin-left: 5%;">
                                                        <small>
                                                            <strong>Followers</strong>: <?= $row->user->followers_count ?>
                                                            <br>
                                                            <strong>Followings</strong>: <?= $row->user->friends_count ?>
                                                            <br>
                                                            <strong>Tweets:</strong> <?= $row->user->statuses_count ?>
                                                            <br>
                                                            <strong>Location</strong>: <?= $row->user->location ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <div>
                                                <a style="color: #fff;" data-toggle="modal" data-target="#tweet-details" screen-name="<?php echo $row->user->screen_name; ?>" class="btn btn-primary" tweet-id="<?= $row->id; ?>" onclick="moreDetail(this)">View Details</a>

                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
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




<div class="sidebar-overlay" id="sidebar-overlay"></div>

<article class="content grid-page">


    <section class="section">
        <?php require_once(__DIR__ . '/../viral-tweets/single-twitter-account.php'); ?>

        <div class="row">
            <?php
            //print_r($AccountRecentTweet);

            //print_r($searchTweetsResult);
            ?>



        </div>
        
    </section>

</article>

<!--model box show-->
<div class="modal" id="tweet-details" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" onClick="onClose()">&times;</button>
                <h4 class="modal-title">Tweet content</h4>
            </div>
            <div style="min-height:300px;" class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show alert-dang" style="display:none;"><strong>You Already Retweeted</strong></div>
                <div class="alert alert-success alert-model" style="display:none; padding-top: 7px;padding-bottom: 14px;" role="alert">
                    <strong>Retweeted Successfully! </strong>
                    <div style="float: right;">
                        <a screenname="<?php echo $twitterSingleDetail['screen_name'];  ?>" target="_blank" onclick="viewTweetDetail(this)" style="width: 101px;color: #85ce36 !important;background: #fff;font-weight: 600;" class="btn-modal btn-view-detail btn-views btn btn-default btn-sm btn-rounded">View in Twiter</a>
                        <a onclick="viewedit(this)" target="_blank" style="width: 101px;color: #85ce36 !important;background: #fff;font-weight: 600;" class="btn-modal btn-view-detail btn-edit btn btn-default btn-sm btn-rounded">Edit retweet</a>
                    </div>
                </div>
                <div class="row">
                <div class="show-tweet-details col-md-12">
                    
                    
                </div>
                </div>
                <br/>
                <div class="row">
                <div class="retweet-and-share-button" >
                        <a style="width: 101px;color: #fff !important;" onclick="retweet(this)" id="reTweetid" class="btn-modal btn btn-primary btn-sm btn-rounded btn-view-detail"><i class="fa fa-retweet" style="margin-right: 6px;" aria-hidden="true"></i>Retweet</a>
                        <a style="width: 101px;color: #fff !important;" id="viewTweet" target="_blank" class="btn-modal btn btn-primary btn-sm btn-rounded">View in Twiter</a>

                    </div>
                </div>
                <br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="onClose()">Close</button>
            </div>
        </div>
    </div>
</div>
<!--model box-->


<?php include_once './../includes/main_footer.php'; ?>

<script>
    function showCompleteText(attr) {

    }

    function onClose() {
        $('#tweet-details').css('display', 'none');
    }
    $(document).ready(function() {
        $('#search-table').DataTable();
    });


    function moreDetail(attr) {

        $('.alert-dang').css("display", "none");
        $(".alert-model").css("display", "none");
        var tweetId = $(attr).attr('tweet-id');
        var accountId = "<?= $_GET['id']; ?>";
        var screenName = $(attr).attr('screen-name');
        $('.show-tweet-details').css('display', 'none');
        $('#reTweetid').attr("retweet_id", tweetId);
        // $('#reTweetid').attr("re-tweet",);
        var settings = {
            "url": "action/getSingleTweetProcess.php?tweet-id=" + tweetId + "&account-id=" + accountId + "&screenName=" + screenName,
            "method": "GET",
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            }

        };

        $.ajax(settings).done(function(response) {
            console.log(response);
            data = JSON.parse(response);
            html = "";
            html = data.html;
            url = data.url;
            $('#viewTweet').attr("href", url);
            console.log(url);
            $('.show-tweet-details').css('display', 'block');

            $('.show-tweet-details').html(html);

            console.log(data);
            //console.log(html);
        });
    }

    function retweet(attr) {
        var tweetId = $(attr).attr('retweet_id');
        var accountId = "<?= $_GET['id']; ?>";
        console.log(tweetId);
        console.log(accountId);

        var settings = {
            "url": "action/retweetProcess.php?account-id=" + accountId + "&tweet-id=" + tweetId,
            "method": "GET",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
        };

        $.ajax(settings).done(function(response) {
            console.log(response);
            data = JSON.parse(response);
            if (data.success == true) {
                $('alert-dang').css("display", "none");
                $(".alert-model").css("display", "block");
                lastid = data.data.data.last_id;
                id = data.data.data.tweet_account_id;
                $('.btn-views').attr("acount_id", id);
                $('.btn-edit').attr("lastid", lastid);
                //   console.log(id);

            } else if (data.success == false) {
                $('alert-dang').css("display", "block");
                $(".alert-model").css("display", "none");

                //        console.log(data.message);
            }
        });

    }

    function viewTweetDetail(attr) {
        screenName = $(attr).attr('screenname');
        id = $(attr).attr('acount_id');
        url = "https://twitter.com/" + screenName + "/status/" + id;
        $(attr).attr('href', url);

    }

    function viewedit(attr) {
        account_id = "<?php echo $_GET['id']; ?>"
        id = $(attr).attr('lastid');
        url = "add-tweet.php?id=" + account_id + "&tweetid=" + id;

        $(attr).attr('href', url);

    }

    function changeTab(attr) {
        $('.search-tabs li span').removeClass('active');
        if ($(attr).attr('tab') == 'SearchKeyword') {
            $('.accountDetails').css('display', 'none');
            $('.keyword').css('display', 'block');

        } else if ($(attr).attr('tab') == 'AccountDetail') {
            $('.accountDetails').css('display', 'block');
            $('.keyword').css('display', 'none');

        }
        $(attr).children('span').addClass("active");
    }
</script>