<?php 
$menu = array('tab'=>2, 'option' => 'get_referral_link');
//include_once 'includes/header.php';
include_once 'includes/main-header.php';
?>
<!--    <div class="sidebar-overlay" id="sidebar-overlay"></div>-->
<div class="content-wrapper referral_link_page">
    <section class="content-header">
        <h1>
            Referral Link
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Referral Link</li>
        </ol>
    </section>


    <article class="content grid-page">


        <section class="section">
            <div class="box" style="display: block; padding: 20px; min-height: 675px;">


                <div class="title-description alert alert-info text-center">In order to sign up people in your downline, they need to register from this link</div>

                <?php include ('includes/balance_amount.php'); ?>



                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        <input class="form-control" id="copyTarget" type="text" value="<?=$newsifyObj->base_url.'/referral/?ref='.$_SESSION['user']['ibm'].'' ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <span class="d-inline-block mr-5">
                            <a href="#" id="watsapp_link" class="btn btn-success"
                               data-toggle="tooltip" title="Send Referral Link using Whatsapp">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i> Share on WhatsApp
                            </a>
                        </span>
                        <span class="d-inline-block">
                            <a id="copyButton" class="btn btn-primary"  onclick="myFunction()" style="cursor: pointer; color: white">
                                <i class="fa fa-copy"></i> Copy referral link
                            </a>
                            <span style="font-size: 14px; margin-left: 10px;color: green;"
                                  id="text_notify" data-toggle="tooltip" title="Click Here To Copy Referrel Link">
                            </span>
                        </span>
                    </div>
                </div>

                <div class="row " id="watsapp_textarea" style="display:none; margin-top: 20px;">
                    <div class="col-md-6">

                        <form name="form" action="" method="post">

                            <div class="form-group">

                                <textarea rows="5" cols="60"  placeholder="Please Write Your Message here" class="form-control" id="message" name="message"></textarea>

                            </div>


                            <div class="form-check pl-0">
                                <label class="container">Include my referral link
                                  <input id="link" name="link" type="checkbox" checked="checked" >
                                  <span class="checkmark"></span>
                                </label>
                            </div>

                         <button type="button" class="btn btn-primary btn-block" style="width: 30%;margin-top: 1%;" id="Send_message" onclick="whatsapp_link()">Send Message</button>

                        </form>

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
    
    $('#watsapp_link').click(function(){
        $('#watsapp_textarea').fadeIn(600);
   })
     
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
    } catch(e) {
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
    function myFunction()
    {
        document.getElementById("text_notify").innerHTML = "Referral Link Copied!";  
    }

     function whatsapp_link(){
         
         var msg = $('#message').val();
         var link;
         var encodeLink;
         var encodemsg;
         if(msg == "")
         {
             msg = "Hi,\nHere is the link that i promised you. Just follow the link to download the app for FREE"
         }
         
         if ($('#link').is(":checked"))
         {
              link = $('#copyTarget').val();
              encodeLink = encodeURIComponent(link);
              
         }
         else
         {
             link = "";
             encodeLink = "";
         }
         
         var completeMsg = msg+" "+link;
         encodemsg = encodeURIComponent(msg+"\n");
         var webMsg = encodemsg+encodeLink;
         var ua = navigator.userAgent.toLowerCase();
         var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");
         var isIOS = ua.indexOf("iphone") > -1 || ua.indexOf("ipad") > -1;
         if(isAndroid) 
         {
              window.location.href = 'whatsapp://send?text='+completeMsg;
         }
         else if(isIOS)
         {
             
              window.location.href = 'whatsapp://send?text='+completeMsg;
         }
         else
         {
             window.open('https://api.whatsapp.com/send?text='+webMsg, '_blank');
              
         }
         
     
     }


</script>
<style>

/* The container */
.container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
    background-color: #2196A3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<?php //include_once 'includes/footer.php'; ?>