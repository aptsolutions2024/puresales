<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - Delivery Challan Details</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  //$getcust=$user->getCustomerbyId($id);
  $getcust=$user->getAllCustomers();
  $getGas=$user->getAllGases();
  //print_r($getcust);
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Delivery Challan Details</h5>
									</div>
									<hr>
									
									<?php if($_SESSION['adddelmsg']=='001'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully added Cylinder. </div>
									<?php } if($_SESSION['adddelmsg']=='002'){ ?>
									<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Cylinder already exists, Please try again. </div>
									<?php } if($_SESSION['adddelmsg']=='003'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You successfully updated Cylinder. </div>
									<?php } ?>

									<form class="p-20" method="post" action="/add-delivered-process" onsubmit="return validation();" autocomplete="off">
									<?php if($id!=''){ ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="editId" value="<?=$id;?>">
									<?php } ?>

												
									<div class="row mb-3">
										<label for="name" class="col-sm-3 col-form-label">Select Customer <span class="mandotry">*</span></label>
										<div class="col-sm-9">
										    
											<select class="form-select" id="cust_id" name="cust_id" >
											    <option value="">Select Customer</option>
											    <?php foreach($getcust as $cust){ ?>
											    <option value="<?=$cust['cust_id'];?>"><?=$cust['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="challan_no" class="col-sm-3 col-form-label">Challan No <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control " id="challan_no"  name="challan_no" placeholder="Challan No" value="<?=$getdele['chln_no'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="chln_date" class="col-sm-3 col-form-label">Challan Date <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="chln_date"  name="chln_date" placeholder="Challan No" value="<?=$getdele['chln_date'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle No <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="vehicle_no"  name="vehicle_no" placeholder="Vehicle No" value="<?=$getdele['vehicle_no'];?>">
										</div>
									</div>
									
									
									<div class="row mb-3">
									 <label for="vehicle_no" class="col-sm-3 col-form-label"></label>
									<div class="col-sm-9">
									<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
												</div>
												<div class="tab-title">Delivered</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												<div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
												</div>
												<div class="tab-title" onclick="getReturnCylinders();">Returned</div>
											</div>
										</a>
									</li>
									
								</ul>
								</div>
									</div>
									
									<div class="tab-content py-3">
									<div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
									
									<div class="row mb-3">
									    	<div class="col-sm-3"></div>
										<label for="gas_id" class="col-sm-2 col-form-label">Select Gas <span class="mandotry">*</span></label>
										<div class="col-sm-7">
										    
											<select class="form-select" id="gas_id" name="gas_id" onchange="getCylinder(this.value);">
											    <option value="">Select Gas</option>
											    <?php foreach($getGas as $gas){ ?>
											    <option value="<?=$gas['gas_id'];?>"><?=$gas['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
									</div>
									<div class="row mb-3">
										<label for="cylinderL" class="col-sm-3 col-form-label"></label>
										<div class="col-sm-4">
										    <label for="cylinderRetL" class=" col-form-label">From Pure Sales</label>
											<select multiple size="15" class="form-control list" data-target="avaliable" name="cylinderL" id="cylinderL" style="height: 160px;">
											</select>
										</div>
										<div class="col-sm-1">
										<br>	<br>
											<button type="button" id="moveall" class="btn btn-outline-info">>></button><br>
										   <button type="button" id="moveone" class="btn btn-outline-secondary" style="width: 44px;">></button><br>
										
										   <button type="button" id="removeone" class="btn btn-outline-secondary" style="width: 44px;"><</button><br>
										   <button type="button" id="removeall" class="btn btn-outline-danger"><<</button><br>
										</div>
										<div class="col-sm-4">
										    <label for="cylinderRetL" class=" col-form-label">To Customer</label>
											<select multiple size="15" class="form-control list" data-target="avaliable" name="cylinderR[]" id="cylinderR" style="height: 160px;">
											</select>
										</div>
									</div>
									</div>
									<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
									    
										<input type="hidden" name="delivery_action" value="2">
										
										<div class="row mb-3">
										    	<div class="col-sm-3"></div>
										<table class="table table-bordered tblwidth">
                                          <thead>
                                            <tr>
                                              <th scope="col">#</th>
                                              <th scope="col">Cylinder No.</th>
                                              <th scope="col">Challan No.</th>
                                              <th scope="col">Status</th>
                                              
                                            </tr>
                                          </thead>
                                          <tbody id="cylinderRetL">
                                           
                                          </tbody>
                                        </table>
									</div>
									
									</div>
									</div>
									
									
								
									
									
									
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										
											<button type="submit" class="btn btn-primary px-5">Save</button>
										
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
<?php unset($_SESSION['adddelmsg']);?>
var cust_id=$("#cust_id").val();
var challan_no=$("#challan_no").val();
var chln_date=$("#chln_date").val();
var vehicle_no=$("#vehicle_no").val();
var cy_action=$("#cy_action").val();
var gas_id=$("#gas_id").val();

$("#cust_id").removeClass('bordererror');
$("#challan_no").removeClass('bordererror');
$("#chln_date").removeClass('bordererror');
$("#vehicle_no").removeClass('bordererror');
$("#cy_action").removeClass('bordererror');
$("#gas_id").removeClass('bordererror');

if(cust_id==""){
   $("#cust_id").focus();
   errors ="Please enter name";
   $("#cust_id").val('');
   $("#cust_id").addClass('bordererror');
   $("#cust_id").attr("placeholder", errors);
   return false;
} else if(challan_no ==""){
   $("#challan_no").focus();
   errors ="Please enter challan no";
   $("#challan_no").val('');
   $("#challan_no").addClass('bordererror');
   $("#challan_no").attr("placeholder", errors);
   return false;
} else if(chln_date ==""){
   $("#chln_date").focus();
   errors ="Please enter challan date";
   $("#chln_date").val('');
   $("#chln_date").addClass('bordererror');
   $("#chln_date").attr("placeholder", errors);
   return false;
} else if(vehicle_no ==""){
   $("#vehicle_no").focus();
   errors ="Please enter vehicle no";
   $("#vehicle_no").val('');
   $("#vehicle_no").addClass('bordererror');
   $("#vehicle_no").attr("placeholder", errors);
   return false;
} else if(cy_action ==""){
   $("#cy_action").focus();
   errors ="Please select action";
   $("#cy_action").val('');
   $("#cy_action").addClass('bordererror');
   $("#cy_action").attr("placeholder", errors);
   return false;
} /*else if(gas_id ==""){
   $("#gas_id").focus();
   errors ="Please select gas";
   $("#gas_id").val('');
   $("#gas_id").addClass('bordererror');
   $("#gas_id").attr("placeholder", errors);
   return false;
} */ 
}
$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
   }
 });

function getCylinder(gasId)
{
$.post('/get-filled-cylinder-by-gasid', {
          'gasId': gasId
		  }, function (data) {
		  //alert(data);
          $("#cylinderL").html(data);
      });	
}
function getReturnCylinders()
{
var cust_id=$("#cust_id").val();
$.post('/get-filled-cylinder-by-gasid', {
          'cust_id': cust_id
		  }, function (data) {
		  //alert(data);
          $("#cylinderRetL").html(data);
      });	
}
$('#moveone').click(function () {
return !$('#cylinderL option:selected').remove().appendTo('#cylinderR');
});
$('#removeone').click(function () {
return !$('#cylinderR option:selected').remove().appendTo('#cylinderL');
});
$('#moveall').click(function () {
return !$('#cylinderL option').remove().appendTo('#cylinderR');
});
$('#removeall').click(function () {
return !$('#cylinderR option').remove().appendTo('#cylinderL');
});

</script>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Cylinder Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <input type="hidden" id="cy_id_chln_id" name="cy_id_chln_id" value="">
                <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Select Status <span class="mandotry">*</span></label>
                <div class="col-sm-9">
                
                <select class="form-select" id="status" name="status">
                <option value="">Select Status</option>
                <option value="1">Empty</option>
                <option value="2">Filled</option>
                <option value="3">Damaged</option>
                <option value="4">Lost</option>
                </select>
                </div>
                </div>
          </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="changeStatus();">Save Staus</button>
        </div>
        </div>
        </div>
    </div>
<script>
    function changeStatus()
    {
       var cy_id_chln_id=$("#cy_id_chln_id").val(); 
       var status=$("#status").val(); 
       var cust_id=$("#cust_id").val();
       var type='addStatus';
      // var test=cy_id_chln_id+' - '+status;
       //var option1="<option value='test'>test</option>"
        /*var option = $('<option value="'+test+'">'+test+'</option>');
        $('#cylinderRetR').append(option);*/
       
       
       $.post('/get-filled-cylinder-by-gasid', {
          'cy_id_chln_id': cy_id_chln_id,
          'status': status,
          'cust_id': cust_id,
          'type': type
		  }, function (data) {
		  //alert(data);
          $("#cylinderRetR").append(data);
      });
    }
</script>
</body>

</html>