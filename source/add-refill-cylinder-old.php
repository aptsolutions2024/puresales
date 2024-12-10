<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - Refill Cylinder Details</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
 $getrefdata=$user->getRefillDatabyId($id);
  $getGas=$user->getAllGases();

  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Refill Cylinder Details( For Sending )</h5>
									</div>
									<hr>
									
									<?php if($_SESSION['adddelmsg']=='001'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully added Refill. </div>
									<?php } if($_SESSION['adddelmsg']=='002'){ ?>
									<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Refill already exists, Please try again. </div>
									<?php } if($_SESSION['adddelmsg']=='003'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully updated Refill. </div>
									<?php } ?>

									<form class="p-20" method="post" action="" autocomplete="off">
									<?php if($id!=''){ ?>
									<input type="hidden" name="action" id="action" value="update">
									<input type="hidden" name="editId" id="editId" value="<?=$id;?>">
									<?php } ?>

									
									<div class="row mb-3">
										<label for="chln_date" class="col-sm-3 col-form-label">Refill Document </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="refill_document"  name="refill_document" placeholder="Refill Document" value="<?=$getrefdata['refill_document'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="chln_date" class="col-sm-3 col-form-label">Refill Date <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="refill_date"  name="refill_date" value="<?=$getrefdata['refill_date'];?>">
										</div>
									</div>
								
									
									<div class="row mb-3">
										<label for="cylinderL" class="col-sm-3 col-form-label"></label>
										<div class="col-sm-4">
										    <label for="cylinderRetL" class=" col-form-label">Empty Cylinders</label>
											<select multiple size="15" class="form-control list" data-target="avaliable" name="cylinderL" id="cylinderL" style="height: 160px;">
											</select>
										</div>
										<div class="col-sm-1">
										<br>	<br><?php if($id!=''){ ?><br><?php } ?>
											<button type="button" id="moveall" class="btn btn-outline-info">>></button><br>
										   <button type="button" id="moveone" class="btn btn-outline-secondary" style="width: 44px;">></button><br>
										<?php if($id==''){ ?>
										   <button type="button" id="removeone" class="btn btn-outline-secondary" style="width: 44px;"><</button><br>
										   <button type="button" id="removeall" class="btn btn-outline-danger"><<</button><br>
										   <?php } ?>
										</div>
										<div class="col-sm-4">
										    <label for="cylinderRetL" class=" col-form-label">Selected for refilling</label>
											<select multiple size="15" class="form-control list" data-target="avaliable" name="cylinderR[]" id="cylinderR" style="height: 160px;">
											 <?php
											 if($id!='')
											 {
											     $cyNos=$getrefdata['cy_no'];
											     $cyId=$getrefdata['cy_id'];
											     $cyNos=explode(",",$cyNos);
											     $cyId=explode(",",$cyId);
											     foreach($cyNos as $key => $cno) { ?>
											      <option value="<?=$cyId[$key];?>"><?=$cno;?></option>   
											    <?php } } ?>
											</select>
										</div>
									</div>
								
									
									
									
								
									
									
									
									
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										<?php if($id==''){ ?>
											<button type="button" class="btn btn-primary px-5" onclick="validation();">Save</button>
											<?php } else { ?>
											<button type="button" class="btn btn-primary px-5" onclick="validation();">Update</button>
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
$( document ).ready(function() {
    getCylinder(0);
});

 function validation()
{
<?php unset($_SESSION['adddelmsg']);?>
var refill_date=$("#refill_date").val();
var refill_document=$("#refill_document").val();
var action=$("#action").val();
var editId=$("#editId").val();

var cylinderR=[]; 
$('select[name="cylinderR[]"] option:selected').each(function() {
    cylinderR.push($(this).val());
});

$("#refill_date").removeClass('bordererror');

if(refill_date==""){
   $("#refill_date").focus();
   errors ="Please enter date";
   $("#refill_date").val('');
   $("#refill_date").addClass('bordererror');
   $("#refill_date").attr("placeholder", errors);
   return false;
} else if(cylinderR ==""){
   alert("Please select cylinder!.")
}  else
{
    $.post('/add-refill-cylinder-process', {
          'refill_date': refill_date,
          'refill_document': refill_document,
          'cylinderR': cylinderR,
          'action': action,
          'editId': editId
          }, function (data) {
		  //alert(data);
          location.reload();
      });
}
}

function getCylinder(gasId)
{
$.post('/get-refill-cylinders-by-gasid', {
          'gasId': gasId
		  }, function (data) {
		 $("#cylinderL").html(data);
      });	
}
$('#moveone').click(function () {
return !$('#cylinderL option:selected').remove().appendTo('#cylinderR');
});
$('#removeone').click(function () {
    var aaa=$("#cylinderR").val();
    alert(aaa);
return !$('#cylinderR option:selected').remove().appendTo('#cylinderL');
});
$('#moveall').click(function () {
return !$('#cylinderL option').remove().appendTo('#cylinderR');
});
$('#removeall').click(function () {
return !$('#cylinderR option').remove().appendTo('#cylinderL');
});
</script>

</body>

</html>