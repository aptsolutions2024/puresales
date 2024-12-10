<?php
session_start();
error_reporting(E_ALL);
?><!doctype html>
<html lang="en" class="light-theme">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>Pure Sales - View Challan Details</title>
  <?php include 'sidebar.php'; 

  $id = base64_decode($_GET['ID']);
  include 'class/user.php';
  $user = new user();
  $getcust=$user->getAllCustomers();
  $lastCust = $user->displayLastCust();

  ?>
  <!--start content-->
          <main class="page-content">
              
            <div class="card">
							<div class="card-body">
							    
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Edit Customer Delivery Challan Details</h5>
									</div>
									<p><?php echo " Customer Name:  " . $lastCust['name'] . 
										"&nbsp;Challan Date: " . date('d-m-y',strtotime($lastCust['chln_date'])) .
										"&nbsp;Challan Number: " . $lastCust['chln_no'] 
										
										;?></p>
									<hr>
									<div class="row">
									<div class=" mb-3 col-sm-5">
										<div class="col-sm-12">
											<select class="form-select" id="cust_id" name="cust_id" onchange="getCylinderByCustId(this.value);">
											    <option value="">Select Customer</option>
											    <?php foreach($getcust as $cust){ ?>
											    <option value="<?=$cust['cust_id'];?>"><?=$cust['name'];?></option>
											    <?php } ?>
											 </select>
										</div>
									</div>
									<div class=" mb-3 col-sm-5">
										<div class="col-sm-12">
											<select class="form-select" id="challan_id" name="challan_id" onchange="showDetails();">
											    <option value="">Select Challan</option>
											 </select>
										</div>
									</div>
									<div class=" mb-3 col-sm-2">
										<div class="col-sm-12">
											<button type="button" class="btn btn-primary px-5" onclick="showDetails();">Show</button>
										</div>
									</div>
									</div>
									
									
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
function getCylinder(gasId)
{
   // alert("GAS ID-"+gasId);
   var selectedCyl  ='';
      $('#cylinderR option').each(function(){
          selectedCyl+=","+this.value;
        });
      
      $.post('/get-filled-cylinder-by-gasid', {
          'gasId': gasId,
          'selectedCyl':selectedCyl
		  }, function (data) {
		  //alert(data);
          $("#cylinderL").html(data);
          
      });	
}
 function showDetails()
{
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
       // alert("challan_id-"+challan_id);
        $.post('/edit-delivery-challan', {
              'cust_id': cust_id,
              'challan_id': challan_id
              }, function (data) {
    		  $("#ShowData").html(data);
              
          });
    }
}

function getCylinderByCustId(custId)
{
    $("#ShowData").empty();
 $.post('/get-cylinders-by-custId', {
          'custId': custId
          }, function (data) {
		  //alert(data);
		  $("#challan_id").html(data);
      });   
}


$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
   }
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

</script>
</body>

</html>