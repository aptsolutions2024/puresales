<?php
session_start();
error_reporting(E_ALL);
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />



   <title>Pure Sales - View Cylinder</title>
  <?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $getcyl='';
 $cy_id='';
  if(isset($_REQUEST['submit'])) 
    { 
      $cy_id=$_REQUEST['cy_id'];
      $from_date = date('Y-m-d',strtotime($_REQUEST['from_date']));
      $to_date = date('Y-m-d',strtotime($_REQUEST['to_date']));
      $getcyl=$user->getTrackingCylinders($cy_id,$from_date,$to_date);
    }	 

    $getallcyl=$user->getAllCylinder();
  ?>
       <!--start content-->
          <main class="page-content">
            <div class="card">
					<div class="card-body">
				  <div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Track Cylinder Details</h5>
									</div>
									<hr>
				<form class="p-20" method="post" action="/track-cylinder" autocomplete="off">
				       <div class="row">
				<div class="col-md-3">
    <label class="form-label">Select Cylinder <label class="mandatory">*</label></label>
    <select id="cy_id" name="cy_id" class="form-select">
        <option value="">Select Cylinder</option>
        <?php foreach($getallcyl as $cy){ ?>                                              
            <option value="<?=$cy['cy_id'];?>" <?php if($cy_id==$cy['cy_id']){ echo "selected";} ?>>
                <?=$cy['name']." - ".$cy['cy_no'];?>
            </option>
        <?php } ?>
    </select>
</div>
                            <div class="col-md-3">
                               <label class="form-label">From Date<label class="mandatory">*</label></label>
                               <input id="from_date" name="from_date" type="date" class="form-control" value="<?=($_REQUEST['from_date'])?$_REQUEST['from_date']:date('Y-m-01');?>">
                            </div>
                            <div class="col-md-3">
                               <label class="form-label">To Date<label class="mandatory">*</label></label>
                               <input id="to_date" name="to_date" type="date" class="form-control" value="<?=($_REQUEST['to_date'])?$_REQUEST['to_date']:date('Y-m-t')?>">
                            </div>
                            <div class="col-md-2" style="margin-top:auto;">
                                <input type="submit" class="btn btn-primary" name='submit' value="submit">
                            </div>
                           
                        </div>
                           </br></br>
             </form>
           
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Type</th>
										<th>Name</th>
										<th>Cylinder No.</th>
										<th>Challan No.</th>
										<th>Challan Date</th>
										<th>Ret Challan Date</th>
										<th>No. of days</th>
										<th>Ret Challan No.</th>
										<th>Ret Status.</th>
										<th>Remark</th>
										<!--<th>Refill Date</th>-->
										<!--<th>Action</th>-->
									</tr>
								</thead>
								<tbody>
								<?php  
							//	 echo "<pre>";print_r($getcyl);echo "</pre>";
								       $count=1; foreach($getcyl as $row){
								           $type='';
								         if($row['type']=='c'){
								             $type='Customer';
        							    	$getcust=$user->getCustomerbyId($row['cust_id']);
        								//	$getchaln=$user->getCylinderByChallanId($row['mast_id']);
        								    $getretchaln=$user->getCylinderByChallanId($row['ret_chln_id']);
        								    
								         }elseif($row['type']=='s'){
								             $type='Supplier';
								            $getcust=$user->getSupplierbyId($row['cust_id']); 
        								    $getretchaln=$user->getRefillCylinderByChallanId($row['ret_chln_id']);
        								    
								         }
								         
        								$ret_status="";
                						if($row['ret_status']==1)
        								{
        								    $ret_status="<span class='badge bg-light-warning w-100' style='color:darkviolet;'>Empty</span>";
        								}else if($row['ret_status']==2)
        								{
        								    $ret_status="<span class='badge bg-light-success text-success w-100'>Filled</span>";
        								}else if($row['ret_status']==3)
        								{
        								    $ret_status="<span class='badge bg-light-danger text-danger w-100'>Damaged</span>";
        								}else if($row['ret_status']==4)
        								{
        								    $ret_status="<span class='badge bg-light-danger text-danger w-100'>Lost</span>";
        								}
        								$date1='';
        								$date2='';
        								 $date1 = new DateTime($row['date']);
									    if($row['type']=='c'){
    										    if($getretchaln['chln_date']){
    										        $date2 = new DateTime($getretchaln['chln_date']);
    										    }else{
    									                $date2 = new DateTime("now");
    								          	}
    									}elseif($row['type']=='s'){
    										  		if($getretchaln['date']){
    										  		    $date2 = new DateTime($getretchaln['date']); 
    										  		}else{
    									                 $date2 = new DateTime("now");
    									         }
    									}
                                         $interval = $date1->diff($date2);
                                         $bgcolor='';
                                         if($interval->days>10){
                                             $bgcolor="style='background-color:lightpink;'";
                                         }
    								?>
							      <tr>
										<td><?=$count;?></td>
										<td><?=$type;?></td>
										<td><?=$getcust['name'];?></td>
										<td><?=$row['name']." - ".$row['cy_no'];?></td>
										<td><?php if($row['chln_no']){ echo $row['chln_no'];}else { echo "-";} ?></td>
										<td><?php if($row['date']){ echo date('d-m-Y',strtotime($row['date']));}else { echo "-";} ?></td>
										<td><?php 
										if($row['type']=='c'){
										    if($getretchaln['chln_date']){ echo date('d-m-Y',strtotime($getretchaln['chln_date']));}else { echo "-";} 
										}elseif($row['type']=='s'){
										  		if($getretchaln['date']){ echo $getretchaln['date'];}else { echo "-";}   
										}
										?></td>
										 <td <?=$bgcolor;?>><?php
									    echo $interval->days . " days ";?></td>
										<td><?php 
										if($row['type']=='c'){
										if($getretchaln['chln_no']){ echo $getretchaln['chln_no'];}else { echo "-";} 
										}elseif($row['type']=='s'){
										  		if($getretchaln['refill_document']){ echo $getretchaln['refill_document'];}else { echo "-";}   
										}
										?></td>
									    <td><?=$ret_status;?></td>
									    
									  
										<td><?=$row['ret_remark'];?></td>
										<!--<td>-->
          <!--                    <div class="d-flex align-items-center gap-3 fs-6">-->
          <!--                      <a href="add-cylinder?ID=<?php echo base64_encode($row['cy_id']); ?>" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill"></i></a>-->
          <!--                      <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>-->
          <!--                    </div>-->
          <!--                  </td>-->
									</tr>
								<?php $count++; } ?>
									
								</tfoot>
							</table>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 
<script>
    $(document).ready(function() {
    $('#cy_id').select2({
      placeholder: "Select Cylinder",
      width: 'resolve' 
    });
  });
</script>

</body>

</html>