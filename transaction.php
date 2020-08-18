<?php
$menu = array('tab' => 5, 'option' => null);
//include_once 'includes/header.php';
include_once 'includes/main-header.php';

require_once(__DIR__ . '/_libs/payment.php');
require_once(__DIR__ . '/_libs/dbConnect.php');
require_once(__DIR__ . '/_libs/bitcoinSetting.php');
$bitcoinSetting = new bitcoinSetting();

$newsifyPaymentObj = new  payment();
$db = new dbConnect();

$walletAccountDetail = $bitcoinSetting->getSingleAccount($_SESSION['user']['wallet_xpub']);
if ($walletAccountDetail['receiveAddress'] != $_SESSION['user']['wallet_number']) {
  $response = $db->updateWalletAddress($walletAccountDetail['receiveAddress'], $_SESSION['user']['wallet_xpub']);
  if ($response['success'] == true) {
    $_SESSION['user']['wallet_number'] = $walletAccountDetail['receiveAddress'];
  }
}

?>

<div class="content-wrapper transaction_page">

    <section class="content-header">
        <h1>
            Transaction
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Transaction</li>
        </ol>
    </section>

<article class="content grid-page">

  <section class="section">
      <div class="box" style="display: block; padding: 20px; min-height: 675px;">

      <div>
          <?php include('includes/balance_amount.php'); ?>
      </div>

    <?php

    function get_transaction_password($email, $ibm)
    {
      $obj = new  dbConnect();
      $result2 = $obj->db_select("SELECT transaction_password FROM members WHERE user_email ='" . $email . "' AND ibm='" . $ibm . "'");
      $count = mysqli_num_rows($result2);
      if ($count > 0) {

        $ref = mysqli_fetch_array($result2);
        return $ref['transaction_password'];
      }
    }


    function check_External_or_internal_wallet($wallet)
    {
      $obj = new  dbConnect();
      $result2 = $obj->db_select("SELECT ibm FROM members WHERE wallet_number ='" . $wallet . "'");
      $count = mysqli_num_rows($result2);
      if ($count > 0) {
        $ref = mysqli_fetch_array($result2);
        return $receiver_ibm = $ref['ibm'];
      } else {
        return $receiver_ibm = 'Received By external';
      }
    }


    $ibm = $_SESSION['user']['ibm'];
    $email = $_SESSION['user']['email'];
    $transection_password = get_transaction_password($email, $ibm);

    if (isset($_POST['Submit_transaction'])) {
      $email = $_SESSION['user']['wallet_email'];

      $wallet_number = $_POST['wallet_number'];
      $amount = $_POST['amount'];
      $conform = $_POST['conformation'];
      $fee = $db->getTransactionFeeMtoM($_POST['amount']);
      $sender_wellet = $_SESSION['user']['wallet_number'];
      $sender_xpub = $_SESSION['user']['wallet_xpub'];
      $sender_ibm = $_SESSION['user']['ibm'];
      $receiver_ibm = check_External_or_internal_wallet($_POST['wallet_number']);


      if ($conform == 1) {
        $response = $newsifyPaymentObj->transaction_payment($email, $amount, $wallet_number, $fee, $sender_wellet, $sender_xpub, $sender_ibm, $receiver_ibm);
        if ($response['success'] == true) {
    ?>
          <div class="alert alert-success">
            <strong>Success!</strong> <?php echo $response['message']; ?>
          </div>
        <?php
        }
        if ($response['error'] == true) {
        ?>
          <div class="alert alert-danger">
            <strong></strong> <?php echo $response['message']; ?>
          </div>
    <?php
        }
      }
    }



    ?>


    <button id="transaction_model_show" type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaction-password">
<!--        <i class="ion ion-paper-plane"></i>-->
      Send
    </button>

    <button id="send_btn_show" type="button" style="display:none" class="btn btn-primary" data-toggle="modal" data-target="#send"><i class="far fa-paper-plane fa_change"></i> Send </button>

    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#request"><i class="fas fa-sign-in-alt fa_change"></i> Request</button>

    <div class="modal fade" id="request" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Wallet Address</h4>
          </div>
          <div class="modal-body">

            <input type="text" id="copyTarget" class="form-control mb-5" value="<?php echo $_SESSION['user']['wallet_number']; ?>" disabled>

              <button id="copyButton" class="btn btn-block btn-primary" onclick="myFunction()"><span id="copyresult">Click Here to Copy</span></button>
            <p>

            </p>

              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

          </div>

        </div>

      </div>
    </div>
    <!--model box for transection Password-->
    <div class="modal fade" id="transaction-password" role="dialog">
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
            <h4 class="modal-title">Complete Transaction Password</h4>

          </div>

          <div class="modal-body">

              <div id="transection_notification" class="alert alert-danger  mb-3" style="display: none">
                  There Is Something Went Wrong. Try Again Later.
              </div>
            <?php
            if ($transection_password == null) {
            ?>
              <p style="text-transform: font-size: 16px; text-decoration: font-weight: 600;">You need to register for a Transactional password in order to do transactions. </p>
              <br>
              <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">
                <center><a href="https://theviralmarketer.biz/profile.php"> CLICK HERE TO REGISTER NOW </a></center>
              </p>
            <?php
            } else {
            ?>
              <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">
                Please Complete Transaction Password
              </p>


              <div class="form-group password">

                <label for="Inputpassword">Enter 3 hidden Digits of password:</label>
                <div class="row">

                  <div class="col-6 col-md-3 col-lg-3">
                      <div class="row">
                          <div class="col-6">
                              <span style="margin-left: 34%;">1</span>
                              <input id="index_1" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_1">
                          </div>

                          <div class="col-6">
                              <span style="margin-left: 34%;">2</span>
                              <input id="index_2" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_2">
                          </div>
                      </div>

                  </div>

                  <div class="col-6 col-md-3 col-lg-3" >
                      <div class="row">
                          <div class="col-6">
                              <span style="margin-left: 34%;">3</span>
                              <input id="index_3" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_3">
                          </div>

                          <div class="col-6">
                              <span style="margin-left: 34%;">4</span>
                              <input id="index_4" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_4">
                          </div>

                      </div>

                  </div>


                  <div class="col-6 col-md-3 col-lg-3" >
                      <div class="row">
                          <div class="col-6">
                              <span style="margin-left: 34%;">5</span>
                              <input id="index_5" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_5">
                          </div>

                          <div class="col-6">
                              <span style="margin-left: 34%;">6</span>
                              <input id="index_6" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_6">
                          </div>

                      </div>

                  </div>

                  <div class="col-6 col-md-3 col-lg-3">

                      <div class="row">

                          <div class="col-6">
                              <span style="margin-left: 34%;">7</span>
                              <input id="index_7" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_7">
                          </div>

                          <div class="col-6">
                              <span style="margin-left: 34%;">8</span>
                              <input id="index_8" type="password" step="any" minlength="1" maxlength="1" pattern=".{1,1}" class="form-control" name="index_8">
                          </div>

                      </div>

                  </div>


                </div>
              </div>
              <div class="modal-footer">
                <button id="trensection_password_check" name="trensection_password_check" class="btn btn-primary">Submit</button>

                <button type="button" id="transection-close" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>

            <?php
            }
            ?>

          </div>


        </div>

      </div>
    </div>
    <!--end model box for transection Password-->

    <!--Send button-->
    <div class="modal fade" id="send" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Transfer Amount</h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">

              <div class="form-group">
                <label for="InputWallet">Wallet Address</label>
                <input id="InputWallet" type="text" class="form-control" name="wallet_number" required aria-describedby="WalletHelp" placeholder="Enter Wallet Address">
                <small id="WalletHelp" class="form-text text-muted">Write here Wallet Address </small>
              </div>

              <div class="form-group">
                <label for="InputAmount">Amount($)</label>
                <small id="AmountHelp" class="form-text text-muted">Write the Amount that you want to transfer </small>
                <input id="InputAmount" type="number" step="any" class="form-control" name="amount" required aria-describedby="AmountHelp" placeholder="Enter Amount In dollers($)" oninput="transactionFee()">
                <p id="transaction-fee" style="color:red"></p>

              </div>


              <input type="hidden" name="conformation" value="0" />

                <div class="form-check pl-0 mb-5">
                    <input class="form-check-input" name="conformation" type="checkbox" value="" id="conformation" required value="1">
                    <label class="form-check-label" for="conformation">
                        Confirm Transaction
                    </label>
                </div>

<!--              <input type="checkbox" name="conformation" required value="1"> Confirm Transaction-->
<!---->
<!--              <br><br>-->

                <div class="modal-footer">

                    <button type="submit" name="Submit_transaction" class="btn btn-primary">Send</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                    </form>
                </div>



          </div>


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
  document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
  });

  function copyToClipboard(elem) {
    // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
      // can just use the original source element for the selection and copy
      target = elem;
      origSelectionStart = elem.selectionStart;
      origSelectionEnd = elem.selectionEnd;
    } else {
      // must use a temporary form element for the selection and copy
      target = document.getElementById(targetId);
      if (!target) {
        var target = document.createElement("textarea");
        target.style.position = "absolute";
        target.style.left = "-9999px";
        target.style.top = "0";
        target.id = targetId;
        document.body.appendChild(target);
      }
      target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);

    // copy the selection
    var succeed;
    try {
      succeed = document.execCommand("copy");
    } catch (e) {
      succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
      currentFocus.focus();
    }

    if (isInput) {
      // restore prior selection
      elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
      // clear temporary content
      target.textContent = "";
    }
    return succeed;
  }

  function myFunction() {

    document.getElementById("copyButton").innerHTML = "Text Copied";
  }



  function transactionFee() {
    var x = document.getElementById("InputAmount").value;
    var percentage;
    var transaction_fee;
    if (x < 51) {
      percentage = x / 100;
      transaction_fee = 1.50;
    } else {
      percentage = (x / 100)
      transaction_fee = percentage + percentage + 0.5
    }

    var total = parseFloat(x) + parseFloat(transaction_fee);
    document.getElementById("transaction-fee").innerHTML = x + "$ +" + transaction_fee + "$ (transaction_fee) = $" + parseFloat(total);
  }

  $('#transaction_model_show').click(function() {
    var rendom_value = '';
    var transection_password = '<?php echo $transection_password; ?>';

    var index_1 = transection_password.slice(0, 1);
    var index_2 = transection_password.slice(1, 2);
    var index_3 = transection_password.slice(2, 3);
    var index_4 = transection_password.slice(3, 4);
    var index_5 = transection_password.slice(4, 5);
    var index_6 = transection_password.slice(5, 6);
    var index_7 = transection_password.slice(6, 7);
    var index_8 = transection_password.slice(7, 8);

    // var completepassword = inputvalue+hidden_password;
    var transection_password_array = ['', index_1, index_2, index_3, index_4, index_5, index_6, index_7, index_8];
    var i;
    var rendom_array = ['123', '245', '784', '524', '325', '426', '827', '378', '531', '432', '653', '734', '385', '436', '537', '241', '641', '742', '843', '345', '786', '546', '647', '851', '751', '852', '358', '458', '658', '756', '257', '261', '861', '362', '463', '564', '685', '726', '867', '278'];

    var j;
    for (j = 1; j <= transection_password.length; ++j) {

      $('#index_' + j).attr('disabled', false);

    }

    for (i = 0; i < rendom_array.length; ++i) {
      var value = Math.floor(10 + Math.random() * 30);
      var rendom_value = rendom_array[value];
    }

    //rendow value for index
    var rendom_index_1 = rendom_value.slice(0, 1);
    var rendom_index_2 = rendom_value.slice(1, 2);
    var rendom_index_3 = rendom_value.slice(2, 3);



    for (i = 1; i <= transection_password.length; ++i) {
      if (rendom_index_1 == i || rendom_index_2 == i || rendom_index_3 == i) {

        $('#index_' + i).val('');

      } else {
        $('#index_' + i).val(transection_password_array[i]).attr("disabled", true);

      }

    }
  });
  $('#trensection_password_check').click(function() {
    var input_all_value = '';
    var get_id = $('#get_id').val();

    var transection_password = '<?php echo $transection_password; ?>';


    for (i = 1; i <= transection_password.length; ++i) {

      var single_value = $('#index_' + i).val();

      var input_all_value = input_all_value + single_value;



    }

    if (input_all_value == transection_password) {

      $('#transection-close').trigger('click');
      $('#send_btn_show').trigger('click');

    } else {
      $('#transection_notification').show();
      setTimeout(function(){
          $('#transection_notification').fadeOut();
      }, 5000);
    }



  })
</script>
<?php //include_once 'includes/footer.php'; ?>