<?php
session_start();
include_once '../_libs/dbConnect.php';
$objDB = new  dbConnect();
$access_token = $_GET['access_token'];
$url = 'http://theviralmarketer-biz.ephrononline.com/';
if(!empty($access_token)) 
{
	$sql = "SELECT p.member_id, m.ibm, m.first_name, m.last_name, m.user_email, m.refer_ibm FROM `profile_access_tokens` AS p,  `members` AS m
			WHERE p.access_token = '".$access_token."' AND p.member_id=m.u_id Limit 1"; 
	$query   = $objDB->db_select($sql);
	$user_data    = mysqli_fetch_assoc($query);
	if ($user_data) {
		 $_SESSION['user'] = array(
		 'u_id' => $user_data['member_id'],
		 'is_logged_in' => 1,
		 'first_name' => $user_data['first_name'],
		 'email' => $user_data['user_email'],
		 'user_role'=> 1,
		 'ibm'=> $user_data['ibm'],
		 'is_root'=>  (empty($user_data['refer_ibm'])) ? true : false
	 );
	 $objDB->redirectMe($url);
	 exit();
	}
}
	$objDB->redirectMe($url);
	exit();