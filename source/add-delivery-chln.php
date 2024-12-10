<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!doctype html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <title>Pure Sales - Delivery Challan Details</title>

<style>
@media screen and (max-device-width:640px), screen and (max-width:640px) {
select.list {
height: auto !important;
}
}
</style>
  <?php 
  include 'sidebar.php'; 
  error_reporting(0);
  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  //$getcust=$user->getCustomerbyId($id);
  $getcust=$user->getAllCustomers();
  $getGas=$user->getAllGases();
  
$getdele = $user->chalanDate();   
echo "1111111";
$lastCust = $user->displayLastCust();

print_r($lastCust);
$formattedDate = $getdele ? date('Y-m-d', strtotime($getdele)) : '';
  echo "2222222";
  $result=$user->getCylindersforCustomer();
//   print_r($result);
  //print_r($getcust);
  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Customer Delivery Challan Details- </h5> <br>
										
										
										
									</div>
									<p><?php echo " Last Entry - Customer Name:  " . $lastCust['name'] . 
										"&nbsp;Challan Date: " . date('d-m-y',strtotime($lastCust['chln_date'])) .
										"&nbsp;Challan Number: " . $lastCust['chln_no'] 
										
										;?></p>
									<hr>
									
								

									<form class="p-20" method="post" action="" autocomplete="off">
									<?php if($id!=''){ ?>
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="editId" value="<?=$id;?>">
									<?php } ?>

												
									<div class="row mb-3">
										<label for="name" class="col-sm-3 col-form-label">Select Customer <span class="mandotry">*</span></label>
										<div class="col-sm-9">
										    
											<select class="form-select" id="cust_id" name="cust_id" onchange="getReturnCylinders();">
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
        
        <input type="date" class="form-control" id="chln_date" name="chln_date" 
               value="<?= $formattedDate; ?>" onchange="getReturnCylinders();">
    </div>
</div>
									<div class="row mb-3">
										<label for="vehicle_no" class="col-sm-3 col-form-label">Vehicle No <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<!--<input style="text-transform: uppercase" type="text" class="form-control" id="vehicle_no"  name="vehicle_no" placeholder="Vehicle No" value="<?php //$getdele['vehicle_no'];?>">-->
										<input style="text-transform: uppercase" type="text" class="form-control" id="vehicle_no"  name="vehicle_no" placeholder="Vehicle No" value="MH12SX7875">
										
										</div>
									</div>
									
									
									<div class="row mb-3">
									 <label for="" class="col-sm-3 col-form-label"></label>
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
									<!--add delivary gag-->
									<!--<div class="row mb-3">-->
									<!--    	<div class="col-sm-3"></div>-->
									<!--	<label for="gas_id" class="col-sm-2 col-form-label">Select Gas <span class="mandotry">*</span></label>-->
									<!--	<div class="col-sm-7">-->
										    
											<!--<select class="form-select" id="gas_id" name="gas_id" onchange="getCylinder(this.value);">-->
									<!--		<select class="form-select" id="gas_id" name="gas_id">-->
											    
									<!--		    <option value="">Select Gas</option>-->
									<!--		    <?php foreach($getGas as $gas){ ?>-->
									<!--		    <option value="<?=$gas['gas_id'];?>"><?=$gas['name'];?></option>-->
									<!--		    <?php } ?>-->
									<!--		 </select>-->
									<!--	</div>-->
									<!--</div>-->
									
									
									
									<div class="row mb-3">
									    		<div>
    <h5 style="padding-left: 233px;">Selected Cylinders: <span id="selectedCount2">0</span></h5>
</div>
<label for="cylinderL" class="col-sm-3 col-form-label"></label>
<div class="col-sm-4">
    <label for="cylinderRetL" class="col-form-label">From Pure Sales</label>
    <select multiple size="15" class="form-control list" name="cylinderL" id="cylinderL" style="width: 100%;" onchange="displyCount2()">
            <option value="">Select Cylinder</option>
            <?php foreach ($result as $res) { ?>
                <option value="<?= $res['cy_id']; ?>"><?= $res['name'] . " - " . $res['cy_no']; ?></option>
                <!-- Hidden inputs for cylinder name and gas ID -->
                <?php } ?>
        </select>
        <?php foreach ($result as $res) { ?>
        
         <input type="hidden" name="cyName" id="cyName<?= $res['cy_id']; ?>" value="<?= $res['name']; ?>">
                <input type="hidden" name="gasID" id="gasID<?= $res['cy_id']; ?>" value="<?= $res['gas_id']; ?>">
            <?php } ?>
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
									    <div>
    <h5 style="padding-left: 233px;">Selected Cylinders: <span id="selectedCount">0</span></h5>
</div>
<br>
										<input type="hidden" name="delivery_action" value="2">
										
										<div class="row mb-3">
										    	<div class="col-sm-3"></div>
										<table class="table table-bordered tblwidth" id="checkboxCount">
                                          <thead>
                                            <tr>
                                              <th scope="col">
                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this);displyCount();">
            </th>
                                              <th scope="col">Cylinder No.</th>
                                              <th scope="col">Challan No.</th>
                                              <th scope="col">Status</th>
                                              <th scope="col">Remark</th>
                                            </tr>
                                          </thead>
                                          <tbody id="cylinderRetL">
                                           
                                          </tbody>
                                        </table>
									</div>
									
									</div>
									</div>
										<?php if($_SESSION['adddelmsg']=='001'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully added Cylinder. </div>
									<?php } if($_SESSION['adddelmsg']=='002'){ ?>
									<div class="alert alert-danger" role="alert"> <strong>Warning!</strong> Cylinder already exists, Please try again. </div>
									<?php } if($_SESSION['adddelmsg']=='003'){ ?>
									<div class="alert alert-success" role="alert"> <strong>Well done!</strong> You have successfully updated Cylinder. </div>
									<?php } ?>
									<div class="row">
									    <!-- Display count of selected cylinders -->

										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										
											<button type="button" class="btn btn-primary px-5" onclick="validation();">Save</button>
										
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

var cylinderR=[]; 
$('select[name="cylinderR[]"] option').each(function() {
    cylinderR.push($(this).val());
});

var checkboxes =$("input[name='cylinderRetR[]']:checked");
              
              
//var cylinderRetR = document.getElementsByName('cylinderRetR[]');
var cylinderRetR = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
    if (checkboxes[i].checked) 
    {
        
      cylinderRetR += ","+checkboxes[i].value+"#"+$("#status"+checkboxes[i].value).val()+"!"+$("#cylinderRetranId"+checkboxes[i].value).val()+"@"+$("#ret_remark"+checkboxes[i].value).val();
    }
}
//alert(cylinderRetR);return false;
if (cylinderRetR) cylinderRetR = cylinderRetR.substring(1);

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
}  else
{
    $.post('/add-delivered-process', {
          'cust_id': cust_id,
          'challan_no': challan_no,
          'chln_date': chln_date,
          'vehicle_no': vehicle_no,
          'gas_id': gas_id,
          'cylinderR': cylinderR,
          'cylinderRetR': cylinderRetR
		  }, function (data) {
		  console.log(data);
          location.reload();
      });
}
}
$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
   }
 });
$(document).ready(function() {
    // Trigger fetching cylinders when the page loads if a customer is already selected
    var cust_id = $("#cust_id").val();
    if (cust_id !== "") {
        getReturnCylinders(); // Fetch return cylinders automatically if customer is pre-selected
    }
});
// function getCylinder(gasId)
// {
// var selectedCyl  ='';
//       $('#cylinderR option').each(function(){
//           selectedCyl+=","+this.value;
//         });
      
//       $.post('/get-filled-cylinder-by-gasid', {
//           'gasId': gasId,
//           'selectedCyl':selectedCyl
// 		  }, function (data) {
// 		  //alert(data);
//           $("#cylinderL").html(data);
          
//       });	
// }
function getReturnCylinders()
{
var cust_id=$("#cust_id").val();
var chln_date=$("#chln_date").val();
$.post('/get-filled-cylinder-by-gasid', {
          'cust_id': cust_id,
          'chln_date':chln_date,
		  }, function (data) {
		  //alert(data);
          $("#cylinderRetL").html(data);
      });	
}

$('#moveone').click(function () {
       $('#cylinderL option:selected').remove().appendTo('#cylinderR');
         reSort('cylinderR');
         $("#cylinderR").show(); 
      return;
 

});
function reSort(listName){
        //alert("listName"+listName);
        var lstBox = document.getElementById(listName);
         
        var arrTexts = new Array();
        var arrValues = new Array();
        console.log("length:"+lstBox.length);
           var arrTextsSorted = new Array();
        //Copy options to arrays
        for (i = 0; i < lstBox.length; i++){
            
            arrTexts[i] = lstBox.options[i].text;
            arrTextsSorted[i]=lstBox.options[i].text;
            arrValues[i] = lstBox.options[i].value;
            console.log(i+" - arrTexts"+arrTexts[i]+ "   arrValues[i]"+arrValues[i]);
        }
     
        //Sort texts and copy to new array
     
        //arrTextsSorted = arrTexts;
        arrTextsSorted = arrTextsSorted.sort();
        //  for (j = 0; j < arrTexts.length; j++){
        //      console.log(arrTexts[j]);
        //  }
         //return false;
         var optionsToappend='';
  
        for (i = 0; i < lstBox.length; i++){
            
            //list texts in alpha-order
            lstBox.options[i].Text = arrTextsSorted[i];
            
            //Locate text's assoc ID
            for (j = 0; j < arrTexts.length; j++){
                
                // console.log("***"+i+" - arrTextsSorted"+arrTextsSorted[i]+" j :"+j+"   arrValues[j]"+arrValues[j]+ "   arrTexts[j]"+arrTexts[j]);
                if (arrTextsSorted[i].match(arrTexts[j])){
                    lstBox.options[i].value = arrValues[j];
                    optionsToappend+="<option value='"+arrValues[j]+"'>"+arrTexts[j]+"</option>"
                     // console.log(i+" - arrTextsSorted"+arrTextsSorted[i]+" j :"+j+"   arrValues[j]"+arrValues[j]+ "   arrTexts[j]"+arrTexts[j]);
                    break;
                }
            }
        }
              $('#cylinderR').find('option').remove();
              $('#cylinderR').append(optionsToappend);
               //$('#cylinderR').show();
            
    }
function Sortit() {

        var $r = $("#cylinderR option");
        $r.sort(function(a, b) {
            alert("a.text "+a.text+" b.text"+b.text);
            if (a.text < b.text) return -1;
            if (a.text == b.text) return 0;
            return 1;
        });
        $($r).remove();
        //alert("Sortit"+$r);
        $("#cylinderR").append($($r));
        }
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

 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 
<script>
  $(document).ready(function() {
    $('#cylinderL').select2({
      placeholder: "Select Cylinder",
      width: 'resolve' 
    });
  });
  
  function toggleSelectAll(selectAllCheckbox) {
    // Get all checkboxes with class "selectItem"
    const checkboxes = document.querySelectorAll('.selectItem');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
}
</script>
<script>
function displyCount(){
    var gasArray = [];
    var count = 0;
    var previousGasId = 0;
    var gasCount = 0;
    var gasStr = '';
    $('#checkboxCount > tbody > tr').each(function(i) {
        var $chkbox = $(this).find('input[type="checkbox"]');
        var cy_id = $chkbox.val();
        var gasID = $('#gasID'+cy_id).val();
        var cy_name = $('#cyName'+cy_id).val();
        if($chkbox.is(':checked')){
            count++;
            if (previousGasId != gasID ){
                gasCount = 0;
                gasCount++;
                previousGasId = gasID;
                gasStr += "<b>"+cy_name+"</b>: ";
            } else {
                gasCount++;
                gasStr = gasStr.split(": ")[0];
                gasStr = gasStr + ": ";
            }
            gasStr = gasStr + gasCount + ", ";
        }
    });
    // Remove trailing comma and space, if any
    if (gasStr.endsWith(", ")) {
        gasStr = gasStr.slice(0, -2);
    }
    $('#selectedCount').html(count + " - " + gasStr);
}

function displyCount2() {
    var count = 0; // Total count of selected cylinders
    var gasCounts = {}; // Object to group cylinders by gas ID
    var gasStr = ''; // String to display summary

    // Iterate over selected options in the select element
    $('#cylinderL').find(':selected').each(function () {
        var cy_id = $(this).val(); // Get the selected cylinder ID
        if (cy_id) { // Skip the placeholder "Select Cylinder"
            var cy_name = $('#cyName' + cy_id).val(); // Retrieve the cylinder name
            var gas_id = $('#gasID' + cy_id).val(); // Retrieve the gas ID

            // Group and count cylinders by gas ID
            if (!gasCounts[gas_id]) {
                gasCounts[gas_id] = { count: 0, name: cy_name };
            }

            gasCounts[gas_id].count++; // Increment count for this gas ID
            count++; // Increment total selected count
        }
    });

    // Build the display string for selected cylinders
    for (var gasID in gasCounts) {
        gasStr += `<b>${gasCounts[gasID].name}</b>: ${gasCounts[gasID].count}, `;
    }

    // Remove trailing comma and space
    if (gasStr.endsWith(", ")) {
        gasStr = gasStr.slice(0, -2);
    }

    // Update the count and summary in the display element
    $('#selectedCount2').html(count + " - " + gasStr);
}


</script>

</body>

</html>