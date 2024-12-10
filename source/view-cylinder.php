<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - View Cylinder</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $getcyl=$user->getAllCylinder();
  ?>


       <!--start content-->
          <main class="page-content">
              
            <div class="card">
					<div class="card-body">
					    <div class="card-title d-flex align-items-center">
										<h5 class="mb-0">View Cylinder Details</h5>
									</div>
									<hr>
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Gas</th>
										<th>Cylinder No.</th>
										<th>Location</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $count=1; foreach($getcyl as $row){
								 if($row['cust_id']){   
								    $getcust=$user->getCustomerbyId($row['cust_id']);
								 }elseif($row['supl_id']){
							    	$getcust=$user->getSupplierbyId($row['supl_id']);
								 }
								$getgas=$user->getGasesbyId($row['gas_id']);
								if($row['filled_status']==1)
								{
								    $status="<span class='badge bg-light-warning text-warning w-100'>Empty</span>";
								}else if($row['filled_status']==2)
								{
								    $status="<span class='badge bg-light-success text-success w-100'>Filled</span>";
								}else if($row['filled_status']==3)
								{
								    $status="<span class='badge bg-light-danger text-danger w-100'>Damaged</span>";
								}else if($row['filled_status']==4)
								{
								    $status="<span class='badge bg-light-danger text-danger w-100'>Lost</span>";
								}
								?>
								<tr>
										<td><?=$count;?></td>
										<td><?=$getgas['name'];?></td>
										<td><?=$row['cy_no'];?></td>
										<td><?=$getcust['name'];?></td>
										<td><?=$status;?></td>
										<td>
                              <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="add-cylinder?ID=<?php echo base64_encode($row['cy_id']); ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <!--<a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>-->
                              </div>
                            </td>
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