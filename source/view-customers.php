<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - View Customer</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $getcust=$user->getAllCustomers();
  ?>


       <!--start content-->
          <main class="page-content">
              
            <div class="card">
					<div class="card-body">
					    <div class="card-title d-flex align-items-center">
										<h5 class="mb-0">View Customer Details</h5>
									</div>
									<hr>
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Email</th>
										<th>GST No.</th>
										<th>Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $count=1; foreach($getcust as $row){ ?>
								<tr>
										<td><?=$count;?></td>
										<td><?=$row['name'];?></td>
										<td><?=$row['mobile'];?></td>
										<td><?=$row['email'];?></td>
										<td><?=$row['gstno'];?></td>
										<td><?=$row['address'];?></td>
										
										<td>
                              <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="add-customer?ID=<?php echo base64_encode($row['cust_id']); ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>
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