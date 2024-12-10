<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - Delete Refill Cylinder</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $id = base64_decode($_GET['ID']);
  $getrefdata=$user->getRefillDatabyId($id);
  ?>


       <!--start content-->
          <main class="page-content">
              
            <div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Cylinder No.</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $count=1; 
								$cyNos=$getrefdata['cy_no'];
							     $cyId=$getrefdata['cy_id'];
							     $cyNos=explode(",",$cyNos);
							     $cyId=explode(",",$cyId);
								foreach($cyNos as $key => $cy_no){ ?>
								<tr>
										<td><?=$count;?></td>
										<td><?=$cy_no;?></td>
										<td>
                              <div class="d-flex align-items-center gap-3 fs-6">
                                <a onclick="deleteRefillCylinder('<?=$cyId[$key];?>','<?=$cy_no;?>')" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill" ></i></a>
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
<script>
function deleteRefillCylinder(deletecyId,deletecyno)
{
    var cy_no='<?=$getrefdata['cy_no'];?>';
    var cyId='<?=$getrefdata['cy_id'];?>';
    var refill_id='<?=$getrefdata['id'];?>';
    $.post('/delete-refillcylinder-process', {
          'cyId': cyId,
          'cy_no': cy_no,
          'refill_id': refill_id,
          'deletecyno': deletecyno,
          'deletecyId': deletecyId
          }, function (data) {
		  //alert(data);
          location.reload();
      });
}
</script>
</body>

</html>