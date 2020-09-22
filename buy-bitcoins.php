

<?php
$menu = array(
    'tab' => 6,
    'option' => null
);
include_once 'includes/main-header.php';
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
<style>

    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,700,700italic);
@import url(https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic);
@import url(https://fonts.googleapis.com/css?family=Roboto);


@font-face {
    font-family: "icons";
    src: url(../fonts/icons.woff) format("woff");
    src: url(../fonts/icons.svg) format("svg");
    src: url(../fonts/icons.eot) format("eot");
    src: url(../fonts/icons.eot) format("embedded-opentype");
    src: url(../fonts/icons.ttf) format("truetype")
}
@font-face {
    font-family: "PragmaticaSlab";
    src: url(../fonts/PragmaticaSlab-Medium.woff) format("woff");
    src: url(../fonts/PragmaticaSlab-Medium.svg) format("svg");
    src: url(../fonts/PragmaticaSlab-Medium.eot) format("eot");
    src: url(../fonts/PragmaticaSlab-Mediumns.eot) format("embedded-opentype");
    src: url(../fonts/PragmaticaSlab-Medium.ttf) format("truetype")
}
.animated {
    -webkit-animation-duration: 1.5s;
    animation-duration: 2.5s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both
}
@-webkit-keyframes fadeIn {
    from {
        opacity: 0
    }
    to {
        opacity: 1
    }
}
@keyframes fadeIn {
    from {
        opacity: 0
    }
    to {
        opacity: 1
    }
}
.fadeIn {
    -webkit-animation-name: fadeIn;
    animation-name: fadeIn
}
#features {
    text-align: center
}
#features .features-title {
    display: inline-block;
    position: relative;
    color: #404040;
    font-size: 32px;
    font-family: "Roboto";
    font-weight: 400;
    line-height: 46px;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin: 1em 0
}
.transationfee{
   font-size: 16px !important;
    color: #a0a0a0;
    margin-bottom: 5px;
}
#features .features-title::after {
    display: block;
    position: absolute;
    bottom: -.2em;
    left: 50%;
    margin-left: -40px;
    content: "";
    width: 80px;
    height: 3px;
    background-color: #fbae1c;
}
#features .features-content {
   
    align-items: center;
    padding-bottom: 5em;
    margin-bottom: 5em;
    border-bottom: 2px solid #e5f7fb
}
#features .features-content+.features-content {
    border: 0
}
@media(min-width: 756px){
.password-div{
    flex: 0 0 12.333333%;
   max-width: 11%;
    margin: 3px;
}
.password-div input
{
    font-size: 22px;
    padding: 20px;
    
}    
#features .features-content-col {
    width: 50%;
    text-align: left
}
#features .features-content {
     display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
}
}
@media(max-width: 756px){
.password-div{
    flex: 0 0 10.333333%;
   max-width: 11%;
    margin: 3px;
}
.password-div input
{
    font-size: 22px;
    padding: 14px;
    
}
#features .features-content-col {
    width: 100%;
    text-align: left
}
#features .features-content {
     display: block;
    
}
}
#features .features-textblock {
    display: none;
    position: relative
}
#features .features-textblock.__active {
    display: block
}
#features .features-textblock h1,
#features .features-textblock h2,
#features .features-textblock h3,
#features .features-textblock h4,
#features .features-textblock h5 {
    color: #404040;
    font-family: "Open Sans";
    font-weight: 900;
    padding: 0;
    font-size: 1.5em
}
#features .features-textblock p {
    color: #404040;
    font-family: "Open Sans";
    font-size: 12px;
    font-weight: 300;
    line-height: 1.7em
}
#features .features-textblock ul {
    margin: 0;
    padding: 0 2em;
    list-style: none
}
#features .features-textblock ul li {
    position: relative;
    list-style: none;
    margin: 0;
    padding: 0;
    text-indent: -5px;
    color: #404040;
    font-family: "Open Sans";
    font-size: 12px;
    font-weight: 300;
    line-height: 1.7em;
    padding: 0.7em 0
}
#features .features-textblock ul li:before {
    display: inline-block;
    position: relative;
    top: -1px;
    left: -11px;
    content: '';
    width: 5px;
    height: 5px;
    background-color: #00b0de;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%
}
#features .features-graph {
    height: 425px;
    margin: 25px
}
#features .features-graph .button-holder {
    display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    justify-content: center;
    -webkit-justify-content: center;
    align-items: center
}
#features .features-graph .animation-holder {
    display: flex;
    justify-content: center;
    align-items: center
}
#features .features-graph .flash-oval {
    background-color: #fbae1c;
    width: 12em;
    height: 12em;
    border-radius: 7em;
       
    -webkit-transform: translateX(1px);
    -ms-transform: translateX(1px);
    transform: translateX(1px);
    z-index: 100;
    margin: 12em auto 9em auto
}
#features .features-graph .flash-oval span.glyphicon {
  position: absolute;
    right: 23px;
    top: 25px;
    font-size: 46px;
    color: #fff;
}
#features .features-graph .btn-with-icon {
    display: block;
    width: 70px;
    height: 70px;
    background-color: #fff;
    border: 1px solid #9df;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    -ms-border-radius: 10px;
    border-radius: 10px;
    transition-duration: 0.3s;
    background-position: center;
    background-repeat: no-repeat;
    line-height: 5em;
    z-index: 0;
    cursor: pointer;
   
    text-align: center;
    opacity: 0.5;
    filter: alpha(opacity=50)
}
#features .features-graph .btn-with-icon.__active {
    opacity: 1;
    filter: alpha(opacity=100)
}
#features .features-graph .btn-with-icon:hover {
    opacity: 1
}
#features .features-graph .sq-bt-label {
    letter-spacing: 0;
    color: #656b6f;
    font-size: 11px;
    font-weight: 400;
    line-height: 16px;
    position: absolute;
    text-transform: uppercase
}
@media(min-width:756px){
    #features .features-graph .btn-with-icon {
    margin-left: 6%;
    margin-right: 6%;
}

#features .features-graph .label-top-left {
    right: 35%;
    top: 33%;
}
#features .features-graph .label-top {
   right: 23.3%;
    top: 33%;
}
#features .features-graph .label-top-right {
       right: 12%;
    top: 33%;
}    
}

@media(max-width:756px){
    #features .features-graph .btn-with-icon {
    margin-left: 8%;
    margin-right: 8%;
}

 #features .features-graph .label-top-left {
       right: 73%;
    top: 49%;
}
#features .features-graph .label-top {
       right: 44.3%;
    top: 49%;
}
#features .features-graph .label-top-right {
        right: 15.7%;
    top: 49.4%;
}   
}

#features .features-graph .label-bottom-left {
    right: 36.3%;
    bottom: 13%;
}
#features .features-graph .label-bottom {
    right: 21.4%;
    bottom: 13%;
}
#features .features-graph .label-bottom-right {
    right: 6.6%;
    bottom: 13%;
}
#features .features-graph .icon-features-1:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/top-left.svg);
    background-size: 100%;
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
    
}
@media(min-width:756px) {
#features .features-graph .icon-features-1:after {
top: 36.4%;
    right: 29%;
}   
#features .features-graph .icon-features-2:after {
 top: 36.4%
}    

#features .features-graph .icon-features-3:after {
top: 36.4%;
    right: 13%;
    
}   
}
@media(max-width:756px){
#features .features-graph .icon-features-1:after {
    top: 51.4%;
}    

#features .features-graph .icon-features-2:after {
top: 51.4%;
}    

#features .features-graph .icon-features-3:after {
top: 51.4%;
    right: 17%;
}    


    
}


#features .features-graph .icon-features-2:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/top.svg);
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
   
}
#features .features-graph .icon-features-3:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/top-right.svg);
    background-size: 100%;
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
   
}
#features .features-graph .icon-features-4:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/bottom-left.svg);
    background-size: 100%;
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
    bottom: 26%
}
#features .features-graph .icon-features-5:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/bottom.svg);
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
    bottom: 23%
}
#features .features-graph .icon-features-6:after {
    content: ' ';
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/bottom-right.svg);
    background-size: 100%;
    height: 110px;
    width: 85px;
    background-repeat: no-repeat;
    position: absolute;
    bottom: 26%;
    right: 10%
}
#features .features-graph #top-left-line {
    position: absolute;
    top: 170px;
    left: 50px;
    z-index: -4
}
#features .features-graph .icon-features-1 {
    background-image: url('images/1280px-Stripe_Logo,_revised_2016.svg.png');
    background-size: 65%;
   
}
#features .features-graph .icon-features-2 {
    background-image: url('images/paypal_PNG20.png');
    background-size: 70%;
    background-position: 50% 50%
}
#features .features-graph .icon-features-3 {
    background-image: url('images/visa-5-logo-png-transparent.png');
    background-size: 65%
}
#features .features-graph .icon-features-4 {
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/icon-4.svg);
    background-size: 150%;
    background-position: 50% 0
}
#features .features-graph .icon-features-5 {
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/icon-5.svg);
    background-size: 150%
}
#features .features-graph .icon-features-6 {
    background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/598117/icon-6.svg);
    background-size: 65%;
    background-position: 50% 50%
}
#features .features-graph .wave {
    position: absolute;
    opacity: 0;
    width: 12em;
        left: 0;
    height: 12em;
    border: #f7b63a 1px solid;
    border-radius: 7em;
    -webkit-animation-name: ripple;
    animation-name: ripple;
    -webkit-animation-duration: 2s;
    animation-duration: 2s;
    -webkit-animation-iteration-count: linear;
    animation-iteration-count: linear;
    text-align: center;
    top: 0
}
#features .features-graph .wave2 {
    position: absolute;
    opacity: 0;
    width: 12em;
        left: 0;
    height: 12em;
    border: #f7b63a 1px solid;
    border-radius: 7em;
    -webkit-animation-name: ripple2;
    animation-name: ripple2;
    -webkit-animation-duration: 2s;
    animation-duration: 2s;
    -webkit-animation-iteration-count: linear;
    animation-iteration-count: linear;
    top: 0;
    text-align: center
}
#features .features-graph .wave3 {
    position: absolute;
    opacity: 0;
    width: 12em;
        left: 0;
    height: 12em;
    border: #f7b63a 1px solid;
    border-radius: 7em;
    -webkit-animation-name: ripple3;
    animation-name: ripple3;
    -webkit-animation-duration: 2s;
    animation-duration: 2s;
    -webkit-animation-iteration-count: linear;
    animation-iteration-count: linear;
    text-align: center;
    top: 0
}
#features .features-graph .wave4 {
    position: absolute;
    opacity: 0;
     left: 0;
    width: 12em;
    height: 12em;
    border: #f7b63a 1px solid;
    border-radius: 7em;
    -webkit-animation-name: ripple4;
    animation-name: ripple4;
    -webkit-animation-duration: 2s;
    animation-duration: 2s;
    -webkit-animation-iteration-count: linear;
    animation-iteration-count: linear;
    text-align: center;
    top: 0
}
@-webkit-keyframes ripple {
    from {
        opacity: 0.8
    }
    to {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        opacity: 0
    }
}
@keyframes ripple {
    from {
        opacity: 0.8
    }
    to {
        -webkit-transform: scale(1.2);
        transform: scale(1.2);
        opacity: 0
    }
}
@-webkit-keyframes ripple2 {
    from {
        opacity: 0.7
    }
    to {
        -webkit-transform: scale(1.5);
        transform: scale(1.5);
        opacity: 0
    }
}
@keyframes ripple2 {
    from {
        opacity: 0.7
    }
    to {
        -webkit-transform: scale(1.5);
        transform: scale(1.5);
        opacity: 0
    }
}
@-webkit-keyframes ripple3 {
    from {
        opacity: 0.7
    }
    to {
        -webkit-transform: scale(2);
        transform: scale(2);
        opacity: 0
    }
}
@keyframes ripple3 {
    from {
        opacity: 0.7
    }
    to {
        -webkit-transform: scale(2);
        transform: scale(2);
        opacity: 0
    }
}
@-webkit-keyframes ripple4 {
    from {
        opacity: 0.6
    }
    to {
        -webkit-transform: scale(2.5);
        transform: scale(2.5);
        opacity: 0
    }
}
@keyframes ripple4 {
    from {
        opacity: 0.4
    }
    to {
        -webkit-transform: scale(2.5);
        transform: scale(2.5);
        opacity: 0
    }
}
#features .features-items {
    display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    flex-flow: row wrap;
    list-style: none;
    margin: 0;
    padding: 0
}
#features .features-items li {
    list-style: none;
    margin: 0;
    padding: 0;
    width: 50%;
    text-align: left;
    padding: 20px 50px 20px 20px
}

.hidden {display:none;}
.visible {display:block;}

#features .features-textblock p {
    color: #404040;
    font-family: "Open Sans";
    font-size: 12px;
    font-weight: 300;
    line-height: 1.7em
}
#features .features-textblock ul {
    margin: 0;
    padding: 0 2em;
    list-style: none
}
#features .features-textblock ul li {
    position: relative;
    list-style: none;
    margin: 0;
    padding: 0;
    text-indent: -5px;
    color: #404040;
    font-family: "Open Sans";
    font-size: 12px;
    font-weight: 300;
    line-height: 1.7em;
    padding: 0.7em 0
}
#features .features-textblock ul li:before {
    display: inline-block;
    position: relative;
    top: -1px;
    left: -11px;
    content: '';
    width: 5px;
    height: 5px;
    background-color: #00b0de;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    -ms-border-radius: 50%;
    border-radius: 50%
}
#features .features-graph {
    height: 425px;
    margin: 25px
}
#features .features-graph .button-holder {
    display: flex;
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    justify-content: center;
    -webkit-justify-content: center;
    align-items: center
}
#features .features-graph .animation-holder {
    display: flex;
    justify-content: center;
    align-items: center
}
#features .features-graph .flash-oval {
    background-color: #fbae1c;
    width: 12em;
        padding: 27px;
    height: 12em;
    border-radius: 7em;
    -webkit-transform: translateX(1px);
    -ms-transform: translateX(1px);
    transform: translateX(1px);
    z-index: 100;
    margin: 12em auto 9em auto
}
#features .features-graph .flash-oval span.glyphicon {
   position: absolute;
    right: 23px;
    top: 25px;
    font-size: 46px;
    color: #fff;
}
</style>
<div class="content-wrapper">

 <section class="content-header">
      <h1>
        Buy Bitcoins
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Buy Bitcoins</li>
      </ol>
    </section>

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

<article class="content grid-page">


    <section id="features" class="features">
        <div class="box foo">
            <h3 class="features-title">Buy Bitcoin</h3>
            <div class="features-content">
                <div data-features-tabs class="features-content-col col-md-6 col-sm-12 col-xs-12">
                    <div id="feature-1" class="features-textblock animated fadeIn">
                    <div class="modal-body">
                      <!-- <h2>Stripe</h2> -->
                       <!-- <div style="display:flex">
                        <i class="icon fa fa-warning" style="font-size: 18px;margin-top: 3px;margin-right: 4px;color: #fbae1c;"></i><p style="font-weight: 400;font-size: 14px;color: #847d7d;">Stripe is Not Available Yet Please Choose another method.</p> 
                        </div> -->
                        <div class="box box-solid bg-dark">
        <div class="box-header with-border">
          <h3 class="box-title">Step wizard with validation</h3>
          <h6 class="box-subtitle">You can us the validation like what we did</h6>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body wizard-content">
			<form action="#" class="validation-wizard wizard-circle">
				<!-- Step 1 -->
				<h6>Step 1</h6>
				<section class="bg-hexagons-dark">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="wfirstName2"> First Name : <span class="danger">*</span> </label>
								<input type="text" class="form-control required" id="wfirstName2" name="firstName"> </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="wlastName2"> Last Name : <span class="danger">*</span> </label>
								<input type="text" class="form-control required" id="wlastName2" name="lastName"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="wemailAddress2"> Email Address : <span class="danger">*</span> </label>
								<input type="email" class="form-control required" id="wemailAddress2" name="emailAddress"> </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="wphoneNumber2">Phone Number :</label>
								<input type="tel" class="form-control" id="wphoneNumber2"> </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="wlocation2"> Select City : <span class="danger">*</span> </label>
								<select class="custom-select form-control required" id="wlocation2" name="location">
									<option value="">Select City</option>
									<option value="India">India</option>
									<option value="USA">USA</option>
									<option value="Dubai">Dubai</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="wdate2">Date of Birth :</label>
								<input type="date" class="form-control" id="wdate2"> </div>
						</div>
					</div>
				</section>
				<!-- Step 2 -->
				<h6>Step 2</h6>
				<section class="bg-hexagons-dark">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="jobTitle3">Company Name :</label>
								<input type="text" class="form-control required" id="jobTitle3">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="webUrl3">Company URL :</label>
								<input type="url" class="form-control required" id="webUrl3" name="webUrl3"> </div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="shortDescription3">Short Description :</label>
								<textarea name="shortDescription" id="shortDescription3" rows="6" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</section>
				<!-- Step 3 -->
				<h6>Step 3</h6>
				<section class="bg-hexagons-dark">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="wint1">Interview For :</label>
								<input type="text" class="form-control required" id="wint1"> </div>
							<div class="form-group">
								<label for="wintType1">Interview Type :</label>
								<select class="custom-select form-control required" id="wintType1" data-placeholder="Type to search cities" name="wintType1">
									<option value="Banquet">Normal</option>
									<option value="Fund Raiser">Difficult</option>
									<option value="Dinner Party">Hard</option>
								</select>
							</div>
							<div class="form-group">
								<label for="wLocation1">Location :</label>
								<select class="custom-select form-control required" id="wLocation1" name="wlocation">
									<option value="">Select City</option>
									<option value="India">India</option>
									<option value="USA">USA</option>
									<option value="Dubai">Dubai</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="wjobTitle4">Interview Date :</label>
								<input type="date" class="form-control required" id="wjobTitle4">
							</div>
							<div class="form-group">
								<label>Requirements :</label>
									<input name="group2" type="radio" id="radio_3" value="1">
									<label for="radio_3" class="block">Employee</label>
									<input name="group2" type="radio" id="radio_4" value="1">
									<label for="radio_4">Contract</label>
							</div>
						</div>
					</div>
				</section>
				<!-- Step 4 -->
				<h6>Step 4</h6>
				<section class="bg-hexagons-dark">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="behName3">Behaviour :</label>
								<input type="text" class="form-control required" id="behName3">
							</div>
							<div class="form-group">
								<label for="participants3">Confidance</label>
								<input type="text" class="form-control required" id="participants3">
							</div>
							<div class="form-group">
								<label for="participants4">Result</label>
								<select class="custom-select form-control required" id="participants4" name="location">
									<option value="">Select Result</option>
									<option value="Selected">Selected</option>
									<option value="Rejected">Rejected</option>
									<option value="Call Second-time">Call Second-time</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="decisions2">Comments</label>
								<textarea name="decisions" id="decisions2" rows="4" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Rate Interviwer :</label>
								<div class="c-inputs-stacked">
									<input type="checkbox" id="checkbox_6">
									<label for="checkbox_6" class="block">1 star</label>
									<input type="checkbox" id="checkbox_7">
									<label for="checkbox_7" class="block">2 star</label>
									<input type="checkbox" id="checkbox_8">
									<label for="checkbox_8" class="block">3 star</label>
									<input type="checkbox" id="checkbox_9">
									<label for="checkbox_9" class="block">4 star</label>
									<input type="checkbox" id="checkbox_10">
									<label for="checkbox_10" class="block">5 star</label>
								</div>
							</div>
						</div>
					</div>
				</section>
			</form>
        </div>
        <!-- /.box-body -->
      </div>

                      <div style="display:none;padding:0px;" class="modal-body">
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

                    <div class="col-xs-12 col-md-5 col-lg-5">
                        <label for="month_year">Expiration</label>
                        <br>
                        <div class="row" >
                        <div style="padding: 0 6px;padding-left: 15px;" class="col-md-5 col-sm-5"><input id="month" type="tel" onKeyDown="if(this.value.length==2 && event.keyCode!=8) return false;" step="any" class="form-control" name="month" required aria-describedby="AmountHelp" placeholder="MM"></div>

                        <div  style="padding: 0 6px;" class="col-md-7 col-sm-7"><input id="year" type="tel" onKeyDown="if(this.value.length==4 && event.keyCode!=8) return false;" step="any" class="form-control" name="year" required aria-describedby="AmountHelp" placeholder="YYYY"></div>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <label for="verification_value">CVV / CVC *</label>
                        <input id="verification_value" type="number" step="any" class="form-control" name="verification_value" required aria-describedby="AmountHelp" placeholder="CVV / CVC *">
                    </div>

                </div>
                <div style="text-align:center !important; " class="modal-footer">
                    <button style="display:none;" id="buy_bitcoin_craditcard" type="submit" onClick="stripePay(event);" class="btn btn-lg btn-primary">Pay Now</button>

                </div>


                <div style="text-align:center !important; " class="col-md-12 col-sm-12 ">
                    <a class="btn btn-lg btn-primary transaction_model_show"  style="width:100% " data-toggle="modal" data-target="#transaction-password">Continue</a>
                </div>
            </div>
                          </div>
                                           </div>
                    <div id="feature-2" class="features-textblock animated fadeIn  __active">
                
                        <!--paypal button show div-->
        <div class="paypal_btn_show">
            <div class="modal-body">
              <h2 class="h2">Paypal</h2>
                <div  style="display:none" class="row amountdiv">
                    <div  class=" col-md-4 col-xl-4" ></div>
                <div class=" col-md-8 col-xl-8">
			<a class="box box-link-pop text-left" href="javascript:void(0)">
				<div id="transaction-fee-for-paypal" class="box-body ">
				    </div>
			      </a>
		    </div>
                    
                </div>
                
                    <div class="form-group">

                        <label for="InputAmountPaypal"><i class="fa fa-money  "></i>Amount:</label>
                        <input id="InputAmountPaypal" type="number" step="any" class="form-control" name="amount" required aria-describedby="AmountHelp" placeholder="Enter Amount In dollers($)" oninput="transactionFeePaypal()">
                        
                    </div>
                    <div class="row">
                    


                <div class="col-md-6 col-sm-12 col-xs-12 " style="text-align:center !important;float:right; " >
                    <p></p>
                    <p id="paypal_sucess_password"></p>
                        <button  style="display:none;float:left;" id="paynow_paypal" onClick="paypalPay(event);" name="buy_bitcoin"  class="btn btn-lg btn-primary">Pay Now</button>

                    <button   style="float:left;" type="submit" name="continue" id="paypal-button" onclick="validatePaypal()" class="btn btn-lg btn-primary transaction_model_show" data-toggle="modal" data-target="#transaction-password">Continue</button>
                    <button style="float:left;"  type="submit" name="continue" id="credit-card-button" class="btn btn-lg btn-primary transaction_model_show" data-toggle="modal" data-target="#transaction-password">Continue</button>


                </div>
</div>
            </div>
        </div>
        <!--paypal button show div-->

                    </div>
                    <div id="feature-3" class="features-textblock animated fadeIn">
                        <div class="modal-body">
                        <h2>
                            Visa
                        </h2>
                        <div style="display:flex">
                        <i class="icon fa fa-warning" style="font-size: 18px;margin-top: 3px;margin-right: 4px;color: #fbae1c;"></i><p style="font-weight: 400;font-size: 14px;color: #847d7d;">Visa is Not Available Yet Please Choose another method.</p> 
                    </div>
                      
                    </div>
                </div>
                
                </div>
                <div  style=" font-size: 8px;" class="features-content-col">
                    <div data-features-nav class="features-graph" style=" background: #f4f4f4; ">
                        <div style="padding-top: 22px;" class="button-holder">
      <a href="#feature-1" class="icon-features-1 btn-with-icon ">
        <span class="sq-bt-label label-top-left">Stripe</span></a>
      <a  href="#feature-2" class="icon-features-2 btn-with-icon  __active"><span class="sq-bt-label label-top">Paypal</span></a><a  href="#feature-3" class="icon-features-3 btn-with-icon"><span class="sq-bt-label label-top-right">Visa</span></a></div>
                        <div class="animation-holder">
                            
                            <span class="flash-oval">
                         <span class="glyphicon glyphicon-btc"></span>
                           <div class="wave hidden wave-anim"></div>
                           <div class="wave2 hidden wave-anim"></div>
                           <div class="wave3 hidden wave-anim"></div>
                           <div class="wave4 hidden wave-anim"></div>
                        </span>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>








        <div class="modal fade" id="transaction-password" role="dialog">
            <div class="modal-dialog">

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
                             $otp_response =  $dbobject->send_otp_code("2");
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

        <!--Send button-->
        <div class="modal fade" id="paypal" role="dialog">
            <div class="modal-dialog">
            </div>
            </div>
  


</article>
</div>
<?php 
     include_once 'includes/main_footer.php';
?>


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
$(document).ready(function(){
      $('.emptyinput').css('display', 'none');
})


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

    
	
	$('#trensection_password_check').click(function(){
    var input_all_value = '';
    var get_id = $('#get_id').val();
	var otp_code_in = $('#otp_code').val();
    var parent_modal = $('#transaction-password-'+get_id);
	var otp_code = '<?php echo $otp_code; ?>';

  

if(otp_code_in ==  otp_code)
{
    $('#transection-close-'+get_id).trigger('click');
            $('#paynow_paypal').css('display', 'block');
          
            $('.transaction_model_show').css('display', 'none');
            $('#buy_bitcoin_craditcard').css('display', 'block');
  
}
else
{
    $('#transection_notification').show();

    setTimeout(function(){

        $('#transection_notification').fadeOut();
		  $('.emptyinput').css('display', 'block');
            $('#transection_notification').html('<div style="text-align:center;">There Is Something Went Wrong. Try Again Later.</div>');


    }, 5000)
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
        var transaction_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
        if(x == ''){
            x=0;
            total = 0;
			transaction_fee = 0;
        }       
       $('.amountdiv').css('display','flex');
        document.getElementById("transaction-fee-for-paypal").innerHTML ="<p class='transationfee'>Total amount : $" +x + "</p> <p class='transationfee'>Transaction fee: $" + parseFloat(transaction_fee).toFixed(2) +"</p> <div class='total-payment'><h3 style=' width: 95%;'><b>Total :</b>  $"+  parseFloat(total).toFixed(2)+"</h3></div>" ;
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
        var transaction_fee = parseFloat(two_point_nine_percent) + parseFloat(six_point_nine_percent) + parseFloat(percentage) + 0.3;
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
	<script>
	(function() {
    var selectors = {
        nav: '[data-features-nav]',
        tabs: '[data-features-tabs]',
        active: '.__active'
    }
    var classes = {
        active: '__active'
    }
    $('a', selectors.nav).on('click', function() {
        let $this = $(this)[0];
        $(selectors.active, selectors.nav).removeClass(classes.active);
        $($this).addClass(classes.active);
        $('div', selectors.tabs).removeClass(classes.active);
        $($this.hash, selectors.tabs).addClass(classes.active);
        return false
    });
}());

$(".btn-with-icon").on("click", function() {
    $(".wave-anim").addClass('visible').one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd", function() {
        $(".wave-anim").removeClass('visible');
    });
});    
	</script>

	
	