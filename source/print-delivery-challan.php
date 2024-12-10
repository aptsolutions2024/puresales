<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - Print Delivery Challan</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $mastId=base64_decode($_REQUEST['ID']);
 // echo "Mast ID:".$mastId;
  $companyDetails=$user->getcompanyDetails();
  $getDCMastById=$user->getDCMastById($mastId);
  $getDCDetails=$user->getDCDetails($mastId);
  ?>
       <!--start content-->
          <main class="page-content">
            <div class="card">
					<div class="card-body">
				     <h2 class="mb-3 btnprnt">Delivery Challan Print
                    </h2>
                    <section>
                        <div class="row">
                            <div class="col-md-12 mb-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                      
                                      <div class="col-md-4 btnprnt">
                                            <label class="form-label">Choose Copy Type <label class="mandatory">*</label></label>
                                        
                                            <select id="Copy" class="form-select" onchange="getCopyType(this.value);" >
                                                <option value="ORIGINAL Copy">ORIGINAL Copy</option> 
                                                <option value="DUPLICATE Copy">DUPLICATE Copy</option> 
                                                <option value="TRIPLICATE Copy">TRIPLICATE Copy</option> 
                                                  <option value="ALL Copy">ALL Copy</option> 

                                            </select>
                                            <br>
                                        <br>
                                        </div>
                                        
                                        <?php
                                    //  print_r($getDCMastById);
                                    //     echo "<pre>";
                                    //     print_r($getDCDetails); echo "</pre>"; 
                                        ?>
                                            <div class="pagebreak">
                                      <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                          <tr>
                                              <td style="text-align:right;" colspan="12"><span class="getCopyType">ORIGINAL Copy</span></td>
                                         </tr>
                                         <tr>
                                            <td style="text-align:center;" colspan="12">
                                                  <span style="font-size:25px;font-weight: 600;"><?php echo $companyDetails['name'];?> </span><br>
                                                  <span ><?php echo $companyDetails['address'];?></span><b>Mob. <?php echo $companyDetails['contact_no'];?></b><br>
                                                  <span style="font-size:15px;font-weight: 600;">DELIVERY CHALLAN CUM EMPTY RETURN</span>
                                                  <!--<span style=""><span style="">EMAIL ID : </span><?php echo $companyDetails['email_id'];?></span>-->
                                            </td>
                                         </tr>
                                         
                                         <tr>
                                            <td rowspan='3' colspan="6">
                                            <?php  $supplierD=  $user->getCustomerbyId($getDCMastById['cust_id']); ?>
                                                <b>TO </b> : <?=$supplierD['name'];?><br>
                                                              Address : <?=$supplierD['address'];?><br>
                                                            <br><br><br>
                                              <b>GST NUMBER </b>: <?php echo $companyDetails['gst_no'];?>
                                                <span style="float:right"><b>Thursday Closed </b></span>
                                            </td>
                                            <td colspan="6">
                                              <b> Challan No.</b> : <?php echo $getDCMastById['chln_no'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="6">
                                              <b>Date </b>: <?php echo date("d-m-Y",strtotime($getDCMastById['chln_date']));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  colspan="6">
                                             <b> Vehicle No.</b> : <?php echo $getDCMastById['vehicle_no'];?>
                                            </td>
                                        </tr>  
                                     
                                        <tr>
                                            <td  colspan="6">
                                              <b>Bill No.: </b>: _________________
                                              <b>Date.: </b>: ________________
                                            </td>
                                            <td colspan="6">
                                             Received the following empty cylinders subject to examination and inspection by our principal,if any of them is found to be damaged the cost of which will be charged to us as per Cylinder Rule. 
                                             <br>   <span style="float: right;"><b>Empty Cyls._______________ Recd. Date _______________</b></span>
                                            </td>
                                        </tr>
                                            <tr>
                                                <th colspan='2'> SR.NO. </th>
                                                <th colspan='2'> CYLINDER SPECIFICATION </th>
                                                <th colspan='2'> QTY </th>
                                                <th colspan='2'> SR.NO. </th>
                                                <th colspan='2'> CYLINDER SPECIFICATION </th>
                                                <th colspan='2'> QTY </th>
                                                
                                            </tr>
                                              <?php 
                                              $sr=1;
                                               $retsr=1;
                                              $grand_total=0;
                                             // echo "<pre>";print_r($getDCDetails);echo "</pre>";
                                              foreach($getDCDetails as $dcdetails){ 
                                                  $grand_total++;
                                              ?>
                                            <tr>
                                                <td colspan='2'> <?=$sr;?></td>
                                                <td colspan='2'> <?php echo $dcdetails['name']."-".$dcdetails['cy_no'];?></td>
                                                <td colspan='2'> </td>
                                                <td colspan='2'> <?php if($dcdetails['ret_chln_id']){ echo $retsr;$retsr++;}?></td>
                                                <td colspan='2'> <?php if($dcdetails['ret_chln_id']){ echo $dcdetails['name']."-".$dcdetails['cy_no'];}?></td>
                                                <td colspan='2'> </td>
                                            </tr>
                                               <?php  $sr++; } ?>
                                            <tr>
                                                <td colspan='2'></br></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'></br></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                                <td colspan='2'></td>
                                            </tr>
                                            <tr>
                                             <td align="left" colspan="3"> 
                                                <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                                  
                                                        <?php $getCntDCDetails=$user->getCntDCDetails($mastId);
                                                        $dctotal=0;
                                                        foreach($getCntDCDetails as $cnt){
                                                           $dctotal+=$cnt['qty'];
                                                        ?>
                                                          <tr> 
                                                        <td  colspan="6"> 
                                                        <?=$cnt['name'];?>
                                                       </td>
                                                        <td  colspan="6"> 
                                                        <?=$cnt['qty'];?>
                                                       </td>
                                                           </tr> 
                                                       <?php }   ?>
                                                    <tr> 
                                                          <td  colspan="6"><b> Total </b></td>
                                                          <td  colspan="6"> <?=$dctotal;?></td>
                                                    </tr> 
                                                
                                                </table>
                                             </td>
                                                <td align="left" colspan="3"> 
                                                 Received Above Mentioned Full Cylinders ( with Cap & Valve ) in 
                                                 Perfect Condition
                                                  <br><br>
                                                 Paid &#x20b9;_____________
                                                    <br>   <br>
                                                 Signed  _____________
                                                </td>
                                                <td align="left" colspan="3"> 
                                                  <table style="width: 100%;" class="tableprint parentable" id="originalCopy">
                                                  
                                                        <?php $getCntRetDCDetails=$user->getCntRetDCDetails($mastId);
                                                        $dcRettotal=0;
                                                        foreach($getCntRetDCDetails as $cnt){
                                                            $dcRettotal+=$cnt['qty'];
                                                        ?>
                                                          <tr> 
                                                        <td colspan="6"> 
                                                        <?=$cnt['name'];?>
                                                       </td>
                                                        <td  colspan="6"> 
                                                        <?=$cnt['qty'];?>
                                                       </td>
                                                           </tr> 
                                                       <?php }   ?> 
                                                 <tr> 
                                                          <td  colspan="6"><b> Total</b> </td>
                                                          <td  colspan="6"> <?=$dcRettotal;?></td>
                                                    </tr> 
                                                </table>
                                                 
                                                 </td>
                                                <td align="right" colspan="3">
                                                    For,<?php echo $companyDetails['name'];?><br><br><br><br>
                                                    Authorised Signatory
                                                </td>
                                            </tr>
                                      </table>
                                      </div>
                                      <br>
                                      <div class="cloneTable1 pagebreak">
                                          
                                      </div>
                                      <br>
                                       <div class="cloneTable2">
                                          
                                      </div>
                                    <div class="col-12 btnprnt" style="text-align: center;">
                                    <button type="button" class="btn btn-primary" onclick="myFunction()">Print</button>
                                    
                                    <a href="/view-delivery-chln"><button type="button" id="btnCloseCustomer" class="btn btn-danger" data-bs-dismiss="modal">Close</button></a>
                                    
                                    </div>
                                    <br>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </section>
					
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
 <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  font-size: 15px;
}


@media print
{
   table, th, td {
  
  font-size: 12px;
} 
.tableprint{
    width:100%;
   
}
.btnprnt{display:none}
.pagebreak { page-break-after: always; } /* page-break-after works, as well */
}
</style>    
<script>
function myFunction() {

window.print();

}

function getCopyType(type)
{
  if($("#Copy").val()=="ALL Copy"){
        $(".getCopyType").text("ORIGINAL Copy"); 
            
            let $el = $('#originalCopy').clone();
            $('.cloneTable1').append($el);
            $(".getCopyType").eq(1).text("DUPLICATE Copy");
              let $el1 = $('#originalCopy').clone();
             $('.cloneTable2').append($el1);
            $(".getCopyType").eq(2).text("TRIPLICATE Copy");
   }else{
        $(".getCopyType").text(type); 
   }
}
</script>
</body>

</html>