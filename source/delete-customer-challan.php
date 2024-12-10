<?php 
error_reporting(E_ALL);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  $chln_Id=$_REQUEST['chln_Id'];
  $tran_id=$_REQUEST['tran_id'];
  $action=$_REQUEST['action'];
  $cy_id=$_REQUEST['cy_id'];
  $cust_id=$_REQUEST['cust_id'];
  if($action=='1'){
  $delres=$user->deleteCustomerDelChln($tran_id,$chln_Id,$cy_id);
  }elseif($action=='2'){
   $delres=$user->deleteCustomerRetChln($tran_id,$chln_Id,$cy_id,$cust_id); 
  }
 // echo $delres;
  //print_r($getcust);
  ?>
  