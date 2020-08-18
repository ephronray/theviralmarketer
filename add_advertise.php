<?php 
$menu = array('tab'=>11, 'option' => null);
include_once 'includes/header.php';
require_once (__DIR__.'/_libs/payment.php');
require_once (__DIR__.'/_libs/dbConnect.php');
$newsifyObj = new  payment();
$obj = new dbConnect();

?>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">Add New  </h3>

        </div>
        <section class="section">
<?php


$ibm = $_SESSION['user']['ibm'];
$email = $_SESSION['user']['email'];
if(isset($_POST['save_banner']))
{
   
  $images_path = $obj->move_profile_image($_FILES['banner_img']['tmp_name'], "images/" , $_FILES['banner_img']['name'] );
  $data = array(
      'upline_member' => $ibm,
      'banner_path' => $images_path,
      'push_message' => $_POST['push_message'],
      'redirect_url' => $_POST['redirect_url'],
      'youtube_video_url' => $_POST['youtube_video_url'],
      'active_inactive' => $_POST['active_inactive']
      );

$response = $obj->addBanner($data);
    if($response['success'] == true)
    {
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
                    <form role="form" method="POST" action='add_advertise.php' enctype='multipart/form-data' >
                        <!--Default version-->
                         <div class="row section">
                            <div class="col-xs-12 col-md-12">
                              <b>Upload Banner</b>
                            </div>
                            <div class="col-xs-12 col-md-12">
                              <input type="file" id="input-file-now"  name="banner_img" class="dropify" data-default-file="" />
                            </div>
                          </div>
  
                          <div class="form-group">
                              <label for="exampleFormControlTextarea2">Push Message</label>
                              <textarea class="form-control rounded-0" id="push_message" name="push_message" rows="3"></textarea>
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Redirect URL</label>
                            <input type="url" class="form-control" id="redirect_url" name="redirect_url" aria-describedby="emailHelp" placeholder="Please Enter your URL Here">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Youtube Video URL</label>
                            <input type="url" class="form-control" id="youtube_video_url" name="youtube_video_url" aria-describedby="emailHelp" placeholder="Please Enter your Yotube Video URL Here">
                          </div>                          

                          <div class="form-group"> 
                              <label for="active_inactive">Active/Inactive</label>
                              <select class="form-control" name="active_inactive" id="active_inactive">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                              </select>
                          </div>



                        <div class="form-group"> 
                            <button type="submit"  name="save_banner" class="btn btn-primary pull-right">Save</button> 
                        </div>
                    </form>
                </div>
            </div>

  
    </section>
    </article>
    
<?php include_once 'includes/footer.php'; ?>