<?php
//include("DBFunctions.php");

if (is_ajax()) {
  if (isset($_POST["method"]) && !empty($_POST["method"])) { //Checks if action value exists
    $action = $_POST["method"];
    switch($action) { //Switch case for value of action
      case "getCityFun": getCityFun(); break;
	  case "getTimeSlot": getTimeSlot(); break;
    }
  }
}
//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
function mysql_funX_connect()
  {
    @mysql_connect("localhost","root","") or die("Server is Not Connected");
    @mysql_select_db("healthinhand_db") or die("Invalid Database");
  }
function getCityFun(){

     mysql_funX_connect();
     $state = $_POST['state'];

    $query  = "Select * from city_master Where state_id=$state";
    $result = mysql_query($query);
    $temp = array();

      while ($row = mysql_fetch_array($result)) {
         if(empty($temp))
         {
          $data = $row['city']."/".$row['city_id'];
           $temp=array($data);
         }
         else
         {  
          $data = $row['city']."/".$row['city_id'];
           array_push($temp,$data);
         }

      }

      
      echo json_encode($temp);
     } 
function getTimeSlot(){

     mysql_funX_connect();
     $apDate = $_POST['txtDate'];
	$docid = $_POST['hidView'];
	
    $query  = "SELECT timing_slot_id, timing FROM `slot_master` Where timing_slot_id NOT IN (Select timing_slot_id From appointment_master Where ap_date = '$apDate' and doctor_id='$docid')";
   // echo $query;
	$result = mysql_query($query);
    $temp = array();

      while ($row = mysql_fetch_array($result)) {
         if(empty($temp))
         {
          $data = $row['timing']."/".$row['timing_slot_id'];
           $temp=array($data);
         }
         else
         {  
          $data = $row['timing']."/".$row['timing_slot_id'];
           array_push($temp,$data);
         }

      }
      echo json_encode($temp);
    } 
?>