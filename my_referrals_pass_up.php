<?php
$menu = array(
	'tab' => 2,
	'option' => 'my_referrals_pass_up'
);
//include_once 'includes/header.php';
//include_once 'includes/header.php';
include_once 'includes/main-header.php';

unset($_SESSION['new_refferals']);
$is_root = $_SESSION['user']['is_root'];
$my_ibm = $_SESSION['user']['ibm'];
$referrals = array();
$obj = new dbConnect();
function get_details($ibm, $newsifyObj)
{ 	 

	$result2 = $newsifyObj->db_select("SELECT * FROM members WHERE ibm='" . $ibm . "'");
	
	$count = mysqli_num_rows($result2);
	if ($count > 0)
	{
		$ref = mysqli_fetch_array($result2);
		return array(
			'name' => $ref['first_name'] . ' ' . $ref['last_name'],
			'ibm' => $ref['ibm'],
			'u_id' => $ref['u_id']
		);

		
	}
}

function referral_html($referals)
{
	$html = '';
	foreach($referals AS $ref_all)
	{
		foreach($ref_all AS $ref)
		{
			$html.= '
			<tr class="odd gradeX">
				<td class="text-center">' . $ref['level'] . '</td>
				<td>' . $ref['referal_ibm'] . '</td>
				<td>' . $ref['referal_name'] . '</td>
				<td>' . $ref['email'] . '</td>
				<td>' . $ref['refered_by'] . '</td>

				<td class="text-center">
					<a href="mailto:' . $ref['email'] . '" title="Click Here To Email ' . $ref['email'] . '">
						<i class="fa fa-envelope fa_change"></i>
					</a>
				</td>

			</tr>';
		}
	}
	return $html;
}

function show_refferal($level, $ibms, $is_root, $obj)
{
	$level++;
	$referrals = array();
	$odd_ref = array();
	$even_ref = array();
	foreach($ibms as $ibm)
	{
		$result2 = $obj->db_select("SELECT * FROM members WHERE refer_ibm='" . $ibm . "' OR passad_up_to='" . $ibm . "'");
        //$row = $result2->fetch_assoc();
        
		$count = mysqli_num_rows($result2);

		if ($count > 0)
		{
			$counter = 1;
			while ($ref = mysqli_fetch_array($result2))
			{
				
					$current_refferal = array(
						'level' => $level,
						'referal_name' => $ref['first_name'] . ' ' . $ref['last_name'],
						'referal_ibm' => $ref['ibm'],
						'email' => $ref['user_email'],
						'u_id' => $ref['u_id'],
						'refered_by' => get_details($ibm, $obj) ['name'],
						'refered_by_ibm' => get_details($ibm, $obj) ['ibm']
					);

				if ($ref['refer_ibm'] == $ibm  && empty($ref['passad_up_to']) && $level == 1)  //my real refered
				{
					//array_push($referrals, $ref['ibm']); 
					$odd_ref[] = $current_refferal;
				} else if(!empty($ref['passad_up_to']) && $ref['refer_ibm'] != $ibm) {  // my passed up 
					array_push($referrals, $ref['ibm']); 
				    $current_refferal['refered_by'] = get_details($ref['refer_ibm'], $obj) ['name'].' (PASSED UP TO '.get_details($ref['passad_up_to'], $obj) ['name'].')';
					$even_ref[] = $current_refferal;
					$counter++;
				}
			}
		}
	}

	$_SESSION['new_refferals'][$level] = array_merge_recursive($even_ref, $odd_ref);
	if (count($referrals) > 0)
	{
		show_refferal($level, $referrals, 0, $obj);
	}
	else
	{
		echo referral_html($_SESSION['new_refferals']);
	}
} ?>
<Style>
 .levels{
		text-align: center;
		font-weight: bold;
		background-color: #9de451 !important;
		color: white;
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

	.blnc_res{
		margin-left: -65%;
		width: 100%;
	}





	@media only screen and (max-width: 2048px) {
	    .blnc_res {
	        margin-left: -52%;
			width: 100%;
	    }
	}

	@media only screen and (max-width: 1024px) {
	    .blnc_res {
	        margin-left: -52%;
			width: 100%;
	    }
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
	        width: 72%;
	        margin-left: 5%;
	        margin-bottom: 40px;
	    }
	    .btn_ref{
			margin-right: 20%;
		}
	}

    #video-guide:focus{
        color: white;
    }

</style>
<div class="content-wrapper transaction_page">

    <section class="content-header">
        <h1>
            My Email List
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">My Email List</li>
        </ol>
    </section>

    <article class="content grid-page">
        <div class="title-block">
            <div class="row mb-5">
                <div class="col-md-4 mb-5">


                        <a data-toggle="modal" class="btn btn-block btn-success"   id="video-guide" title="Show Level Details" href="javascript:void(0)">
                            <i class="fa fa-video-camera"
                               title="Here is video that will guide you about how Email list works and how can you grow it. "></i>
                                WATCH VIDEO
                        </a>

                </div>


                <?php
                $query_button_check = $obj->db_select("SELECT * FROM subscribed_levels WHERE 
                    level = '1' 
                    AND sender_ibm = '".$my_ibm."'
                    ORDER BY id DESC");
                //print_r($query_button_check);

                if (mysqli_num_rows($query_button_check) > 0 )
                {
                    ?>
                    <div class="col-md-4 mb-5">
                            <button class="pull-right btn btn-block btn-success" onClick="window.location.href='./export/export_ref.php'">
                                Export  your Referrals (XLS)
                            </button>

                    </div>

                    <div class="col-md-4 mb-5">
                        <a href="member_advertise.php" class="btn btn-block  btn-primary" style="float: right;" >
                            Promote Your Opportunity
                        </a>
                    </div>

                    <?php
                }
                else
                {
                    ?>
                    <div class="col-md-4 mb-5">
                            <button class="btn-block btn btn-success"  title="Please Upgrade to Bronze Level from Upgrades to activate this option!" disabled>
                                Export  your Referrals (XLS)
                            </button>

                    </div>

                    <div class="col-md-4 mb-5">
                        <button class="btn btn-block btn-success"  title="Please Upgrade to Bronze Level from Upgrades to activate this option!" disabled >
                            Promote Your Opportunity
                        </button>
                    </div>

                    <?php
                }
                ?>



            </div>



			<div class="row ">




			
			</div>
        </div>
        <section class="section">

            <div class="box" style="display: block; padding: 20px; min-height: 675px;">

                <div class="title-description alert alert-info text-center">Your email list will grow bigger as your downline grows. You can use this list to build any other business</div>

                <div class="">
                    <?php include ('includes/balance_amount.php'); ?>
                </div>

            <div class="row ">
                <div class="col-md-12">

                <?php if(true){ ?>


                    <div class="box box-solid bg-black ">
                        <div class="box-header with-border">
                            <h3 class="box-title">Email List</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                        title="Collapse">
                                    <i class="fa fa-minus"></i></button>

                            </div>
                        </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped no-margin" style="width: 100%;">
                                <thead class="flip-header">
                                <tr>
                                    <th class="text-center">Level</th>
                                    <th>IBM</th>
                                    <th>Names</th>
                                    <th>Email</th>
                                    <th>Introduced By</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php show_refferal(0, array($_SESSION['user']['ibm']), $is_root, $newsifyObj); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    </div>

                    <?php }else {
                    echo  $newsifyObj->alertMessage('info', 'No, Referral Found');
                    }?>

                </div>
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
                                    Email List Building Guidelines</h4>
                            </div>
                            <div class="modal-body video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/dTvTZbU5sSs?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                            <div class="modal-footer" style="padding-left: 20px;">
                                <button type="button" class="btn btn-danger close-btn" >Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>


            </div>


        </section>
	</article>

</div>
	<!-- Bootstrap Modal Start -->

	<!-- <div id="myModal" class="modal fade" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">
                        Email List Details
                    </h4>
                </div>


                <div class="modal-body">
                    <?php if(true){ ?>
                    <div class="table-responsive">
                        <table class="table table-list-search" style="width: 100%;">
                            <thead class="flip-header">
                            <tr>
								<th>Levels</th>
                                <th>IBM</th>
                                <th>Names</th>
                                <th>Email</th>
                                <th>Introduced By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            	<tr>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            	</tr>
                            </tbody>
                        </table>
                    </div>
                    <?php }else {
                    echo  $newsifyObj->alertMessage('info', 'No, Referral Found');
                    }?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                </div>

            </div>

        </div>

    </div> -->
    <!-- Bootstrap Modal END -->



<?php
include_once 'includes/main_footer.php';
?>

<script>
$(document).ready(function(){
	$('#video-guide').click(function() {
		$('#video-demo').show();
		$("#player").attr('src','https://www.youtube.com/embed/lDL8KtFVDqo'); 
	});

	$('.close-btn').click(function() {
		$('#video-demo').hide();
		$("#player").attr('src','');   
	});
});
</script>
<?php //include_once 'includes/footer.php'; ?>