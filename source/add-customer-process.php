<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
session_start();
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();
//print_r($_POST);die;
$name=$_REQUEST['name'];
// $phone_no=$_REQUEST['phone_no'];
$phone_no ='0000000000';
$email=$_REQUEST['email'];
$gst_no=$_REQUEST['gst_no'];
$address=$_REQUEST['address'];

$editId=$_REQUEST['editId'];
$action=$_REQUEST['action'];

if($action!='update'){			
// $count=$user->countCustomer($phone_no);
//if($count=='0')
{ 
$res=$user->insertCustomer($name,$phone_no,$email,$gst_no,$address,$currentDateTime);
$_SESSION['addcustmsg']='001';
echo "<script>window.location.href='/add-customer';</script>";exit();
}
/* else
{
$_SESSION['addcustmsg']='002';
echo "<script>window.location.href='/add-customer';</script>";exit();	
} */
}
else if($action=='update')
{
$res=$user->updateCustomer($editId,$name,$phone_no,$email,$gst_no,$address,$currentDateTime);

$_SESSION['addcustmsg']='003';
echo "<script>window.location.href='/add-customer';</script>";exit();	
}
?>