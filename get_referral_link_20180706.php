<?php 
$menu = array('tab'=>2, 'option' => 'get_referral_link');
include_once 'includes/header.php';?>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">Referral Link</h3>
            <p class="title-description">In order to sign up people in your downline, they need to register from this link</p>
        </div>
        <section class="section">
            <div class="row ">
                <div class="col-md-12">
                    <input class="form-control" id="copyTarget" type="text" value="<?=$newsifyObj->base_url.'/referral/?ref='.$_SESSION['user']['ibm'].'' ?>" readonly>
                </div>

                <div class="row">
                <div style="margin: 19px;" class="col-md-12">
                <span><a href="https://api.whatsapp.com/send?text=http://www.theviralmarketer.biz/referral/?ref%3D<?php echo $_SESSION['user']['ibm']; ?>" target="_blank" data-toggle="tooltip" title="Send Referral Link using Whatsapp"><i class="fa fa-2x fa-whatsapp" aria-hidden="true"></i></a></span>
                <span><a  id="copyButton"  onclick="myFunction()"><i class="fa fa-2x fa-copy"></i></a><span style="font-size: 14px; margin-left: 10px;color: green;" id="text_notify" data-toggle="tooltip" title="Click Here To Copy Referrel Link" ></span></span>
               
               </div>
                </div>
                
            </div>
        </section>
    </article>
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
</script>
<?php include_once 'includes/footer.php'; ?>