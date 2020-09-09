<?php  
$menu = array('tab'=>4, 'option' => 'marketing_pages');
 include_once 'includes/main-header.php';
$newsifyObj = null;
$db = new  dbConnect();
$messages = [];
$userId = $_SESSION['user']['u_id'];
$userIbm = $_SESSION['user']['ibm'];
if(isset($_POST['select_page']) && !empty($_POST['page_no']))
{
	$pageId = $db->cleanPOST($_POST['page_no']);
	if(!empty($pageId))
	{
		$sql = "SELECT
					id
				FROM  
					`tbl_member_landingpage`
				WHERE  
					`member_id` =  {$userId}";
		$query   = $db->db_select($sql);
		if(mysqli_num_rows($query) == 0)
		{
			#insert new data
			echo $new = "INSERT INTO `tbl_member_landingpage`
					(`member_id`, `member_ibm`, `page_id`)
					VALUES ({$userId}, '{$userIbm}', {$pageId});";
			if($db->db_insert($new))
			{
				$messages['class'] = 'success';
				$messages['mesg'] = 'Landing Page Has Been Selected.Now You Can Share YOur Referral Link To Your Friends!';
			} else 
			{
				$messages['class'] = 'danger';
				$messages['mesg'] = 'Something Went Wrong Please Try Later!.';
			}
			
		} else
		{
			#update old one with new page no
			#insert new data
			$update = "UPDATE `tbl_member_landingpage`
					SET 
						`page_id` = {$pageId},
						`updated_at` = '".date('Y-m-d H:i:s')."'
					WHERE 
						`member_id` = {$userId}
					AND 
						`member_ibm` = '{$userIbm}'
					LIMIT 1;";
			if(mysqli_query($db->dbCon, $update))
			{
				$messages['class'] = 'success';
				$messages['mesg'] = 'Landing Page Has Been Updated.Now You Can Share YOur New Landing Page To Your Friends!';
			} else
			{
				$messages['class'] = 'danger';
				$messages['mesg'] = 'Something Went Wrong Please Try Later!.';
			}
		}
	} else 
	{ 
		$messages['class'] = 'danger';
		$messages['mesg'] = 'Something Went Wrong Please Try Later!.';
	}
}
$sql = "SELECT 	
			id, page_name, youtube_video, min_level, page_path, page_images 
		FROM  
			`tbl_landing_pages`
		WHERE  
			`is_active` =  '1' 
		Order by 
			id DESC";
$query   = $db->db_select($sql);
$count_pages = mysqli_num_rows($query);
?>
	<style>
		.title > i {
			color: white;
			font-size: x-large;
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
        Landing Pages
      </h1>
       <p class="title-description">Select your marketing/landing pages and send to your friends!</p>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Landing Pages</li>
      </ol>
    </section>
<section class="content">
    <section class="content grid-page">
       
       
            <div class="row ">
			<div class="col-xl-12">
			<?php
				if(!empty($messages))
				{?>
			
    
    <div > <?=  $db->alertMessage($messages['class'], $messages['mesg']); ?></div>
  
			<?php	}
			?>
			</div>
			<?php 
			if($count_pages > 0)
			{
				$selected = FALSE;
				while($data = mysqli_fetch_array($query))	
				{	
					//if(!is_null($selected))
					//{
						$sql = "SELECT id FROM  `tbl_member_landingpage` WHERE `page_id` =  {$data['id']} 
						AND 
						`member_id` = {$userId}
						AND 
						`member_ibm` = '{$userIbm}' ";
						if(mysqli_num_rows($db->db_select($sql)) == 1)
						{
							$selected = TRUE;
						}
					//}
				?>
				 <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
				<div class="box">
						<div class="box-header with-border">
						      
						     <?php if($selected) {  ?>
						      <div class="ribbon ribbon-vertical-l bg-success" >
						          <?php
									echo '<i  style="font-size: 1.25rem;" class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;'; 
									$selected = NULL; 
									?>
																	</div>
								<?php } ?>

						     <h4 class="box-title" style="margin-left:8%;">
						       
								<?=$data['page_name'];?></h4>
								 <ul class="box-controls pull-right">
                  
                  <li><a class="box-btn-slide"  href="#"></a></li>	
                 
                </ul>
							
						</div>
						 <div class="box-body">
						     <div style="    height: 258px !important;width: 100%;margin-bottom: 4%;">
						     <?php if($data['page_images']){ ?>
							<img  src="assets/landing_pages/images/<?=$data['page_images']?>" 
							
							class="img-thumbnail img-responsive" alt="<?=$data['page_name'];?>"
							style="    height: 258px !important;width: 100%;margin-bottom: 4%;">
							<?php } else { ?>
								<img  src="assets/logo.png" 
							
							class="img-thumbnail img-responsive" alt="Landing Pages"
							style="    height: 258px !important;width: 100%;margin-bottom: 4%;">
							<?php } ?>
							</div>
							<div >
							<form action="" method="POST">
								<input type="hidden" value="<?=$data['id'];?>" name="page_no">
								<button class="btn btn-primary btn-block" type="submit" name="select_page">Select This Landing Page</button>
							</form>
						</div>
						
						</div>
					
					</div>
                </div>
				<?php	
				}	
			} ?>
			</div>
        </section>
    
    </section>
    </div>
<?php include_once 'includes/main_footer.php'; ?>