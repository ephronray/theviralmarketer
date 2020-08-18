<?php 
include_once 'includes/header.php';
$sql = "SELECT 
		  id, page_name, page_content 
		  FROM  `tbl_pages` 
		  WHERE  `page_name` =  'contact-us' Limit 1";
$query   = $newsifyObj->db_select($sql);
$result    = mysqli_fetch_assoc($query);
?>

<?php

function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
    
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
    
    
    
 
 function sendmail()
 {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "mfaizan044@gmail.com";
 
    $email_subject = "Query From Contact Us Page";
 
     
   ///  alert("i m in");
     
 
    
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||

        !isset($_POST['email']) ||
 
        !isset($_POST['subject']) ||
		
		!isset($_POST['message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted. Please Try Again!');       
 
    }
 
     
 
    $first_name = $_POST['name']; // required
 
    $subject = $_POST['subject']; // required
 
    $email_from = $_POST['email']; // required
 
    $message = $_POST['message']; // not required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
 
  }
 
  if(!preg_match($string_exp,$subject)) {
 
    $error_message .= 'The category you selected does not appear to be valid.<br />';
 
  }
 
  if(strlen($message) < 2) {
 
    $error_message .= 'The Description you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
 
     
 
    $email_message .= "Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Subject: ".clean_string($subject)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Message: ".clean_string($Message)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
 @mail($email_to, $email_subject, $email_message, $headers);  
 
 echo "mail sent";
}
 
?>


    <div class="sidebar-overlay" id="sidebar-overlay"></div>
    <article class="content grid-page">
        <div class="title-block">
            <h3 class="title">Contact Us</h3>
            <p class="title-description">Please Contact Us If You Need Any Information</p>
        </div>
        <?php 
        if(isset($_POST['btnContactUs']))
{
    $name = $_POST['name'];
     $email = $_POST['email'];
    $subject = $_POST['subject'];
     $message = $_POST['message'];
     $my_ibm = $_SESSION['user']['ibm'];
    // multiple recipients
$to  = 'admin@gmail.com';
$subject = 'Ticket from'.' '.$name.'  ('.$my_ibm.')';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    
$message = '<p style="text-align:center">'. $message. '</p><br><br>
  <p>Regards</p></br><p>'.$name.'</p><br><br><p>'.$email.'</p>';

if(@mail($to, $subject, $message, $headers))
{
$success_message = '<div class="alert alert-success">
    <strong>Successfully sent!</strong> The query has been recieved. Our support team will contact you shortly.</div>';
    
  echo $success_message;
}else{
    
    $error_message = '<div class="alert alert-danger">There Is something Issue Please Try Again. </div>';
    
  echo $error_message;
}
    
}

        ?>
        <section class="section">
            <div class="row pages-row">
                <div class="col-md-8">
                   <form  action="contact-us.php" method="post">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" id="name" name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" name="email"/></div>
                        </div>
                        <div class="form-group">
                            <label for="subject">
                                Subject</label>
                            <select id="subject" name="subject" class="form-control" required="required">
                                <option value="none" selected="">Choose One:</option>
                                <option value="service">General Customer Service</option>
                                <option value="suggestions">Suggestions</option>
                                <option value="product">Product Support</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" class="form-control" rows="10" cols="25" required="required"
                                placeholder="Write here..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs" name="btnContactUs">
                            Send Message</button>
                    </div>
                </div>
                </form>  
                </div>
				<div class="col-md-4">
                    <?php if(!empty($result['page_content'])){
						echo $result['page_content'];
					}?>
                </div>
            </div>
        </section>
    </article>
<?php include_once 'includes/footer.php'; ?>