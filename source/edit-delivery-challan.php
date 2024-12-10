<?php
session_start();
error_reporting(E_ALL);

  include 'class/user.php';
  $user = new user();
  $cust_id=$_REQUEST['cust_id'];
  $chln_id=$_REQUEST['challan_id'];
  $getdele=$user->getCylinderByChallanId($chln_id);
  $gettran=$user->getCustomersCylinderByChallanDeli($chln_id);
  //echo 'Deliverd<pre>'.print_r($gettran);
  $gettranret=$user->getCylinderByChallanRet($chln_id);
  // echo '<br>Returrned<pre>'.print_r($gettranret);
  $getGas=$user->getAllGases();
    $result=$user->getCylindersforCustomer();

  ?>
<form class="p-20" method="post" action="" autocomplete="off">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <hr>
                                    <div class="row mb-3">
										<label for="chln_date" class="col-sm-3 col-form-label">Challan Date <span class="mandotry">*</span></label>
										<div class="col-sm-9">
											<input type="date" class="form-control" id="chln_date"  name="chln_date" placeholder="Challan No" value="<?=$getdele['chln_date'];?>" onchange='getReturnCylinders();'>
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
										<label for="gas_id" class="col-sm-3 col-form-label"><strong>Delivered Cylinders (<?php echo count($gettran); ?>)  </strong> </label>
										<div class="col-sm-6" style="margin-top: 6px;">
										   <?php foreach($gettran as $dcylinder) { $cyno .=$dcylinder['name']." - ".$dcylinder['cy_no'].', '; } echo trim($cyno,', ') ?> 
											
										</div>
										
										<div class="col-sm-3"></div>
										<label for="gas_id" class="col-sm-3 col-form-label"><strong>Selected Cylinders: </strong></label>
										<div class="col-sm-6" style="margin-top: 6px;">
										   <span id="selectedCount2">0</span>
										</div>
										

									</div>
									<!--<div class="row mb-3">-->
									<!--    	<div class="col-sm-3"></div>-->
									<!--	<label for="gas_id" class="col-sm-2 col-form-label">Select Gas <span class="mandotry">*</span></label>-->
									<!--	<div class="col-sm-7">-->
										    
									<!--		<select class="form-select" id="gas_id" name="gas_id" onchange="getCylinder(this.value);">-->
									<!--		    <option value="">Select Gas</option>-->
									<!--		    <?php foreach($getGas as $gas){ ?>-->
									<!--		    <option value="<?=$gas['gas_id'];?>"><?=$gas['name'];?></option>-->
									<!--		    <?php } ?>-->
									<!--		 </select>-->
									<!--	</div>-->
									<!--</div>-->
									<div class="row mb-3">
										<label for="cylinderL" class="col-sm-3 col-form-label"></label>
										<div class="col-sm-4">
										    <label for="cylinderRetL" class=" col-form-label">From Pure Sales</label>
											<select multiple size="15" class="form-control list" name="cylinderL" id="cylinderL" style="width: 100%; height: 160px;" onchange="displyCount2()">
  <?php foreach($result as $res){ ?>
      <option value="<?=$res['cy_id'];?>"><?=$res['name']." - ".$res['cy_no'];?></option>
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
										    <label for="cylinderRetR" class=" col-form-label">To Customer</label>
											<select multiple size="15" class="form-control list" data-target="avaliable" name="cylinderR[]" id="cylinderR" style="height: 160px;">
											</select>
										</div>
									</div>
									</div>
									<div class="tab-pane fade" id="primaryprofile" role="tabpanel">
									    
										<input type="hidden" name="delivery_action" value="2">
										<div class="row mb-3">
									    	<div class="col-sm-3"></div>
										<label for="gas_id" class="col-sm-3 col-form-label"><strong>Returned Cylinders (<?php echo count($gettranret); ?>)</strong></label>
										<div class="col-sm-6" style="margin-top: 6px;">
										   <?php  
										  // print_r($gettranret);
										   foreach($gettranret as $dcylinderret) { 
										   $cynoret .=$dcylinderret['name']." - ".$dcylinderret['cy_no'].', '; 
										   } 
										   
										   echo trim($cynoret,', ') ?> 
											
										</div>
										<div class="col-sm-3"></div>
										<label for="gas_id" class="col-sm-3 col-form-label"><strong>Selected Cylinders: </strong></label>
										<div class="col-sm-6" style="margin-top: 6px;">
										   <span id="selectedCount">0</span>
										</div>
									</div>
									
										<div class="row mb-3">
										    	<div class="col-sm-3"></div>
										<table class="table table-bordered tblwidth"id="checkboxCount">
                                          <thead>
                                            <tr>
                                              <th scope="col">
                <input type="checkbox" id="selectAll" onclick="toggleSelectAll(this);displyCount();">
            </th><th scope="col">Cylinder No.</th>
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
									<div class="row">
										<label class="col-sm-3 col-form-label"></label>
										<div class="col-sm-9">
										
											<button type="button" class="btn btn-primary px-5" onclick="validation();">Save</button>
										
										</div>
									</div>
									</form>

<script>
 function validation()
{
var cust_id='<?=$cust_id;?>';
var challan_id='<?=$chln_id;?>';
var chln_date=$("#chln_date").val();
var vehicle_no=$("#vehicle_no").val();
var cy_action=$("#cy_action").val();
var gas_id=$("#gas_id").val();
var action='editAction';
//alert("cust_id-"+cust_id);
var cylinderR=[]; 
$('select[name="cylinderR[]"] option').each(function() {
    cylinderR.push($(this).val());
});

var checkboxes =$("input[name='cylinderRetR[]']:checked");

var cylinderRetR = "";
for (var i=0, n=checkboxes.length;i<n;i++) 
{
if (checkboxes[i].checked) 
{
cylinderRetR += ","+checkboxes[i].value+"#"+$("#status"+checkboxes[i].value).val()+"#"+$("#cyId"+checkboxes[i].value).val()+"#"+$("#retchlnno"+checkboxes[i].value).val()+"#"+$("#ret_remark"+checkboxes[i].value).val();
}
}
if (cylinderRetR) cylinderRetR = cylinderRetR.substring(1);
//alert(cylinderRetR);
$("#cust_id").removeClass('bordererror');
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
          'challan_id': challan_id,
          'chln_date': chln_date,
          'vehicle_no': vehicle_no,
          'gas_id': gas_id,
          'action': action,
          'cylinderR': cylinderR,
          'cylinderRetR': cylinderRetR
		  }, function (data) {
//	console.log(data);
          location.reload();
      });
}
}
function getReturnCylinders()
{
var cust_id=$("#cust_id").val();
var chln_date=$("#chln_date").val();
var chln_id='<?=$chln_id;?>';
//alert("chln_id-"+chln_id);
$.post('/get-delivered-cylinders', {
          'cust_id': cust_id,
          'chln_date': chln_date,
          'chln_id': chln_id
		  }, function (data) {
		  console.log(data);
          $("#cylinderRetL").html(data);
      });	
}
$('#moveone').click(function () {
//return !$('#cylinderL option:selected').remove().appendTo('#cylinderR');
      //alert("moveone");
       $('#cylinderL option:selected').remove().appendTo('#cylinderR');
       reSort('cylinderR');
       $("#cylinderR").show(); 
       return;
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 
<script>
  $(document).ready(function() {
    $('#cylinderL').select2({
      placeholder: "Search Cylinder",  // This adds a search-friendly placeholder
      width: 'resolve',  // Adjusts to fit the container
      allowClear: true   // Optional: Allows users to clear selection if needed
    });
  });
  
  
  
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

function displyCount(){
    var gasArray = [];
    var count = 0;
    var previousGasId = 0;
    var gasCount = 0;
    var gasStr = '';
    
    debugger;
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

function toggleSelectAll(selectAllCheckbox) {
    // Get all checkboxes with class "selectItem"
    const checkboxes = document.querySelectorAll('.selectItem');
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllCheckbox.checked;
    });
}

</script>