<?php
session_start();
error_reporting(E_ALL);
include 'class/timeZone.php';
include 'class/user.php';
$user = new user();

$gasId=$_REQUEST['gasId'];
$cust_id=$_REQUEST['cust_id'];
$type=$_REQUEST['type'];
$selectedCyl=$_REQUEST['selectedCyl'];
//echo "---selectedCyl:".$selectedCyl;
if($gasId!='')
{
$res=$user->getEmptyCylinderByGasIdFactory($gasId);

//print_r($res);
$total=sizeof($res);
 if($total!=0){
foreach($res as $cylinder){
 //  $gasData=$user->getGasesbyId($gasId);
  //echo "---STR Pos.".strpos($selectedCyl,$cylinder['cy_id']);
   if(strpos($selectedCyl,$cylinder['cy_id'])>0){
       //echo "---In IF:";
   }else{
?>
<option value="<?=$cylinder['cy_id'];?>"><?=$cylinder['name']." - ".$cylinder['cy_no'];?></option>

<?php 
}
} } else{ ?>
<option value="">No cylinder available.</option>
<?php } }
else if($cust_id!='')
{
 $res=$user->getDeliveredCylByGasIdSupplier($cust_id);  
 $i=1;
 $total=sizeof($res);
 if($total!=0){
foreach($res as $cylinder){
     // $gasData=$user->getGasesbyCylId($cylinder['cy_id']);
?>
<!--<option value="<?=$cylinder['cy_id'].' - '.$cylinder['chln_id'];?>"><?=$cylinder['cy_no'].' - '.$cylinder['refill_document'];?></option>-->
<tr>
<th scope="row">
    <input type="checkbox" name="cylinderRetR[]" id="cylinderRetR<?=$cylinder['cy_id'];?>" value="<?=$cylinder['cy_id'];?>">
      <input type="hidden" name="cylinderRetranId[]" id="cylinderRetranId<?=$cylinder['cy_id'];?>" value="<?=$cylinder['id'];?>">
</th>
<td><?=$cylinder['name']." - ".$cylinder['cy_no'];?></td>
<td><?=$cylinder['refill_document'];?></td>
<td>
    <select class="form-select" id="status<?=$cylinder['cy_id'];?>" name="status[]">
        <option value="1">Empty</option>
        <option value="2">Filled</option>
        <option value="3">Damaged</option>
        <option value="4">Lost</option>
    </select>
</td>
<td>
 <input class="form-control" type="text" name="ret_remark[]" id="ret_remark<?=$cylinder['cy_id'];?>" value="<?=$cylinder['ret_remark'];?>">
</td>
</tr>
<?php $i++; } 
}else{ ?>
<tr><td colspan="5" style="text-align: center;color: #ff0000;">No Cylinders found.</td></tr>
<?php }} ?>
