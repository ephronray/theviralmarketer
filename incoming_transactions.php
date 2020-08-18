<?php 
$menu = array('tab'=>7, 'option' => null);
include_once 'includes/header.php';
require_once (__DIR__.'/_libs/dbConnect.php');
    $obj = new  dbConnect();
    
    $amount_transacted = '--';
    $transaction_fee =  '--';
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
<div class="sidebar-overlay" id="sidebar-overlay"></div>
        <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">Transaction History</h3>
            <?php include ('includes/balance_amount.php'); ?>
        </div>
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
    $transaction_fee =  '--';
    $transaction_date = '--';
    $dataInputs = '--';
     $amount_transacted = '--';
  }
 

 }
?>    
      <section class="section">
          <div class="container">
	<div class="row">
        <div class="col-md-12">

            <form  method="post">
                <div class="input-group">
                     Want to Know Transaction Detail
                   <input class="form-control"  name="tx_id" placeholder="Transaction Id Place Here.." required>
                   <span class="input-group-btn">
          <button style="margin-bottom: -23px;width: 76px;" type="submit" name="get_transaction_detail" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
                   </span>
              </div>
          </form>
        </div>
<?php
if($amount_transacted != '' || $transaction_fee != '' || $transaction_date != '' || $transaction_confirmations != '')
{
?>

<div class="dash dash-4">
<ul>
<li>
<span class="dash-label">Amount Transacted</span><br>
<?php echo $amount_transacted; ?>
</li>
<li>
<span class="dash-label">Fees</span><br>
<?php echo $transaction_fee; ?>
</li>
<li>
<span class="dash-label" title="Sat, 30 Jun 2018 12:15:53 +0000">
Received
</span><br>
<i class="fa fa-clock-o"></i>
<?php echo $transaction_date; ?>
</li>
<li>
<span class="dash-label">
Confirmations
        
</span><br>
<span id="conf-section" class="confirmed">

<span id="num-confs"><?php echo $transaction_confirmations; ?></span>
</span>
</li>
</ul>
<div class="clearfix"></div>
</div>
<?php } 
else
{?>
  <h4>Transaction Not Found! or Still is in Process Please Check Later</h4>
<?php 
}
?>
		<div class="table-responsive">
        <table class="table table-list-search" style="width: 100%;">
          <thead>
              <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>   
              </tr>
          </thead>

          <tbody class="transaction_table">
                        
          <?php
            if ($result->num_rows > 0) {
             if($_SESSION['user']['ibm']== 'IBM1')
             {
                
            while($row = $result->fetch_assoc()) {
                
            if(true)
            {
          ?>
          
        <tr>
        <td><?php echo $row['date']; ?></td>
        
        <td><?php echo $row['description']; ?></td>
    
        <td>
          <button type="button" id="all_transection_<?php echo $row['id'];  ?>" onclick="all_transection_view(this)" class="btn btn-default all_transection_view" table_id ="<?php echo $row['id']; ?>"
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
                echo '<span style="color:red;">'.'$'.$total.'(-)'.'</span>';
                
            }
            
            else
            {
                $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                echo '<span style="color:blue;">'.'$'.$total.'(-)'.'</span>';
            }
             }
          
             else if($row['receiver_ibm'] == $_SESSION['user']['ibm'])
             { 
                 if($_SESSION['user']['ibm'] == "IBM1")
                 {
                     $tvmfull = $row['amount'];
                     echo '$'.$tvmfull.'(+)';
                 }
                 else
                 {
                     echo '$'.$row['amount'].'(+)';
                 }
             } 
             else if($row['receiver_ibm'] != "IBM1" && $row['sender_Ibm'] != "IBM1" && $_SESSION['user']['ibm'] == "IBM1")
        {
            echo '$'.$row['amount'].'(+)';
        }
    }
    else
    {
        
            echo '$'.$row['tvm_fee'].'(+)'; 
        
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
        <table cellpadding="0" cellspacing="0">
        
            <tr class="item">
                <td>Date:</td>
                <td id="date_<?php echo $row['id']; ?>"></td>
            </tr>
            <tr class="item">
                <td> Description:</td>
                <td id="description_<?php echo $row['id']; ?>"></td>
            </tr>
            <tr class="item">
                <td> Transaction ID</td>
                <td id="transection_id_<?php echo $row['id']; ?>"></td>
            </tr>
            
            
            <tr class="item">
                <td>Sender IBM:</td>
                <td id="sender_ibm_<?php echo $row['id']; ?>"></td>
            </tr>
            <tr class="item">
                <td>Receiver IBM:</td>
                <td id="receiver_ibm_<?php echo $row['id']; ?>"></td>
            </tr>
            <tr class="item">
                <td>Amount</td>
                <td id="amount_<?php echo $row['id']; ?>"></td>
            </tr>
            <tr class="item">
                <td>Transaction Fee</td>
                <td id="fee_<?php echo $row['id']; ?>"></td>
            </tr>
                <tr class="item">
                <td>Total Amount</td>
                <td id="total_<?php echo $row['id'];  ?>" style = "color:red"></td>
            </tr>
            
        </table>
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
                                    echo '<span style="color:red;">'.'$'.$total.'(-)'.'</span>';
                                }
                                
                                else
                                {
                                    $total = $row['amount']+$row['miner_fee']+$row['tvm_fee'];
                                    echo '<span style="color:blue;">'.'$'.$total.'(-)'.'</span>';
                                }
                                 }
                              
                                 else if($row['receiver_ibm'] == $_SESSION['user']['ibm'])
                                 { 
                                     if($_SESSION['user']['ibm'] == "IBM1")
                                     {
                                         $tvmfull = $row['amount'];
                                         echo '$'.$tvmfull.'(+)';
                                     }
                                     else
                                     {
                                         echo '$'.$row['amount'].'(+)';
                                     }
                                 } 
                                 else if($row['receiver_ibm'] != "IBM1" && $row['sender_Ibm'] != "IBM1" && $_SESSION['user']['ibm'] == "IBM1")
                            {
                                echo '$'.$row['amount'].'(+)';
                            }
                        }
                        else
                        {
                            
                                echo '$'.$row['tvm_fee'].'(+)'; 
                            
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
							<table cellpadding="0" cellspacing="0">
							
								<tr class="item">
									<td>Date:</td>
									<td id="date_<?php echo $row['id']; ?>"></td>
								</tr>
								<tr class="item">
									<td> Description:</td>
									<td id="description_<?php echo $row['id']; ?>"></td>
								</tr>
								<tr class="item">
									<td> Transaction ID</td>
									<td id="transection_id_<?php echo $row['id']; ?>"></td>
								</tr>
								
								
								<tr class="item">
									<td>Sender IBM:</td>
									<td id="sender_ibm_<?php echo $row['id']; ?>"></td>
								</tr>
								<tr class="item">
									<td>Receiver IBM:</td>
									<td id="receiver_ibm_<?php echo $row['id']; ?>"></td>
								</tr>
								<tr class="item">
									<td>Amount</td>
									<td id="amount_<?php echo $row['id']; ?>"></td>
								</tr>
								<tr class="item">
									<td>Transaction Fee</td>
									<td id="fee_<?php echo $row['id']; ?>"></td>
								</tr>
									<tr class="item">
									<td>Total Amount</td>
									<td id="total_<?php echo $row['id'];  ?>" style = "color:red"></td>
								</tr>
								
							</table>
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
                        } ?>
                        
                        
                        
                    </tbody>
                </table>   
		</div>
	</div>
</div>
     
          </section>
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
    }
    //if(receiver_ibm == session_ibm)
    //{
        
         if(session_ibm == "IBM1" && trans == 1 )
        { 
            $("#amount_"+table_id).html("$"+parseFloat(fee)/2+"(+)"); 
            $("#fee_"+table_id).html("$"+parseFloat(fee)/2+"(+)");
           // var tvmComplete = parseFloat(total)-parseFloat(fee)/2;
            $("#total_"+table_id).html("$"+parseFloat(fee)/2+"(+)");
        }
        else
        {
         if(receiver_ibm == session_ibm)
         {   
            $("#amount_"+table_id).html("$"+amount+"(+)"); 
            $("#fee_"+table_id).html("$"+0+"(+)");
            $("#total_"+table_id).html("$"+amount+"(+)");
         }    
        }
            
       
        
     /*  <?php if($_SESSION['user']['ibm'] == "IBM1" )
        { ?>
            $("#amount_"+table_id).html("$"+amount+"(+)"); 
            $("#fee_"+table_id).html("$"+parseFloat(fee)/2+"(+)");
            var tvmComplete = parseFloat(total)-parseFloat(fee)/2;
            $("#total_"+table_id).html("$"+tvmComplete+"(+)");
       <?php }
        else
        { ?>
            $("#amount_"+table_id).html("$"+amount+"(+)"); 
            $("#fee_"+table_id).html("$"+0+"(+)");
            $("#total_"+table_id).html("$"+amount+"(+)");
        
            
        <? } ?> */
        
        
   
   
   // }
    
}
    

    /*$(".all_transection_view").click(function(){
       
        
       
        var table_id = $(".all_transection_view").attr("table_id");
         //var table_id = $(".all_transection_view").attr("table_id");
        
        
    //$("#date").html(date);
    
    //
    //$("#receiver_ibm").html(receiver_ibm);
    
    
    
     
    });
    $("#transaction_id").click(function(){
     var transaction_id =    $("#transaction_id").attr("transaction_id");   
     $("#tx_id").html(transaction_id);
    
     
    })
    */
    
</script>
<?php 
//   }
// }
include_once 'includes/footer.php'; ?>





