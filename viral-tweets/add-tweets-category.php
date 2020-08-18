<?php 
session_start();
$menu = array('tab'=>4, 'option' => 'viral-tweet');

include_once './../includes/main-header.php'; 

require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once(__DIR__.'/../_libs/dbConnect.php');
// include __DIR__.'/action/addtweetCatagoryprocess.php';
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
 
$keywords = "";
if(isset($_GET['keywords']) && isset($_GET['id'])) {
    $keywords = $_GET['keywords'];
    $data = array('id'=>$_GET['id'] , 'keywords'=> $_GET['keywords']);
 $searchTweetsResult = $twitter->searchTweets($data);
 
    
    
}

//get all tweet categories
$allcategroies = $db->showTweetCatagories($_GET['id']);

//get all tweet categories
$categoryName= '';
$categoryDescription= '';

//on edit category




// on edit category
$btnCatagory = "ADD";
//insert category
$categoryTittle = 'Add Category';
$showalert = false;
$catagoryNum =  0 ;
$message = '';
$err = '';

if($_GET['message'])
{
    $showalert = true;
    $message = $_GET['message'];
}


if((isset($_GET['twitter-category-id'])) && isset($_GET['edit'])==true) 
{
    $id = $_GET['twitter-category-id'];
    $response = $db->getSingleCategory($id);
   $btnCatagory= 'Update';
  $categoryTittle = "Edit Catagory";
   $categoryName = $response['name'];
    $categoryDescription = $response['description'];
    
}

//insert category
?>
<style>
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
/*}*/
    @media only screen and (min-width: 600px) {
.catagorylist
{
    margin-top: 97px;
}
     
}
th 
{
    text-align: center;
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
</style>
  <div class="content-wrapper">
 <section class="content-header">
      <h1>
       Add/list tweets category
      </h1>
       <p class="title-description">Add new category, edit category and list all category of tweets.    </p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        
        <li class="breadcrumb-item "><a href="viral-tweet.php?id=<?= $_GET['id'] ?>">Viral Tweets</a></li>
        <li class="breadcrumb-item "><a href="viral-tweet-services.php?id=<?= $_GET['id'] ?>">Viral Tweets Services</a></li>
         <li class="breadcrumb-item "><a href="add-tweet-services.php?id=<?= $_GET['id'] ?>">Add Tweet Services</a></li>
          <li class="breadcrumb-item active">Add/list tweets category</li>
      </ol>
    </section>
 <section class="content-body">
    <article class="content grid-page">

     

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>



<div class="row col-md-12">   
<?php
if( $showalert == true) {
//if($response['success'] == true){
?>
<div class=" col-md-12 alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?=  $message; ?>
  </div>
  <?php } ?>
      
 <?php
 //} 
  ?>
 </div>
<div class="col-md-12">
<div class="row">
 <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
       <div class="box">
             <div class="box-header with-border">
          <h3 class="box-title"><?= $categoryTittle ?></h3>
          
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">
      <?php if($_GET['edit'] == true) { 
 
?>
 
 <form  action="action/addtweetCatagoryprocess.php?id=<?= $twitterSingleDetail['id'] ?>&twitter-category-id=<?= $id; ?>&Update=true" method="POST" >
 <?php }  else { ?>
              <form  action="action/addtweetCatagoryprocess.php?id=<?= $twitterSingleDetail['id'] ?> " method="POST" >
            <?php } ?>
            <div class="form-group ">
                <label>Name</label>
                <div class="input-group">
                <input type="text" name="name" value="<?= $categoryName; ?>" class="form-control">
                    </div>
                     </div>
                     <div class="form-group ">
                    <label>Description</label>
                    <div class="input-group">
                  <textarea class="form-control" name="description"  rows="3"><?= $categoryDescription; ?></textarea>
                </div>
            </div>
                   <input type="submit" name="submit"  class="btn btn-primary "  style="width: 100%; margin-top: 2%;" value="<?= $btnCatagory?>">
             
              </form>      
            </div>
           </div>
      </div>
      
<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
 <div class="box box-solid bg-black">
	     	<div class="box-header with-border">
	     	      <h3 class="box-title">Catagories List</h3>
	     	      <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
	     	 </div>
	     	 	<div class="box-body">
	     	      	   	<div  class="table-responsive">
	     	      	   	    <table  class="table table-bordered table-striped no-margin">
				                  <thead >
							<tr>
							  
                                 <th>sr#</th>  
                                <th>Name </th>
                                <th>Description</th>
                                <th>Action</th>  
    						  </tr>
						    </thead>
						    
						        <tbody >
              
                <?php foreach($allcategroies as $catagory) { ?>  
                   <tr >
                       <th><?= $catagoryNum  ?> </th>
                       <td><?= $catagory['name']; ?></td>
                       <td><?= $catagory['description']; ?></td>
                       
                       <td >
                <!--edit-->
                           <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $twitterSingleDetail['id'] ?>&twitter-category-id=<?= $catagory['id'];?>&edit=true" class="icons_for_account icon-edit"  data-toggle="tooltip" data-placement="top" title="Update Account"><i class="fa fa-pencil"></i></a>
                        <!--trash-->
                       <a href="action/addtweetCatagoryprocess.php?id=<?= $twitterSingleDetail['id'] ?>&twitter-category-id=<?= $catagory['id'];?>&delete=true" class="icons_for_account icon-delete"  data-toggle="tooltip" data-placement="top" title="Delete Account"><i class="fa fa-trash"></i></a>
                       <!--services-->
                   
                   
                       </td>
                   
                   </tr>
                   
                   <?php  $catagoryNum += 1 ;} ?>
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
<script>
$(document).ready(function(){
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});
});
</script>
<?php include_once './../includes/main_footer.php'; ?>



