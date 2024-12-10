<?php
session_start();
$supl_id=$_REQUEST['cust_id'];
include 'class/user.php';
 $user = new user();
 $getcust=$user->getSupplierCylinderList($supl_id);
?>
 <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Cylinder No.</th>
										<th>Challan No.</th>
										<th>Challan Date.</th>
										<th>Status</th>
										
									</tr>
								</thead>
								<tbody>
								    
								<?php 
							//	print_r($getcust);
								$count=1; foreach($getcust as $row){
								if($row['filled_status']==1)
								{
								    $status='Empty';
								}else if($row['filled_status']==2)
								{
								    $status='Filled';
								}else if($row['filled_status']==3)
								{
								    $status='Damaged';
								}else if($row['filled_status']==4)
								{
								    $status='Lost';
								}
								?>
								<tr>
										<td><?=$count;?></td>
										<td><?=$row['cy_no'];?></td>
										<td><?=$row['chln_no'];?></td>
										<td><?=date('d-m-Y',strtotime($row['chln_date']));?></td>
										<td><?=$status;?></td>
										
									</tr>
								<?php $count++; } ?>
									
								</tfoot>
							</table>
						</div>
					
        <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
  <script src="assets/js/table-datatable.js"></script>