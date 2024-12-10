<?php
session_start();
$challan_id=$_REQUEST['challan_id'];
$cust_id=$_REQUEST['cust_id'];
include 'class/user.php';
$user = new user();
$gettran=$user->getSuppliersCylinderByChallanDeli($challan_id);
//$gettranret=$user->getCustomersCylinderByChallanRet($challan_id);

?>
<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <div class="table-responsive">
    <table id="example2" class="table table-striped table-bordered">
    <thead>
    <tr>
    <th>#</th>
    <th>Cylinder No.</th>
    <th>Cylinder Action</th>
    <th>Other Details</th>
    <th>Action</th>
    
    </tr>
    </thead>
    <tbody>
    <?php $count=1; foreach($gettran as $row){
    if($row['ret_status']==1)
    {
    $status='Empty';
    }else if($row['ret_status']==2)
    {
    $status='Filled';
    }else if($row['ret_status']==3)
    {
    $status='Damaged';
    }else if($row['ret_status']==4)
    {
    $status='Lost';
    }
    if($row['action']==1)
    {
    $caction='Sent for Refilling';
    }else if($row['action']==2)
    {
    $caction='Receipt from Refilling';
    }
    ?>
    <tr>
    <td><?=$count;?></td>
    <td><?=$row['cy_no'];?></td>
    <td><?=$caction;?></td>
    <?php if($row['ret_chln_id'] > 0) {?>
    <td>Returned Through - <?=$row['ret_chln_no'];?> ; Status - 
    <?=$status;?></td>
    <?php } else { echo "<td> - </td>";}?>
    <td>
        <div class="d-flex align-items-center gap-3 fs-6">
       <?php if($row['ret_chln_id']==0 || $row['ret_chln_id']=='' || $row['ret_chln_id']==$challan_id) {?>
      
        <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete" onclick="deleteDeliveredC('<?=$row['id'];?>','<?=$challan_id;?>','<?=$row['cy_id'];?>','<?=$cust_id;?>','<?=$row['action'];?>');"><i class="bi bi-trash-fill"></i></a>
        <?php } ?>
        </div>
    </td>
    </tr>
    <?php $count++; } ?>
    
    
   
    
    
    </tfoot>
    </table>
    </div>

<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/table-datatable.js"></script>

<script>
    function deleteDeliveredC(tran_id,chln_Id,cy_id,cust_id,action)
    {
     $.post('/delete-supplier-challan', {
          'tran_id':tran_id,
          'chln_Id': chln_Id,
          'cy_id':cy_id,
          'cust_id':cust_id,
          'action':action
		  }, function (data) {
		      alert(data);
             validation();
      });
    }
</script>