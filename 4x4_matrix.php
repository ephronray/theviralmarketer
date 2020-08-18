<?php
$menu = array(
	'tab' => 2,
	'option' => '4x4'
);
//include_once 'includes/header.php';
include_once 'includes/main-header.php';
unset($_SESSION['new_refferals']);
$is_root = $_SESSION['user']['is_root'];
$my_ibm = $_SESSION['user']['ibm'];
$referrals = array();
$paid_levels = "SELECT * FROM  `subscribed_levels` WHERE  `sender_ibm` =  '".$_SESSION['user']['ibm']."' AND  `payment_status` =  '1'";
$all_level   = $newsifyObj->db_select($paid_levels);
$count_level    = mysqli_num_rows($all_level);
$levels_list = array();
$levels = array();
if($count_level > 0)
{
	while($data = mysqli_fetch_array($all_level))	
	{
		$levels[] = $data['level'];
		$levels_list[$data['level']] = $data;
		
	}	
}
function get_details($ibm)
{
	$obj = new  dbConnect();
	$result2 = $obj->db_select("SELECT first_name, last_name FROM members WHERE ibm='" . $ibm . "'");
	$count = mysqli_num_rows($result2);
	if ($count > 0)
	{
		$ref = mysqli_fetch_array($result2);
		return $ref['first_name'] . ' ' . $ref['last_name'];
	}
}

function show_html($data)
{
	$table = '<div class="table-responsive">
				<table class = "table-list-search" role="table" style="width: 100%;">
	              	<thead role="rowgroup" style="height:40px; background-color:#f0f3f6;">
	    				<tr role="row">
		              		<th role="columnheader">Level</th>
		              		<th role="columnheader">Sender IBM</th>
		              		<th role="columnheader">Name</th>
		              		<th role="columnheader">Sender Wallet</th>
		              		<th role="columnheader">Paid On</th>
		              	</tr>
		            </thead>

		            <tbody role="rowgroup">';
	$html = '';
	foreach($data AS $ref)
	{
		$html.= '
		<tr role="row">
			<td role="cell">' . $ref['level'] . '</td>
			<td role="cell">' . $ref['sender_ibm'] . '</td>
			<td role="cell">' . get_details($ref['sender_ibm']).'</td>
			<td role="cell">' . $ref['sender_address'] . '</td>
			<td role="cell">' . $ref['paid_date'] . '</td>
		</tr>';
	}
	$html .='</tbody></table></div>';
	return $table.$html;
}

function my_reff($level)
{
	$obj = new  dbConnect();
	$my_reff = "SELECT * FROM  `subscribed_levels` WHERE  `receiver_ibm` =  '".$_SESSION['user']['ibm']."' AND  `level` =  '".$level."' ";
	$result   = $obj->db_select($my_reff);
	$count    = mysqli_num_rows($result);
	if ($count > 0)
	{
		$my_reff_data = [];
		while($data = mysqli_fetch_array($result))	
		{
			$my_reff_datal[] = $data;
		}
		return $my_reff_datal;
	} else {
		return false;
	}
}

function my_incom($level1 , $level2)
{
	$obj = new  dbConnect();
	$my_reff_1 = "SELECT * FROM  `subscribed_levels` WHERE  `receiver_ibm` =  '".$_SESSION['user']['ibm']."' AND  `level` =  '".$level1."' ";
	$result1   = $obj->db_select($my_reff_1);
	$count1    = mysqli_num_rows($result1);
	$balance1 = 0;
	$balance2 = 0;
	if ($count1 > 0)
	{
		
		while($data = mysqli_fetch_array($result1))	
		{
			$balance1 = $balance1 + $data['level_amount'];
		}
		
	}
    
    $my_reff_2 = "SELECT * FROM  `subscribed_levels` WHERE  `receiver_ibm` =  '".$_SESSION['user']['ibm']."' AND  `level` =  '".$level2."' ";
	$result2  = $obj->db_select($my_reff_2);
	$count2    = mysqli_num_rows($result2);
	if ($count2 > 0)
	{
		$my_reff_data2 = [];
		while($data = mysqli_fetch_array($result2))	
		{
			$balance2 = $balance2 + $data['level_amount'];
		}
		
	}
	
	return $balance1 + $balance2;
}


 ?>
<Style>
 .levels{
		text-align: center;
		font-weight: bold;
		background-color: #9de451 !important;
		color: white;
	}
</style>
<Style>
 .levels{
		text-align: center;
		font-weight: bold;
		background-color: #9de451 !important;
		color: white;
	}
	
	 .panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default > .panel-heading {
        padding: 0;
		text-align:center
        border-radius: 0;
        color: #212121;
        border-color: #EEEEEE;
        background-color: #455a64;
    }

     .panel-default .panel-body {
         background-color: #ffffff !important;
         color: #67757c;
         padding: 1.25rem;
         border-radius: 5px;
         border: 1px solid lightgrey;
         margin-top: -5px;
         box-shadow: 0px 0px 8px lightgray;
     }

     .panel-title {
         font-size: 14px;

     }

     .panel-title > a {
         display: block;
         text-align: center;
         font-size: 17px;
         font-weight: normal;
         color: white;
         text-decoration: none
     }
     .panel-title > a :hover{
         text-decoration: none !important;
         color: #eaebe8 !important;
     }

    .tab-content{
        padding: 10px;
        border: 1px solid lightgrey;
        border-radius: 0px 0px 10px 10px;
        border-top: none;
        min-height: 150px;
        height: auto;
    }


    .more-less {
        float: right !important;
        color: #ffffff;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

	.video-container {
		position: relative;
		padding-bottom: 56.25%;
		padding-top: 30px; height: 0; overflow: hidden;
	}

	.video-container iframe,
	.video-container object,
	.video-container embed {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}


	/*
	Max width before this PARTICULAR table gets nasty. This query will take effect for any screen smaller than 760px and also iPads specifically.
	*/
	@media
	  only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr {
			display: block;
			font-size: 90%;
		}

		/* Hide table headers (but not display: none;, for accessibility) */
		thead tr {
			position: absolute;
			top: -9999px;
			left: -9999px;
		}

    tr {
      margin: 0 0 1rem 0;
    }
      
    /*tr:nth-child(odd) {
      background: #ccc;
    }*/
    
		td {
			/* Behave  like a "row" */
			border: none;
			border-bottom: 1px solid #eee;
			position: relative;
			padding-left: 50%;
		}

		td:before {
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 0;
			left: 6px;
			width: 100%;
			padding-right: 10px;
			white-space: nowrap;
		}

		/*
		Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
		*/
		td:nth-of-type(1):before { content: "Level"; }
		td:nth-of-type(2):before { content: "Sender IBM"; }
		td:nth-of-type(3):before { content: "Name"; }
		td:nth-of-type(4):before { content: "Sender Wallet"; }
		td:nth-of-type(5):before { content: "Paid On"; }
	}
	.blnc_res{
		margin-right: 60%;
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
			margin-right: 23%;
		}
	}

 .panel-group .panel-title {
     padding: 15px;
 }

</style>

<div class="content-wrapper matrix_4_page">

    <section class="content-header">
        <h1>
            Income Table
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Income Table</li>
        </ol>
    </section>

    <article class="content grid-page">
        <div class="title-block">
			<div class="row justify-content-end" style="margin-bottom: 20px;">

				<div class="col-md-2" >

					<a data-toggle="modal"  id="video-guide" class="btn btn-block btn-success" title="Show Level Details" href="javascript:void(0)">
                        <i class="fa fa-video-camera mr-5"
                           title="Here is video that will guide you about how income table works and how can you grow it. "></i>WATCH VIDEO
                    </a>

				</div>
			</div>
        </div>
		<section class="section">

            <div class="box" style="display: block; padding: 20px; min-height: 675px;">

                <div class="title-description alert alert-info text-center">This table displays all down line member upgrades</div>


                <div class="">
                    <?php include ('includes/balance_amount.php'); ?>
                </div>

            <div class="row ">
			   <div class="col-md-12">
				  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					 <div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading1">
						   <h4 class="panel-title">
							  <a role="button" class="expand-btn collapsed" data-toggle="collapse" data-parent="#level1" href="#level1" aria-expanded="false" aria-controls="level1">
							      
							  <i class="more-less fa fa-plus-circle"></i>
							  Bronze - Gold &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Earned  <?php echo my_incom(1,5); ?>  (USD) 
							  </a> 
							  
						   </h4>
						</div>
						<div id="level1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1" aria-expanded="false" style="">
						   <div class="panel-body">
							 <div class="card sameheight-item" style="height: auto;">
							 <div class="card-block">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-tabs-bordered">
								    <li class="nav-item"> 
										<a href="" class="nav-link active" data-target="#bronze" aria-controls="gold" data-toggle="tab" role="tab" aria-expanded="true">
										Bronze
										</a> 
									</li>
								    <li class="nav-item"> 
									   <a href="" class="nav-link " data-target="#gold" aria-controls="gold" data-toggle="tab" role="tab" aria-expanded="false">
									   Gold
									   </a> 
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabs-bordered">
								   <div class="tab-pane fade active in" id="bronze" aria-expanded="true">
								   <?php 
								   if(in_array(1, $levels) || $is_root)
									{
										$data = my_reff(1);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Bronze level from your referrals!!</p>';
										}
										
									} else {
										echo '<p>Please subscribe to Bronze Level to start your earning!!</p>';
									}
								   ?>
								   </div>
								   <div class="tab-pane fade " id="gold" aria-expanded="false">
								   <?php 
									if(in_array(5, $levels) || $is_root)
									{
										$data = my_reff(5);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Gold level from your referrals!!</p>';
										}
									} else if (count($levels) == 4){
										echo '<p>Please upgrade to Gold Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								</div>
							 </div>
							<!-- /.card-block -->
							</div>
						   </div>
						</div>
					 </div>
				  </div>
				  
				  
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					 <div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading2">
						   <h4 class="panel-title">
							  <a role="button" class="expand-btn collapsed" data-toggle="collapse" data-parent="#level2" href="#level2" aria-expanded="false" aria-controls="level2">
							  <i class="more-less fa fa-plus-circle"></i>
							  Silver - Platinum &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Earned <?php echo my_incom(2,6); ?> (USD) 
							  </a> 
						   </h4>
						</div>
						<div id="level2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2" aria-expanded="false" style="">
						   <div class="panel-body">
							 <div class="card sameheight-item" style="height: auto;">
							 <div class="card-block">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-tabs-bordered">
								    <li class="nav-item"> 
										<a href="" class="nav-link active" data-target="#silver" aria-controls="silver" data-toggle="tab" role="tab" aria-expanded="false">
										Silver
										</a> 
									</li>
								    <li class="nav-item"> 
									   <a href="" class="nav-link " data-target="#platinum" aria-controls="platinum" data-toggle="tab" role="tab" aria-expanded="true">
									   Platinum
									   </a> 
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabs-bordered">
								   <div class="tab-pane fade active in" id="silver" aria-expanded="true">
								    <?php 
									if(in_array(2, $levels) || $is_root)
									{
										$data = my_reff(2);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Silver level from your referrals!!</p>';
										}
									} else if (count($levels) == 1){
										echo '<p>Please upgrade to Silver Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								   <div class="tab-pane fade " id="platinum" aria-expanded="false">
								    <?php 
									if(in_array(6, $levels) || $is_root)
									{
										$data = my_reff(6);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Platinum level from your referrals!!</p>';
										}
									} else if (count($levels) == 5){
										echo '<p>Please upgrade to Platinum Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								</div>
							 </div>
							<!-- /.card-block -->
							</div>
						   </div>
						</div>
					 </div>
				</div>
				
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading3">
						   <h4 class="panel-title">
							  <a role="button" class="expand-btn collapsed" data-toggle="collapse" data-parent="#level3" href="#level3" aria-expanded="false" aria-controls="level3">
							  <i class="more-less fa fa-plus-circle"></i>
							  Ruby - Titanium &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Earned <?php echo my_incom(3,7); ?> (USD) 
							  </a> 
						   </h4>
						</div>
						<div id="level3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3" aria-expanded="false" style="">
						   <div class="panel-body">
							 <div class="card sameheight-item" style="height: auto;">
							 <div class="card-block">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-tabs-bordered">
								    <li class="nav-item"> 
										<a href="" class="nav-link active" data-target="#ruby" aria-controls="ruby" data-toggle="tab" role="tab" aria-expanded="false">
										Ruby
										</a> 
									</li>
								    <li class="nav-item"> 
									   <a href="" class="nav-link " data-target="#titanium" aria-controls="titanium" data-toggle="tab" role="tab" aria-expanded="true">
									   Titanium
									   </a> 
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabs-bordered">
								   <div class="tab-pane fade active in" id="ruby" aria-expanded="true">
								    <?php 
									if(in_array(3, $levels) || $is_root)
									{
										$data = my_reff(3);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Ruby level from your referrals!!</p>';
										}
									} else if (count($levels) == 2){
										echo '<p>Please upgrade to Ruby Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								   <div class="tab-pane fade " id="titanium" aria-expanded="false">
								   <?php 
									if(in_array(7, $levels) || $is_root)
									{
										$data = my_reff(7);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Titanium level from your referrals!!</p>';
										}
									} else if (count($levels) == 6){
										echo '<p>Please upgrade to Titanium Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								</div>
							 </div>
							<!-- /.card-block -->
							</div>
						   </div>
						</div>
					</div>
				</div>
				  
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="heading4">
						   <h4 class="panel-title">
							  <a role="button" class="expand-btn collapsed" data-toggle="collapse" data-parent="#level4" href="#level4" aria-expanded="false" aria-controls="level4">
							  <i class="more-less fa fa-plus-circle"></i>
							  Pearl - Diamond &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Earned <?php echo my_incom(4,8); ?> (USD) 
							  </a> 
						   </h4>
						</div>
						<div id="level4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4" aria-expanded="false" style="">
						   <div class="panel-body">
							 <div class="card sameheight-item" style="height: auto;">
							 <div class="card-block">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-tabs-bordered">
								    <li class="nav-item"> 
										<a href="" class="nav-link active" data-target="#pearl" aria-controls="pearl" data-toggle="tab" role="tab" aria-expanded="false">
										Pearl
										</a> 
									</li>
								    <li class="nav-item"> 
									   <a href="" class="nav-link " data-target="#diamond" aria-controls="diamond" data-toggle="tab" role="tab" aria-expanded="true">
									   Diamond
									   </a> 
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content tabs-bordered">
								   <div class="tab-pane fade active in" id="pearl" aria-expanded="true">
								    <?php 
									if(in_array(4, $levels) || $is_root)
									{
										$data = my_reff(4);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Pearl level from your referrals!!</p>';
										}
									} else if (count($levels) == 3){
										echo '<p>Please upgrade to Pearl Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								   <div class="tab-pane fade " id="diamond" aria-expanded="false">
								    <?php 
									if(in_array(8, $levels) || $is_root)
									{
										$data = my_reff(8);
										if ($data) {
											echo show_html($data);
										} else {
											echo '<p>You have not received any Payment for Gold level from your referrals!!</p>';
										}
									} else if (count($levels) == 7){
										echo '<p>Please upgrade to Diamond Level to earn more!!</p>';
									}else {
										echo '<p>Level Locked!!</p>';
									}
								   ?>
								   </div>
								</div>
							 </div>
							<!-- /.card-block -->
							</div>
						   </div>
						</div>
					</div>
				</div>
			   </div>
			</div>

            </div>

		</section>
	</article>

</div>

	<div class="modal fade in" id="video-demo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-btn" >
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">
				<i class="fa fa-play-circle"></i>&nbsp;&nbsp;
					Income Table Building Guidelines</h4>
			</div>
			<div class="modal-body video-container">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/Bpn-FErddVw?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>												
			</div>
			<div class="modal-footer" style="padding-left: 20px;">
				<button type="button" class="btn btn-danger close-btn" >Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<?php
include_once 'includes/main_footer.php';
?>


<script>
$(document).ready(function(){
	$('#video-guide').click(function() {
		$('#video-demo').show();
		$("#player").attr('src','https://www.youtube.com/embed/_fHyqyDFXd8'); 
	});

	$('.close-btn').click(function() {
		$('#video-demo').hide();
		$("#player").attr('src','');   
	});
});
$(function ($) {
	$('.expand-btn').on('click', function(e){
		$(this).find('.more-less').toggleClass('fa-plus-circle fa-minus');
	});
});
</script>
<?php //include_once 'includes/footer.php'; ?>