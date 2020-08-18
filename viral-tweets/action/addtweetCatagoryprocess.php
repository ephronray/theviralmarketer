<?php
require_once (__DIR__.'/../../_libs/dbConnect.php');
$db = new dbConnect();

if((isset($_GET['twitter-category-id'])) && isset($_GET['Update'])== true ) {
        if(isset($_POST['submit']))    {
        $record = array('name' => $_POST["name"] , 'description' => $_POST["description"]);
        
        $response = $db->updateCatagory($record , $_GET['twitter-category-id'] , $_GET['id']);
        
        if($response['success']== true) {
            $showalert = true;
          $message = $response['message'];
           
        } else {
              $showalert = true;
          $message = 'There is something  issue, please try again.';
            
        }
        $id = (int)$_GET['id'];
    header("Location: ../add-tweets-category.php?id=".$id."&message=".$message."&showalert=true");
        }   
    
    
}
//insert
else {
        if(isset($_POST['submit']))    {
        echo $twitterSingleDetail['id'];
        $record = array('name' => $_POST["name"] , 'description' => $_POST["description"]);
        
        $response = $db->saveTweetCategry($record , $_GET['id']);
                 
        if($response['success']== true) {
            $showalert = true;
          $message = $response['message'];
           
        } else {
              $showalert = true;
          $message = 'There is something  issue, please try again.';
            
        }
        $id = (int)$_GET['id'];
        
    header("Location: ../add-tweets-category.php?id=".$id."&message=".$message."&showalert=true");
        }
 
}
if((isset($_GET['twitter-category-id'])) && isset($_GET['delete'])== true) 
{
    $id = $_GET['twitter-category-id'];
    $response = $db->deleteTweetCategory($id);

if($response['success']== true) {
            $showalert = true;
           $message = $response['message'];
           
        } else {
               $showalert = true;
           $message =$response['message'];
            
        }
        $id = (int)$_GET['id'];
    header("Location: ../add-tweets-category.php?id=".$id."&message=".$message."&showalert=true");
}

?>