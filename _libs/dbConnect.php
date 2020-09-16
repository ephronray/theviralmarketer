<?php
require_once (__DIR__.'/../_libs/twitterApi/dbip-client.class.php');
require_once (__DIR__.'/../_libs/bitcoinSetting.php');
require_once (__DIR__.'/../_libs/environment.php');
if(!session_id()) session_start();
/*
 *Author: Hadi
 *Date  : Aug - 01 - 2017
 *Type  : The Viral Marketer
 *
*/
//$dbip = new Address();

$GLOBALS = array(
  'wallet_email' => $_SESSION['user']['wallet_email'],
);

class dbConnect
{

 private $host = Environemnt:: DB_HOST;
 private $user = Environemnt::DB_USER;
 private $pass = Environemnt::DB_PASSWORD;
 private $db_name = Environemnt::DB_NAME;
 private $bitcoinSetting;
 public $dbCon;
 public $base_url   = 'https://www.theviralmarketer.biz/';
 public $sqlError   = false;
 public $ref_keys   = array();
 protected $glob;

 public function __construct()
 {
	 
	 $this->bitcoinSetting = new bitcoinSetting();
  global $GLOBALS;
  $this->glob =& $GLOBALS;
  try {
    
    $this->dbCon = new mysqli($this->host, $this->user, $this->pass, $this->db_name);
    if (mysqli_connect_error()) {
      die('connection error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
}

function __destruct(){
        //mysqli_close($this->dbCon);
}

public function getIp()
{
  $ipaddress = '';
  if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
  else if (getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
  else if (getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
  else if (getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
  else if (getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
  else if (getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
  else
    $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

public function redirectMe($loc)
{
  ?>
  <script>
    window.location = '<?php echo $loc; ?>';
  </script>
  <?php
}
public  function  dd(array $data = array()){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  die();
}

    # function to Clean POST DATA
public  function  cleanPOST($input = ""){
  return mysqli_real_escape_string($this->dbCon, strip_tags(trim($input)));
}

    # to check Email Validity 
public function checkEmail($email)
{
 $query = "SELECT `first_name` ,`user_email`, `hash`
 FROM   `members`
 WHERE  `user_email` = '" . $email . "' Limit 1";
 $result = mysqli_query($this->dbCon, $query);
 if (($result) && (mysqli_num_rows($result) == 1)) 
 {
          //$user_data = mysqli_fetch_array($result);
  return true;
  
}
else
{
  return false;
}

}
    # function to add new user
public function registerNewUser($data)
{
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $hash = array(); //remember to declare $hash as an array
    $email_hash = array(); //remember to declare $hash as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 32; $i++) {
      $eh = rand(0, $alphaLength);
      $n = rand(0, $alphaLength);
      $hash[] = $alphabet[$n];
      $email_hash[] = $alphabet[$eh];
    }
    $hash_value   =  implode($hash);
    $newsletter = implode($email_hash);
    $rand_id = rand(100,999);
    $wallet_value = $data['email'].$rand_id;
		$response = $this->bitcoinSetting->createWallet($wallet_value);
  //  if(true) {
    //    $wallet_adress = 'asdae123123asda';
      //   $wallet_xpub = '19231moasmio123m1i23j1j039130913';

     if($response['status'] == true) {
	  $wallet_adress = $response['wallet_address']['user_wallet_address'];
	  $wallet_xpub = $response['wallet_address']['wallet_xpub'];
	
     $password = md5($data['password']);
      $dbQuery = "INSERT INTO `members` 
      (`ibm`, `first_name`, `last_name`, `user_password`, `user_email`, `refer_ibm`, `passad_up_to`, `4_by_4` ,`wallet_number` , `wallet_email`, `wallet_xpub`, `hash` , `newsletter_hash`) 
      VALUES ('".$data['my_ibm']."', '".$data['firstname']."', '".$data['lastname']."', '".$password."', '".$data['email']."', '".$data['ibm']."', '".$data['passad_up_to']."', '".$data['4_by_4']."', '".$wallet_adress."' , '".$wallet_value."', '".$wallet_xpub."', '".$hash_value."','".$newsletter."')";        
      
      
      try {
       
        $results = mysqli_query($this->dbCon, $dbQuery);
        
        if ($results) {
          
         $last_id = mysqli_insert_id($this->dbCon);
         $ibm = $data['my_ibm'];
         $page = 3;
         $addPage = "INSERT INTO `tbl_member_landingpage` 
         (`member_id`, `member_ibm`, `page_id`)
         VALUES ('".$last_id."','".$ibm."','".$page."')";
         
         
         
         $addresult = mysqli_query($this->dbCon, $addPage);
         
         
         $query = "SELECT `first_name` ,`user_email`, `hash`
         FROM   `members`
         WHERE  `u_id` = '" . $last_id . "' Limit 1";
         $result = mysqli_query($this->dbCon, $query);
         if (($result) && (mysqli_num_rows($result) == 1)) 
         {
          $user_data = mysqli_fetch_array($result);
          
          
          
          $template  = file_get_contents('email-templates/signup_verification_email.php');
          $message       = str_replace('{{$name}}', $user_data['first_name'], $template);
          $message       = str_replace('{{$email}}', $user_data['user_email'], $message);
          $message       = str_replace('{{$hash}}', $user_data['hash'], $message);
          $message       = str_replace('{{$support_url}}', $this->base_url, $message);
			 
		 $headers = 'MIME-Version: 1.0'."\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: info@theviralmarketer.biz"; 
			 
			
	  if(mail($user_data['user_email'], 'The Viral Marketer Signup | Email Verification', $message, $headers)) {
            
            $_SESSION['register_new_user'] = array(
             'email' => $user_data['user_email'] ,
             'hash' => $user_data['hash'],
             'first_name' => $user_data['first_name'],
             'base_url' => $this->base_url,
           );
            $this->redirectMe('new_user.php');
            
          }
          $_SESSION['register_new_user'] = array(
           'email' => $user_data['user_email'] ,
           'hash' => $user_data['hash'],
           'first_name' => $user_data['first_name'],
           'base_url' => $this->base_url,
         );
          $this->redirectMe('new_user.php');
          
          
        }
      }
    } 
    catch (Exception $e) {
      echo  $e->getMessage();
      die;
    }

    $this->redirectMe('new_user.php');
  }
}
public  function  loggedINStatus(){
  if($this->isLoggedIN() && $this->isAdminIN()){
    $this->redirectMe($this->base_url.'');
  }
  else if ($this->isLoggedIN()){
    $this->redirectMe($this->base_url.'');
  }else{
    return false;
            //$this->redirectMe($this->base_url.'users/login.php');
  }

}
    # function to login user
public function loginUser($data)
{
  $password = md5($data['password']);
  $dbQuery = "SELECT  
  `wallet_email`, `wallet_number`, `u_id`, `first_name`, `user_email` ,`ibm`, `refer_ibm`, `wallet_xpub`
  FROM
  `members`
  WHERE `user_password` =  '" . $password . "' AND `user_email` = '" . $data['email'] . "' AND  `is_active` ='1'  Limit 1";
  $results = mysqli_query($this->dbCon, $dbQuery);
  if (($results) && (mysqli_num_rows($results) == 1)) {
   
   $user_data = mysqli_fetch_array($results);
   $_SESSION['user'] = array(
     'wallet_email' => $user_data['wallet_email'],
     'wallet_number' => $user_data['wallet_number'],
	 'wallet_xpub' => $user_data['wallet_xpub'],
     'u_id' => $user_data['u_id'],
     'is_logged_in' => 1,
     'first_name' => $user_data['first_name'],
     'email' => $user_data['user_email'],
     'user_role'=> 1,
     'ibm'=> $user_data['ibm'],
     'is_root'=>  (empty($user_data['refer_ibm'])) ? true : false
   );
   return $data = array(
     "success" => true,
     "error" => false
   );
   
   
   
 } 
 else {
  return $data = array(
   "success" => false,
   "error" => true
 );
}
}
public function generateNewTransectionPassword($data)
{
  $query = "SELECT `transaction_password`
  FROM   `members`
  WHERE  `user_email` = '" . $data['email'] . "' Limit 1";
  $result = mysqli_query($this->dbCon, $query);
  if (($result) && (mysqli_num_rows($result) == 1)) 
  {
    $user_data = mysqli_fetch_array($result);
    
    if($data['old_password'] == $user_data['transaction_password'])
    {
      if($data['password'] == $data['conform_password'] )
      {
        $password = $data['password'];
        $userQuery = "UPDATE  members
        SET transaction_password = '$password'
        WHERE 
        transaction_password ='".$data['old_password']."' AND user_email ='".$data['email']."'";
        
        if (mysqli_query($this->dbCon, $userQuery)){
         
         return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false
        );
       }
       else
       {
        return $response = array('success'=> false,
          'message' => 'There Is something Wrong. Please Try again.',
          'error' => true
        );
      }
      
    }
    else
    {
      return $response = array('success'=> false,
        'message' => 'Password Do Not Match Please Try Again',
        'error' => true
      );
    }
    
    
  }
  else 
  {
   return   $response = array('success'=> false,
    'message' => 'Old Password Is Incorrect. Please Try again',
    'error' => true
  );
 }
 
 
}

        /*if($data['password'] == $data['conform_password'])
        {
            $password = $data['password'];
            $userQuery = "UPDATE  members
    SET transaction_password = '$password'
    WHERE 
    user_email='".$data['email']."'";
   
   if (mysqli_query($this->dbCon, $userQuery)){
       return $response = array(
           'success' => true,
           'message' => 'Successfully Reset your Transaction password.',
           'error' => false
           );
   }
   else {
      
       return $response = array(
           'success' => false,
           'message' => ' There Is Something Went Wrong To Login.<br>Try Again Later.',
           'error' => true
           );
   }
        }
       else{
           return $response = array(
           'success' => false,
           'message' => 'Please Confrom ! Password does not match.',
           'error' => true
           );
           //else part
         }*/
         
       }
       public function generateNewPassword($data)
       {
        if($data['password'] == $data['conform_password'])
        {
          $password = md5($data['password']);
          $userQuery = "UPDATE  members
          SET user_password = '$password'
          WHERE 
          user_email='".$data['email']."'";
          
          if (mysqli_query($this->dbCon, $userQuery)){
           return $response = array(
             'success' => true,
             'message' => 'Successfully recover you password Please <a href="http://www.theviralmarketer.biz/login.php">Login here</a>',
             'error' => false
           );
         }
         else {
          
           return $response = array(
             'success' => false,
             'message' => ' There Is Something Went Wrong To Login.<br>Try Again Later.',
             'error' => true
           );
         }
       }
       else{
         return $response = array(
           'success' => false,
           'message' => 'Please Confrom ! Password does not match.',
           'error' => true
         );
           //else part
       }
       
     }
     public function recoverTransactionPassword($email)
     {
      $query = "SELECT transaction_password
      FROM   `members`
      WHERE  `user_email` = '" . $email . "' Limit 1";
      $result = mysqli_query($this->dbCon, $query);
      if (($result) && (mysqli_num_rows($result) == 1)) 
      {
        
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
      $n = rand(0, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    $new_transaction_password =  implode($pass); //turn the array into a string
    $userQuery = "UPDATE  members
    SET transaction_password = '$new_transaction_password'
    WHERE 
    user_email ='".$email."'";
    
    if (mysqli_query($this->dbCon, $userQuery)){
     $newquery = "SELECT `first_name` ,`user_password`, 'ibm', `transaction_password`
     FROM   `members`
     WHERE  `user_email` = '" . $email . "' Limit 1";
     $newresult = mysqli_query($this->dbCon, $newquery);
     if (($newresult) && (mysqli_num_rows($newresult) == 1)) 
     {
      $user_data = mysqli_fetch_array($newresult);
      $template  = file_get_contents('email-templates/forget-transaction-password.html');
      $message       = str_replace('{{$name}}', $user_data['first_name'], $template);
      $message       = str_replace('{{$password}}', $user_data['transaction_password'], $message);
      $message       = str_replace('{{$support_url}}', $this->base_url, $message);
		 
		  $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= "From: info@viralmarketer.com";  
	
		 if(mail($email, "Viral-Marketer Recover Transaction Password", $message, $headers)) {
        return [
          'success' => true,
          'message' => 'Email has been sent!!'
        ];
      }
    } else {
      return [
        'success' => false,
        'message' => 'Sorry, No account found'
      ];
    }
    
    
  }
  else
  {
    return [
      'success' => false,
      'message' => 'There Is Something Wrong Please Try again'
    ];
  }    
  
}
else
{
  return [
    'success' => false,
    'message' => 'Sorry, No account found'
  ];
}


}
public function insertTransectionHistory($data , $tx_id, $level_description , $status , $miner_fee , $tvm_fee)
{
  $date = date('d-m-Y');
  $tvm_discription = 'TVM Fee By '.$data['sender_ibm'];
  $query = "INSERT INTO `transaction_history` 
  (
  `description`,
  `transaction_id`,
  `sender_Ibm`, 
  `receiver_ibm`, 
  `amount`,
  `receiver_wallet_address`,
  `status`,
  `miner_fee`,
  `tvm_fee`,
  `admin_trans`
  ) VALUES (
  '".$level_description."',
  '".$tx_id."',
  '".$data['sender_ibm']."',
  '".$data['wallet_ibm']."',
  '".$data['amount']."',
  '".$data['wallet_address']."',
  '".$status."',
  '".$miner_fee."',
  '".$tvm_fee."',
  '0'
)";

if($this->dbCon->query($query) && $this->db->affected_rows == 1)
{
  $tvmQuery = "INSERT INTO `transaction_history` 
  (
  `description`,
  `transaction_id`,
  `sender_Ibm`, 
  `receiver_ibm`, 
  `amount`,
  `receiver_wallet_address`,
  `status`,
  `miner_fee`,
  `tvm_fee`,
  `admin_trans`
  ) VALUES (
  '".$tvm_discription."',
  '".$tx_id."',
  '".$data['sender_ibm']."',
  '".$data['wallet_ibm']."',
  '".$data['amount']."',
  '".$data['wallet_address']."',
  '".$status."',
  '".$miner_fee."',
  '".$tvm_fee."',
  '1'
)";
if($this->dbCon->query($tvmQuery) && $this->db->dbCon->affected_rows == 1)
{
 
  return $response = array("success"=>true,
   "message" => mysqli_error($this->dbCon)
 );
}
else
{
  return $response = array("success"=>false,
    "message" => mysqli_error($this->dbCon)
  );
}  
}
return $response = array("success"=>false,
  "message" => mysqli_error($this->dbCon)
);
}

public function transectionHistoryforBuyBitcoin($data)
{
 $date = date('d-m-Y');
 $sender = "IBM1";
 $tvm_description = 'TVM Fee By '.$data['receiver_ibm'];
 $query = "INSERT INTO `transaction_history` 
 (
 `description`,
 `transaction_id`,
 `sender_Ibm`, 
 `receiver_ibm`, 
 `amount`,
 `receiver_wallet_address`,
 `status`,
 `miner_fee`,
 `tvm_fee`,
 `admin_trans`
 ) VALUES (
 '".$data['description']."',
 '".$data['transaction_id']."',
 '".$sender."',
 '".$data['receiver_ibm']."',
 '".$data['amount']."',
 '".$data['receiver_wallet_address']."',
 '".$data['status']."',
 '".$data['miner_fee']."',
 '".$data['tvm_fee']."',
 '0'
)";


if($this->dbCon->query($query) && $this->dbCon->affected_rows == 1)
{
  
  
  $tvmQuery = "INSERT INTO `transaction_history` 
  (
  `description`,
  `transaction_id`,
  `sender_Ibm`, 
  `receiver_ibm`, 
  `amount`,
  `receiver_wallet_address`,
  `status`,
  `miner_fee`,
  `tvm_fee`,
  `admin_trans`
  ) VALUES (
  '".$tvm_description."',
  '".$data['transaction_id']."',
  '".$data['receiver_ibm']."',
  '".$sender."',
  '".$data['amount']."',
  '".$data['receiver_wallet_address']."',
  '".$data['status']."',
  '".$data['miner_fee']."',
  '".$data['tvm_fee']."',
  '1'
)";
if($this->dbCon->query($tvmQuery) && $this->dbCon->affected_rows == 1)
{
 
  return $response = array("success"=>true,
   "message" => ''
 );
}
else
{
  return $response = array("success"=>false,
    "message" => mysqli_error($this->dbCon)
  );
}  
}
return $response = array("success"=>false,
  "message" => mysqli_error($this->dbCon)
);
}

public function recoverPassword ($email) {
  $query = "SELECT `first_name` ,`user_password`, 'ibm'
  FROM   `members`
  WHERE  `user_email` = '" . $email . "' Limit 1";
  $result = mysqli_query($this->dbCon, $query);
  if (($result) && (mysqli_num_rows($result) == 1)) 
  {
    $user_data = mysqli_fetch_array($result);
    $template  = file_get_contents('email-templates/forget-password.html');
    $message       = str_replace('{{$name}}', $user_data['first_name'], $template);
    $message       = str_replace('{{$recovery_email}}', $email, $message);
    $message       = str_replace('{{$support_url}}', $this->base_url, $message);
    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= "From: info@viralmarketer.com"; 
    if(mail($email, 'Viral-Marketer Recover Password', $message, $headers)) {
      return [
        'success' => true,
        'message' => 'Email has been sent!!'
      ];
    }
  } else {
    return [
      'success' => false,
      'message' => 'Sorry, No account found'
    ];
  }

} 

public function updateProfile($user_id, $data){
  $query = "UPDATE `members` SET 
  `first_name` = '".$data['first_name']."',
  `last_name` = '".$data['last_name']."',
  `btc_add` = '".$data['btc_add']."',
  `user_password` = '".$data['password']."'
  WHERE 
  `members`.`u_id` = '$user_id'; ";
  if (mysqli_query($this->dbCon, $query)){
    return [
      'success' => true,
      'message' => 'Profile has been updated!!'
    ];
  }else {
    return [
      'success' => false,
      'message' => 'Profile update operation failed!!'
    ];
  }
}


    /**
     * @return string
     */
    public function rand_string( $length ) {

      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      return substr(str_shuffle($chars),0,$length);

    }

    # function to check root user
    public function isRoot($ibm){
      $dbQuery = 'SELECT refer_ibm, is_root FROM members WHERE ibm = "'.$ibm.'" Limit 1';
      $results = mysqli_query($this->dbCon, $dbQuery);
      $user_data = mysqli_fetch_array($results);
      if(empty($user_data['refer_ibm']) && $user_data['is_root'] == true){
            return true; //is root
          } 
          return false;
        }
        
        
    # move uploaded file
        public function move_profile_image($temp_path , $directory_path, $image_name)
        {
          if ($image_name != '') {
           
           if (move_uploaded_file($temp_path, $directory_path.$image_name)) {
             return $image_file = $directory_path.$image_name;
           } 

           else {
            return "No Image";
          }

        }
      }
      public function updateBanner($data)
      {
        $id= $data['id'];
        $upline_member = $data['upline_member'];
        $banner_path = $data['banner_path'];
        $push_message = $data['push_message'];
        $redirect_url = $data['redirect_url'];
        $youtube_video_url = $data['youtube_video_url'];
        $active_inactive = $data['active_inactive'];
        
        
        $dbQuery = "UPDATE `MemberAdvertise` SET 
        upline_member='$upline_member', 
        banner_path='$banner_path', 
        push_message='$push_message', 
        redirect_url='$redirect_url' , 
        youtube_video_url='$youtube_video_url' , 
        active_inactive='$active_inactive' 
        WHERE id='$id'";


        if (mysqli_query($this->dbCon,$dbQuery)) {
          return $response = array(
            'error' =>  false,
            'message' => 'Successfully Added',
            'success' => true,

          );
        }
        else
        {
          return $response = array(
            'error' => true,
            'message' =>  "There Is something Wrong. Please try again",
            'success' => false,
          );
        }   
      }
#add banner 
      public function addBanner($data)
      {

    // print_r($data);
    // die();
        $upline_member = $data['upline_member'];
        $banner_path = $data['banner_path'];
        $push_message = $data['push_message'];
        $redirect_url = $data['redirect_url'];
        $youtube_video_url = $data['youtube_video_url'];
        $active_inactive = $data['active_inactive'];

        $sql = "INSERT INTO MemberAdvertise SET
        upline_member = '".$upline_member."',
        banner_path = '".$banner_path."',
        active_inactive = '".$active_inactive."',
        push_message = '".$push_message."',
        redirect_url = '".$redirect_url."',
        youtube_video_url = '".$youtube_video_url."' ";

        if (mysqli_query($this->dbCon,$sql)) {
          return $response = array(
            'error' =>  false,
            'message' => 'Successfully Added',
            'success' => true,

          );
        }
        else
        {
          return $response = array(
            'error' => true,
            'message' =>  mysqli_error($this->dbCon),
            'success' => false,
          );
        }
      }
#delete banner
      public function deleteBanner($id)
      {
        $DelSql = "DELETE FROM `MemberAdvertise` WHERE id='$id'";

        $res = mysqli_query($this->dbCon, $DelSql);


        if ($res) {
          return $response = array(
            'error' =>  false,
            'message' => 'Deleted successfully.',
            'success' => true,

          );
        }
        else
        {
          return $response = array(
            'error' => true,
            'message' =>  "Something Wrong Please Try again!",
            'success' => false,
          );
        }

      }
    # function to check for passed up user -- on register referral
      public function getPassedUp($ibm){
        
        $dbQuery = 'SELECT refer_ibm, passad_up_to FROM members WHERE ibm = "'.$ibm.'" Limit 1';
        $results = mysqli_query($this->dbCon, $dbQuery) or  mysqli_error($this->dbCon);
        $user_data = mysqli_fetch_array($results);
        if(!empty($user_data['passad_up_to'])) {
          return $user_data['passad_up_to'];
        }
        return $user_data['refer_ibm'];
      }
      
      
    # function to check root user
      public function getMemberInfo($ibm){
        
        $dbQuery = 'SELECT `first_name`, `wallet_number`, `wallet_xpub`, `btc_add` ,`user_email` ,`ibm`, `refer_ibm` FROM members WHERE ibm = "'.$ibm.'" Limit 1';
        $result = $this->dbCon->query($dbQuery);
        $data = $result->fetch_assoc();
        if(!empty($data)) { return $data; } 
        else
          return [ 'success' => false, 'message' => 'No, Account found  '.$ibm];
      }
      
      public function getReferredBy($ibm)
      {
        $query  = 'SELECT refer_ibm FROM `members` WHERE ibm = "'.$ibm.'" LIMIT 1';
        $sql    = mysqli_query($this->dbCon, $query);
        if ($sql) {
          $result = mysqli_fetch_array($sql);
          return $result['refer_ibm'];
        }
        return false;
      }
      
      
      public function checkMatrixCount($ibm)
      {
        $query = 'SELECT u_id,ibm,user_email FROM members WHERE 4_by_4 = "'.$ibm.'" Limit 4';
        $result = $this->db_select($query, false, false);
        $total_referred = mysqli_num_rows($result);
        if($total_referred >= 4)
        {
          return true;
        }
        return false;
      }

    # Cross Site Script  & Code Injection Sanitization
      function xss_cleaner($input_str) {
        $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
        $return_str = str_ireplace( '%3Cscript', '', $return_str );
        return $return_str;
      }
      
    # function to check 4 by 4 matrix position 
      public function getMatrixPosition($ibms)
      {
        $ibm_list = array();
        foreach ( $ibms AS $ibm ) 
        {
          $query = 'SELECT u_id,ibm,user_email FROM members WHERE 4_by_4 = "'.$ibm.'" Limit 4';
          $result = $this->db_select($query, false, false);
          $total_referred = mysqli_num_rows($result);
          if($total_referred >= 4)
          {
                while ($ref = mysqli_fetch_assoc($result)) // this is loop
                {
                  if($this->checkMatrixCount($ref['ibm'])) 
                  {
                    $ibm_list[] = $ref['ibm'];  
                  }else
                  {
                    return $ref['ibm'];
                  }                   
                }
              } else 
              {
                return $ibm;
              }       
            }
            return $this->getMatrixPosition($ibm_list);
          }
    # function to check root user
          public function getLatestIbm(){
            
            $dbQuery = 'SELECT COUNT(*) AS total_mem FROM members';
            $results = mysqli_query($this->dbCon, $dbQuery);
            $data = mysqli_fetch_assoc($results);
            $new_ibm = ($data['total_mem']+1);
            return 'IBM'.$new_ibm;
          }

          
    # function to login user
          public function isLoggedIN(){

            if(  (isset($_SESSION['user']) && $_SESSION['user']['is_logged_in']== 1) &&
              (filter_var($_SESSION['user']['u_id'], FILTER_VALIDATE_INT) && !empty($_SESSION['user']['u_id']))){
              return true;
          }else{
            return false;
          }
        }

    # function to login user is admin or not
        public function isAdminIN(){

          if( $this->isLoggedIN() && $_SESSION['user']['user_role']== '1' ){
            return true;
          }else{
            return false;
          }
        }
    # function to logout user / admin
        public function logOutMe(){

          if( $this->isLoggedIN()){
            session_destroy();
            $this->redirectMe($this->base_url.'');
          }else{
            return false;
          }
        }
#to verify  singup 
        public function verifiyActivation($data)
        {
          $query = "SELECT user_email, hash, is_active FROM members WHERE user_email='".$data['email']."' AND hash='".$data['hash']."' AND is_active='0'";
          $result = mysqli_query($this->dbCon, $query);
          if (($result) && (mysqli_num_rows($result) == 1)) 
          {
           $updatequery = "UPDATE members SET is_active='1' WHERE user_email='".$data['email']."' AND hash='".$data['hash']."'";
           
           if (mysqli_query($this->dbCon, $updatequery)){
             return $response = array(
              'error' => false,
              'message' => 'Your account has been activated, you can now login',
              'success' => true
            );
             
           }
           else{
      // 
             return $response = array(
              'error' => true,
              'message' => 'The url is either invalid or you already have activated your account.',
              'success' => false
            );
           }
         }
         return $response = array(
          'error' => true,
          'message' => 'The url is either invalid or you already have activated your account.',
          'success' => false
        );
       }

#to unsubscribe member from email list
       public function unsubscribe($data)
       {
        $query = "SELECT user_email, newsletter_hash, accept_emails FROM members WHERE user_email='".$data['email']."' AND newsletter_hash='".$data['hash']."' AND accept_emails='1'";
        $result = mysqli_query($this->dbCon, $query);
        if (($result) && (mysqli_num_rows($result) == 1)) 
        {
         $updatequery = "UPDATE members SET accept_emails='0' WHERE user_email='".$data['email']."' AND newsletter_hash='".$data['hash']."'";
         
         if (mysqli_query($this->dbCon, $updatequery)){
           return $response = array(
            'error' => false,
            'message' => 'You have been unsubscribed Sussessfully! From now you will not emails from Viral-Marketer',
            'success' => true
          );
           
         }
         else{
      // 
           return $response = array(
            'error' => true,
            'message' => 'Either you have already unsubscribed or you have not subscribe to Viral-Marketer Emails yet!',
            'success' => false
          );
         }
       }
       return $response = array(
        'error' => true,
        'message' => 'Either you have already unsubscribed or you have not subscribe to Viral-Marketer Emails yet',
        'success' => false
      );
     }
    #db select function
     public  function  db_select($dbQuery, $onlyCount = false, $debug = false){
      $results = mysqli_query($this->dbCon, $dbQuery);
      if($onlyCount){
        $countResult =  mysqli_num_rows($results);
        return $countResult;
      }
      if($debug){
        echo '<strong> Query:</strong> '.$dbQuery.'<br>';
        $data = mysqli_fetch_assoc($results);
        if($data){
          echo '<strong> Result:</strong><br><pre>';
          print_r($data);
          echo '</pre>';
          die();
        }else{
          die(mysqli_error($this->dbCon));
        }
      }
      return $results;
    } 
    #db_insert in database
    public  function  db_insert($dbQuery){
      $results = mysqli_query($this->dbCon, $dbQuery);
      if($results && mysqli_affected_rows($this->dbCon)== 1){
        return true;
      }else if($this->sqlError){
        die(mysqli_error($this->dbCon));
      }else{
        return false;
      }
    }
    public function get_transaction_detail($data)
    {
      
     
      $get_transaction_detail = $this->api('http://206.189.73.130/wallets/get_transaction_detail',
        json_encode(array(
          'email'  => $data['wallet_email'],
          'hash' => $data['tx_id']
        ))
      );
      if($get_transaction_detail['success'] == true)
      {
        $values = json_decode($get_transaction_detail['wallet_address']);
        return  array('success'=>true,
         'values' => $values);

        

            //return "Successfull";
      } 
      else
      {
        return "no";
      }
    }
    public function checkbalance($xpub)
    {
		return $this->bitcoinSetting->getWalletBalnce($xpub);
    }
    
    public function getpassphrase($email)
    {
      
      
      $getPass =  $this->api('http://206.189.73.130/wallets/get_user_passphrase',
        json_encode(array(
          'email'  => $email
        ))
      );

      if ($getPass['success'] == true)
      {
       
        
            // Balance in satoshi
        return $getPass['mnemonic'];
      }
      else
      {
        return "There is an error with your Wallet";
      }
    }
    
    public function api($url, $payload)
    {
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
  # Setup request to send json via POST.
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );

      $headers = [
       "Cache-Control: no-cache",
       "Content-Type: application/json",
       "Postman-Token: d7d6ee39-c095-470f-8644-2abc274c88bf",
       "api-key: 1N1stZHASThiaVHVJ3RTwMdkFidonotdelete",
       "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
       "secret-key: 13u4GKaWPYmVFoXRqbTNdHtqmVdonotdelete"
     ];
     
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  # Return response instead of printing.
     curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  # Send request.
     $result = curl_exec($ch);
     curl_close($ch);
     $res = json_decode($result, true);
     return $res;
   }
   public function get_details($ibm)
   {
    $result2 = $this->dbCon->db_select("SELECT first_name,last_name,ibm FROM members WHERE ibm='" . $ibm . "'");
    $count = mysqli_num_rows($result2);
    if ($count > 0)
    {
      $ref = mysqli_fetch_array($result2);
      return array(
        'name' => $ref['first_name'] . ' ' . $ref['last_name'],
        'ibm' => $ref['ibm']
      );
    }
  }
  
  public function get_memeber_by_id($id)
  {
    $dbQuery = "SELECT * FROM members WHERE u_id='" . $id . "'";
    $results = mysqli_query($this->dbCon, $dbQuery);
    $count = mysqli_num_rows($results);
    if ($count > 0)
    {
      $ref = mysqli_fetch_array($results);
      return array(
        'name' => $ref['first_name'],
        'btc_add' => $ref['btc_add'],
        'ibm' => $ref['ibm'],
        'email' => $ref['user_email'],
        'wallet_number' => $ref['wallet_number'],
        'wallet_email' => $ref['wallet_email'],
		'wallet_xpub' => $ref['wallet_xpub']
        
      );
    }
    return false;
  }
  
  public function get_level_info($level)
  {
    $dbQuery = "SELECT * FROM system_levels WHERE id='" . $level . "'";
    $results = mysqli_query($this->dbCon, $dbQuery);
    $count = mysqli_num_rows($results);
    if ($count > 0)
    {
      $ref = mysqli_fetch_array($results);
      return array
      (
        'level_name'  => $ref['level_name'],
        'level_amount' => $ref['level_price']
      );
    } 
    return false;
  }
  
  function sendResponse($res)
  {
    header('Content-Type: application/json');
    return json_encode($res);
  }
  
    #get Where Clasue
  public function getWhere( $where = array()){

    $dbQuery = "SELECT ".$where['select']." FROM  ".$where['from']." WHERE  ".$where['compare']." = '".$where['where']."'";
    $result = mysqli_query($this->dbCon, $dbQuery);
    if (($result)) {
      $user_data = mysqli_fetch_assoc($result);
      return  ($where['select'] != '*')? ucfirst($user_data[$where['select']]): $result;
    }
    return;
  }
    #get  data about admin or user
  public  function  getUserById($id, $admin= false){
    $where = 'u_id = '.$id.'';
    $where.= ($admin)? ' AND user_role="1"': 'AND user_role="0"' ;
    $dbQuery = 'SELECT first_name FROM  newsify_users WHERE  '.$where.'';
    $result = SELF::db_select($dbQuery,false,false);
    if (($result) && (mysqli_num_rows($result) == 1)) {
      $user_data = mysqli_fetch_array($result);
      return  ucfirst($user_data['first_name']);
    }
    return;
  }


  public  function alertMessage($alertClass = string, $mesgText = string ){
   $alert =  '<div class="alert alert-'.$alertClass.'  in alert-dismissible">
   <button type="button" class="close" data-dismiss="alert">&times;</button>
   <strong><i class="fa fa-info-circle" aria-hidden="true"></i></strong>&nbsp;&nbsp;
   '.$mesgText.'
   </div>';
   return $alert;
 }
 public function getGlob() {
  
        //return $this->glob['wallet_email'];
 }
 public function buy_bitcoin_through_cradit_card($data)
 {
   
   $cradit_value = $this->api('http://206.189.73.130/wallets/credit_card_transaction',
    json_encode(array(
     'card_number' => $data['credit_card_number'],
     'month' => $data['month'],
     'year' => $data['year'],
     'verification_value' => $data['verification_value'],
     'amount' => $data['amount'],  
     'wallet_address' => $data['wallet_address'],
     'fee' => $data['fee'],
     'email' => $data['email'],
   ))
  );
   if($cradit_value['success'] == true)
   {
     $miner_fee = $this->getFee($data['amount'])/2;
     $tvm_fee = $this->getFee($data['amount'])/2;
     $historyData = array(
      'description'=> 'Wallet Funded by Credit Card',
      'transaction_id' => $cradit_value['txid'],
      'receiver_wallet_address' => $data['wallet_address'],
      'receiver_ibm' => $data['ibm'],
      'amount' => $data['amount'],
      'status' =>  'Successfull',
      'miner_fee' => $miner_fee,
      'tvm_fee' => $tvm_fee
    );
     
     $responses =  $this->transectionHistoryforBuyBitcoin($historyData);
     
     return $response = array(
      'success' => true,
      'message' => $cradit_value['transactions'],
      'error' => false
    );
     
   }
   else
   {
                          //  $description = "Wallet Funded Via Credit Card";
                            //$status = "Failed";
                            //$miner_fee = $data['fee']/2;
                            //$tvm_fee = $data['fee']/2;
    
                           // $responseHistory = $this->insertTransectionHistory($data ,'0' , $description , $status , $miner_fee , $tvm_fee);
    
                            //return false;
    return $response = array(
      'success' => false,
      'message' => $cradit_value['error'],
      'error' => true
    );
  }

}

public function send_email_for_sender($levelname)
{
  $memberID 	= $_SESSION['user']['u_id'];
  $memberInfo = $this->get_memeber_by_id($memberID);
  $memberInfo['email'];
  $memberInfo['name'];
  $template_sender  = $this->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 2");
  $count = mysqli_num_rows($template_sender);
  if ($count > 0)
  {
    
    $template = mysqli_fetch_array($template_sender);
    $content      = str_replace('{#first_name#}', $memberInfo['name'] , $template['template_content']);
    $content     = str_replace('{#level#}', $levelname, $content);

    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= "From: info@theviralmarketer.biz"; 
    mail($memberInfo['email'], 'You Have Just Upgraded | The Viral Marketer', $content, $headers); 
  }  
  
  
}

public function send_welcome_email($name , $email , $ibm)
{
  
  $template_sender  = $this->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 18");
  $count = mysqli_num_rows($template_sender);
  if ($count > 0)
  {
    
    $template = mysqli_fetch_array($template_sender);
    $content      = str_replace('{#first_name#}', $name , $template['template_content']);
    $content       = str_replace('{#email#}', $email, $content);
    $content       = str_replace('{#ibm#}', $ibm, $content);

    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
    $headers .= "From: info@theviralmarketer.biz"; 
    mail( $email, 'Welcome To The Viral Marketer', $content, $headers); 
  }  
  
  
}

public function send_email_for_receiver($receiverEmail , $receiverName , $lavelName , $levelAmount)
{
        //return $receiverEmail.' '. $receiverName;
  $memberID 	= $_SESSION['user']['u_id'];
  $memberInfo = $this->get_memeber_by_id($memberID);
  $memberInfo['email'];
  $memberInfo['name'];
  $template_reciever  = $this->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 3");
  $mycount = mysqli_num_rows($template_reciever);
  if ($mycount > 0)
  {
   $receiver_template = mysqli_fetch_array($template_reciever);
   
   $message  = str_replace('{#first_name#}',  $receiverName , $receiver_template['template_content']);
   $message  = str_replace('{#level#}', $lavelName , $message);
   $message  = str_replace('{#name#}', $memberInfo['name'] , $message);
   $message  = str_replace('{#amount#}', $levelAmount , $message);
   $headers = 'MIME-Version: 1.0'."\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
   $headers .= "From: info@theviralmarketer.biz";  
   mail($receiverEmail, 'Payment Notification | The Viral Marketer', $message, $headers);
   
   return $receiverEmail;
 }
 
 
}

public function send_otp_code($action)
{
  // Action Level Upgrade = 1  ,   Buy bitcoins = 2  ,  Pay Paypal = 3
  $memberID 	= $_SESSION['user']['u_id'];
  $memberInfo = $this->get_memeber_by_id($memberID);
  $memberInfo['email'];
  $memberInfo['name'];
  $otp_code = rand(100000,999999);
  $dbQuery = "INSERT INTO `members_otp_codes` ( `member_id`, `otp_code` , `actions` ) 
  VALUES ('".$memberID."', '".$otp_code."' , '".$action."')";   
	
$otp_insert = mysqli_query($this->dbCon, $dbQuery);
        
  
  if($otp_insert)
  {  
		  $template_sender  = $this->db_select("SELECT `template_content` FROM `tbl_email_templates` WHERE `id` = 19");
		  $count = mysqli_num_rows($template_sender);
		  if ($count > 0)
		  {

			$template = mysqli_fetch_array($template_sender);
			$content      = str_replace('{#first_name#}', $memberInfo['name'] , $template['template_content']);
			$content       = str_replace('{#otp_code#}', $otp_code, $content);


      $headers = 'MIME-Version: 1.0'."\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
        $headers .= "From: info@theviralmarketer.biz"; 
			 

			mail($memberInfo['email'], 'OTP Payment Verification | The Viral Marketer', $content, $headers); 
		  }  
	    return $response = array('success'=> true,
          'message' => 'OTP has been sent to email. Check Spam Folder if not received in inbox.',
		  'otp_code' => $otp_code,
          'error' => false
        );        
        
	 
  }
  else
  {
       return $response = array('success'=> false,
          'message' => 'Invalid Request. Please close Popup and Try Again',
          'error' => true
        );        
        
  }
  
}	
function validate_otp($otp_code , $action)
{
}
	
public function buy_bitcoin_through_paypal($amount)
{
  
 $paypal_value = $this->api('http://206.189.73.130/wallets/get_paypal_url',
  json_encode(array(
    'return_url'     => 'http://www.theviralmarketer.biz/paypal_success.php',
    'cancel_url' => 'http://www.theviralmarketer.biz/paypal_success.php',
    'amount' => $amount))
);
 if($paypal_value['success'] == true)
 {
  
  $_SESSION['amount_of_paypal'] = $amount;
  return $paypal_value['success'];
  
}                       

}
function get_level_description($level_id)
{
  $result2 = $this->db_select("SELECT level_name FROM system_levels WHERE id ='" . $level_id . "'");
  $count = mysqli_num_rows($result2);
  if ($count > 0)
  {
    $level_description = mysqli_fetch_array($result2);
    return "Upgrade to  ".$level_description['level_name'];
  }
}
public function paypal_payment_complete($wellet_address ,$email ,$token ,$PayerID ,$amount ,$ibm ,$fee)
{
  
  $paypal_value = $this->api('http://206.189.73.130/wallets/complete_paypal_transaction',
    json_encode(array(
      'wallet_address' => $wallet_number,
      'business_wallet_email' => $wallet_email,
      'PayerID'=> $PayerID,
      'token' => $token,
      'amount' => $amount,
      'fee' => $fee))
    
  );
  if($paypal_value['success'] == true)
  {
   $miner_fee = $this->getFee($amount)/2;
   $tvm_fee = $this->getFee($amount)/2;
   $historyData = array(
    'description'=> 'Wallet Funded by Paypal',
    'transaction_id' => $PayerID,
    'receiver_wallet_address' => $wellet_address,
    'receiver_ibm' => $ibm,
    'amount' => $amount,
    'status' =>  'Successfull',
    'miner_fee' => $miner_fee,
    'tvm_fee' => $tvm_fee
  );
   
   $response =  $this->transectionHistoryforBuyBitcoin($historyData);
   return  $data = array(
    'success' => 1,
    'successfully_Message' => 'Payment Successfully Done',                            
    'error' => 0,
  );
 }
 else
  return "failed transection";
}
public function sendMail($email, $subject, $body)
{
            // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Create email headers
  $headers .= 'From: The Viral Marketer <info@theviralmarketer.biz>'."\r\n".
  'Reply-To: <info@theviralmarketer.biz>'."\r\n" .
  'X-Mailer: PHP/' . phpversion();
  if(mail($email, $subject, $body,$headers)){
    return true;
  }
  return false;
}
public function getTrasactionFee($amount)
{
        // 0.5$ of TVM to Miner fee also added on Api side with this Transaction Amount
  if ($amount <= 30)
  {
    return 1;
  }
  else
  {
    $fee = $amount/100;
    return ($fee*2);
  }
}
public function getTransactionFeeCraditCard($amount)
{
        // 0.5$ of TVM to Miner fee also added on Api side with this Transaction Amount
  $two_point_nine_percent = ($amount/ 100) * 2.9;
  $six_percent = ($amount/ 100) * 6;
  $percentage;
  if ($amount < 51)
  {
   $percentage =  1.50;
 }
 else
 {
  $percentage = (($amount/100)*2)+0.5;
}

$total = $two_point_nine_percent + $six_percent + $percentage + 0.3;
return $total;
}



public function getTransactionFeeMtoM($amount)
{
        // 0.5$ of TVM to Miner fee also added on Api side with this Transaction Amount   
  if ($amount < 51)
  {
   return 1;
 }
 else
 {
   return  (($amount/100)*2);
 }
}

public function getFee($amount)
{
  if ($amount < 51)
  {
   return ($amount/100);
 }
 else
 {
   return  (($amount/100)*2);
 }
 
}



public function addTweeterAccounts($data) {
  
  $query = "SELECT * FROM   `members_twitter_accounts`
  WHERE  `pid` = '" . $data['pid'] . "' AND  `uid` = '" . $data['uid'] . "' Limit 1";
  $result = mysqli_query($this->dbCon, $query);
  if (($result) && (mysqli_num_rows($result) >= 1)) {
    $createdDate = $data['created'];
    $screenName = $data['screen_name'];
    $accessToken = $data['access_token'];
    $status = $data['status'];
    $avater = $data['avatar'];
    $dataProfile = $data['data_profile'];
    
    $tweeter_account_data = mysqli_fetch_array($result);
    
    $updateTweeterQuery = "UPDATE  `members_twitter_accounts`
    SET created = '$createdDate' , avatar = '$avater' , screen_name = '$screenName' , data_profile = '$dataProfile' , access_token = '$accessToken' , status = '$status'
    WHERE id ='".$tweeter_account_data['id']."'";
    if (mysqli_query($this->dbCon, $updateTweeterQuery)){
      return  array(
        'success' => 1,
        'successfully_Message' => 'Insert Successfully',                        'id' => $tweeter_account_data['id'],     
        'error' => 0,
      );
      
    }
    else {
     
     echo mysqli_error($this->dbCon);
     die();
   }
   
   
   
   
 }
 else { 
  $dbQuery = "INTO `members_twitter_accounts` 
  ( `uid`, `pid`, `screen_name`, `avatar`, `access_token`, `created`, `status`, `data_profile`, `list_data`, `followed_list_data`) 
  VALUES ('".$data['uid']."', '".$data['pid']."', '".$data['screen_name']."', '".$data['avatar']."', '".$data['access_token']."', '".$data['created']."', '".$data['status']."', '".$data['data_profile']."','".$data['list_data']."', '".$data['followed_list_data']."')";        
  


  try {
   
   $results = mysqli_query($this->dbCon, $dbQuery);
   $last_id = mysqli_insert_id($this->dbCon);
   if ($results) {
    return  array(
      'success' => 1,
      'successfully_Message' => 'Insert Successfully',                          'id' =>   $last_id,
      'error' => 0,
    );
    
  } else 	{
   return array(
    'success' => 0,
    'successfully_Message' => 'There is something issue please try again',                            
    'error' => 1,
  );
 }
} 
catch (Exception $e) {
 echo  $e->getMessage();
 echo mysqli_error($this->dbCon);
 die();
 
}
}
}

function updateTwitterAccount($data , $id) {
    
    $avater = $data['avatar'];
    $dataProfile = $data['data_profile'];
    $tweeter_account_data = mysqli_fetch_array($result);
    
    $updateTweeterQuery = "UPDATE  `members_twitter_accounts`
    SET  avatar = '$avater' , data_profile = '$dataProfile'
    WHERE id ='".$id."'";
    if (mysqli_query($this->dbCon, $updateTweeterQuery)){
      return  array(
        'success' => 1,
        'successfully_Message' => 'Your twitter account has been updated successfully',                        '
        id' => $tweeter_account_data['id'],     
        'error' => 0,
      );
      
    }
    else {
     
     echo mysqli_error($this->dbCon);
     die();
   }
}


public function getTweeterAccountDetails() {
 $response = array();
 $query = "SELECT * FROM   `members_twitter_accounts` WHERE `uid` = '" . $_SESSION['user']["u_id"] . "'";
   $result = mysqli_query($this->dbCon, $query);
while ($tweeterAccount = mysqli_fetch_assoc($result)) {
    $response[] = array('id'=> $tweeterAccount['id'] , 'pid'=>$tweeterAccount['pid'] , 'status'=> $tweeterAccount['status'], 
        'avatar'=> $tweeterAccount['avatar'],
    'data_profile' => json_decode($tweeterAccount['data_profile'])  );
}
  return $response;
    }

public function getSingleTweeterAccountDetail($accountId) {
 $response = array();
 $query = "SELECT * FROM   `members_twitter_accounts` WHERE `uid` = '" . $_SESSION['user']["u_id"] . "' AND  `id` = '" .$accountId . "' Limit 1 ";
   $result = mysqli_query($this->dbCon, $query);
    $tweeterAccount = mysqli_fetch_array($result);
    
    return array('id'=> $tweeterAccount['id'] , 'pid'=>$tweeterAccount['pid'] , 'status'=> $tweeterAccount['status'], 'access_token'=> $tweeterAccount['access_token'],
        'avatar'=> $tweeterAccount['avatar'],
        'screen_name'=> $tweeterAccount['screen_name'],
    'data_profile' => json_decode($tweeterAccount['data_profile']) ,
    'list_data' => json_decode($tweeterAccount['list_data']),
    'followed_list_data' => json_decode($tweeterAccount['followed_list_data'])
    );
    
}

public function getSingleTweeterAccountDetailForTweet($accountId) {
 $response = array();
 $query = "SELECT * FROM   `members_twitter_accounts` WHERE `id` = '" .$accountId . "' Limit 1";
   $result = mysqli_query($this->dbCon, $query);
    $tweeterAccount = mysqli_fetch_array($result);
    
    return array('id'=> $tweeterAccount['id'] , 'pid'=>$tweeterAccount['pid'] , 'status'=> $tweeterAccount['status'], 'access_token'=> $tweeterAccount['access_token'],
        'avatar'=> $tweeterAccount['avatar'],
        'screen_name'=> $tweeterAccount['screen_name'],
    'data_profile' => json_decode($tweeterAccount['data_profile']) ,
    'list_data' => json_decode($tweeterAccount['list_data']),
    'followed_list_data' => json_decode($tweeterAccount['followed_list_data'])
    );
    
}

public function saveTweetCategry($data , $twitter_acccount_id) {
    
   $uid = $_SESSION['user']["u_id"];

  $twitter_account_id = $data['twitter_account_id'];
  $dbQuery = "INSERT INTO `members_tweets_category` ( `name`, `description` , `uid`, `twitter_account_id`) 
  VALUES ('".$data['name']."', '".$data['description']."' , '".$uid."' , '".$twitter_acccount_id."')";        
  
      try {
            $results = mysqli_query($this->dbCon, $dbQuery);
        
        if ($results) {
          return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false
        );        
        
                
        }
      }
      catch (Exception $e) {
    echo $e->getMessage();
  }

}
public function showTweetCatagories($data)
{
      
   $uid = $_SESSION['user']["u_id"];
    $query = "Select * from `members_tweets_category` where `uid`= '".$uid."' AND `twitter_account_id` = '".$data."' ";
     $response = array();
   $result = mysqli_query($this->dbCon, $query);
while ($catagory = mysqli_fetch_assoc($result)) {
    
    $response[] = array('id'=> $catagory['id'] , 'name'=>$catagory['name'] , 'description'=> $catagory['description']);
}

  return $response;
    
    
}

public function deleteTweetCategory($id) {
    $DelSql = "DELETE FROM `members_tweets_category` WHERE id='$id'";

        $result = mysqli_query($this->dbCon, $DelSql);

        if ($result) {
          return $response = array('success'=> true,
          'message' => 'Deleted Successfully.',
          'error' => false
        );        
        
        } else {
             return $response =
              array('success'=> false,
          'message' => 'There is something issue please try again.',
          'error' => true
             
          );
        }
}

public function getSingleCategory($id) {
    $response = array();
 $query = "SELECT * FROM   `members_tweets_category` WHERE  `id` = '" .$id . "' Limit 1 ";
   $result = mysqli_query($this->dbCon, $query);
    $category = mysqli_fetch_array($result);
    
    return array('id'=> $category['id'] , 'name'=>$category['name'] , 'description'=> $category['description']);
 
}
public function updateCatagory($data,$id ,$twitter_acccount_id)
{
    $name = $data['name'];
    $description = $data['description'];
    $uid= $_SESSION['user']["u_id"];

    $updateTweeterQuery = "UPDATE  `members_tweets_category`
    SET  name = '$name' , description = '$description', uid = '$uid', twitter_account_id = '$twitter_acccount_id'
    WHERE id ='".$id."'";
    $result = mysqli_query($this->dbCon, $updateTweeterQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Catagory has been updated successfully',                        '
        id' => $tweeter_account_data['id'],     
        'error' => 0,
      );
      
    }
 
}

public function addTwitterLogs($data) {
    // 	uid	twitter_user_id	twitter_account_id	status	date

    $data['account-id'];
    $data['user-id'];
    $data['account-id'];
    $data['status'];
    $data['uid']= $_SESSION['user']["u_id"];
    $data['date'] = date("Y/m/d");

$query = "SELECT * FROM   `members_twitter_logs`
  WHERE  `twitter_user_id` = '" . $data['user-id'] . "'";
  $check = mysqli_query($this->dbCon, $query);
if( mysqli_num_rows($check) == 0){
  $dbQuery = "INSERT INTO `members_twitter_logs` ( `uid`,`twitter_user_id`, `twitter_account_id`,`status`,`date`) 
    VALUES ( '".$data['uid']."' ,'" .$data['user-id']."', '".$data['account-id']."' , '".$data['status']."' , '".$data['date']."' )";        
    try {
            $results = mysqli_query($this->dbCon, $dbQuery);
       $last_id = mysqli_insert_id($this->dbCon);
        if ($results) {
          return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false,
          'data' => $last_id
        );        
        
                
        }
      }
 catch (Exception $e) {
    return  $e->getMessage();
  }
}
else if(mysqli_num_rows($check) >= 1)
{
    
    $updateTweeterQuery = "UPDATE  `members_twitter_logs`
    SET  uid = '".$data['uid']."' , twitter_user_id = '" .$data['user-id']."' , twitter_account_id =  '".$data['account-id']."' ,status= '".$data['status']."',date='".$data['date']."' 
    WHERE twitter_user_id ='" . $data['user-id'] ."'";
    $result = mysqli_query($this->dbCon, $updateTweeterQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Follower has been updated successfully',                        '
        id' => $tweeter_account_data['id'],     
        'error' => 0,
      );
      
    }
}
     
    
    // return "here is".$results;
    
    
}
public function showTwitterLogs($data)
{
    $data['accountId'];
    $data['uid']= $_SESSION['user']["u_id"];
     $response = array();
     $query = "SELECT * FROM   `members_twitter_logs` WHERE  `uid`='" .$data['uid'] . "' AND `twitter_account_id` ='".$data['accountId']."'  ";
   $result = mysqli_query($this->dbCon, $query);
while ($logs = mysqli_fetch_assoc($result)) {
    
    $response[] = array('id'=> $logs['id'] , 'status'=>$logs['status'] , 'twitter_user_id'=>$logs['twitter_user_id'] , 'twitter_account_id'=>$logs['twitter_account_id'] ,  'date'=>$logs['date']);
}

 return $response;   
}
public function saveTweets($data) {
    
    // return $data;
  $uid = $_SESSION['user']["u_id"];
  $dbQuery = "INSERT INTO `members_twitter_posts` ( `uid`, `account_id` , `category_id`, `tweet_id`,`type`,`data`,`status`,`result`,`time_post`) 
  VALUES ('".$uid."', '".$data['account_id']."' ,'".$data['category_id']."' ,'".$data['tweet_id']."' ,'".$data['type']."' ,'".$data['data']."' ,'".$data['status']."' ,'".$data['result']."' ,'".$data['time_post']."')";    
  
      try {
          
            $results = mysqli_query($this->dbCon, $dbQuery);
         $last_id = mysqli_insert_id($this->dbCon);
         $twitterPostResult = "SELECT * FROM `members_twitter_posts` WHERE id ='".$last_id."' Limit 1";
         $twitterPostResult = mysqli_query($this->dbCon, $twitterPostResult);
        $twitterPostResult = mysqli_fetch_array($twitterPostResult);
         $tweetdata->last_id = $last_id;
         $tweetdata->tweet_account_id = $twitterPostResult["tweet_id"];
        if ($results) {
          return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false,
          'data'=> $tweetdata
        );        
         
                
        }
      }
      catch (Exception $e) {
    echo $e->getMessage();
  }

}
public function showTweets($data)
{   
    $uid = $uid = $_SESSION['user']["u_id"];
    $query = "Select * , mtc.name as category_name from `members_tweets_category` as mtc , `members_twitter_posts` as mtp where mtc.id = mtp.category_id AND mtp.uid = '".$uid."' AND mtp.account_id= '".$data."'";
     $response = array();
   $result = mysqli_query($this->dbCon, $query);
while ($catagory = mysqli_fetch_assoc($result)) {
    
    $response[] = array('id'=> $catagory['id'], 'type'=> $catagory['type'] , 'name'=>$catagory['name'] , 'caption'=> $catagory['data'] , 'time_post'=> $catagory['time_post'], 'result'=> $catagory['result'] ,'status'=>$catagory['status'] ,'tweet_id'=>$catagory['tweet_id'] );
}

  return $response;
    
    
}

//delete post 
public function deleteTweets($id) {
    $DelSql = "DELETE FROM `members_twitter_posts` WHERE id='$id'";

        $result = mysqli_query($this->dbCon, $DelSql);

        if ($result) {
          return $response = array('success'=> true,
          'message' => 'Deleted Successfully.',
          'error' => false
        );        
        
        } else {
             return $response =
              array('success'=> false,
          'message' => 'There is something issue please try again.',
          'error' => true
             
          );
        }
}

//show posts
public function showTweetforChrone()
{
      
    $query = "Select * from `members_twitter_posts`";
     $response = array();
   $result = mysqli_query($this->dbCon, $query);
while ($post=mysqli_fetch_assoc($result)) {
    
    $response[] = array('id'=> $post['id'], 'type'=> $post['type'] , 'account_id'=>$post['account_id'] , 'data'=> $post['data'] , 'time_post'=> $post['time_post'], 'result'=> $post['result'] , 'category_id'=>$post['category_id'], 'tweet_id'=> $post['tweet_id'],'url'=> $post['url'] ,'status'=>$post['status'] );

}

  return $response;
    
    
}

public function updateTweetforChrone($data,$id)
{
    $result = $data['result'];
    $status = $data['status'];
    $timepost = $data['timepost'];
    $tweet_id = $data['tweet_id'];

    $updateTweeterQuery = "UPDATE  `members_twitter_posts`
    SET  result = '$result' , status = '$status', time_post = '$timepost', tweet_id = '$tweet_id'
    WHERE id ='".$id."'";
    $result = mysqli_query($this->dbCon, $updateTweeterQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Tweet Post has been updated successfully',    
        'error' => 0,
      );
      
    }
 
}
//get single tweet
public function showSingleTweet($data ,$id)
{   
    $uid = $uid = $_SESSION['user']["u_id"];
    $query = "Select * , mtc.name as category_name from `members_tweets_category` as mtc , `members_twitter_posts` as mtp where mtc.id = mtp.category_id AND mtp.uid = '".$uid."' AND mtp.account_id= '".$data."' AND  mtp.id= '".$id."'" ;
   //  $response = array();
   $result = mysqli_query($this->dbCon, $query);
    $response = mysqli_fetch_array($result);
   
 //   $response[] = array('id'=> $catagory['id'], 'type'=> $catagory['type'] , 'name'=>$catagory['name'] , 'caption'=> $catagory['data'] , 'time_post'=> $catagory['time_post'], 'result'=> $catagory['result'] );


  return $response;
    
    
}
//Update Tweet
public function updateTweet($data,$id)
{

    $updateTweeterQuery = "UPDATE `members_twitter_posts` SET `category_id`='".$data['category_id']."' ,`type`= '".$data['type']."' ,`data`= '".$data['data']."' ,`status`='".$data['status']."',`result`='".$data['result']."',`time_post`='".$data['time_post']."',`changed`='".$data['changedate']."' WHERE `id`= '".$id."' ";
    $result = mysqli_query($this->dbCon, $updateTweeterQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Tweet has been updated successfully',                        '
        id' => $tweeter_account_data['id'],     
        'error' => 0,
      );
      
    }
 
}
//Update Media
public function updateTweetMedia($data,$id)
{

    $updateTweeterQuery = "UPDATE `members_twitter_posts` SET `data`= '".$data."' WHERE `id`= '".$id."' ";
    $result = mysqli_query($this->dbCon, $updateTweeterQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Tweet has been updated successfully',
        'error' => 0,
      );
      
    }
 
}
 public function deleteaccount($id)
      {
        $DelSqlcatagory = "DELETE FROM `members_tweets_category` WHERE twitter_account_id='$id'";
        $DelSqlmembertwitter = "DELETE FROM `members_twitter_accounts` WHERE id='$id'";
        $DelSqltwitterlogs = "DELETE FROM `members_twitter_logs` WHERE twitter_account_id='$id'";
        $DelSqltwitterpost = "DELETE FROM `members_twitter_posts` WHERE account_id='$id'";

        $rescatagory = mysqli_query($this->dbCon, $DelSqlcatagory);
        $restwiiteracount = mysqli_query($this->dbCon, $DelSqlmembertwitter);
        $restwitterlogs = mysqli_query($this->dbCon, $DelSqltwitterlogs);
        $restwitterpost = mysqli_query($this->dbCon, $DelSqltwitterpost);


        if ($rescatagory && $restwiiteracount && $restwitterlogs && $restwitterpost) {
          return $response = array(
            'error' =>  false,
            'message' => 'Deleted successfully.',
            'success' => true,

          );
        }
        else
        {
          return $response = array(
            'error' => true,
            'message' =>  "Something Wrong Please Try again!",
            'success' => false,
          );
        }

      }

    public function timeset() {
     if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && $_SERVER["HTTP_X_FORWARDED_FOR"]) {
	$ipAddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
	$ipAddress = $_SERVER["REMOTE_ADDR"];
}

// Lookup IP address information
$asdasd = new DBIP\Address();
$addrInfo = $asdasd->lookup($ipAddress);

// Create DateTime object with the right time zone
$now = new DateTime("now", new DateTimeZone($addrInfo->timeZone));

// Display results
echo "Visitor local time : " . $now->format("H:i:s");
    }
	
  public function updateWalletAddress($walletNumber , $xpub) {
	$userQuery = "UPDATE  members
        SET wallet_number = '$walletNumber'
        WHERE 
        wallet_xpub ='".$xpub."'";
        
        if (mysqli_query($this->dbCon, $userQuery)){
         
         return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false
        );
       }
       else
       {
        return $response = array('success'=> false,
          'message' => 'There Is something Wrong. Please Try again.',
          'error' => true
        );
      }
	
}
 public function savePayPalTransaction($data) {
    
   $uid = $_SESSION['user']["u_id"];
  $dbQuery = "INSERT INTO `paypal_Transaction` ( `user_id`, `amount` , `amount_with_tax`, `status` , `token`) 
  VALUES ('".$uid."', '".$data['amount']."' , '".$data['amount_with_tax']."','".$data['status']."' , '".$data['token']."')";        
  
      try {
            $results = mysqli_query($this->dbCon, $dbQuery);
        
        if ($results) {
          return $response = array('success'=> true,
          'message' => 'Save Successfully.',
          'error' => false
        );        
        
                
        }
      }
      catch (Exception $e) {
    echo $e->getMessage();
  }

}


public function getSinglePayPalTransaction($token) {
    $response = array();
 $query = "SELECT * FROM   `paypal_Transaction` WHERE  `token` = '" .$token . "' AND `status`='0' Limit 1 ";
   $result = mysqli_query($this->dbCon, $query);
    $transaction = mysqli_fetch_array($result);
    
    return array('id'=> $transaction['id'] ,'user_id'=>$transaction['user_id'], 'amount'=>$transaction['amount'] , 'amount_with_tax'=> $transaction['amount_with_tax'] , 'status'=> $transaction['status'] , 'token'=> $transaction['token'] );
 
}
public function updatePayPalTransaction($token)
{
    $uid= $_SESSION['user']["u_id"];

    $updateTransactionQuery = "UPDATE  `paypal_Transaction`
    SET  status = '1'
    WHERE token ='".$token."'";
    $result = mysqli_query($this->dbCon, $updateTransactionQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Transaction has been updated successfully', 
		'error' => 0,
      );
      
    }
 
}
public function updatePayPalTransactionbyid($id)
{
    $uid= $_SESSION['user']["u_id"];

    $updateTransactionQuery = "UPDATE  `paypal_Transaction`
    SET  status = '1'
    WHERE id ='".$id."'";
    $result = mysqli_query($this->dbCon, $updateTransactionQuery);
    if ($result){
      return  array(
        'success' => true ,
        'message' => 'Transaction has been updated successfully', 
		'error' => 0,
      );
      
    }
 
}
	
public function showallmembers()
{
      $query = "Select * from `members`";
     $result = mysqli_query($this->dbCon, $query);
	
while ($member = mysqli_fetch_assoc($result)) {
    
    $response[] = $member;

}	
	

return $response;
    
}

public function countReferrals() {
    
     $query = "SELECT *
 FROM   `members`  WHERE  `refer_ibm` = '" . $_SESSION['user']['ibm']. "' ";
 $result = mysqli_query($this->dbCon, $query);
//print_r($result);
return mysqli_num_rows($result)?mysqli_num_rows($result): 0 ;
   
 }
 
 public function countTwitterAccount() {
    
     $query = "SELECT *
 FROM   `members_twitter_accounts`  WHERE  `uid` = '" . $_SESSION['user']['u_id']. "' ";
 $result = mysqli_query($this->dbCon, $query);
return mysqli_num_rows($result);
   
   
 }
 
 public function getLevelSystems() {
    
     $query = "SELECT *
 FROM   `system_levels` ";
 $result = mysqli_query($this->dbCon, $query);
    $response = [];
    
   while ($level = mysqli_fetch_assoc($result)) {
    
    $response[] = array('id'=> $level['id'] , 'level_name'=>$level['level_name'] , 'level_price'=>$level['level_price']);
}
   
   return $response;
 }
 
 
 public function getUserLevel() {
         $query = "SELECT level, u_id
 FROM   `members`  WHERE  `u_id` = '" . $_SESSION['user']['u_id']. "' Limit 1";
 $result = mysqli_query($this->dbCon, $query);
//print_r($result);
$data = mysqli_fetch_array($result);
return $data['level'] ?? 0;
   
     
 }
public function insertPaid($data){
   
    $dbQuery = "INSERT INTO `paid_memberships` 
      (`name`, `slug`, `is_show`) 
      VALUES ('".$data['name']."', '".$data['slug']."', '".$data['is_show']."')";        
   
      try {
        if (mysqli_query($this->dbCon, $dbQuery)) {
         $last_id = mysqli_insert_id($this->dbCon);
         $addmember = "INSERT INTO `paid_member_relationship` (`member_id`, `paid_id`)
         VALUES ('". $_SESSION['user']["u_id"] ."','".$last_id."')";
         $addresult = mysqli_query($this->dbCon, $addmember);
        if ($addresult) {
            return  array(
                    'success' => 1,
                    'message' => 'Insert Successfully',                         
                    'error' => 0
                  );
                        }
          else{
            return  array(
                    'success' => 0,
                    'message' => 'Insert Faliure!',                          
                    'error' => 1
                  );
              
                      
              }
            
      }
        else{
            return  array(
                    'success' => 0,
                    'message' => 'Insert Faliure !',                          
                    'error' => 1
                  );
              
                      
              }
    
    
}
catch (Exception $e) {
    echo $e->getMessage();
  }

}
 public function paidmembers(){
     
   $uid = $_SESSION['user']["u_id"];
	 
    $query = "SELECT * FROM `paid_member_relationship` AS `PMR` ,`paid_memberships` AS `PM` WHERE `member_id` = '$uid'  AND PMR.paid_id = PM.id";
     $response = array();
   $result = mysqli_query($this->dbCon, $query);
while ($paidlist = mysqli_fetch_assoc($result)) {
    
    $response[] = array('slug'=> $paidlist['slug'] , 'is_show'=>$paidlist['is_show']);
}

  return $response;
	 
}
public function updatePaid($data){
	$user_id = $_SESSION['user']["u_id"];
	 $query = "UPDATE `paid_member_relationship` ,`paid_memberships`  SET 
  `is_show` = '".$data['is_show']."'
  WHERE 
  `member_id` = '".$user_id."' AND
  `slug`= '".$data['slug']."' ";
  if (mysqli_query($this->dbCon, $query)){
    return [
      'success' => true,
      'message' => 'Premium Facilty has been updated!!'
    ];
  }else {
    return [
      'success' => false,
      'message' => 'Premium Facilty  update operation failed!!'
    ];
  }
}
}