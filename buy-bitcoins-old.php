<?php
$menu = array(
    'tab' => 6,
    'option' => null
);
include_once 'includes/header.php';
require_once(__DIR__ . '/_libs/payment.php');
require_once(__DIR__ . '/_libs/dbConnect.php');

$newsifyObj = new payment();
$dbobject   = new dbConnect();
function get_transaction_password($email, $ibm)
{
    $obj     = new dbConnect();
    $result2 = $obj->db_select("SELECT transaction_password FROM members WHERE user_email ='" . $email . "' AND ibm='" . $ibm . "'");
    $count   = mysqli_num_rows($result2);
    if ($count > 0) {

        $ref = mysqli_fetch_array($result2);
        return $ref['transaction_password'];
    }
}
$ibm                  = $_SESSION['user']['ibm'];
$email                = $_SESSION['user']['email'];
$transection_password = get_transaction_password($email, $ibm);
$success_message      = "";
$error                = "";





?>
<div class="sidebar-overlay" id="sidebar-overlay"></div>
<article class="content grid-page">
    <div class="title-block">
        <h3 class="title">Buy Bitcoin </h3>
    </div>

    <?php


    if (isset($_POST['buy_bitcoin'])) {

        /*$GLOBALS['wallet_address'] = 'n3zTBdFJuejSwcsY8KBjzNBx45aqPWq8x5';
    $GLOBALS['email'] = $_SESSION['user']['wallet_email'];
    $GLOBALS['amount'] = $_POST['amount'];
    
    */
        $amount     = $_POST['amount'];
        $paypal_url = $dbobject->buy_bitcoin_through_paypal($amount);

        $redierct = $dbobject->redirectMe($paypal_url);
    }

    // if (isset($_POST['buy_bitcoin_craditcard'])) {

    //     $year           = $_POST['year'];
    //     $month          = $_POST['month'];
    //     $date           = date('Y');
    //     $wallet_address = $_SESSION['user']['wallet_number'];
    //     $ibm = $_SESSION['user']['ibm'];
    //     $fee = $dbobject->getTransactionFeeCraditCard($_POST['credit_card_amount']);
    //     $tvmminer = $dbobject->getFee($_POST['credit_card_amount']);
    //     if ($month >= 12) {
    //         $error = "invalid Month detail";
    //     } elseif ($year < $date) {
    //         $error = "invalid Year detail";
    //     } elseif ($month >= 12 && $year < $date) {
    //         $error = "invalid Month & Year detail";
    //     } else {
    //         $data     = array(
    //             'credit_card_number' => $_POST['credit_card_number'],
    //             'verification_value' => $_POST['verification_value'],
    //             'month' => $_POST['month'],
    //             'year' => $_POST['year'],
    //             'amount' => $_POST['credit_card_amount'],
    //             'wallet_address' => $wallet_address,
    //             'ibm' => $ibm,
    //             'email' => 'theviralmarketer2015@gmail.com',
    //             'fee' => $fee,
    //             'tvmminer' => $tvmminer

    //         );

    //         $response = $dbobject->buy_bitcoin_through_cradit_card($data);
    //         if ($response['success'] == true) {
    //             $success_message = $response['message'];

    //         } else {
    //             $error = $response['message'];
    //         }


    //     }

    // }
    ?>



    <?php
    if ($success_message != '') {
    ?>
        <div class="alert alert-success">
            <strong>Success!</strong> <?php
                                        echo $success_message;
                                        ?>
        </div>
    <?php
    }
    ?>
    <?php
    if ($error != '') {
    ?>
        <div class="alert alert-danger">
            <?php
            echo $error;
            ?>
        </div>




    <?php
    }
    ?>
    <?php 
    if(isset($_GET['success'])) {
        ?>
        <div class="alert alert-success" > <?php echo $_GET['success']; ?></div>
        <?php } ?>

<div id="success-message" class="alert alert-success" style="display: none;"></div>
    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
    <section class="section">
        <!--        <div style="text-align: center;-->
        <!--background-color: #85CE36;-->
        <!--padding: 15px;-->
        <!--color: #fff;-->
        <!--text-transform: uppercase;-->
        <!--font-size: 17px;-->
        <!--margin-bottom: 13px;-->
        <!--font-weight: 800;" class="row"><span >Select any of the below payment method to buy bitcoins</span></div>-->
        <div>
            <button id="craditcard_transection" type="button" class="craditcar" style="display:none; border-radius: 52px; background: url(/images/Credit-Card-Button-3.png); width: 357px; height: 94px; background-repeat: no-repeat;background-size: 100% 100%;" class="btn btn-default" data-toggle="modal" data-target="l"> </button>
            <button style="display:none;" type="button" class="paypal-button" style="background: url(/images/PayPal-PayNow-Button.png); width: 357px; height: 94px; background-repeat: no-repeat;background-size: 100% 100%;" class="btn btn-default"> </button>
            <button id="paypal_btn_show" type="button" class="paypal-button" style="border-radius: 52px; background: url(/images/PayPal-PayNow-Button.png); width: 357px; height: 94px; background-repeat: no-repeat;background-size: 100% 100%;" class="btn btn-default"> </button>

        </div>

        <!--paypal button show div-->
        <div class="paypal_btn_show">
            <div class="modal-body">
                    <div class="form-group">

                        <label for="InputAmountPaypal">Amount($)</label>
                        <input id="InputAmountPaypal" type="number" step="any" class="form-control" name="amount" required aria-describedby="AmountHelp" placeholder="Enter Amount In dollers($)" oninput="transactionFeePaypal()">
                        <span id="transaction-fee-for-paypal" style="color:red"></span>
                    </div>
                    <div style="text-align:center !important; " class="modal-footer">
                        <p id="paypal_sucess_password"></p>
                        <button style="display:none;" id="paynow_paypal" onClick="paypalPay(event);" name="buy_bitcoin"  class="btn btn-lg btn-primary">Pay Now</button>

                    </div>

                <div style="text-align:center !important; " class="modal-footer">
                    <p></p>
                    <button type="submit" name="continue" id="paypal-button" onclick="validatePaypal()" class="btn btn-lg btn-primary transaction_model_show" data-toggle="modal" data-target="#transaction-password">Continue</button>
                    <button type="submit" name="continue" id="credit-card-button" class="btn btn-lg btn-primary transaction_model_show" data-toggle="modal" data-target="#transaction-password">Continue</button>


                </div>

            </div>
        </div>
        <!--paypal button show div-->

        <!--cradit Card div show-->
        <div class="cradit_card_btn_show">
            <div class="modal-body">
                <div class="form-group">

                    <label for="credit_card_amount">Amount($)</label>
                    <input id="credit_card_amount" type="number" step="any" class="form-control" name="credit_card_amount" required placeholder="Amount in Doller($)" oninput="transactionFeeCreditCard()">
                    <span id="transaction-fee-for-credit-card" style="color:red"></span>
                </div>
                <div class="form-group">
                    <label for="credit_card">Credit Card Number</label>
                    <input id="credit_card" type="number" step="any" class="form-control" name="credit_card_number" required aria-describedby="AmountHelp" placeholder="Enter Cradit Card Number">
                    <!--<p id = "transaction-fee" style = "color:red"></p>-->
                </div>
                <div class="row">

                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <label for="month_year">Expiration</label>
                        <br>
                        <div class="col-md-5"><input id="month" type="tel" onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;" step="any" class="form-control" name="month" required aria-describedby="AmountHelp" placeholder="MM"></div>

                        <div class="col-md-5"><input id="year" type="tel" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;" step="any" class="form-control" name="year" required aria-describedby="AmountHelp" placeholder="YYYY"></div>
                    </div>
                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <label for="verification_value">CVV / CVC *</label>
                        <input id="verification_value" type="number" step="any" class="form-control" name="verification_value" required aria-describedby="AmountHelp" placeholder="CVV / CVC *">
                    </div>

                </div>
                <div style="text-align:center !important; " class="modal-footer">
                    <button style="display:none;" id="buy_bitcoin_craditcard" type="submit" onClick="stripePay(event);" class="btn btn-lg btn-primary">Pay Now</button>

                </div>


                <div style="text-align:center !important; " class="modal-footer">
                    <a class="btn btn-lg btn-primary transaction_model_show" data-toggle="modal" data-target="#transaction-password">Continue</a>
                </div>
            </div>
        </div>
        <!--cradit card div show end-->

        <!--model box for transection Password-->
        <div class="modal fade" id="transaction-password" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="transection_notification">

                        </div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Complete Transaction Password</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        if ($transection_password == null) {
                        ?>
                            <p style="text-transform: font-size: 16px; text-decoration: font-weight: 600;">You need to register for a Transactional password in order to do transactions.</p>
                            <br>
                            <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">
                                <a href="https://www.theviralmarketer.biz/profile.php"> CLICK HERE TO REGISTER NOW </a>
                            </p>
                        <?php
                        } else {
                        ?>

                            <p style="text-transform: uppercase; font-size: 16px; text-decoration: underline; font-weight: 600;">
                                Please Complete Transaction Password
                            </p>


                            <div class="form-group">

                                <label for="Inputpassword">Enter 3 hidden Digits of Password:</label>
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">1</span>
                                            <input id="index_1" type="password" step="any" class="form-control" name="index_1">
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">2</span>
                                            <input id="index_2" type="password" step="any" class="form-control" name="index_2">
                                        </div>
                                    </div>

                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">3</span>
                                            <input id="index_3" type="password" step="any" class="form-control" name="index_3">
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">4</span>
                                            <input id="index_4" type="password" step="any" class="form-control" name="index_4">
                                        </div>
                                    </div>


                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">5</span>
                                            <input id="index_5" type="password" step="any" class="form-control" name="index_5">
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">6</span>
                                            <input id="index_6" type="password" step="any" class="form-control" name="index_6">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3" style="margin-right: -3%;">
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">7</span>
                                            <input id="index_7" type="password" step="any" class="form-control" name="index_7">
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-lg-6">
                                            <span style="margin-left: 34%;">8</span>
                                            <input id="index_8" type="password" step="any" class="form-control" name="index_8">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="trensection_password_check" name="trensection_password_check" class="btn btn-primary">Submit</button>

                                <button type="button" id="transection-close" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <div class="modal fade" id="paypal" role="dialog">
            <div class="modal-dialog">
    </section>
</article>


<script>
    $(document).ready(function() {
       $('.cradit_card_btn_show').hide();
        $('#paypal-button').hide();
    });

    function validatePaypal() {
        var x = document.getElementById("InputAmountPaypal").value;
        if (x == "") {
            alert("Amount is required");
            return false;
        }
    }

    $('#paypal_btn_show').click(function() {
        $('.paypal_btn_show').fadeIn(600);
        $('.cradit_card_btn_show').fadeOut();
        $('#credit-card-button').fadeOut();
        $('#paypal-button').fadeIn(600);
    })

    $('#craditcard_transection').click(function() {
        $('#credit-card-button').fadeIn(600);
        $('.cradit_card_btn_show').fadeIn(600);
        $('.paypal_btn_show').fadeOut();
        $('#paypal-button').fadeOut();
    });

    $('.transaction_model_show').click(function() {
        var amount = $("#InputAmountPaypal").val();

        if (amount == null || amount == '') {
            //alert(amount);
            $('#transaction-password').css("display", "none");

        }
    });

    $('.transaction_model_show').click(function() {
        var rendom_value = '';
        var transection_password = '<?php
                                    echo $transection_password;
                                    ?>';

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
        for (i = 0; i < rendom_array.length; ++i) {
            var value = Math.floor(10 + Math.random() * 30);
            var rendom_value = rendom_array[value];
        }

        var j;
        for (j = 1; j <= transection_password.length; ++j) {

            $('#index_' + j).attr('disabled', false);

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

        var transection_password = '<?php
                                    echo $transection_password;
                                    ?>';


        for (i = 1; i <= transection_password.length; ++i) {

            var single_value = $('#index_' + i).val();

            var input_all_value = input_all_value + single_value;



        }

        if (input_all_value == transection_password) {

            $('#transection-close').trigger('click');
            $('#paynow_paypal').css('display', 'block');
            $('.transaction_model_show').css('display', 'none');
            $('#buy_bitcoin_craditcard').css('display', 'block');
        } else {
            $('#transection_notification').html('<div style="width:100%; height:50px; background-color:red;text-align:center;">There Is Something Went Wrong.<br>Try Again Later.</div>');
        }

    })

    function transactionFeePaypal() {
        var x = document.getElementById("InputAmountPaypal").value;
        two_point_nine_percent = (x / 100) * 2.9
        six_point_nine_percent = (x / 100) * 6
        var percentage;
        if (x < 51) {
            percentage = 1.5;
        } else {
            percentage = ((x / 100) * 2) + 0.5;
        }
        var total = parseFloat(x) + parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
        var miner_fee = percentage + 0.5
        var transaction_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + parseFloat(percentage);
        document.getElementById("transaction-fee-for-paypal").innerHTML = x + "$ + " + parseFloat(transaction_fee).toFixed(2) + " $ (Transaction fee) =  " + parseFloat(total).toFixed(2) + "$";
    }

    function paypalTotalAmount() {
        var x = document.getElementById("InputAmountPaypal").value;
        two_point_nine_percent = (x / 100) * 2.9
        six_point_nine_percent = (x / 100) * 6
        var percentage;
        if (x < 51) {
            percentage = 1.5;
        } else {
            percentage = ((x / 100) * 2) + 0.5;
        }
        var total = parseFloat(x) + parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
        var miner_fee = percentage + 0.5
        var transaction_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + parseFloat(percentage);
        return +parseFloat(total).toFixed(2);
    }


    function transactionFeeCreditCard() {
        var x = document.getElementById("credit_card_amount").value;
        var percentage;
        two_point_nine_percent = (x / 100) * 2.9
        six_point_nine_percent = (x / 100) * 6
        if (x < 51) {
            percentage = 1.5;
        } else {
            percentage = ((x / 100) * 2) + 0.5;
        }
        var total = parseFloat(x) + parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
        var miner_fee = percentage + 0.5
        var total_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3
        document.getElementById("transaction-fee-for-credit-card").innerHTML = x + "$ + " + parseFloat(total_fee).toFixed(2) + "$ (Transaction Fee)" + "= " + parseFloat(total).toFixed(2) + "$";
    }

    function creditCardAmount() {
        var x = document.getElementById("credit_card_amount").value;
        if (x.trim() == '') {
            return 0;
        }
        var percentage;
        two_point_nine_percent = (x / 100) * 2.9
        six_point_nine_percent = (x / 100) * 6
        if (x < 51) {
            percentage = 1.5;
        } else {
            percentage = ((x / 100) * 2) + 0.5;
        }
        var total = parseFloat(x) + parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
        var miner_fee = percentage + 0.5
        var total_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3
        return +parseFloat(total).toFixed(2);
    }
</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
    function cardValidation() {
        var valid = true;
        var amount = creditCardAmount();
        var cardNumber = $('#credit_card').val();
        var month = $('#month').val();
        var year = $('#year').val();
        var cvc = $('#verification_value').val();

        $("#error-message").html("").css('display', 'none');

        if (amount == 0) {
            valid = false;
        }

        if (cardNumber.trim() == "") {
            valid = false;
        }

        if (month.trim() == "") {
            valid = false;
        }
        if (year.trim() == "") {
            valid = false;
        }
        if (cvc.trim() == "") {
            valid = false;
        }


        if (valid == false) {
            $("#error-message").html("All Fields are required").css('display', 'block');
        }

        return valid;
    }

    //set your publishable key
    Stripe.setPublishableKey("pk_test_0ZGdc8XYeV2t7jFJF8SfRcMR");

    //callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            //enable the submit button
            $("#submit-btn").show();
            $("#loader").css("display", "none");
            //display the errors on the form
            $("#error-message").html(response.error.message).show();
        } else {
            //get token id
            var amount = creditCardAmount();
            var token = response['id'];
            $.ajax({
                url: './ajax/stripeProcess.php',
                data: {
                    "token": token,
                    "amount": amount,
                    "user_amount": document.getElementById("credit_card_amount").value
                },
                type: 'post',
                dataType: 'JSON',
                success: function(response) {
                if(response['success']) {
                    
                    $("#success-message").html(response['message']).css('display', 'block');
                    setTimeout(function(){
                        window.location.href = window.location.href + "?success=".response['message'];
                        ; }, 7000);
                   

			    } else {
				  $("#error-message").html(response['message']).css('display', 'block');
                  $(window).scrollTop()
				}
                }
            });

        }
    }

    function stripePay(event) {
        var valid = cardValidation();
        if (valid == true) {
            $("#submit-btn").hide();
            $("#loader").css("display", "inline-block");
            Stripe.createToken({
                number: $('#credit_card').val(),
                cvc: $('#verification_value').val(),
                exp_month: $('#month').val(),
                exp_year: $('#year').val()
            }, stripeResponseHandler);

            //submit from callback
            return false;
        }
    }

    
</script>

<script>
function paypalPay(event) {
    var amount = paypalTotalAmount();
    var user_amount = document.getElementById("InputAmountPaypal").value;
     $.ajax({
                url: './ajax/paypalProcess.php',
                 data: {
                     "amount": amount,
                    "user_amount": user_amount
                },
                type: 'post',
                dataType: 'JSON',
                success: function(response) {
	              if(response['success']) {
					  window.open(response['url'],'_self');
			} else {
				  $("#error-message").html(response['message']).css('display', 'block');
				$(window).scrollTop()
				}
          }
            });
}

</script>
<?php
include_once 'includes/footer.php';
?>