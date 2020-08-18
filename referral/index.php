<?php
	include_once '../_libs/dbConnect.php';
	$obj = new  dbConnect();
	if(!isset($_GET['ref']) || empty($_GET['ref']))
	{
		echo 'No ref Found!';
		exit();
	}else 
	{
		$ibm = strtoupper($_GET['ref']);
		$sql = "SELECT 
					member_id, page_id 
				FROM  
					`tbl_member_landingpage` 
				WHERE 
					`member_ibm` =  '{$ibm}' 
				LIMIT 1;";
		$query = $obj->db_select($sql);
		$result = mysqli_fetch_assoc($query);
		if(count($result) == 2)
		{
			$sql = "SELECT 	
						id, page_name, youtube_video,page_path 
					FROM  
						`tbl_landing_pages`
					WHERE  
						`id` =  {$result['page_id']}";
			$query   = $obj->db_select($sql);
			$landingPage = mysqli_fetch_assoc($query);
			if(!empty($landingPage))
			{
			    //echo "https://admin.theviralmarketer.biz/landing_pages/".$landingPage['page_path']	;
				echo "<li> <iframe src=\"https://admin.theviralmarketer.biz/landing_pages/".$landingPage['page_path'].'/?ref='.$_GET['ref']."\" style=\"position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;\">	</iframe></li>";
				exit();
			}
		}
	}
?>