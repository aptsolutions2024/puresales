<?php
session_start();
?>
<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - Dashboard</title>
  <?php include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  $getsupl=$user->getSupplierbyId($id);
  //print_r($getsupl);
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Supplier Details</h5>
									</div>
									<hr>
									
									<?php if($_SESSION['addcustmsg']=='001'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully added Supplier. </div>
									<?php } if($_SESSION['addcustmsg']=='002'){ ?>
									<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Duplicate mobile no., Please try again. </div>
									<?php } if($_SESSION['addcustmsg']=='003'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully updated Supplier. </div>
									<?php } ?>

									<form class="p-20" method="post" action="/add-supplier-process" onsubmit="return validation();" autocomplete="off">
									<?php if($id!=''){ ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="editId" value="<?=$id;?>">
									<?php } ?>

												
									<div class="row mb-3">
										<label for="name" class="col-sm-3 col-form-label">Enter Name <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?=$getsupl['name'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="phone_no" class="col-sm-3 col-form-label">Phone No <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="text" class="form-control allownumericwithoutdecimal" id="phone_no"  name="phone_no" placeholder="Phone No" maxlength="10" value="<?=$getsupl['mobile'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="email" class="col-sm-3 col-form-label">Email Address </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="email"  name="email" placeholder="Email Address" value="<?=$getsupl['email'];?>">
										</div>
									</div>
									<div class="row mb-3">
										<label for="gst_no" class="col-sm-3 col-form-label">GST No.</label>
										<div class="col-sm-9">
											<input style="text-transform: uppercase" type="text" class="form-control" id="gst_no"  name="gst_no" placeholder="GST No." value="<?=$getsupl['gstno'];?>">
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="address" class="col-sm-3 col-form-label">Address</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="address" name="address" rows="3" placeholder="Address"><?=$getsupl['address'];?></textarea>
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
<?php unset($_SESSION['addcustmsg']);?>
var name=$("#name").val();
var phone_no=$("#phone_no").val();
var email=$("#email").val();

var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

$("#name").removeClass('bordererror');
$("#phone_no").removeClass('bordererror');
$("#email").removeClass('bordererror');

if(name==""){
   $("#name").focus();
   errors ="Please enter name";
   $("#name").val('');
   $("#name").addClass('bordererror');
   $("#name").attr("placeholder", errors);
   return false;
} else if(phone_no ==""){
   $("#phone_no").focus();
   errors ="Please enter phone no";
   $("#phone_no").val('');
   $("#phone_no").addClass('bordererror');
   $("#phone_no").attr("placeholder", errors);
   return false;
}else if (!filter.test(email) && email != "") {
   $("#email").val('');
   error = "Please enter valid email";
   $("#email").focus();
   $("#email").addClass('bordererror');
   $("#email").attr("placeholder",error);
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