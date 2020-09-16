<?php
$menu = array('tab'=>2, 'option' => 'my_referrals');
//include_once 'includes/header.php';
include_once 'includes/main-header.php';
$query    = "SELECT * FROM members WHERE refer_ibm='".$_SESSION['user']['ibm']."'";
$result   = $newsifyObj->db_select($query);
$count    = mysqli_num_rows($result);
$referrals = array();

function get_details($ibm, $newsifyObj){
	    $result2   = $newsifyObj->db_select("SELECT * FROM members WHERE ibm='".$ibm."'");
		$count    = mysqli_num_rows($result2);
		if($count > 0)
		{
			$ref = mysqli_fetch_array($result2);
			return array(
						'name'=>$ref['first_name'].' '.$ref['last_name'],
						'ibm'=>$ref['ibm']
					);
		}	
}

function show_refferal($level, $ibms, $obj){
	
	$accordion_start = '<div class="panel panel-default"> <div class="panel-heading" role="tab" id="heading'.$level.'" title="Click title to expand"> <h4 class="panel-title">
				    <a role="button" class="expand-btn" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$level.'" aria-expanded="true" aria-controls="collapse'.$level.'">
                        <i class="more-less fa fa-plus-circle"></i>
                       Level #'.($level+1).'
                    </a> </h4>  </div><div id="collapse'.$level.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$level.'">
					<div class="panel-body">';
					
	$accordion_end = ' </div> </div> </div>';
	$refferal = $accordion_start;
	$refferal .= '
					<div class="table-responsive">
                        <table class="table table-list-search" style="width: 100%;">
					<thead class="flip-header">
				 		<tr>
				 			<th>Levels</th>
				 			<th>Names</th> 
				 			<th>IBM</th>  
				 			<th>Referral\'s Name</th> 
				 			<th>Referral\'s IBM</th> 
				 		</tr>
                 	</thead> 

                 	<tbody>';
	$level++;
	$referrals = array();
	foreach ($ibms as $ibm){
		$result2   = $obj->db_select("SELECT * FROM members WHERE refer_ibm='".$ibm."'");
		$count    = mysqli_num_rows($result2);
		if($count > 0){
			$counter = 0;
			while($ref = mysqli_fetch_array($result2)){
				$counter++;
				array_push($referrals, $ref['ibm']);
				$next_refferal[] = array(
									'level'=>$level,
									'referal_name' => $ref['first_name'].' '.$ref['last_name'],
									'referal_ibm'=>$ref['ibm'],
									'refered_by'=>get_details($ibm, $obj)['name'],
									'refered_by_ibm'=>get_details($ibm, $obj)['ibm']
								);
				$refferal .= '
					<tr class="odd gradeX">
						<td>'.$level.'</td>
						<td>'.$ref['first_name'].' '.$ref['last_name'].'</td>
						<td>'.$ref['ibm'].'</td>
						<td>'.get_details($ibm, $obj)['name'].'</td>
						<td>'.get_details($ibm, $obj)['ibm'].'</td>
					</tr>';
			}
		}
	}
	if(count($referrals) > 0 )
	{

echo "referals are .".$referrals;    
		$refferal .= '</tbody>  </table></div>';
		$refferal .= $accordion_end;
		echo $refferal;
		show_refferal($level, $referrals, $obj);
		
	} 
}

?>
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

    .more-less {
        float: right !important;
        color: #ffffff;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

</style>
<div class="content-wrapper my_referrals">

    <section class="content-header">

        <h1>
            My Referrals
        </h1>
        <p class="title-description">Here is list of all your Referrals</p>


        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">My Referrals</li>
        </ol>
    </section>

    <article class="content grid-page">



        <section class="section">
            <div class="box" style="display: block; padding: 20px; min-height: 675px;">

                <div>
                    <?php include('includes/balance_amount.php'); ?>
                </div>

                
                <div class="row ">
                    <div class="col-md-12">
                    <?php if($count > 0){ ?>
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                               
                                 show_refferal(0, array($_SESSION['user']['ibm']), $newsifyObj); ?>
                        </div>

                        <?php }else {
                        echo  $newsifyObj->alertMessage('info', 'No, Referral Found');
                        }?>

                    </div>
                </div>

            </div>
        </section>

	</article>

</div>

<?php
include_once 'includes/main_footer.php';
?>
		<script>
		$(function ($) {
			$('.expand-btn').on('click', function(e){
				$(this).find('.more-less').toggleClass('fa-plus-circle fa-minus');
			});
		});
		</script>

<?php //include_once 'includes/footer.php'; ?>