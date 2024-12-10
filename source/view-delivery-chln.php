<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - View Delivery Challan</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();

    if(isset($_REQUEST['submit'])) 
    { 
        $from_date = date('Y-m-d',strtotime($_REQUEST['from_date']));
        $to_date = date('Y-m-d',strtotime($_REQUEST['to_date']));
        $getdelcln=$user->getDeliveryChallanByDate($from_date,$to_date);
    }
  ?>
       <!--start content-->
          <main class="page-content">
            <div class="card">
					<div class="card-body">
					    <div class="card-title d-flex align-items-center">
										<h5 class="mb-0">View Customer Delivery Challan Details</h5>
									</div>
									<hr>
					 <form class="p-20" method="post" action="/view-delivery-chln" autocomplete="off">
				       <div class="row">
                            <div class="col-md-3">
                               <label class="form-label">From Date<label class="mandatory">*</label></label>
                               <input id="from_date" name="from_date" type="date" class="form-control" value="<?=($_REQUEST['from_date'])?$_REQUEST['from_date']:date('Y-m-01');?>">
                            </div>
                            <div class="col-md-3">
                               <label class="form-label">To Date<label class="mandatory">*</label></label>
                               <input id="to_date" name="to_date" type="date" class="form-control" value="<?=($_REQUEST['to_date'])?$_REQUEST['to_date']:date('Y-m-t')?>">
                            </div>
                            <div class="col-md-2" style="margin-top:auto;">
                                <input type="submit" class="btn btn-primary" name='submit' value="submit">
                            </div>
                           
                        </div>
                           </br></br>
             </form>
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Action</th>
										<th>Gas-Cylinder No.</th>
										<th>Customer</th>
										<th>Del. Challan No.</th>
										<th>Del. Challan Date</th>
										<th>Del. Vehicle No.</th>
										<th>Ret. Status</th>
										<th>Ret. Challan Date</th>
										<th>Ret. Challan No.</th>
										<th>Ret. Challan ID.</th>
										<th>Remark</th>
									</tr>
								</thead>
								<tbody>
								    
								<?php $count=1; 
							//	echo "<pre>".print_r($getdelcln)."</pre>";	
								foreach($getdelcln as $row){
								$getcust=$user->getCustomerbyId($row['cust_id']);
									$getgas=$user->getGasesbyCylId($row['cy_id']);
										$retChlnDate=$user->getCylinderByChallanId($row['ret_chln_id']);
							//	$getgas=$user->getGasesbyId($getgasDet['gas_id']);
								$ret_status='';
								$ret_status1='';
								$del_status='';
								$del_status1='';
								if($row['filled_status']==1)
								{
								    $del_status="<span class='badge bg-light-warning w-100' style='color:darkviolet;'>Empty</span>";
								}else if($row['filled_status']==2)
								{
								    $del_status="<span class='badge bg-light-success text-success w-100'>Filled</span>";
								}else if($row['filled_status']==3)
								{
								    $del_status="<span class='badge bg-light-danger text-danger w-100'>Damaged</span>";
								}else if($row['filled_status']==4)
								{
								    $del_status="<span class='badge bg-light-danger text-danger w-100'>Lost</span>";
								}
								
								//for action
								if($row['action']==1)
								{								    
								    $del_status1="<span class='badge bg-light-success text-success w-100'>Delivered</span>";
								    
								} 
								
								//for return
							
									if($row['ret_status']==1)
								{
								    $ret_status="<span class='badge bg-light-warning w-100' style='color:darkviolet;'>Empty</span>";
								}else if($row['ret_status']==2)
								{
								    $ret_status="<span class='badge bg-light-success text-success w-100'>Filled</span>";
								}else if($row['ret_status']==3)
								{
								    $ret_status="<span class='badge bg-light-danger text-danger w-100'>Damaged</span>";
								}else if($row['ret_status']==4)
								{
								    $ret_status="<span class='badge bg-light-danger text-danger w-100'>Lost</span>";
								}
								
								if($row['filled_status']==2)
								{
								   $ret_status1="<span class='badge bg-light-warning text-warning w-100'>Returned</span>";
								}
								?>
								<tr class="<?=($row['ret_chln_id'])?'text-primary':'text-danger';?>">
										<td><?=$count;?></td>
											<td>
                                          <div class="d-flex align-items-center gap-3 fs-6">
                                            <a href="print-delivery-challan?ID=<?php echo base64_encode($row['mast_id']); ?>"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Print info" aria-label="Print" style="color:black;"><i class="bi bi-printer"></i></a>
                                        
                                          </div>
                                        </td>
										<td><?=$getgas['name']." - ". $row['cy_no'];?></td>
										<!--<td><?=$row['cy_no'];?></td>-->
										<td><?=$getcust['name'];?></td>
										<td><?=$row['chln_no'];?></td>
										<td><?=date('d-m-Y',strtotime($row['chln_date']));?></td>
										<td><?=$row['vehicle_no'];?></td>
										<!--<td><?=$del_status1;?></td>-->
										<!--<td><?=$del_status;?></td>-->
											<td><?=$ret_status;?></td>
										<td><?=($retChlnDate['chln_date'])?date('d-m-Y',strtotime($retChlnDate['chln_date'])):"";?></td>
										<td><?=$row['ret_chln_no'];?></td>
										<td><?=$row['ret_chln_id'];?></td>
									
										<!--<td><?=$ret_status1;?></td>-->
										<td><?=$row['ret_remark'];?></td>
									
									</tr>
								<?php $count++; } ?>
									
								</tfoot>
							</table>
						</div>
					</div>
				</div>
				

          </main>
       <!--end page main-->

       <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
       <!--end overlay-->

       <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
       <!--End Back To Top Button-->

       <!--start switcher-->
       

  </div>
  <!--end wrapper-->



<?php include 'footer.php'; ?>

</body>

</html>