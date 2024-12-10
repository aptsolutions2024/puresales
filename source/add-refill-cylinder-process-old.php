<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
session_start();
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();
//print_r($_POST);die;
$refill_date=$_REQUEST['refill_date'];
$refill_document=$_REQUEST['refill_document'];
$cylinderR=$_REQUEST['cylinderR'];
$action=$_REQUEST['action'];
$editId=$_REQUEST['editId'];
$login_id=$_SESSION['login_id'];

if(sizeof($cylinderR) > 0)
{ 
if($action!='update')
{
$res=$user->insertRefillDelChln($login_id,$refill_date,$refill_document,$cylinderR,$currentDateTime);
$_SESSION['adddelmsg']='001';
}else
{
  $res=$user->updateRefillDelChln($editId,$login_id,$refill_date,$refill_document,$cylinderR,$currentDateTime);
$_SESSION['adddelmsg']='003';  
}
}

?>