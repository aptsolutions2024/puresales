<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);

include 'class/timeZone.php';
include 'class/user.php';
$user = new user();
//print_r($_POST);die;
$cust_id=$_REQUEST['cust_id'];
$challan_id=$_REQUEST['challan_id'];
$challan_no=$_REQUEST['challan_no'];
$chln_date=$_REQUEST['chln_date'];
$vehicle_no=$_REQUEST['vehicle_no'];
$cy_action=$_REQUEST['cy_action'];
$gas_id=$_REQUEST['gas_id'];
$cylinderR=$_REQUEST['cylinderR'];


$cylinderRetR=$_REQUEST['cylinderRetR'];  //tran_del_chln-id
$login_id=$_SESSION['login_id'];

$editId=$_REQUEST['editId'];
$action=$_REQUEST['action'];
if($action!='editAction')
{
if(sizeof($cylinderR) > 0 || sizeof($cylinderRetR) > 0)
{  
$res=$user->insertMastDelChln($login_id,$cust_id,$challan_no,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR,$currentDateTime);
$_SESSION['adddelmsg']='001';
}

}else if($action=='editAction')
{
$res=$user->updateDelChln($cust_id,$challan_id,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR);
}


?>