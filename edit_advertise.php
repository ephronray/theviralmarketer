<?php 
$menu = array('tab'=>12, 'option' => null);
include_once 'includes/header.php';
require_once (__DIR__.'/_libs/payment.php');
require_once (__DIR__.'/_libs/dbConnect.php');
$obj = new dbConnect();
if(isset($_GET['id']))
$id = $_GET['id'];
$query    = "SELECT * FROM MemberAdvertise WHERE id= '$id'";
$result   = $obj->db_select($query);
?>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">Edit Banner</h3>
        </div>
        <section class="section">
<?php
$banner_path = '';
$active_inactive= '';
while($data = mysqli_fetch_array($result))
{ //echo "<pre>";print_r($data);die();
$banner_path= $data['banner_path']; 
$push_message= $data['push_message']; 
$redirect_url= $data['redirect_url']; 
$youtube_video_url= $data['youtube_video_url']; 
$active_inactive = $data['active_inactive'];
}
$ibm = $_SESSION['user']['ibm'];
$email = $_SESSION['user']['email'];

if(isset($_POST['update_banner']))
{
  $banner_path;
   
  $images_path = $obj->move_profile_image($_FILES['banner_img']['tmp_name'], "images/" , $_FILES['banner_img']['name'] );
  if($images_path == null)
  {
      $images_path = $banner_path;
  }
  $data = array(
      
      'upline_member' => $ibm,
      'banner_path' => $images_path,
      'active_inactive' => $_POST['active_inactive'],
      'push_message' => $_POST['push_message'],
      'redirect_url' => $_POST['redirect_url'],
      'youtube_video_url' => $_POST['youtube_video_url'],
      'id' => $_GET['id']
      );
     
      $response = $obj->updateBanner($data);
      $url = "http://theviralmarketer.biz/member_advertise.php?message=".$response['message'];
      if($response['success'] == true)
      {
        $obj->redirectMe($url);
      ?>
        <div class="alert alert-success">
          <strong>Success!</strong> <?php echo $response['message']; ?>
        </div>
        
      <?php

      }
      if($response['success'] == false)
      {

      ?>
    <div class="alert alert-danger">
    <strong></strong> <?php echo $response['message']; ?>
  </div>
  <?php
    }

  }

  ?>
        <div class="col-xs-12 col-md-12">
           
          <div class="card card-block sameheight-item" style="height: 820px;">

              <form role="form" method="POST" enctype='multipart/form-data' >
                  <!--Default version-->
     
                   <div class="row section">
                      <div class="col-xs-12 col-md-12">
                        <b>Upload Banner</b>
                      </div>
                      <div class="col-xs-12 col-md-12">
                        <input type="file" id="input-file-now" value="<?php echo $banner_path; ?>" name="banner_img" class="dropify" data-default-file="<?php echo $banner_path; ?>" />
                      </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2">Push Message</label>
                        <textarea class="form-control rounded-0" id="push_message" name="push_message" rows="3">
                          <?php echo $push_message; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Redirect URL</label>
                      <input type="url" class="form-control" id="redirect_url" name="redirect_url" aria-describedby="emailHelp" placeholder="Please Enter your URL Here" value="<?php echo $redirect_url; ?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Youtube Video URL</label>
                      <input type="url" class="form-control" id="youtube_video_url" name="youtube_video_url" aria-describedby="emailHelp" placeholder="Please Enter your Yotube Video URL Here" value="<?php echo $youtube_video_url; ?>">
                    </div>   

                    <div class="form-group"> 
                        <label for="active_inactive">Active/Inactive</label>
                        <select class="form-control" name="active_inactive" id="active_inactive">
                         <?php   if($active_inactive= 1)
                            { ?>
                            <option value="1" selected="selected">Active</option>
                            <option value="0" >Inactive</option>
                            
                            <?php
                            } 
                            if($active_inactive= 0)
                            { 
                            ?>
                            <option value="1" >Active</option>
                            <option value="0" selected="selected">Inactive</option>
                        <?php }    ?>
                        </select>
                    </div>
                    
                    <div class="form-group"> 
                      <button type="submit"  name="update_banner" onclick="myFunction()" class="btn btn-primary pull-right">
                        Update
                      </button> 
                    </div>

              </form>
          </div>


        </div>

  
    </section>
    </article>
    
    
<!-- <script type="text/javascript">
  function myFunction() {
    alert("in my function");
      window.location.href = 'http://localhost/theviralmarketer.biz/member_advertise.php';
  }
  </script> -->
<?php include_once 'includes/footer.php'; ?>