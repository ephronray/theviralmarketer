<?php 
$menu = array('tab'=>3, 'option' => null);
//include_once 'includes/header.php';
include_once 'includes/main-header.php';
require_once (__DIR__.'/_libs/uplineMembers.php');
$query    = "SELECT * FROM system_levels;";
$result   = $newsifyObj->db_select($query);
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
  function getTrasactionFee($amount)
    {
        
        if ($amount < 51)
        {
            return 1.5;
        }
        else
        {
            $fee = $amount/100;
            return ($fee*2)+0.5;
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
function get_transaction_password($email , $ibm)
{
    $obj = new  dbConnect();
	$result2 = $obj->db_select("SELECT transaction_password FROM members WHERE user_email ='".$email."' AND ibm='" . $ibm . "'");
	$count = mysqli_num_rows($result2);
	if ($count > 0)
	{
	     
		$ref = mysqli_fetch_array($result2);
		return $ref['transaction_password'];
	}
}
$ibm = $_SESSION['user']['ibm'];
$email = $_SESSION['user']['email'];
$transection_password = get_transaction_password($email , $ibm );
?>

<div class="content-wrapper transaction_page">

    <section class="content-header">
        <h1>
            Upgrades
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Upgrades</li>
        </ol>
    </section>

    <article class="content grid-page">

        <section class="section">

            <div class="box" style="display: block; padding: 20px; min-height: 675px;">

                <div class="title-description alert alert-info text-center">
                    This table reflects all the upline members that you need to pay in order to upgrade though all 8 levels
                </div>

                <div class="">
                    <?php include ('includes/balance_amount.php'); ?>
                </div>


            <div class="row " >
                <div class="col-md-12" id="payment-messages">
                </div>
			</div>


            <div class="row ">
				<?php 
					while($data = mysqli_fetch_array($result))	
					{ 	$is_paid = False;
						$class = array("fa fa-4x fa-times-circle", "");
						if(array_key_exists($data['id'], $levels_list))
						{
							$is_paid = TRUE;
							$class = array("fa fa-4x fa-check-circle text-success", "image");
						}
				?>

<style type="text/css">
	
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

	<div class="col-12 col-md-4 col-lg-3">
	<div class="box bg-hexagons-dark" style="padding: 20px; box-shadow: 0px 0px 15px lightgrey;">
        <div class="" style="text-align: center;">
            <div class="<?=$class[1];?> "><span class="<?=$class[0];?>"></span></div>
        </div>
	<div class="icon pt-5">

	<div class="info">
		<h3 class="title text-center" style="margin-top:9px; font-weight:bold; color:#867e7e">
			Level <?=$data['level_name']?>
		</h3>
		<div class="text-center" >
			<div class="h6 text-warning">Price: $<?=$data['level_price']?></div>
		</div>
		
		<?php if($is_paid)
		{ 	
			$level_detail = $levels_list[$data['id']];
		?>
            <div class="more text-center" style="margin-top: 15px;">
                <a data-toggle="modal" href="#paid-model-<?=$data['id']; ?>" title="Show Level Details" class="btn btn-success show_details"><i class="fa fa-plus"></i> Details</a>
            </div>
		<div class="modal fade" id="paid-model-<?=$data['id']; ?>">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title">
						<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
							<?=$data['level_name']?> Level Details</h4>
					</div>
					<div class="modal-body">
					
						<div class="invoice-box">
						  <div class="table-responsive">
							<table class="table table-list-search" width="70%" >
								<tr class="heading">
									<td colspan="2"> <strong>Level Detail</strong> </td>
								</tr>
								<tr class="item">
									<td> Name</td>
									<td> <?=$data['level_name']?></td>
								</tr>
								<tr class="item">
									<td> Price</td>
									<td> <?=$level_detail['level_amount']; ?>$</td>
								</tr>
								<tr class="heading">
									<td colspan="2"> <strong>Received By</strong></td>
								</tr>
								<tr class="item">
									<td> Name</td>
									<td> <?=get_details($level_detail['receiver_ibm']); ?></td>
								</tr>
								<tr class="item">
									<td> IBM</td>
									<td> <?=$level_detail['receiver_ibm']; ?></td>
								</tr>

								<tr class="item">
									<td> Wallet Address</td>
									<td><?=$data['wallet_number']?> </td>
								</tr>
								<tr class="heading">
									<td colspan="2"><strong> Paid By</strong></td>
								</tr>
								<tr class="item">
									<td> Name</td>
									<td> <?=get_details($_SESSION['user']['ibm']); ?></td>
								</tr>
								<tr class="item">
									<td> IBM</td>
									<td> <?=$level_detail['sender_ibm']; ?></td>
								</tr>
								<tr class="heading">
									<td colspan="2"> <strong>Paid On</strong></td>
								</tr>
								<tr class="item">
									<td> Date</td>
									<td> <?=$level_detail['paid_date']; ?></td>
								</tr>
								<tr class="total">
									<td></td>

									<td>
										Total: $<?=$level_detail['level_amount']; ?>
									</td>
								</tr>
							</table>
						  </div>	
							
						</div>	
					
					</div>
                <div class="modal-footer" style="padding-left: 20px">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
			<!-- /.modal -->

			<?php 
			} else if (count($levels_list)+1 == $data['id'] ) { 
					$uplineMember = new uplineMember($_SESSION['user']['u_id'], $_SESSION['user']['ibm'], $data['id']);
					$memberInfo = $uplineMember->getUpMember()['memberInfo'];
					/*echo '<pre>';
					print_r($uplineMember->getUpMember());
					echo '</pre>'; */
			?>
			<!--model box for transection Password-->
<!--			 <div class="modal fade" id="transaction-password---><?//=$data['id']; ?><!--" role="dialog">-->
<!--    <div class="modal-dialog">-->
<!--      -->
<!--      <style type="text/css">-->
<!--        @media screen and (max-width: 600px) {-->
<!--          .modal-content {  -->
<!--            margin-left: -9%;-->
<!--            width: 125%;-->
<!--          }-->
<!--          .modal-footer{-->
<!--            margin-right: 40px;-->
<!--          }-->
<!--          .modal-title{-->
<!--            margin-left: 20px;-->
<!--          }-->
<!--          .modal-body{-->
<!--            margin-left: 20px;-->
<!--            margin-right: 10%;-->
<!--          }-->
<!---->
<!--        }-->
<!--      </style>-->
<!---->
<!---->
<!--       Modal content-->
<!--      <div class="modal-content">-->
<!--        <div class="modal-header">-->
<!--            <div id="transection_notification">-->
<!--            -->
<!--            </div>-->
<!--          <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--          <h4 class="modal-title">Complete Transaction Password</h4>-->
<!--        </div>-->
<!--        <div class="modal-body">-->
<!--    --><?php //
//    if($transection_password == null)
//    {
//     ?><!-- -->
<!--     <p style="text-transform: font-size: 16px; text-decoration: font-weight: 600;">You need to register for a Transactional password in order to do transactions.</p>-->
<!--     <br>-->
<!--     <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">-->
<!--           <a href="https://theviralmarketer.biz/profile.php">  CLICK HERE TO REGISTER NOW </a>-->
<!--          </p>   -->
<!--    --><?php
//    }
//    else
//    {
//    ?>
<!--    -->
<!--            <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">-->
<!--             Please Complete Transaction Password  -->
<!--          </p>-->
<!--          -->
<!--             -->
<!--  <div class="form-group">-->
<!--      -->
<!--    <label for="Inputpassword">Enter 3 hidden Digits of password:</label>-->
<!--    <input type="hidden" id="get_id" value="--><?//=$data['id']; ?><!--" >-->
<!--    <div class="row">-->
<!--        <div  class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">-->
<!--            <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--                <span>1</span>-->
<!--            <input  id="index_1" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_1" >-->
<!--        </div>-->
<!--        -->
<!--        <div  class="col-xs-6 col-sm-6 col-lg-6">-->
<!--            <span>2</span>-->
<!--            <input id="index_2" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_2" >-->
<!--        </div>-->
<!--        </div>-->
<!--        -->
<!--        <div  class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">-->
<!--            <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--                <span>3</span>-->
<!--            <input  id="index_3" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_3" >-->
<!--        </div>-->
<!--        <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--            <span>4</span>-->
<!--            <input id="index_4" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_4" >-->
<!--        </div>-->
<!--        </div>-->
<!--        -->
<!--        -->
<!--        <div  class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">-->
<!--            <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--                <span>5</span>-->
<!--            <input id="index_5" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_5" >-->
<!--        </div>-->
<!--        <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--            <span>6</span>-->
<!--            <input id="index_6"  type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_6" >-->
<!--        </div>-->
<!--        </div>-->
<!--        <div  class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">-->
<!--            <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--                <span>7</span>-->
<!--            <input  id="index_7" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_7" >-->
<!--        </div>-->
<!--        <div class="col-xs-6 col-sm-6 col-lg-6">-->
<!--            <span>8</span>-->
<!--            <input  id="index_8" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control"  name="index_8" >-->
<!--        </div>-->
<!--        </div>-->
<!--        -->
<!--        -->
<!--        -->
<!--        -->
<!--    </div>-->
<!--     </div>-->
<!--    -->
<!--  <div class="modal-footer">-->
<!--      <button id="trensection_password_check" name="trensection_password_check" class="btn btn-primary">Submit</button>-->
<!--      -->
<!--          <button type="button" id="transection-close---><?//=$data['id']; ?><!--" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--        </div>-->
<!--    --><?php //
//    }
//    ?>
<!--   -->
<!--        </div>-->
<!--    -->
<!--      </div>-->
<!--      -->
<!--    </div>-->
<!--  </div>-->

            <div class="modal fade" id="transaction-password-<?=$data['id']; ?>" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->

                    <style type="text/css">
                        @media screen and (max-width: 600px) {
                            .modal-content {
                                margin-left: -9%;
                                width: 125%;
                            }

                            .modal-footer {
                                margin-right: 40px;
                            }

                            .modal-title {
                                margin-left: 20px;
                            }

                            .modal-body {
                                margin-left: 20px;
                            }

                        }
                    </style>



                       <div class="modal-content">
                        <div class="modal-header">


                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">OTP Verification</h4>

                        </div>

                        <div class="modal-body">

                            <div id="transection_notification" class="alert alert-danger  mb-3" style="display: none">
                                There Is Something Went Wrong. Try Again Later.
                            </div>
                            <?php
                             $otp_response =  $newsifyObj->send_otp_code("1");
					         $otp_code = '';
					         if($otp_response['success'])
							 {
                               $otp_code = $otp_response['otp_code'];
							 }
                                ?>
                                <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">
                                    OTP Verification
                                </p>


                                <div class="form-group password">

                                    <label for="Inputpassword">Enter 6 digits OTP Code sent your Email Address</label>
                                        <input type="hidden" id="get_id" value="<?=$data['id']; ?>" >
                                <div class="row">

                                        <div class="col-6 col-md-6 col-lg-6">
											<input type="text" id="otp_code" value="" >
									</div>
									<div class="col-6 col-md-6 col-lg-6">
										<a href="#" > Resend OTP Rquest </a>
									</div>
									</div>
                                   
                                </div>
                                <div class="modal-footer">
                                    <button id="trensection_password_check" name="trensection_password_check" class="btn btn-primary">Submit</button>

                                    <button type="button" id="transection-close-<?=$data['id']; ?>" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                                <?php
                            
                            ?>

                        </div>


                    </div>

                </div>
            </div>
  	<!--end model box for transection Password-->
 
				<div class="modal fade" id="pay-now-<?=$data['id']; ?>" style ="margin-top: -35px; overflow-y:auto">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<h4 class="modal-title">
							<i class="fa fa-check-circle"></i>&nbsp;&nbsp;
								Are you ready to upgrade <?=$data['level_name']?> Level?</h4>
						</div>
						<div class="modal-body">
							<p>Payment detail for <b><?=$data['level_name']?> </b> Level.</p>
							<p><?php // print_r ($uplineMember->getUpMember()); ?></p>
						<div class="table-responsive">
        					<table class="table table-list-search" style="width: 100%;">
								<tr class="heading">
									<td colspan="2"> <strong>Level Detail</strong> </td>
								</tr>
								<tr class="item">
									<td> Name</td>
									<td> <?=$data['level_name']?></td>
								</tr>
								<tr class="item">
									<td> Price</td>
									<td> $<?=$data['level_price']; ?></td>
								</tr>
								<tr class="item">
									<td> Transaction Fee</td>
									<td> $<?=getTrasactionFee($data['level_price']); ?></td>
								</tr>
								<tr class="heading">
									<td colspan="2"> <strong>Receiver Detail</strong></td>
								</tr>
								<tr class="item">
									<td> Name</td>
									<td><?=$memberInfo['first_name']?></td>
								</tr>
								<tr class="item">
									<td> IBM</td>
									<td><?=$memberInfo['ibm']?></td>
								</tr>
								<tr class="item">
									<td> E-mail</td>
									<td><?=$memberInfo['user_email']?></td>
								</tr>
								<tr class="item">
									<td> Wallet Address</td>
									<td> <?=$memberInfo['wallet_number']?></td>
								</tr>
								<tr class="total">
									<td></td>
									<td>
									    <?php $total = $data['level_price']+getTrasactionFee($data['level_price']); ?>
										Total: $<?=$total ?>
									</td>
								</tr>
							</table>
								<div class="confirm" style="padding-top: -50px;">
							
							
						</div>
								
						</div>
						<div class="confirm" style="padding-top: -50px;">
                            <div class="form-check pl-0 mb-5">

                                <input type="checkbox" id="confirmBox"  class="confirmBox form-check-input">

                                <label class="form-check-label" for="confirmBox">
                                    Yes, I accept terms and conditions.
                                </label>

                            </div>



							
						</div>
						</div>
						 <div class="modal-footer modal-footer-level" style="padding-left: 20px">
							<button type="button" class="btn btn-primary level-upgrade" disabled data-level="<?=$data['id']; ?>">
								<i class="fa fa-arrow-down"></i> Pay Now
							</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
				<div class="more paymore paymore pay text-center" style="margin-top: 15px;">
					<a style="display:none;" data-toggle="modal" id="pay_now_btn_<?=$data['id']; ?>" href="#pay-now-<?=$data['id']; ?>" title="Upgrade To <?=$data['level_name']?> Level"><i class="fa fa-money"></i> Pay Now</a>
					<a data-toggle="modal" class="transaction_model_show btn btn-primary" href="#transaction-password-<?=$data['id']; ?>" title="Upgrade To <?=$data['level_name']?> Level"><i class="fa fa-money"></i> Pay Now</a>
				
				</div>
			<?php } else { ?>
				<div class="more text-center">
					<a href="#" title="" class="btn btn-info" style="margin-top: 15px;"><i class="fa fa-plus"></i> Pending</a>
				</div>
			<?php } ?>
		</div>

    </div>

	<div class="space"></div>
</div>
</div>
	<?php 	
		} ?>
</div>

            </div>
</section>
</article>

</div>

<?php
include_once 'includes/main_footer.php';
?>


<script>
$(document).ready(function(){
var loader = $(".loader");
$('.confirmBox').on('click', function(e){
	if($(this).is(':checked')){
		$('.level-upgrade').attr("disabled",false)
	}
    else 
		$('.level-upgrade').attr("disabled",true);
});
function generateNotify(class_type, message, icon_name)
{
	var notify = '<div class="alert alert-'+class_type+' fade in ">'+
	'<strong><i class="fa fa-'+icon_name+'" aria-hidden="true"></i></strong>&nbsp;&nbsp;'+
	message+'</div>';
	return notify;
}


$('.level-upgrade').click(function(){
	$(this).prop("disabled", true)
    var level_no = $(this).data('level');
	var notify = '';
	var message_div = $('#payment-messages');
	var pay_modal = $('#pay-now-'+level_no);
	pay_modal.delay(5000).fadeOut('slow');
	loader.fadeIn("slow");
    $.ajax
    ({ 
        url: './ajax/upgrade.php',
        data: {"level": level_no},
        type: 'post',
		dataType: 'JSON',
        success: function(response)
        {
			loader.fadeOut("slow");
			pay_modal.modal('hide');
				   if(response.success){
						notify = generateNotify('info', response.message, 'check-circle');	
				 setTimeout(function() {
				  location.reload();
				}, 2500); 
				   }else {
						notify = generateNotify('danger', response.error, 'info-circle');					
					}
					message_div.html(notify);
					
        }
    }); 
});
});
</script>
<script>
$('.transaction_model_show').click(function(){
     var rendom_value= '';
    var transection_password = '<?php echo $transection_password; ?>';
   
    var index_1 = transection_password.slice(0 , 1);
    var index_2 = transection_password.slice(1 , 2);
    var index_3 = transection_password.slice(2 , 3);
    var index_4 = transection_password.slice(3 , 4);
    var index_5 = transection_password.slice(4 , 5);
    var index_6 = transection_password.slice(5 , 6);
    var index_7 = transection_password.slice(6 , 7);
    var index_8 = transection_password.slice(7 , 8);
   // var completepassword = inputvalue+hidden_password;
   var transection_password_array = ['',index_1 , index_2 , index_3 , index_4 , index_5 , index_6 , index_7 , index_8 ];
   var i;
   var rendom_array = ['123','245','784','524','325','426','827','378','531','432','653','734','385','436','537','241','641','742','843','345','786','546','647','851','751','852','358','458','658','756','257','261','861','362','463','564','685','726','867','278'];
   for(i = 0; i < rendom_array.length; ++i)
   {
        var value = Math.floor(10 + Math.random() * 30);
        var rendom_value = rendom_array[value];
   }

   for(i = 0; i < rendom_array.length; ++i)
   {
        var value = Math.floor(10 + Math.random() * 30);
        var rendom_value = rendom_array[value];
   }

   var j;
   for (j= 1; j <= transection_password.length; ++j) 
   {

      $('#index_'+j).attr('disabled',false);
     
   }
 
   //rendow value for index
   var rendom_index_1 = rendom_value.slice(0 , 1);
   var rendom_index_2 = rendom_value.slice(1 , 2);
   var rendom_index_3 = rendom_value.slice(2 , 3);
   
   
   
 for (i = 1; i <= transection_password.length; ++i) {
      if(rendom_index_1 == i || rendom_index_2 == i || rendom_index_3 == i )
     {
         
         $('#index_'+i).val('');
        
         
     }
     
     
     else 
     {
         $('#index_'+i).val(transection_password_array[i]).attr("disabled",true);
     }
      
}
})
$(document).ready(function(){
  
 
    
})

$('#trensection_password_check').click(function(){
    var input_all_value = '';
    var get_id = $('#get_id').val();
	var otp_code_in = $('#otp_code').val();
    var parent_modal = $('#transaction-password-'+get_id);
	var otp_code = '<?php echo $otp_code; ?>';

  

if(otp_code_in ==  otp_code)
{
  
    $('#transection-close-'+get_id).trigger('click');
      $('#pay_now_btn_'+get_id).trigger('click');

  
}
else
{
    $('#transection_notification').show();

    setTimeout(function(){

        $('#transection_notification').fadeOut();


    }, 5000)
}

   
    
})
	
	
	
	
	
	

</script>

<?php //include_once 'includes/footer.php'; ?>