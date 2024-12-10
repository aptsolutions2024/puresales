<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - Add Cylinder</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  $getcyl=$user->getCylinderbyId($id);
  $getGas=$user->getAllGases();
  //print_r($getcust);
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Cylinder Details</h5>
									</div>
									<hr>
									
									<?php if($_SESSION['addcymsg']=='001'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully added Cylinder. </div>
									<?php } if($_SESSION['addcymsg']=='002'){ ?>
									<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Cylinder already exists, Please try again. </div>
									<?php } if($_SESSION['addcymsg']=='003'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully updated Cylinder. </div>
									<?php } ?>

									<form class="p-20" method="post" action="/add-cylinder-process" onsubmit="return validation();" autocomplete="off">
									<?php if($id!=''){ ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="editId" value="<?=$id;?>">
									<?php } ?>

												
								
									<div class="row mb-3">
									  
										<label for="name" class="col-sm-3 col-form-label">Select Gas <span class="mandotry">*</span></label>
										<div class="col-sm-9">
										    
											<select class="form-select" id="gas_id" name="gas_id" onchange="getCylinder(this.value);">
											    <option value="">Select Gas</option>
											    <?php 
											    
											    foreach($getGas as $gas){ ?>
											    <option <?php if($getcyl['gas_id']==$gas['gas_id']){ echo "selected";} ?> <?php if($_SESSION['gas_id']==$gas['gas_id']){ echo "selected";} ?> value="<?=$gas['gas_id'];?>"><?=$gas['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="cy_no" class="col-sm-3 col-form-label">Cylinder No <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="cy_no"  name="cy_no" placeholder="Cylinder No" value="<?=$getcyl['cy_no'];?>">
										</div>
									</div>
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										<?php if($id==''){ ?>
											<button type="submit" class="btn btn-primary px-5">Submit</button>
										<?php }else { ?>
										<button type="submit" class="btn btn-primary px-5">Update</button>
										<?php } ?>
										</div>
									</div>
									</form>
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
 function validation()
{
<?php unset($_SESSION['addcymsg']);?>
var gas_id=$("#gas_id").val();
var cy_no=$("#cy_no").val();

$("#gas_id").removeClass('bordererror');
$("#cy_no").removeClass('bordererror');

if(gas_id ==""){
   $("#gas_id").focus();
   errors ="Please enter gas";
   $("#gas_id").val('');
   $("#gas_id").addClass('bordererror');
   $("#gas_id").attr("placeholder", errors);
   return false;
} else if(cy_no ==""){
   $("#cy_no").focus();
   errors ="Please enter cylinder no.";
   $("#cy_no").val('');
   $("#cy_no").addClass('bordererror');
   $("#cy_no").attr("placeholder", errors);
   return false;
} 
}
$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
   }
 });
</script>
</body>

</html>