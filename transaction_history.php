
<style>
    /*.bg-yellow th{*/
    /*    color:#fff !important;*/
        
    /*}*/
    /*.cloured-hover tbody tr:hover{*/
    /*    border-left : 3px solid #faa64b !important;*/
    /*}*/
    /* .cloured-hover tbody td*/
    /*{*/
    /*padding: 9px 14px;*/
    /*font-size: 14px;*/
    /*}*/
</style>

<?php
$menu = array('tab'=>7, 'option' => null);
 include_once 'includes/main-header.php';
require_once (__DIR__.'/_libs/dbConnect.php');
    $obj = new  dbConnect();
    
    $amount_transacted = '0';
    $transaction_fee =  '0';
    $transaction_date = '--';
    $transaction_confirmations = '--';




$ibm  = $_SESSION['user']['ibm'];
$IBM1 = "IBM1";
if($ibm == "IBM1")
{
  $result  = $obj->db_select("SELECT * FROM `transaction_history` WHERE `admin_trans` = '1'  OR (`sender_Ibm` ='" . $IBM1 . "' OR `receiver_ibm` = '" . $IBM1 . "') order by date desc");
        
}
else
{
$result   = $obj->db_select("SELECT * FROM `transaction_history` WHERE `admin_trans` = '0'  AND (`sender_Ibm` ='" . $ibm . "' OR `receiver_ibm` = '" . $ibm . "') order by date desc");
}

?>

        <!--<article class="content grid-page">-->
        
<?php
if(isset($_POST['get_transaction_detail']))
{
    $transection_id = $_POST['tx_id'];
    $tx_id = str_replace(' ', '', $transection_id);
     $wallet_email = $_SESSION['user']['wallet_email'];
    $data = array('tx_id' => $tx_id,
    'wallet_email' => $wallet_email
    );
  $response = $obj->get_transaction_detail($data);
  if($response['success'] == true)
  {
  $value = $response['values'];
    $data = $value->data;
    $transaction_confirmations = $data->confirmations;
    $transaction_fee =  $data->fee;
    $transaction_date = $data->date;
    $dataInputs = $data->inputs;
     $amount_transacted = $dataInputs[0]->value;
   
    
  }
  else
  {
     $data = '--';
    $transaction_confirmations = '--';
    $transaction_fee =  '0';
    $transaction_date = '--';
    $dataInputs = '--';
     $amount_transacted = '0';
  }
 

 }

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transactions History
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="transaction.php">Transactions</a></li>
        <li class="breadcrumb-item active">Transactions Histroy</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
		  <div class="col-12 col-md-12">
      Want to Know Transaction Detail <br />
      <form  method="post">
                <div class="input-group">
                    
                   <input style="border-top-left-radius: 31px;
    border-bottom-left-radius: 31px;height: 43px;" class="form-control"  name="tx_id" placeholder="Transaction Id Place Here.." required>
                   <span class="input-group-btn">
                       
                    <button style="margin-bottom: 2px;width: 76px;max-height: 49px ;height: 43px;
                    border-top-right-radius: 31px;
    border-bottom-right-radius: 31px;" type="submit" name="get_transaction_detail" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                   </span>
              </div>
          </form>
        </div>
        
    
      </div>
   
        <?php
if($amount_transacted != '' || $transaction_fee != '' || $transaction_date != '' || $transaction_confirmations != '')
{
?>
	  <div class="row">
    <div class="row col-md-12 mt-20">
       <div class="col-md-3 col-sm-13 col-xs-12">
           	<a class="box box-link-pop text-center" href="javascript:void(0)">
				<div class="box-body py-25">
					<p class="font-size-40 text-cyan">
						<strong><?php echo '$'.$amount_transacted; ?></strong>
					</p>
					<p class="font-weight-600">
						<i class="fa fa-line-chart text-muted mr-5"></i>Amount Transacted
						
					</p>
				</div>
			</a>
       </div>
        <div class="col-md-3 col-sm-13 col-xs-12">
            	<a class="box box-link-pop text-center" href="javascript:void(0)">
				<div class="box-body py-25">
					<p class="font-size-40 text-pink">
						<strong> <?php echo '$'.$transaction_fee; ?></strong>
					</p>
					<p class="font-weight-600">
						<i class="fa fa-money text-muted mr-5"></i> Fees
					</p>
				</div>
			</a>
            
        </div>
         <div class="col-md-3 col-sm-13 col-xs-12">
             	<a class="box box-link-pop text-center" href="javascript:void(0)">
				<div class="box-body py-25">
					<p class="font-size-40 text-danger">
						<strong><?php echo $transaction_date; ?></strong>
					</p>
					<p class="font-weight-600">
						<i class="fa fa-shopping-cart text-muted mr-5"></i> Received
					</p>
				</div>
			</a>
         </div>
         <div class="col-md-3 col-sm-13 col-xs-12">
             	<a class="box box-link-pop text-center" href="javascript:void(0)">
				<div class="box-body py-25">
					<p class="font-size-40 text-pink">
						<strong><?php echo $transaction_confirmations; ?></strong>
					</p>
					<p class="font-weight-600">
						<i class="fa fa-location-arrow text-muted mr-5"></i> Confirmations
					</p>
				</div>
			</a>
         </div>
        </div>
      <div class="col-md-12 col-lg-12 col-12">
			  <!-- Default box -->
			  <div class="box box-solid bg-black ">
				<div class="box-header with-border">
				  <h3 class="box-title">Recent Transactions</h3>
				 <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
				
				</div>
				<div class="box-body">
					<div class="table-responsive">
					    
				 <table class="table table-bordered table-striped no-margin ">
								
						  <thead >
							<tr >
							  
                <th>Date</th>
                <th>Description</th>
							  <th>Amount</th>
							  <th>Status</th>
							 
							</tr>
						  </thead>
		<tbody>				 
						  <?php
            if ($result->num_rows > 0) {
             if($_SESSION['user']['ibm']== 'IBM1')
             {
                
            while($row = $result->fetch_assoc()) {
                
            if(true)
			{
	
          ?>
          
							<tr >
							  <td>
							  <?php echo $row['date']; ?>
							  </td>
							  <td><?php echo $row['description']; ?></td>
							  <td> 
          <button type="button" id="all_transection_<?php echo $row['id'];  ?>" onclick="all_transection_view(this)" class="btn 
        <?php 
      
    if($row['admin_trans'] == 0 )
    {
        if($row['sender_Ibm'] == $_SESSION['user']['ibm']){ 
            if($row['sender_Ibm'] == 'IBM1')
            {
                $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
        	echo 'btn-danger';        
            }
            
            else
            {
                $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                	echo 'btn-danger';
            }
             }
          
             else if($row['receiver_ibm'] == $_SESSION['user']['ibm'])
             { 
                 if($_SESSION['user']['ibm'] == "IBM1")
                 {
                     $tvmfull = $row['amount'];
                     	echo 'btn-success';
                 }
                 else
                 {
                     	echo 'btn-success';
                 }
             } 
             else if($row['receiver_ibm'] != "IBM1" && $row['sender_Ibm'] != "IBM1" && $_SESSION['user']['ibm'] == "IBM1")
        {
            	echo 'btn-success';
        }
    }
    			else
    			{
        
           			echo 'btn-success';
        
        }
      
  
  ?>
      all_transection_view" table_id ="<?php echo $row['id']; ?>"
         date="<?php echo $row['date']; ?>" transaction_id="<?php echo $row['transaction_id']; ?>" amount="<?php echo $row['amount']; ?>" 
        fee="<? echo $row['miner_fee']+$row['tvm_fee']; ?>" receiver_ibm="<?php echo $row['receiver_ibm']; ?>" sender_ibm="<?php echo $row['sender_Ibm']; ?>" 
        description="<?php echo $row['description']; ?>" trans="<? echo $row['admin_trans'] ?>"  data-toggle="modal" 
        data-target="#view_transaction_<?php echo $row['id'];  ?>"><i class="fas fa-sign-in-alt fa_change"></i>
        <?php 
      
    if($row['admin_trans'] == 0 )
    {
        if($row['sender_Ibm'] == $_SESSION['user']['ibm']){ 
            if($row['sender_Ibm'] == 'IBM1')
            {
                $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                echo '<span >'.'$'.$total.' (-)'.'</span>';
                
            }
            
            else
            {
                $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                echo '<span >'.'$'.$total.' (-)'.'</span>';
            }
             }
          
             else if($row['receiver_ibm'] == $_SESSION['user']['ibm'])
             { 
                 if($_SESSION['user']['ibm'] == "IBM1")
                 {
                     $tvmfull = $row['amount'];
                     echo '$'.$tvmfull. ' (+)';
                 }
                 else
                 {
                     echo '$'.$row['amount'].' (+)';
                 }
             } 
             else if($row['receiver_ibm'] != "IBM1" && $row['sender_Ibm'] != "IBM1" && $_SESSION['user']['ibm'] == "IBM1")
        {
            echo '$'.$row['amount'].' (+)';
        }
    }
    			else
    			{
        
           			 echo '$'.$row['tvm_fee'].' (+)'; 
        
        }
      }
  
  else
  { ?>
    <h4> Transaction Not Found! or Still is in Process Please Check Later</h4>
  <?php 
  }
  ?>
  </button>
	  <!--view transaction-->
<div class="modal fade" id="view_transaction_<?php echo $row['id']; ?>" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Transaction Detail</h4>
</div>
<div class="modal-body">
<div class="invoice-box">
    <div class="row">
           
            
     <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Sender IBM</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="sender_ibm_<?php echo $row['id']; ?>"></p>
            </div>        
    <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Receiver IBM</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="receiver_ibm_<?php echo $row['id']; ?>"></p>
            </div>          
    
     <div class="col-sm-12 col-xs-12 col-md-12">
                <h5 style="font-size: 13px;color: #000;">Description:</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="description_<?php echo $row['id']; ?>"></p>
            </div>
    <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Transaction ID:</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="transection_id_<?php echo $row['id']; ?>"></p>
            </div> 
    
      <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Amount</h5>
                <p style="font-size: 13px;" class="colorchange"  id="amount_<?php echo $row['id']; ?>"></p>
            </div>  
                  <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Transaction Fee</h5>
                <p style="font-size: 13px;" class="colorchange"   id="fee_<?php echo $row['id']; ?>"></p>
            </div>  
              <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Total Amount</h5>
                <p style="font-size: 13px;" class="colorchange" id="total_<?php echo $row['id'];  ?>"></p>
            </div>  
             <div class="col-sm-12 col-xs-12 col-md-12">
                <div style="display: flex;">
                <i style="margin-right:10px;" class="fa fa-calendar" aria-hidden="true"></i>
                <p style="font-size: 13px;color: #a4a4a4;" id="date_<?php echo $row['id']; ?>"></p>
            </div>
            </div>
            </div>
     
    </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" style="float:right;" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>
	</td>
	<td>
          <?php echo $row['status'] ?>
        </td>
							 
							</tr>
							<?php } 
    }

    // end here
   }
   else {


                                // output data of each row
    while($row = $result->fetch_assoc()) {
        
                            ?>
         <tr>
                            <td><?php echo $row['date']; ?></td>
                            
                           
                            <td><?php echo $row['description']; ?></td>
                        
                            
                            <td><button type="button" id="all_transection_<?php echo $row['id'];  ?>" onclick="all_transection_view(this)" class="btn btn-default all_transection_view" table_id ="<?php echo $row['id']; ?>"
                             date="<?php echo $row['date']; ?>" transaction_id="<?php echo $row['transaction_id']; ?>" amount="<?php echo $row['amount']; ?>" 
                            fee="<? echo $row['miner_fee']+$row['tvm_fee']; ?>" receiver_ibm="<?php echo $row['receiver_ibm']; ?>" sender_ibm="<?php echo $row['sender_Ibm']; ?>" 
                            description="<?php echo $row['description']; ?>" trans="<? echo $row['admin_trans'] ?>"  data-toggle="modal" 
                            data-target="#view_transaction_<?php echo $row['id'];  ?>"><i class="fas fa-sign-in-alt fa_change"></i>
                            <?php 
                          
                        if($row['admin_trans'] == 0 )
                        {
                            if($row['sender_Ibm'] == $_SESSION['user']['ibm']){ 
                                if($row['sender_Ibm'] == 'IBM1')
                                {
                                    $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                                    echo '<span >'.'$'.$total.'<i class="fa fa-chevron-down"></i>'.'</span>';
                                }
                                
                                else
                                {
                                    $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                                    echo '<span >'.'$'.$total.'<i class="fa fa-chevron-down"></i>'.'</span>';
                                }
                                 }
                              
                                 else if($row['receiver_ibm'] == $_SESSION['user']['ibm'])
                                 { 
                                     if($_SESSION['user']['ibm'] == "IBM1")
                                     {
                                         $tvmfull = $row['amount'];
                                         echo '$'.$tvmfull.'<i class="fa fa-chevron-up"></i>';
                                     }
                                     else
                                     {
                                         echo '$'.$row['amount'].'<i class="fa fa-chevron-up"></i>';
                                     }
                                 } 
                                 else if($row['receiver_ibm'] != "IBM1" && $row['sender_Ibm'] != "IBM1" && $_SESSION['user']['ibm'] == "IBM1")
                            {
                                echo '$'.$row['amount'].'<i class="fa fa-chevron-up"></i>';
                            }
                        }
                        else
                        {
                            
                                echo '$'.$row['tvm_fee'].'<i class="fa fa-chevron-up"></i>'; 
                            
                        }
                               
                            
                            ?>
                            </button>
                             <!--view transaction-->
<div class="modal fade" id="view_transaction_<?php echo $row['id']; ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transaction Detail</h4>
        </div>
        <div class="modal-body">
        <div class="invoice-box">
           
             <div class="row">
           
            
     <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Sender IBM</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="sender_ibm_<?php echo $row['id']; ?>"></p>
            </div>        
    <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Receiver IBM</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="receiver_ibm_<?php echo $row['id']; ?>"></p>
            </div>          
    
     <div class="col-sm-12 col-xs-12 col-md-12">
                <h5 style="font-size: 13px;color: #000;">Description:</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="description_<?php echo $row['id']; ?>"></p>
            </div>
    <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Transaction ID:</h5>
                <p style="font-size: 13px;color: #a4a4a4;" id="transection_id_<?php echo $row['id']; ?>"></p>
            </div> 
    
      <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Amount</h5>
                <p style="font-size: 13px;" class="colorchange"  id="amount_<?php echo $row['id']; ?>"></p>
            </div>  
                  <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Transaction Fee</h5>
                <p style="font-size: 13px;" class="colorchange"   id="fee_<?php echo $row['id']; ?>"></p>
            </div>  
              <div class="col-sm-12 col-xs-12 col-md-6">
                <h5 style="font-size: 13px;color: #000;">Total Amount</h5>
                <p style="font-size: 13px;" class="colorchange" id="total_<?php echo $row['id'];  ?>"></p>
            </div>  
             <div class="col-sm-12 col-xs-12 col-md-12">
                <div style="display: flex;">
                <i style="margin-right:10px;" class="fa fa-calendar" aria-hidden="true"></i>
                <p style="font-size: 13px;color: #a4a4a4;" id="date_<?php echo $row['id']; ?>"></p>
            </div>
            </div>
            </div>
						
						</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--view transaction-->
  

                            </td>
                            
                            
                            
                            <td>
                              <?php 
                                if ($row['status'] == "Successfull") 
                                {
                              ?>
                                <div>
                                  <img src="images/checked.png" style="width: 30px;">
                                </div>
                              <?php
                                }
                                else
                                {
                              ?>
                                <div>
                                  <img src="images/error.png" style="width: 30px;">
                                </div>
                              <?php
                                }
                               ?>
                            </td>
                            
                            </tr>
                      
                            <?php } 
                        }
                         ?>
    						 
						  </tbody>
						
						</table>
					</div>

				</div>
				<!-- /.box-body -->
			  
			  </div>
			
			  <!-- /.box -->
		  </div>
		 
	  </div>
	  <?php } ?>

    </section>
    <!-- /.content -->
  </div>

  <script>
function all_transection_view(item)
{
     var session_ibm = "<?php echo $_SESSION['user']['ibm']; ?>";
    var date =    $(item).attr("date");
    var table_id = $(item).attr("table_id");
    var description =    $(item).attr("description");
    var sender_ibm =    $(item).attr("sender_ibm");
    var receiver_ibm =    $(item).attr("receiver_ibm");
    var amount =    $(item).attr("amount");
    var transaction_id = $(item).attr("transaction_id"); 
    var fee = $(item).attr("fee");
    var trans = $(item).attr("trans");
    var transection_firstslice = transaction_id.slice(0 , 25);
    var transection_secondslice = transaction_id.slice(25 , 50);
    var transection_thirdslice = transaction_id.slice(50);
    var total = parseFloat(amount)+parseFloat(fee);
    $("#transection_id_"+table_id).html(transection_firstslice+'<br>'+transection_secondslice+'<br>'+transection_thirdslice);
    $("#date_"+table_id).html(date);
    $("#description_"+table_id).html(description);
    $("#sender_ibm_"+table_id).html(sender_ibm);
    $("#receiver_ibm_"+table_id).html(receiver_ibm);
    
    if(sender_ibm == session_ibm)
    {
    $("#amount_"+table_id).html("$"+amount+"(-)");
    $("#fee_"+table_id).html("$"+fee+"(-)");
    $("#total_"+table_id).html("$"+total+"(-)");
    $('.colorchange').css('color','red');
    }
    //if(receiver_ibm == session_ibm)
    //{
        
         if(session_ibm == "IBM1" && trans == 1 )
        { 
            $("#amount_"+table_id).html("$"+parseFloat(fee)/2+"(+)"); 
            $("#fee_"+table_id).html("$"+parseFloat(fee)/2+"(+)");
           // var tvmComplete = parseFloat(total)-parseFloat(fee)/2;
            $("#total_"+table_id).html("$"+parseFloat(fee)/2+"(+)");
            $('.colorchange').css('color','green');
        }
        else
        {
         if(receiver_ibm == session_ibm)
         {   
            $("#amount_"+table_id).html("$"+amount+"(+)"); 
            $("#fee_"+table_id).html("$"+0+"(+)");
            $("#total_"+table_id).html("$"+amount+"(+)");
         $('.colorchange').css('color','green');
             
         }    
        }
      
    
}
    

    
</script>
<?php include_once 'includes/main_footer.php'; ?>