<?php
$valueDate = $_POST['dateFormatChange'] ;
if(isset($_POST['dateFormatChange'] )){

    echo dateFormatChange($_POST['dateFormatChange']);

}


 
function dateFormatChange($valueDate) {
    if($valueDate) {
       $date1 = date("Y-m-d", strtotime($valueDate));
        $date2 = date("Y-m-d");
       if($date1 == $date2) {
       return "Today";
      }
  $diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$changeyears = $years != 0? (int)$years > 1? $years.' years': $years.' year':"";
$monthschange = $months != 0? $months > 1 ? $months.' month':$months.' months':"" ;
$dayChange = $days != 0? $days > 1 ? $days.' days':$days.' day':"" ;

return $changeyears.($changeyears != ""?" / ":"").$monthschange.($monthschange != ""?" / ":"").$dayChange. ($dayChange != "" ? " ago ": "Never Tweeted");
}
}
  


?>