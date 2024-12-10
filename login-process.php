<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'source/class/user.php';
$user = new user();
$username=$_REQUEST['username'];
$loginpass=$_REQUEST['password'];

$total=$user->loginCountDetails($username,$loginpass);
if($total=='1')
{
$res=$user->loginDetails($username,$loginpass);

$_SESSION['login_id']=$res['login_id'];
$_SESSION['name']=$res['name'];
$_SESSION['role']=$res['role'];

if($res['role']=='1')
{
	//print_r($_SESSION);exit;
echo "<script>window.location.href='/dashboard';</script>";exit();	
}

}
else
{
$_SESSION['msg']='003';
echo "<script>window.location.href='/home';</script>";exit();
}


?>