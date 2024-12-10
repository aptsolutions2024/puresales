<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);

include 'class/timeZone.php';
include 'class/user.php';
$user = new user();
$cust_id=$_REQUEST['custId'];

$res=$user->getCylinderBySuplId($cust_id);
 $total=sizeof($res);
 if($total!=0){ ?>
 <option value="">Select Challan</option>
<?php 
foreach($res as $cylinder){ ?>
<option value="<?=$cylinder['id'];?>"><?=$cylinder['refill_document'];?></option>
<?php } } else {?>
<option value="">No Cylinder Found.</option>
<?php } ?>
