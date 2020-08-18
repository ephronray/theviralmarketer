<?php
$menu = array(
	'tab' => 2,
	'option' => '4x4'
);
include_once 'includes/header.php';
unset($_SESSION['new_refferals']);
$is_root = $_SESSION['user']['is_root'];
$my_ibm = $_SESSION['user']['ibm'];
$referrals = array();
function get_details($ibm)
{
	$obj = new  dbConnect();
	$result2 = $obj->db_select("SELECT * FROM members WHERE ibm='" . $ibm . "'");
	$count = mysqli_num_rows($result2);
	if ($count > 0)
	{
		$ref = mysqli_fetch_array($result2);
		return array(
			'name' => $ref['first_name'] . ' ' . $ref['last_name'],
			'ibm' => $ref['ibm']
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
				<td>' . $ref['level'] . '</td>
				<td>' . $ref['referal_ibm'] . '</td>
				<td>' . $ref['referal_name'] . '</td>
				<td>' . $ref['refered_by'] . '</td>
				<td><b>' . $ref['spill_over'] . '</b></td>
			</tr>';
		}
	}
	return $html; 
}


function show_refferal($level, $ibms, $obj)
{
	$accordion_start = '<div class="panel panel-default"> <div class="panel-heading" role="tab" id="heading'.$level.'"> <h4 class="panel-title">
				    <a role="button" class="expand-btn" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$level.'" aria-expanded="true" aria-controls="collapse'.$level.'">
                        <i class="more-less fa fa-plus-circle"></i>
                       Level #'.($level+1).' &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; Earned X (USD) 
                    </a> </h4>  </div><div id="collapse'.$level.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$level.'">
					<div class="panel-body">';
					
	$accordion_end = ' </div> </div> </div>';
	$refferal = $accordion_start;
	$refferal .= '<table class="table table-striped table-bordered table-hover flip-content"> <thead class="flip-header">
				 <tr><th>Levels</th> <th>IBM</th>  <th>Name</th> <th>Introduced By</th><th>SpillOver To</th> </tr>
                 </thead> <tbody>';
	
	$level++;
	$referrals 		= array();
	$next_refferal 	= array();
	if($level < 5 )
	{
		foreach($ibms AS $ibm)
		{
			
			$next_refferal = array();
			$result2 = $obj->db_select("SELECT * FROM members WHERE 4_by_4='" . $ibm . "'");
			$count = mysqli_num_rows($result2);
			if ($count > 0)
			{
				while ($ref = mysqli_fetch_array($result2))
				{
					array_push($referrals, $ref['ibm']);
							$spill = ($ref['refer_ibm'] != $ref['4_by_4'])  ? get_details($ref['4_by_4'])['name'] .'-'. $ref['4_by_4'] : '';	
							$refferal.= '
							<tr class="odd gradeX">
								<td>' . $level . '</td>
								<td>' . $ref['ibm'] . '</td>
								<td>' . $ref['first_name'].' '.$ref['last_name'] . '</td>
								<td>' . get_details($ref['refer_ibm'])['name'] . '</td>
								<td><b>' .$spill. '</b></td>
							</tr>';
				}
				if(!empty($next_refferal)) $_SESSION['new_refferals'][$ibm] = $next_refferal;

			}
		}
		if (count($referrals) > 0)
		{
			$refferal .= '</tbody>  </table>';
			$refferal .= $accordion_end;
			echo $refferal;
			show_refferal($level, $referrals, $obj);
		} 
	}
} ?>
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
        background-color: #85ce36;
        border-color: #EEEEEE;
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title > a {
		display: block;
		text-align: center;
		padding: 15px;
		font-size: 17px;
		font-weight: bold;
		color: white;
		text-decoration: none
    }
	.panel-title > a :hover{
		text-decoration: none !important;
		color: #eaebe8 !important;
	}
    .more-less {
        float: right !important;
        color: #ffffff;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

</style>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <article class="content grid-page">
        <div class="title-block">
		<div class="row ">
			<div class="col-md-6">
				<h3 class="title">4x4 Forced Matrix System</h3>
				<p class="title-description">Here is list of all your Referrals</p>
			</div>
			<!--<div class="col-md-6 text-right">
				<button class="pull-right btn btn-primary" onClick="window.location.href='/export/export_ref.php'">Export  your Referrals To Xls</button>
			</div> -->
        </div>
        </div>
        <section class="section">
            <div class="row ">
                <div class="col-md-12">
                <?php if(true){ ?>
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">				
                            <?php show_refferal(0, array($_SESSION['user']['ibm']),  $newsifyObj); ?>
                    </div>
                    <?php }else {
                    echo  $newsifyObj->alertMessage('info', 'No, Referral Found');
                    }?>

                </div>
            </div>
        </section>
    </article>
	<script src="js/jquery.min.js"></script>
		<script>
		$(function ($) {
			$('.expand-btn').on('click', function(e){
				$(this).find('.more-less').toggleClass('fa-plus-circle fa-minus');
			});
		});
		</script>
<?php include_once 'includes/footer.php'; ?>