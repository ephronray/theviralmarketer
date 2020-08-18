<?php
include_once '../_libs/dbConnect.php';
$newsifyObj = new  dbConnect();
$status = '';
  if(isset($_POST)){
      $first_name   = $_POST['first_name'];
      $last_name    = $_POST['last_name'];
      $email        = $_POST['email'];
      $ref          = $_POST['ref'];
      $gender       = $_POST['gender'];
      $f_id         = $_POST['F_ID'];
      $pass         = $newsifyObj->rand_string(8);
      $query        = "SELECT * FROM members WHERE f_id='".$f_id."'";
      $count        =  mysqli_num_rows($newsifyObj->dbCon->query($query));
      if($count != 0 ){
      $response     = array('error'=>false,'status'=>true,'mesg'=>$newsifyObj->alertMessage('info','You are already registered with this Facebook Acount.Please goto Login'));
      echo json_encode($response);
      exit();    
      }
      $sql          = 'INSERT INTO members(`ibm`,`first_name`,`last_name`,`user_email`,`user_password`,`refer_ibm`,`f_id`,`gender`)
                       VALUES("IBM'.$f_id .'","'.$first_name.'","'.$last_name.'","'.$email.'",
                       "'.$pass.'","'.$ref.'","'.$f_id.'","'.$gender.'")';
      if($newsifyObj->db_insert($sql)){
          $body = '<html><body>'.
                   'Hi '.$first_name.',<br />
                     Thanks For Your Registeration.<br />
                     Below Is Your Login Credentials:</p>
                     <table>
                     <tr>
                        <td>E-mail:</td>
                        <td><b>'.$email.'</b></td>
                     </tr>
                     <tr>
                     <td>Password</td>
                     <td><b>'.$pass.'</b></td>
                     </tr>
                     </table>
                     <strong>Note:</strong><p>This password is system generated.<br />Please update your password after Login</p>
                     Regard:
                     <strong>The Viral Marketer</strong>
                    </body></html>';
          if($newsifyObj->sendMail($email.',hamad.pixiders@gmail.com','Account Registered',$body)){
              $response = array(
              'error'=>false,'status'=>true,
              'mesg'=>$newsifyObj->alertMessage('info','<b>hi '.$first_name.',</b><p>Your Account Has Been Registered Please Check Your Inbox.'));
               echo json_encode($response);
               exit();
          }
      }
      
      $response = array('error'=>true,'status'=>false,'mesg'=>$newsifyObj->alertMessage('danger','Something went wrong please try later'));
      echo json_encode($response);
      die;
  }else {
    $response = array('error'=>true,'status'=>false);
    echo json_encode($response);
    die;
  }
  ?>