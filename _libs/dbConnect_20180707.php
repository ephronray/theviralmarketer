<?php

if(!session_id()) session_start();
/*
 *Author: Hadi
 *Date  : Aug - 01 - 2017
 *Type  : The Viral Marketer
 *
*/


$GLOBALS = array(
    'wallet_email' => $_SESSION['user']['wallet_email'],
);

class dbConnect
{

    private $host = "localhost";
    private $user = "ephronon_viral";
    private $pass = "V^m=UsrHBxbg";
    private $db_name = "ephronon_viral_db";
    public $dbCon;
    public $base_url   = 'http://theviralmarketer.biz';
    public $sqlError   = false;
    public $ref_keys   = array();
    protected $glob;

    public function __construct()
    {
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
    # function to add new user
public function registerNewUser($data)
    
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $hash = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 32; $i++) {
        $n = rand(0, $alphaLength);
        $hash[] = $alphabet[$n];
    }
 $hash_value   =  implode($hash);
        $rand_id = rand(100,999);
        $wallet_value = $data['email'].$rand_id;
        $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL,"http://192.241.134.225/wallets/create_wallet?email=".$wallet_value."");
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

 $headers = [
  "Cache-Control: no-cache",
  "Content-Type: application/json",
  "Postman-Token: d7d6ee39-c095-470f-8644-2abc274c88bf",
  "api-key: 1N1stZHASThiaVHVJ3RTwMdkFidonotdelete",
  "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
  "secret-key: 13u4GKaWPYmVFoXRqbTNdHtqmVdonotdelete"
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

curl_close ($ch);
$response = json_decode($server_output, true);

if($response['success'] == 1) {

$wallet_adress = $response['wallet_address']['user_wallet_address'];

            $password = md5($data['password']);
           $dbQuery = "INSERT INTO `members` 
                    (`ibm`, `first_name`, `last_name`, `user_password`, `user_email`, `refer_ibm`, `passad_up_to`, `4_by_4` ,`wallet_number` , `wallet_email`, `hash`, `transaction_password`) 
                    VALUES ('".$data['my_ibm']."', '".$data['firstname']."', '".$data['lastname']."', '".$password."', '".$data['email']."', '".$data['ibm']."', '".$data['passad_up_to']."', '".$data['4_by_4']."', '".$wallet_adress."' , '".$wallet_value."','".$hash_value."','".$data['transaction_password']."')";        
            
            $new = "INSERT INTO `tbl_member_landingpage`
                    (`member_id`, `member_ibm`, `page_id`)
                    VALUES ({$userId}, '{$userIbm}', {$pageId});";
       try {
            $results = mysqli_query($this->dbCon, $dbQuery);
         
            if ($results) {
                 $last_id = mysqli_insert_id($this->dbCon);
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
            $headers .= "From: info@viralmarketer.com"; 
           if(mail($data['email'], 'The Viral Marketer Signup | Email Verification', $message, $headers)) {
            return true;
           }
                   return true;
            }
          }
        } catch (Exception $e) {
            echo  $e->getMessage();
            die;
        }

        return false;

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
                   `wallet_email`, `wallet_number`, `u_id`, `first_name`, `user_email` ,`ibm`, `refer_ibm`
                    FROM
                    `members`
                    WHERE `user_password` =  '" . $password . "' AND `user_email` = '" . $data['email'] . "' AND  `is_active` ='1'  Limit 1";
                     $results = mysqli_query($this->dbCon, $dbQuery);
                 if (($results) && (mysqli_num_rows($results) == 1)) {
                     
                     $user_data = mysqli_fetch_array($results);
                     $_SESSION['user'] = array(
                         'wallet_email' => $user_data['wallet_email'],
                         'wallet_number' => $user_data['wallet_number'],
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
           if(mail($email, 'Viral-Marketer Recover Transaction Password', $message, $headers)) {
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
					
        if($this->db->dbCon->query($query) && $this->db->dbCon->affected_rows == 1)
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
					if($this->db->dbCon->query($tvmQuery) && $this->db->dbCon->affected_rows == 1)
		{
		 
		  return $response = array("success"=>true,
           "message" => mysqli_error($this->db->dbCon)
           );
		}
        else
        {
            return $response = array("success"=>false,
        "message" => mysqli_error($this->db->dbCon)
        );
        }  
        }
        return $response = array("success"=>false,
        "message" => mysqli_error($this->db->dbCon)
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
    $sql = "INSERT INTO MemberAdvertise(upline_member,banner_path,active_inactive,push_message,redirect_url,youtube_video_url) 
    VALUES ('$upline_member','$banner_path','$active_inactive','$push_message','$redirect_url','$youtube_video_url')";
  

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
        
        $dbQuery = 'SELECT `first_name`, `wallet_number`, `btc_add` ,`user_email` ,`ibm`, `refer_ibm` FROM members WHERE ibm = "'.$ibm.'" Limit 1';
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
        
     
        $get_transaction_detail = $this->api('http://192.241.134.225/wallets/get_transaction_detail',
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
    public function checkbalance($email)
    {
        $checkBalance = $this->api('http://192.241.134.225/wallets/get_user_balance',
                        json_encode(array(
                        'email'  => $email,
                    ))
                        );

        if (!empty ($checkBalance['wallet_address']))
        {
            $balance = [];  
            $balance[0] =$checkBalance['wallet_address']['user_balance_in_btc']; 
            $balance[1] =$checkBalance['wallet_address']['user_balance_in_user_currency']; 
            $balance[2] =$checkBalance['wallet_address']['user_currency']; 
            
            // Balance in satoshi
            return $balance;
        }
        else
        {
            return 0;
        }
    }
    
    public function getpassphrase($email)
    {
        $getPass =  $this->api('http://192.241.134.225/wallets/get_user_passphrase',
                        json_encode(array(
                        'email'  => $email
                         ))
                        );

        if ($getPass['success'] == true)
        {
             
            
            // Balance in satoshi
            return $getPass['"mnemonic"'];
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
                'wallet_email' => $ref['wallet_email']
                
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
           $alert =  '<div class="alert alert-'.$alertClass.' fade in">
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
            $cradit_value = $this->api('http://192.241.134.225/wallets/credit_card_transaction',
                        json_encode(array(
                         'card_number' => $data['credit_card_number'],
                         'month' => $data['month'],
                         'year' => $data['year'],
                         'verification_value' => $data['verification_value'],
                         'amount' => $data['amount'],  
                         'wallet_address' => $data['wallet_address'],
                         'fee' => $data['fee'],
                         'email' => 'theviralmarketer2015@gmail.com'
                         ))
                        );
                        if($cradit_value['success'] == true)
                        {
                         //   $description = "Wallet Funded Via Credit Card";
                           // $status = "Successfull";
                            
					        //$miner_fee = $data['fee']/2;
                            //$tvm_fee = $data['fee']/2;
                            
					        //$this->insertTransectionHistory($data ,'0' , $description , $status , $miner_fee , $tvm_fee);
					
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
    public function buy_bitcoin_through_paypal($amount)
    {
    
 $paypal_value = $this->api('http://192.241.134.225/wallets/get_paypal_url',
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
    public function paypal_payment_complete($wallet_number ,$wallet_email ,$token ,$PayerID ,$amount )
    {
    
        $paypal_value = $this->api('http://192.241.134.225/wallets/complete_paypal_transaction',
                        json_encode(array(
                        'wallet_address' => $wallet_number,
                        'business_wallet_email' => $wallet_email,
                        'PayerID'=> $PayerID,
                        'token' => $token,
                        'amount' => $amount))
                        );
                        if($paypal_value['success'] == true)
                        {
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
            $headers .= 'From: The Viral Marketer <info@seersol.com>'."\r\n".
                'Reply-To: <info@seersol.com>'."\r\n" .
                'X-Mailer: PHP/' . phpversion();
            if(mail($email, $subject, $body,$headers)){
                return true;
            }
            return false;
    }
   public function getTrasactionFee($amount)
    {
        
        if ($amount <= 30)
        {
            return 1;
        }
        else if($amount ==  60)
        {
            return 1.20;
        }
        else
        {
            $fee = $amount/100;
            return $fee*2;
        }
    }
    
     public function getTransactionFeePayPal($amount)
    {
           
        if ($amount <= 50)
        {
           return $amount/100;
        }
        else
        {
           return  ($amount/100)*2;
        }
    }
}
