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
 
$keywords = "";
if(isset($_GET['keywords']) && isset($_GET['id'])) {
    $keywords = $_GET['keywords'];
    $data = array('id'=>$_GET['id'] , 'keywords'=> $_GET['keywords']);
 $searchTweetsResult = $twitter->searchTweets($data);
 
    
    
}

//get all tweet categories
$allcategroies = $db->showTweetCatagories();

//get all tweet categories

//insert category
$categoryTittle = 'Add Category';
$showalert = false;
$message = '';
        if(isset($_POST['submit']))    {
        $record = array('name' => $_POST["name"] , 'description' => $_POST["description"]);
        $response = $db->saveTweetCategry($record);
        
        if($response['success']== true) {
            $showalert = true;
           $message = $response['message'];
           
        } else {
               $showalert = true;
           $message = 'There is something  issue, please try again.';
            
        }
           
        }   
        
if((isset($_GET['twitter-category-id'])) && isset($_GET['delete'])==true) 
{
    $id = $_GET['twitter-category-id'];
    $db->deleteTweetCategory($id);
    
}

//insert category
?>
<style>


     

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

            <h3 class="title">Add/list tweets category</h3>

            <p class="title-description">Add new category, edit category and list all category of tweets.  </p>

            <div class="blnc_res">
                <?php require_once (__DIR__.'/../includes/balance_amount.php');
                ?>
            </div>

        </div>

        <section class="section">
         <?php require_once (__DIR__.'/../viral-tweets/single-twitter-account.php'); ?>



        <div classs="row">
            <!--content here-->
           <h3 align="center"> <?= $categoryTittle ?></h3>
           <?php
if( $showalert == true) {
if($response['success']== true){?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?=  $message; ?>
  </div>
  <?php }else
  { ?>
      <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <?=  $message; ?>
     </div>
 <?php }} ?>
 
              <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $twitterSingleDetail['id'] ?> " method="POST" >
            <div class="form-group col-md-12">
                <label>Name</label>
                <div class="input-group">
                <input type="text" name="name" class="form-control">
                    </div>
                    <label>Description</label>
                    <div class="input-group">
                  <textarea class="form-control" name="description"  rows="3"></textarea>
                </div>
                   <input type="submit" name="submit"  class="btn btn-primary w-100" value="ADD">
              </div>
              </form>
      
        </div>


<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
     <strong>Catagory is Successfully Deleted</strong>
     </div>


<div class="row">

<h3 align="center">Catagories List</h3>

    <div class="col-md-12">
                <div class="table-responsive">
        <table class="table twitter-account-table" style="width: 100%;">
          <thead>
              <tr>
                <th>Name </th>
                <th>disc</th>
                <th>Action</th>   
              </tr>
          </thead>

          <tbody class="twitter-account-table-body">
              
                <?php foreach($allcategroies as $catagory) { ?>  
                   <tr style="height:45px;">
                       <td><?= $catagory['name']; ?></td>
                       <td><?= $catagory['description']; ?></td>
                       
                       <td>
                <!--edit-->
                           <a href="#" class="icon-edit"  data-toggle="tooltip" data-placement="top" title="Update Account"><i class="fa fa-edit"></i></a>
                        <!--trash-->
                       <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?= $twitterSingleDetail['id'] ?>&twitter-category-id=<?= $catagory['id'];?>&delete=true  " class="icon-delete"  data-toggle="tooltip" data-placement="top" title="Delete Account"><i class="fa fa-trash"></i></a>
                       <!--services-->
                   
                   
                       </td>
                   
                   </tr>
                   
                   <?php } ?>
                        </tbody>
                    </table>
                </div>
    </div>
</div>
         <br/>
         <br/>
       </section>

    </article>

<?php require_once (__DIR__.'/../includes/footer.php'); ?>



