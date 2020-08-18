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
  $tweeterSingleDetail =  $twitter->getSingleAccountDetail($_GET['id']);
 
}

//get single tweeter account
?>
<style>

.icons_for_account {
margin: 0 2px;
}
.icons_for_account i.fa-pencil {
    font-size: 1.4em;
    color: #57c7d4;
}

.icons_for_account i.fa-trash {
   font-size: 1.4em;
    color: #ff2f2f;
}

.icons_for_account i.fa-list-ul {
  font-size: 1.4em;
    color: #40e240;
}
/*.table-hover tbody tr:hover {*/
/*    background-color: #fff;*/
/*    box-shadow: 0 2px 30px #dee2e5;*/
/*    -webkit-transform: translateY(-3px);*/
/*    transform: translateY(-3px);*/
/*    opacity: 1;*/
/*}*/
/*.bg-yellow th{*/
/*  text-align: inherit;*/
/*    color: #fff !important;*/
/*    font-size: 1.1rem;*/
/*}*/
/*.table tbody tr td {*/
/*    vertical-align: middle;*/
/*} */
.modal-header
{
    background-color:#fff !important;
    color: #000 !important;
    padding-bottom: 0;
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
        Viral Tweets
      </h1>
       <p class="title-description">Follow/unfollow your tweets. and schedule your tweets.  </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Viral Tweet</li>
      </ol>
    </section>


<section class="content-body">
    <article class="content grid-page">

        <section class="section">

         <div class= row> 
    
    <div class="col-md-12" style="text-align:right;"> 
    <a href="action/createAccountProcess.php" class="btn btn-primary btn-lg">Authorize Twitter Account</a>
    </div>
         </div>
         <br/>
         <br/>
	  <div class="box box-solid bg-black ">
	     	<div class="box-header with-border">
	     	      <h3 class="box-title">Account Information</h3>
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
	     	      	   	    <table  class="table table-bordered table-striped no-margin ">
				                  <thead >
							<tr>
							  
                            <th>Name</th>
							<th>Tweets</th>
							<th>Followers</th>
							 <th>Followings</th>
							 <th>Action</th>
							</tr>
						  </thead>
				 <tbody>
                <?php foreach($alltwitterAccountDetail as $twitterAccount) { ?>  
                   <tr>
                       <td style=" display: flex; vertical-align: middle; "><img src="<?php echo $twitterAccount['avatar']; ?>" style="width: 47px; border-radius: 50%; height: 47px;" class="tweeter-avatar" /> 
                       <p style="padding: 13px 9px;margin: 0;"><?php echo $twitterAccount['data_profile']->name; ?></p>
                       </td>
                       <td><?php echo $twitterAccount['data_profile']->statuses_count; ?></td>
                       <td><?php echo $twitterAccount['data_profile']->followers_count; ?></td>
                       <td><?php echo $twitterAccount['data_profile']->friends_count; ?></td>
                       <td>
                <!--edit-->
                           <a href="action/refreshAccountProcess.php?id=<?php echo $twitterAccount['id']; ?>" class="icons_for_account icon-edit"  data-toggle="tooltip" data-placement="top" title="Update Account"><i class="fa fa-pencil"></i></a>
                        <!--trash-->
                       <a href="#"  data-toggle="modal" data-target="#exampleModalCenter" account_Name="<?php echo $twitterAccount['data_profile']->name; ?>"  account_id="<?php echo $twitterAccount['id']; ?>" onclick="deleteaccount(this)" class=" icons_for_account icon-delete"  data-toggle="tooltip" data-placement="top" title="Delete Account" id="sa-params"><i class="fa fa-trash"></i></a>
                       <!--services-->
                   
                   <a href="viral-tweet-services.php?id=<?php echo $twitterAccount['id']; ?>" class="icons_for_account asicon-services" data-toggle="tooltip" data-placement="top" title="Twitter Services" > <i class="fa fa fa-list-ul"></i></a>
                   
                       </td>
                   
                   </tr>
                   
                   <?php } ?>
                        </tbody>
				
				
	     	                </table>  	   	    
	     	      	   	  </div>
	     	      	 </div>
	      </div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div style="border-radius:7px;" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Confirmed Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <p>  Do you Really want to Delete <strong class="accountName"></strong> Account? </p>
      </div>
      <div class="modal-footer">
        <button type="button" style="border-radius:4px;" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button"  onclick="confirmdeleteAccount(this)" style="border-radius:4px;" class="btn btn-danger confirmdelete">Delete</button>
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

    var url = '';
    $("select.tweeter-accounts").change(function(){
        var accountId = $(this).children("option:selected").val();
        if(accountId == -1) {
         url = new URL(window.location.href);
        url.href = removeParam("id" , url.href );
        $(location).attr('href',url.href); 
        } else {
        url = new URL(window.location.href);
        url.searchParams.set('id',accountId);
        $(location).attr('href',url.href);
}
    });


function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}
function deleteaccount(attr)
{
    var accountid=$(attr).attr('account_id');
    var accountName = $(attr).attr('account_Name');
    $('.confirmdelete').attr("accountid",accountid);
    $('.accountName').html(accountName);
    
}
 function confirmdeleteAccount(attr)
 {
accountid = $(attr).attr('accountid');
    var settings = {
  "url": "https://theviralmarketer.biz/viral-tweets/action/deleteAccountProcess.php?id="+accountid,
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
};

$.ajax(settings).done(function (response) {
res = JSON.parse(response);
if(res.success == true)
{
 location.reload();   
}
    
});
 }
</script>