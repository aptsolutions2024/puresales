<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - Customer Cylinder Details</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  include 'class/user.php';
  $user = new user();
  $getcust=$user->getAllSuppliers();
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Supplier Cylinder Details</h5>
									</div>
									<hr>
									
									<form class="p-20" method="post" autocomplete="off">
									<div class="row mb-3">
										<label for="cust_id" class="col-sm-3 col-form-label">Select Supplier <span class="mandotry">*</span></label>
										<div class="col-sm-6">
											<select class="form-select" id="cust_id" name="cust_id">
											    <option value="">Select Supplier</option>
											    <?php foreach($getcust as $cust){ ?>
											    <option value="<?=$cust['supl_id'];?>"><?=$cust['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
										<div class="col-sm-3">
										
											<button type="button" class="btn btn-primary px-5" onclick="showCustomerCylinder();">Search</button>
										
										</div>
									</div>
									
									</form>
									
									<div id="showCustomerCylinder"></div>
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
 function showCustomerCylinder(cust_id)
{
var cust_id=$("select#cust_id").val();
//alert(cust_id);
$("#cust_id").removeClass('bordererror');
if(cust_id==""){
   $("#cust_id").focus();
   errors ="Please enter name";
   $("#cust_id").val('');
   $("#cust_id").addClass('bordererror');
   $("#cust_id").attr("placeholder", errors);
   return false;
}else
{
 $.post('/show-supplier-cylinder', {
          'cust_id': cust_id
		  }, function (data) {
		  //alert(data);
          $("#showCustomerCylinder").html(data);
      });   
}
}

</script>
</body>

</html>