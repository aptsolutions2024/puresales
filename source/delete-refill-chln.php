<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - View Challan Details</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  //$getcust=$user->getCustomerbyId($id);
  $getcust=$user->getAllSuppliers();
  $getGas=$user->getAllGases();
  //print_r($getcust);
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Delete Supplier Refilling Challan Details</h5>
									</div>
									<hr>
									
									
									<form class="p-20" method="post" action="" autocomplete="off">
												
									<div class="row">
									<div class=" mb-3 col-sm-5">
									<!--	<label for="name" class="col-sm-3 col-form-label">Select Customer <span class="mandotry">*</span></label>-->
										<div class="col-sm-12">
										    
											<select class="form-select" id="cust_id" name="cust_id" onchange="getCylinderByCustId(this.value);">
											    <option value="">Select Supplier</option>
											    <?php foreach($getcust as $cust){ ?>
											    <option value="<?=$cust['supl_id'];?>"><?=$cust['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
									</div>
									<div class=" mb-3 col-sm-5">
									<!--	<label for="challan_id" class="col-sm-3 col-form-label">Select Challan No <span class="mandotry">*</span></label>-->
										<div class="col-sm-12">
											<select class="form-select" id="challan_id" name="challan_id" onchange="validation();">
											    <option value="">Select Challan</option>
											    
											 </select>
										</div>
									</div>
									<div class=" mb-3 col-sm-2">
									<!--	<label for="challan_id" class="col-sm-3 col-form-label">Select Challan No <span class="mandotry">*</span></label>-->
										<!--<div class="col-sm-12">-->
										<!--	<button type="button" class="btn btn-primary px-5" onclick="validation();">Show</button>-->
										<!--</div>-->
									</div>
									</div>
									
									
									</form>
									<div id="ShowData"></div>
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
<?php unset($_SESSION['adddelmsg']);?>
var cust_id=$("#cust_id").val();
var challan_id=$("#challan_id").val();

$("#cust_id").removeClass('bordererror');
$("#challan_id").removeClass('bordererror');

if(cust_id==""){
   $("#cust_id").focus();
   errors ="Please enter name";
   $("#cust_id").val('');
   $("#cust_id").addClass('bordererror');
   $("#cust_id").attr("placeholder", errors);
   return false;
} else if(challan_id ==""){
   $("#challan_id").focus();
   errors ="Please enter challan no";
   $("#challan_id").val('');
   $("#challan_id").addClass('bordererror');
   $("#challan_id").attr("placeholder", errors);
   return false;
} else
{
    $.post('/show-supplier-cylinder-by-challan', {
          'challan_id':challan_id,
          'cust_id':cust_id,
          }, function (data) {
		  $("#ShowData").html(data);
          
      });
}
}

function getCylinderByCustId(custId)
{
   // $("#ShowData").hide();
 $.post('/get-cylinders-by-supId', {
          'custId': custId
          }, function (data) {
		  //alert(data);
		  $("#challan_id").html(data);
      });   
}
</script>
</body>

</html>