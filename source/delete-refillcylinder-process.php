<?php 
session_start();
$cyId=$_POST['cyId'];
$refill_id=$_POST['refill_id'];
$cy_no=$_POST['cy_no'];
$deletecyno=$_POST['deletecyno'];
$deletecyId=$_POST['deletecyId'];
$cyNos=explode(",",$cy_no);
$cyId=explode(",",$cyId);
$position= array_search($deletecyno,$cyNos);
unset($cyNos[$position]);
unset($cyId[$position]);
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();
 $cyNos=implode(",",$cyNos);
$cyId=implode(",",$cyId);
$login_id=$_SESSION['login_id'];

$getrefdata=$user->deleteRefillCylinder($login_id,$cyNos,$cyId,$refill_id,$deletecyId,$currentDateTime);
?>
  