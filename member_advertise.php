<?php 
$menu = array('tab'=>10, 'option' => null);
include_once 'includes/header.php';
require_once (__DIR__.'/_libs/payment.php');
require_once (__DIR__.'/_libs/dbConnect.php');

$newsifyObj = new dbConnect();
$query    = "SELECT * FROM MemberAdvertise;";
$result   = $newsifyObj->db_select($query);

?>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
        <article class="content grid-page">
        <div class="title-block">
            <h3 class="title"> Member Advertise </h3>

        </div>
        <section class="section">
<?php


$ibm = $_SESSION['user']['ibm'];
$email = $_SESSION['user']['email'];

if(isset($_GET['delete']))
{
?>
<div class="alert alert-success">
    <strong>Success!</strong> Successfully Deleted
  </div>
<?php }

if(isset($_GET['message']))
{
?>
<div class="alert alert-success">
  <strong> Record Updated Successfully</strong>
  </div>
<?php 
}
    

if(isset($_POST['delete_btn']))
{
    
     $id= $_POST['delete_id'];
  $response =  $newsifyObj->deleteBanner($id);
      if($response['success'] == true)
    {
        $newsifyObj->redirectMe("member_advertise.php?delete='successfully'");
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

<a href="add_advertise.php" class="btn  btn-primary" style="float: right;">Add New</a>
      
  <div class="box-body table-responsive no-padding card card-block sameheight-item">
                  <table class="table table-hover">
                    <tr>
                      <th>Banner</th>
                      <th>Status</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      
                    </tr>
                    <?php
                    	
                    while($data = mysqli_fetch_array($result))
                    	{
                    	    if($data['upline_member'] == $ibm)
                    	    {
                    	        
                    	    
                    ?>
                    <tr>
                      <td><img src="<?php echo $data['banner_path']; ?>" width="100px; height="100px"></td>
                      <td><?php if($data['active_inactive'] == 1){
                      echo "Active";
                      }
                      if($data['active_inactive'] == 0)
                      {
                          echo "Inactive";
                      }
                      
                      ?>
                      </td>                      
                      <td class="text-center"><a class="btn btn-sm btn-primary" href="edit_advertise.php?id=<?php echo $data['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                      <td class="text-center">
                          <form method="POST">
                              <input type="hidden" value="<?php echo $data['id']; ?>" name="delete_id">
                              <button class="btn btn-sm btn-danger" type="submit" name="delete_btn" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                             </form> 
                          
                      </td>
                    </tr>
                    <?php
                        }
                    	}
                
                    ?>
                  </table>
                  
                  </div>
  
    </section>
    </article>
    
<?php include_once 'includes/footer.php'; ?>