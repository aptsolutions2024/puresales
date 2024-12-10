<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();

$cust_id='1';
$gas_id=$_REQUEST['gas_id'];
$cy_no=$_REQUEST['cy_no'];

$editId=$_REQUEST['editId'];
$action=$_REQUEST['action'];
$_SESSION['gas_id']=$_REQUEST['gas_id'];

$count=$user->countCylinder($cy_no);

/*
$torange=$cy_no+3;
$ins=0;
for($i=$cy_no;$i<=$torange;$i++){
   $res=$user->insertCylinderRangewise($cust_id,$gas_id,$i); 
   
   if($res){
       $ins++;
   }
}
echo "Records Inserted - ".$ins;
exit;*/

if($count=='0')
{ 
if($action!='update'){			

$res=$user->insertCylinder($cust_id,$gas_id,$cy_no);
$_SESSION['addcymsg']='001';
echo "<script>window.location.href='/add-cylinder';</script>";exit();
}else if($action=='update')
{
$res=$user->updateCylinder($editId,$cust_id,$gas_id,$cy_no);

$_SESSION['addcymsg']='003';
echo "<script>window.location.href='/add-cylinder';</script>";exit();	
}
}
 else
{
$_SESSION['addcymsg']='002';
echo "<script>window.location.href='/add-cylinder';</script>";exit();	
} 

?>