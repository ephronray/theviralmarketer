<?php 
require_once (__DIR__.'/../includes/header.php');
require_once (__DIR__.'/../_libs/twitterSetting.php');
require_once (__DIR__.'/../_libs/commonHelper.php');
require_once (__DIR__.'/../_libs/dbConnect.php');
$db = new dbConnect();
$twitter = new TwitterSetting();
$common = new CommonHepler();
?>
 <article class="content grid-page">

        <div class="title-block">

            <h3 class="title">Date And Time</h3>


            <div class="blnc_res">
                <?php require_once (__DIR__.'/../includes/balance_amount.php');
                ?>
            </div>

        </div>
<div><h2>Date And time :</h2>
    <h2 class="dateandtime"></h2>
</div>
</article>

<?php require_once (__DIR__.'/../includes/footer.php');?>
<script>
$(document).ready(function(){
var d = new Date();
$('h2.dateandtime').html(d);    
});
</script>
 