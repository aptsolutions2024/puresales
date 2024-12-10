<?php
session_start();
error_reporting(0);
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();

$cust_id=$_REQUEST['cust_id'];
$chln_date=$_REQUEST['chln_date'];
$chln_id=$_REQUEST['chln_id'];

 $res=$user->getRefilledCylinder($cust_id,$chln_date,$chln_id);  
 $i=1;
 $total=sizeof($res);
 if($total!=0){
foreach($res as $cylinder){
  // echo "<pre>";print_r($cylinder);exit;
?>

<tr>
<th scope="row">
    <input type="hidden" name="retchlnno[]" id="retchlnno<?=$cylinder['id'];?>" value="<?=$cylinder['refill_document'];?>">
    <input type="hidden" name="cyId[]" id="cyId<?=$cylinder['id'];?>" value="<?=$cylinder['cy_id'];?>">
    <input type="checkbox" name="cylinderRetR[]" id="cylinderRetR<?=$cylinder['id'];?>" value="<?=$cylinder['id'];?>">
</th>
<td><?=$cylinder['name']." - ".$cylinder['cy_no'];?></td>
<td><?=$cylinder['refill_document'];?></td>
<td>
<select class="form-select" id="status<?=$cylinder['id'];?>" name="status[]">
<option value="1">Empty</option>
<option value="2">Filled</option>
<option value="3">Damaged</option>
<option value="4">Lost</option>
</select>
</td>
<td>
 <input class="form-control" type="text" name="ret_remark[]" id="ret_remark<?=$cylinder['id'];?>" value="<?=$cylinder['ret_remark'];?>">
</td>
</tr>
<?php $i++; } 
}else{ ?>
<tr><td colspan="5" style="text-align: center;color: #ff0000;">No Cylinders found.</td></tr>
<?php } ?>
