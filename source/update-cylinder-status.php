<?php
error_reporting(0);
session_start();
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();

$gasId=$_REQUEST['gasId'];
$cust_id=$_REQUEST['cust_id'];
if($gasId!='')
{
$res=$user->getCylinderByGasIdFactory($gasId);
foreach($res as $cylinder){
   
?>
<option value="<?=$cylinder['cy_id'];?>"><?=$cylinder['cy_no'];?></option>

<?php 
} 
}else
{
 $res=$user->getCylinderByGasIdCustomer($cust_id);  
foreach($res as $cylinder){
   
?>
<option value="<?=$cylinder['cy_id'].' - '.$cylinder['chln_id'];?>"><?=$cylinder['cy_no'].' - '.$cylinder['chln_no'];?></option>

<?php } }?>