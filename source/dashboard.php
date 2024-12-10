<?php
session_start();
?><!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pure Sales - Dashboard</title>
  
  
<?php include 'sidebar.php'; 
  include 'class/user.php';
  $user = new user();
  $getTotalCylinders=$user->getTotalCylinders();
  $getTotfilledCylinders=$user->getTotfilledCylinders();
  $getTotEmptyCylinders=$user->getTotEmptyCylinders();
  $getTotDeliveredCylinders=$user->getTotDeliveredCylinders();
  $getAllGases=$user->getAllGases();
?>
       <!--start content-->
          <main class="page-content">
              
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-4">
                 <div class="col">
                <div class="card overflow-hidden radius-10">
                    <div class="card-body p-2">
                     <div class="d-flex align-items-stretch justify-content-between radius-10 overflow-hidden">
                      <div class="w-50 p-3 bg-light-pink">
                        <p>Total Cylinders</p>
                        <h4 class="text-primary"><?=$getTotalCylinders;?></h4>
                      </div>
                     <div class="w-50 bg-pink p-3 text-white">
                        <p>Cylinder Delivered</p>
                        <h4 class="text-white"><?=$getTotDeliveredCylinders;?></h4>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
               <div class="col">
                <div class="card overflow-hidden radius-10">
                    <div class="card-body p-2">
                     <div class="d-flex align-items-stretch justify-content-between radius-10 overflow-hidden">
                      <div class="w-50 p-3 bg-light-success">
                         <p>Filled Cylinders</p>
                         <h4 class="text-primary"><?=$getTotfilledCylinders;?></h4>
                      </div>
                      <div class="w-50 bg-success p-3 text-white">
                        <p>Empty Cylinders</p>
                        <h4 class="text-white"><?=$getTotEmptyCylinders;?></h4>
                      </div>
                    </div>
                  </div>
                </div>
               </div>
               <!--<div class="col">-->
               <!-- <div class="card overflow-hidden radius-10">-->
               <!--     <div class="card-body p-2">-->
               <!--      <div class="d-flex align-items-stretch justify-content-between radius-10 overflow-hidden">-->
               <!--       <div class="w-50 p-3 bg-light-orange">-->
               <!--         <p>Filled Cylinders</p>-->
               <!--         <h4 class="text-primary"><?=$getTotfilledCylinders;?></h4>-->
               <!--       </div>-->
               <!--       <div class="w-50 bg-orange p-3">-->
               <!--          <p class="mb-3 text-white"><?=($getTotfilledCylinders/$getTotalCylinders)*100;?>%<i class="bi bi-arrow-up"></i></p>-->
               <!--          <div id="chart3"></div>-->
               <!--       </div>-->
               <!--     </div>-->
               <!--   </div>-->
               <!-- </div>-->
               <!--</div>-->
               <!--<div class="col">-->
               <!-- <div class="card overflow-hidden radius-10">-->
               <!--     <div class="card-body p-2">-->
               <!--      <div class="d-flex align-items-stretch justify-content-between radius-10 overflow-hidden">-->
               <!--       <div class="w-50 p-3 bg-light-primary">-->
               <!--         <p>Empty Cylinders</p>-->
               <!--         <h4 class="text-primary"><?=$getTotEmptyCylinders;?></h4>-->
               <!--       </div>-->
               <!--       <div class="w-50 bg-primary p-3">-->
               <!--          <p class="mb-3 text-white"><?=($getTotEmptyCylinders/$getTotalCylinders)*100;?>%<i class="bi bi-arrow-up"></i></p>-->
               <!--          <div id="chart4"></div>-->
               <!--       </div>-->
               <!--     </div>-->
               <!--   </div>-->
               <!-- </div>-->
               <!--</div>-->
            </div><!--end row-->

			<div class="row">
			    <?php 
			    $i=0;
			    foreach($getAllGases as $gas){  
			        $i++;
			     $getTotGasDelivered=$user->getTotGasDelivered($gas['gas_id']);
			     $getTotGasDeliveredSup=$user->getTotGasDeliveredSup($gas['gas_id']);
			      $getTotEmptyGas=$user->getTotEmptyGas($gas['gas_id']);
			      $getTotFilledGas=$user->getTotFilledGas($gas['gas_id']);
			      	      $getTotGas=$user->getTotGas($gas['gas_id']);
			      if($i==1 || $i==9){
			        $bgcolor=' bg-light-orange';  
			      }elseif($i==2 || $i==10){
			        $bgcolor=' bg-orange text-white';    
			      }elseif($i==3 || $i==11){
			            $bgcolor=' bg-light-primary'; 
			      }elseif($i==4 || $i==12){
			            $bgcolor=' bg-primary text-white'; 
			      }elseif($i==5 || $i==13){
			          $bgcolor=' bg-light-pink';
			      }elseif($i==6 || $i==14){
			            $bgcolor=' bg-pink text-white'; 
			      }elseif($i==7 || $i==15){
			          $bgcolor=' bg-light-success ';
			      }elseif($i==8 || $i==16){
			            $bgcolor=' bg-success text-white'; 
			      }
			    ?>
              <div class="col-12 col-lg-6 col-xl-6 col-xxl-4 d-flex">
                <div class="card radius-10 bg-transparent shadow-none w-100">
                  <div class="card-body p-0">
                    <div class="card radius-10">
                      <div class="card-body <?=$bgcolor;?>">
                        <div class="d-flex align-items-center">
                           <h6 class="mb-0"><?=$gas['name'];?> <span style="margin-left: 95px;"> Total Cylinders - <?php echo $getTotGas;?></span></h6>
                          
                        </div>
                        <div class="row mt-3 g-3 align-items-center">
                          <!--<div class="col">-->
                            <!--<div class="by-device-container">-->
                            <!--  <canvas id="chart5"></canvas>-->
                            <!--</div>-->
                          <!--</div>-->
                          <div class="col align-items-center">
                            <div class="">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                  <i class="bi bi-tablet-landscape-fill me-2 text-primary"></i> <span>Customer - </span> <span><?=$getTotGasDelivered;?></span>
                                </li>
                                 <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                  <i class="bi bi-display-fill me-2 text-primary-3"></i> <span>Supplier - </span> <span><?=$getTotGasDeliveredSup;?></span>
                                </li>
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                  <i class="bi bi-phone-fill me-2 text-primary-2"></i> <span>Empty - </span> <span><?=$getTotEmptyGas;?></span>
                                </li>
                                <li class="list-group-item d-flex align-items-center justify-content-between border-0">
                                  <i class="bi bi-display-fill me-2 text-primary-3"></i> <span>Filled - </span> <span><?=$getTotFilledGas;?></span>
                                </li>
                               
                              </ul>
                             </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                    </div>
                    </div>
  
              <?php } ?>
            </div><!--end row-->

            
            


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

</body>

</html>