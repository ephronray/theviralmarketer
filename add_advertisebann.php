<?php 
$menu = array('tab'=>11, 'option' => null);
include_once 'includes/header.php';
require_once (__DIR__.'/_libs/payment.php');
require_once (__DIR__.'/_libs/dbConnect.php');
//$newsifyObj = new  payment();
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
    echo "raza";
   // echo $_FILES['banner_img']['tmp_name'];
    //echo $images_path = $obj->move_profile_image($_FILES['banner_img']['tmp_name'], "/images" , $_FILES['banner_img']['name'] );
  
}
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
    <strong>transaction Unsuccessfull!</strong> <?php echo $response['error']; ?>
  </div>
        <?php
    }
        




?>
<div class="col-xs-12 col-md-12">
               
           
                <div class="card card-block sameheight-item" style="height: 685px;">
                    <form role="form" method="post" action="add_advertise.php" enctype='multipart/form-data'>
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
                            <label for="active_inactive">Active/Inactive</label>
                            <select class="form-control" name="active_inactive" id="active_inactive">
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group"> 
                            <button type="submit" name="save_banner" class="btn btn-primary ">Save</button> 
                        </div>
                    </form>
                </div>
            </div>

  
    </section>
    </article>
    
<?php include_once 'includes/footer.php'; ?>