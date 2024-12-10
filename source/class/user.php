<?php

class user
{
	public $connection;
    
	public function __construct() {
        $this->connection = new PDO('mysql:dbname=PureSales;host=localhost;charset=utf8','PureSales','PureSales@1234');	
		$this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
     function loginDetailsById($loginId){
        $qs = "SELECT * FROM login_master where id ='$loginId'";
        $stmt = $this->connection->prepare($qs);
        $stmt->execute();
        $rows = $stmt->fetch();
        return $rows;
    }
      function loginDetails($email,$password){
        $qs = "SELECT * FROM login_master where username ='$email' and password ='$password'";
        $stmt = $this->connection->prepare($qs);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }
      function loginCountDetails($email,$password){
        $qs = "SELECT * FROM login_master where username ='$email' and password ='$password'";
        $stmt = $this->connection->prepare($qs);
        $stmt->execute();
        $rows = $stmt->rowCount();
        return $rows;
    }
    
    /*------------------------------------------Customer-----------------------------------*/
    
	function countCustomer($phone_no) {
        $query = "select * from customer where mobile='$phone_no'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
    	function countSupplier($phone_no) {
        $query = "select * from supplier where mobile='$phone_no'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
	function insertCustomer($name,$phone_no,$email,$gst_no,$address,$curr) {
        $query = "INSERT INTO `customer`(`name`, `mobile`, `email`, `address`, `gstno`, `add_date`, `update_date`) VALUES ('$name','$phone_no','$email','$address',UPPER('$gst_no'),'$curr','$curr')";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();
		return 1;
    }
    function insertSupplier($name,$phone_no,$email,$gst_no,$address,$curr) {
        $query = "INSERT INTO `supplier`(`name`, `mobile`, `email`, `address`, `gstno`, `add_date`, `update_date`) VALUES ('$name','$phone_no','$email','$address',UPPER('$gst_no'),'$curr','$curr')";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
		return 1;
    }
     function updateCustomer($editId,$name,$phone_no,$email,$gst_no,$address,$curr) {
        $query = "UPDATE `customer` SET `name`='$name',`mobile`='$phone_no',`email`='$email',`address`='$address',`gstno`=UPPER('$gst_no'),`update_date`='$curr' WHERE cust_id='$editId'";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
		return 1;
    }
    function updateSupplier($editId,$name,$phone_no,$email,$gst_no,$address,$curr) {
        $query = "UPDATE `supplier` SET `name`='$name',`mobile`='$phone_no',`email`='$email',`address`='$address',`gstno`=UPPER('$gst_no'),`update_date`='$curr' WHERE supl_id='$editId'";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
		return 1;
    }
	function getAllCustomers() {
       $query = "select * from customer where cust_id>1 order by name";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
	function getAllSuppliers() {
       $query = "select * from supplier order by name";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
  function getCustomerbyId($id) {
        $query = "select * from customer where cust_id='$id'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);    
        return $fetch;
    }
    
	 function getSupplierbyId($id) {
        $query = "select * from supplier where supl_id='$id'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);    
        return $fetch;
    }
    
	function deleteCustomers($id) {
       $query = "DELETE FROM `customer` WHERE cust_id='$id' ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		return $stmt;
    }
    

    /*------------------------------------------Cylinders-----------------------------------*/
    
    function countCylinder($cy_no) {
        $query = "select * from Cylinders where cy_no='$cy_no'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
    
	function insertCylinder($cust_id,$gas_id,$cy_no) {
        $query = "INSERT INTO `Cylinders`(`gas_id`, `cust_id`, `cy_no`) VALUES ('$gas_id','$cust_id','$cy_no')";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
    }
     function updateCylinder($editId,$cust_id,$gas_id,$cy_no) {
        $query = "UPDATE `Cylinders` SET `gas_id`='$gas_id',`cust_id`='$cust_id',`cy_no`='$cy_no' WHERE cy_id='$editId'";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
    }
	function getAllCylinder() {
       $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id order by  cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
   function getCylinderbyId($id) {
       $query = "select * from Cylinders where cy_id='$id'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);    
        return $fetch;
    }
    function getCylinderByGasIdFactory($gasId) {
       $query = "select cy.*,gs.gas_id,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.gas_id='$gasId' and cy.cust_id='1' and cy.filled_status=2 order by gs.name,cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getEmptyCylinderByGasIdFactory($gasId) {
      $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.gas_id='$gasId' and cy.cust_id='1' and cy.filled_status=1 order by gs.name,cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getCylinderByGasIdSupplier($gasId,$supl_id) {
       $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.gas_id='$gasId' and cy.supl_id='$supl_id' and cy.filled_status=2 order by gs.name,cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getRefillCylinders() {
       $query = "select * from Cylinders where cust_id='1' and filled_status=1 order by cy_no asc ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getCylinderByGasIdCustomer($cust_id,$chln_date) {
        $query = "select tdc.id,tdc.cy_no, mdc.chln_no,tdc.cy_id,tdc.mast_id,tdc.ret_remark,gs.gas_id,gs.name from tran_del_chln tdc inner join mast_del_chln mdc on tdc.mast_id = mdc.id inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where  (isnull(tdc.ret_chln_no) or tdc.ret_chln_no='') and  tdc.cy_id in (select cy_id from Cylinders where cust_id = '$cust_id') and mdc.chln_date <= '$chln_date' order by gs.name,tdc.cy_no";
        //max(tdc.mast_id) as chln_id,
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
     function getDeliveredCylByGasIdSupplier($supl_id,$chln_date,$chln_id) {
   $query = "select tdc.id,tdc.cy_no, mdc.refill_document,tdc.cy_id,tdc.mast_id,tdc.ret_remark,gs.name from tran_refill tdc inner join mast_refill mdc on tdc.mast_id = mdc.id inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.cy_id in (select cy_id from Cylinders where supl_id = '$supl_id') and mdc.date <= '$chln_date' and tdc.mast_id!='$chln_id'  and tdc.ret_chln_id>0 order by gs.name,tdc.cy_no";
       //max(tdc.mast_id) as chln_id,
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getDeliveredCylinder($cust_id,$chln_date,$chln_id) {
     $query = "select tdc.id,tdc.cy_no, mdc.chln_no,tdc.cy_id,tdc.mast_id,tdc.ret_remark,gs.name,gs.gas_id from tran_del_chln tdc inner join mast_del_chln mdc on tdc.mast_id = mdc.id inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where mdc.cust_id='$cust_id' and (tdc.ret_chln_no='' OR ISNULL (tdc.ret_chln_no)) and tdc.mast_id!='$chln_id' and mdc.chln_date <= '$chln_date'  order by gs.name,tdc.cy_no";
       $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
      function getRefilledCylinder($supl_id,$date,$chln_id) {
       $query = "select tdc.id,tdc.cy_no,mdc.refill_document,tdc.cy_id,tdc.mast_id,tdc.ret_remark,gs.name from tran_refill tdc inner join mast_refill mdc on tdc.mast_id = mdc.id inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where mdc.supl_id='$supl_id' and (tdc.ret_chln_no='' OR ISNULL (tdc.ret_chln_no)) and tdc.mast_id!='$chln_id' and mdc.date <= '$date' order by gs.name,tdc.cy_no";
       $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    /*------------------------------Gases--------------------*/
    function getAllGases() {
       $query = "select * from Gases order by name";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getCylindersforCustomer() {
      $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where  cy.cust_id='1' and cy.filled_status=2 order by cy.cy_no";
    $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getGasesbyId($id) {
       $query = "select * from Gases where gas_id='$id'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);    
        return $fetch;
    }
    
    /*------------------------------Mast_Del_Chln--------------------*/
    
    function insertMastDelChln($login_id,$cust_id,$challan_no,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR,$curr)
    {
        
        $query = "INSERT INTO `mast_del_chln`(`cust_id`, `chln_no`, `vehicle_no`, `chln_date`, `created_by`, `created_date`) VALUES ('$cust_id','$challan_no',UPPER('$vehicle_no'),'$chln_date','$login_id','$curr')";
        $stmts = $this->connection->prepare($query);         
        $stmts->execute();	  
        $chln_id = $this->connection->lastInsertId();
        
        //foreach for cylinder delivery factory to customer 
        foreach($cylinderR as $row){
    	$cyno=$this->getCylinderbyId($row);
      echo  $query1 = "INSERT INTO `tran_del_chln`(`mast_id`,`cy_id`,`cy_no`,`action`) VALUES ('$chln_id','$row','$cyno[cy_no]','1')";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        $query1 = "UPDATE `Cylinders` SET `cust_id`='$cust_id' WHERE cy_id='$row'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        }
        
        //foreach for  cylinder returned by customer to factory
        $cylinderRetRs=explode(",",$cylinderRetR);
        foreach($cylinderRetRs as $key => $row){
            $details=explode("#",$row);  
            //print_r($details);
            $cy_id=$details[0];
            $statusRem=explode("!",$details[1]);  
        	$status=trim($statusRem[0]);
        	$ChalaidRem=explode("@",$statusRem[1]);  
        	$tranId=trim($ChalaidRem[0]);
        	$remark=trim($ChalaidRem[1]);
        	$cyno=$this->getCylinderbyId($cy_id);
            
          $query1 = "UPDATE `tran_del_chln` SET `action`='2',`ret_chln_no`='$challan_no',`ret_status`='$status',`ret_chln_id`='$chln_id',ret_remark='$remark' WHERE cy_id='$cy_id' and id='$tranId'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
            
            $query1 = "UPDATE `Cylinders` SET `cust_id`='1' , `filled_status`='$status' WHERE cy_id='$cy_id'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
    
    
    }
    
    function updateDelChln($cust_id,$challan_id,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR)
    {
      echo "**".  $query1 = "UPDATE `mast_del_chln` SET `vehicle_no`=UPPER('$vehicle_no'),`chln_date`='$chln_date' WHERE cust_id='$cust_id' and id='$challan_id'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        
        foreach($cylinderR as $row){
    	$cyno=$this->getCylinderbyId($row);
     echo "**".  $query1 = "INSERT INTO `tran_del_chln`(`mast_id`,`cy_id`,`cy_no`,`action`) VALUES ('$challan_id','$row','$cyno[cy_no]','1')";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        $query1 = "UPDATE `Cylinders` SET `cust_id`='$cust_id' WHERE cy_id='$row'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        }
        
        $cylinderRetRs=explode(",",$cylinderRetR);
        foreach($cylinderRetRs as $key => $row){
            $details=explode("#",$row);  
            //echo "<pre>";print_r($details);
            $tranid=$details[0];
        	$status=trim($details[1]);
        	$cyId=trim($details[2]);
        	$retchln_no=trim($details[3]);
        	$ret_remark=trim($details[4]);
        	
        	$cyno=$this->getCylinderbyId($cyId);
        	$cylinderDetails=$this->getCylinderByChallanId($challan_id); 
        	$retchln_no=$cylinderDetails['chln_no'];
            
            //$query1 = "UPDATE `tran_del_chln` SET `ret_chln_no`='$challan_id',`ret_status`='$status',`ret_chln_id`='$challan_id' WHERE cy_id='$cyId'";
          echo "**". $query1 = "UPDATE `tran_del_chln` SET `action`='2',`ret_chln_no`='$retchln_no',`ret_status`='$status',`ret_chln_id`='$challan_id',ret_remark='$ret_remark' WHERE cy_id='$cyId' and id='$tranid'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
            
           echo  $query1 = "UPDATE `Cylinders` SET `cust_id`='1' , `filled_status`='$status' WHERE cy_id='$cyId'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
        
         
    
        
    }
    function deleteCustomerDelChln($tran_id,$mast_Id,$cy_id) {
        $query = "DELETE FROM `tran_del_chln` WHERE id='$tran_id' and mast_id='$mast_Id' and action='1'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		
	   $query1 = "UPDATE `Cylinders` SET `cust_id`='1' WHERE cy_id='$cy_id'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
       
         $count = $stmt->rowCount();
         print "Deleted $count row.\n";
    }
    function deleteCustomerRetChln($tran_id,$mast_Id,$cy_id,$cust_id) {
		
	    $query1 = "UPDATE `tran_del_chln` SET `action`='1',`ret_chln_no`='',`ret_status`='',`ret_chln_id`='',ret_remark='' WHERE cy_id='$cy_id' and id='$tran_id'";
            $stmt = $this->connection->prepare($query1);         
            $stmt->execute();
            
          $query1 = "UPDATE `Cylinders` SET `cust_id`='$cust_id' WHERE cy_id='$cy_id'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
          $count = $stmt->rowCount();
         print "Updated $count row.\n";
            
    }
    
    function deleteSupplierDelChln($tran_id,$mast_Id,$cy_id) {
        $query = "DELETE FROM `tran_refill` WHERE id='$tran_id' and mast_id='$mast_Id' and action='1'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		
	   $query1 = "UPDATE `Cylinders` SET `cust_id`='1' WHERE cy_id='$cy_id'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
       
         $count = $stmt->rowCount();
         print "Deleted $count row.\n";
    }
    
     function deleteSupplierRetChln($tran_id,$mast_Id,$cy_id,$cust_id) {
		
	    $query1 = "UPDATE `tran_refill` SET `action`='1',`ret_chln_no`='',`ret_status`='',`ret_chln_id`='',ret_remark='' WHERE cy_id='$cy_id' and id='$tran_id'";
            $stmt = $this->connection->prepare($query1);         
            $stmt->execute();
            
          $query1 = "UPDATE `Cylinders` SET `cust_id`='$cust_id' WHERE cy_id='$cy_id'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
          $count = $stmt->rowCount();
         print "Updated $count row.\n";
            
    }
     /*------------------------------Mast_Refill--------------------*/
    
    function insertMastDelRefillChln($login_id,$supl_id,$challan_no,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR,$curr)
    {
      echo  $query = "INSERT INTO `mast_refill`(`supl_id`, `refill_document`, `vehicle_no`, `date`, `created_by`, `created_date`) VALUES ('$supl_id','$challan_no',UPPER('$vehicle_no'),'$chln_date','$login_id','$curr')";
        $stmts = $this->connection->prepare($query);         
        $stmts->execute();	  
        $chln_id = $this->connection->lastInsertId();
        
        //foreach for cylinder delivery factory to customer 
        foreach($cylinderR as $row){
    	$cyno=$this->getCylinderbyId($row);
    echo    $query1 = "INSERT INTO `tran_refill`(`mast_id`,`cy_id`,`cy_no`,`action`) VALUES ('$chln_id','$row','$cyno[cy_no]','1')";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
     echo  $query1 = "UPDATE `Cylinders` SET `cust_id`='',`supl_id`='$supl_id' WHERE cy_id='$row'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        }
        //foreach for  cylinder returned by customer to factory
        $cylinderRetRs=explode(",",$cylinderRetR);
        foreach($cylinderRetRs as $key => $row){
            $details=explode("#",$row);  
            //print_r($details);
            $tranId=$details[0];
            $status=$details[1];
            $cy_id=$details[2];
            $ret_remark=$details[3];
        //	$cyno=$this->getCylinderbyId($cy_id);
            
        echo  $query1 = "UPDATE `tran_refill` SET `action`='2', `ret_chln_no`='$challan_no',`ret_status`='$status',`ret_chln_id`='$chln_id',ret_remark='$ret_remark' WHERE cy_id='$cy_id' and id='$tranId'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
            
            $query1 = "UPDATE `Cylinders` SET `cust_id`='1',`supl_id`='',`filled_status`='$status' WHERE cy_id='$cy_id'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
    }
    
      function updateDelRefillChln($supl_id,$challan_id,$chln_date,$vehicle_no,$cy_action,$gas_id,$cylinderR,$cylinderRetR)
    {
      echo "**".  $query1 = "UPDATE `mast_refill` SET `vehicle_no`=UPPER('$vehicle_no'),`date`='$chln_date' WHERE supl_id='$supl_id' and id='$challan_id'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        
        foreach($cylinderR as $row){
    	$cyno=$this->getCylinderbyId($row);
        echo "**".  $query1 = "INSERT INTO `tran_refill`(`mast_id`,`cy_id`,`cy_no`,`action`) VALUES ('$challan_id','$row','$cyno[cy_no]','1')";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        $query1 = "UPDATE `Cylinders` SET `cust_id`='',`supl_id`='$supl_id' WHERE cy_id='$row'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        }
        
        $cylinderRetRs=explode(",",$cylinderRetR);
        foreach($cylinderRetRs as $key => $row){
            $details=explode("#",$row);  
            //echo "<pre>";print_r($details);
            $tranid=$details[0];
        	$status=trim($details[1]);
        	$cyId=trim($details[2]);
        	$retchln_no=trim($details[3]);
        	$ret_remark=trim($details[4]);
        	
        	$cyno=$this->getCylinderbyId($cyId);
        	$cylinderDetails=$this->getRefillCylinderByChallanId($challan_id);
        	$retchln_no=$cylinderDetails['refill_document'];
            
            //$query1 = "UPDATE `tran_del_chln` SET `ret_chln_no`='$challan_id',`ret_status`='$status',`ret_chln_id`='$challan_id' WHERE cy_id='$cyId'";
          echo "**". $query1 = "UPDATE `tran_refill` SET `action`='2',`ret_chln_no`='$retchln_no',`ret_status`='$status',`ret_chln_id`='$challan_id',ret_remark='$ret_remark' WHERE cy_id='$cyId' and id='$tranid'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
            
           echo  $query1 = "UPDATE `Cylinders` SET `cust_id`='1',`supl_id`='' , `filled_status`='$status' WHERE cy_id='$cyId'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
        
         
    
        
    }
    
  function getCustomersCylinderList($cust_id) {
      if($cust_id=='1')
      {
          $action=2;
      }else{
         $action=1; 
      }
       $query = "select tdc.cy_no,mdc.chln_no,mdc.chln_date,tdc.filled_status from tran_del_chln tdc,mast_del_chln mdc where tdc.mast_id=mdc.id and mdc.cust_id='$cust_id' and tdc.action='$action' and (ISNULL(tdc.ret_chln_no) OR trim(tdc.ret_chln_no=''))  order by tdc.id desc ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
    
      function getSupplierCylinderList($supl_id) {
     
        $action=1;  //1-delivered 2-returned
        $query = "select tdc.cy_no,mdc.refill_document,mdc.date,tdc.filled_status from tran_refill tdc,mast_refill mdc where tdc.mast_id=mdc.id and mdc.supl_id='$supl_id' and tdc.action='$action' and (ISNULL(tdc.ret_chln_no) OR trim(tdc.ret_chln_no=''))  order by tdc.id desc ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
    function getCylinderByChallanId($chln_id) {
       $query = "select `id`, `cust_id`, `chln_no`, `vehicle_no`, `chln_date` from mast_del_chln where id='$chln_id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
    } 
     function getRefillCylinderByChallanId($chln_id) {
       $query = "select `id`, `supl_id`, `refill_document`, `vehicle_no`, `date` from mast_refill where id='$chln_id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
    } 
    function getCylinderByCustId($custId) {
       $query = "select * from mast_del_chln where cust_id='$custId' order by id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
      function getCylinderBySuplId($suplId) {
       $query = "select distinctrow `id`, `supl_id`, `refill_document`, `vehicle_no`, `date` from mast_refill where supl_id='$suplId' order by id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
    function getCustomersCylinderByChallanDeli($chln_id) {
      $query = "select tdc.*,gs.name from tran_del_chln tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$chln_id' or ret_chln_id='$chln_id' order by tdc.id desc";
    //   echo 'Deliver'.$query."<br>";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
    
      function getCylinderByChallanRet($chln_id) {
       $query = "select tdc.*,gs.name from tran_del_chln tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$chln_id' and tdc.ret_chln_id!='' order by tdc.id desc";
    //   echo 'Return'.$query;
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    
     function getSuppliersCylinderByChallanDeli($chln_id) {
      $query = "select tdc.*,gs.name from tran_refill tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$chln_id' or ret_chln_id='$chln_id' order by tdc.id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    } 
    
    function getCustomersCylinderByChallanRet($chln_id) {
       $query = "select tdc.*,mdc.chln_no from tran_del_chln tdc inner join mast_del_chln mdc On mdc.id=tdc.mast_id where tdc.mast_id='$chln_id' and ret_chln_id!='' order by id desc ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    
  
     function getRefillCylinderByChallanRet($chln_id) {
       $query = "select tdc.*,gs.name from tran_refill tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$chln_id' and tdc.ret_chln_id!='' order by tdc.id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    
    /*------------------------------Refill_Del_Chln-----------------------*/
    
    function insertRefillDelChln($login_id,$refill_date,$refill_document,$cylinderR,$curr)
    {
        foreach($cylinderR as $cyID){
        	$cyno=$this->getCylinderbyId($cyID);
        	$CYNO .=rtrim($cyno['cy_no'].',');
        	$query1 = "UPDATE `Cylinders` SET `cust_id`='1' , `filled_status`='2' WHERE cy_id='$cyID'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
        $CYNO =rtrim($CYNO, ',');
        $cyid=implode(",",$cylinderR);
        $query1 = "INSERT INTO `refill`(`refill_document`, `refill_date`, `cy_no`, `cy_id`, `created_by`, `created_date`) VALUES ('$refill_document','$refill_date','$CYNO','$cyid','$login_id','$curr')";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
    }
    function updateRefillDelChln($editId,$login_id,$refill_date,$refill_document,$cylinderR,$curr)
    {
        foreach($cylinderR as $cyID){
        	$cyno=$this->getCylinderbyId($cyID);
        	$CYNO .=rtrim($cyno['cy_no'].',');
        	$query1 = "UPDATE `Cylinders` SET `cust_id`='1' , `filled_status`='2' WHERE cy_id='$cyID'";
            $stmts1 = $this->connection->prepare($query1);         
            $stmts1->execute();
        }
        $CYNO =rtrim($CYNO, ',');
        $cyid=implode(",",$cylinderR);
        $query1 = "UPDATE `refill` SET `refill_document`='$refill_document',`refill_date`='$refill_date',`cy_no`='$CYNO',`cy_id`='$cyid',`updated_by`='$login_id',`updated_date`='$curr' WHERE `id`='$editId'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
    
    }
    function getAllRefillCylinders() {
       $query = "select * from refill order by refill_document,refill_date desc ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getRefillDatabyId($id) {
       $query = "select * from refill where id='$id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(PDO::FETCH_ASSOC); 		
        return $fetch;
    }
    function deleteRefillCylinder($loginId,$cyNos,$cyId,$refill_id,$deletecyId,$curr) {
       $query = "UPDATE `refill` SET `cy_no`='$cyNos',`cy_id`='$cyId',`updated_by`='$loginId',`updated_date`='$curr' WHERE `id`='$refill_id' ";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		
		$query1 = "UPDATE `Cylinders` SET `cust_id`='1' , `filled_status`='1' WHERE cy_id='$deletecyId'";
        $stmts1 = $this->connection->prepare($query1);         
        $stmts1->execute();
        
        
    }
    function getTrackingCylinders($cy_id,$from_date,$to_date){
     $query = "select * from (SELECT 'c' as type, mdc.chln_date as date,mdc.chln_no,mdc.cust_id,mdc.vehicle_no,tdc.`id`, tdc.`mast_id`, tdc.`cy_id`,gs.name, tdc.`cy_no`, tdc.`action`, tdc.`filled_status`, tdc.`delivered_through`, tdc.`ret_chln_no`, tdc.`ret_status`, tdc.`ret_chln_id`, tdc.`ret_remark` FROM `tran_del_chln` tdc 
        inner join mast_del_chln mdc on tdc.mast_id=mdc.id inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.cy_id='$cy_id' and mdc.chln_date BETWEEN '$from_date' and '$to_date' 
        UNION ALL select 's' as type, mdc.date as date,mdc.refill_document as chln_no,mdc.supl_id as cust_id,mdc.vehicle_no,tdc.`id`, tdc.`mast_id`, tdc.`cy_id`,gs.name, tdc.`cy_no`, tdc.`action`, tdc.`filled_status`, tdc.`delivered_through`, tdc.`ret_chln_no`, tdc.`ret_status`, tdc.`ret_chln_id`, tdc.`ret_remark` FROM `tran_refill` tdc 
        inner join mast_refill mdc on tdc.mast_id=mdc.id  inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.cy_id='$cy_id' and mdc.date BETWEEN '$from_date' and '$to_date')a order by date";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC); 		
        return $fetch;
    }
    
    //========================Newly added  by asharani========================
    
    function getDeliveryChallanByDate($from_date,$to_date) {
           
      $query = "select tdc.*,mdc.id,mdc.chln_no,mdc.chln_date,mdc.cust_id,mdc.vehicle_no from tran_del_chln tdc inner join mast_del_chln mdc On mdc.id=tdc.mast_id where mdc.chln_date between '$from_date' and '$to_date' order by mdc.chln_date desc";
      $stmt = $this->connection->prepare($query);
	  $stmt->execute();
	  $fetch = $stmt->fetchAll(); 		
      return $fetch;
    }
    
    function getRefillDeliveryChallanByDate($from_date,$to_date) {
     
     $query = "select tdc.*,mdc.id,mdc.refill_document,mdc.date,mdc.supl_id,mdc.vehicle_no from tran_refill tdc inner join mast_refill mdc On mdc.id=tdc.mast_id where mdc.date between '$from_date' and '$to_date' order by mdc.date desc";
     $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    function getGasesbyCylId($id){
        $query = "select gs.gas_id,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.cy_id='$id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
    }
  function getcompanyDetails(){
       $query = "select * from mast_company";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
  }
   function getDCMastById($id){
        $query = "select `id`, `cust_id`, `chln_no`, `vehicle_no`, `chln_date` from mast_del_chln where id='$id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
   }
    function getDCDetails($id){
        $query = "select tdc.*,gs.name from tran_del_chln tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$id' order by tdc.id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
   }
      function getCntDCDetails($id){
      $query = "select count(gs.gas_id) as qty,gs.name,gs.gas_id from tran_del_chln tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$id' group by gs.gas_id  order by tdc.id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
   }
      function getCntRetDCDetails($id){
      $query = "select count(gs.gas_id) as qty,gs.name,gs.gas_id from tran_del_chln tdc inner join Cylinders cy on tdc.cy_id=cy.cy_id inner join Gases gs On cy.gas_id=gs.gas_id where tdc.mast_id='$id' and ret_chln_id!='' group by gs.gas_id  order by tdc.id desc";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
   }
   
   //=================================  28-03-2024 =========================================
    function getTotalCylinders() {
        $query = "select cy_id from Cylinders";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
     function getTotfilledCylinders() {
        $query = "select cy_id from Cylinders where filled_status=2";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
     function getTotEmptyCylinders() {
        $query = "select cy_id from Cylinders where filled_status=1";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
      function getTotDeliveredCylinders() {
        $query = "select cy_id from Cylinders where cust_id!=1";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();		
		$num = $stmt->rowCount();
		return $num;	       
    }
    function getTotGasDelivered($gas_id){
        $query = "SELECT count(gs.gas_id) as delivered_gas FROM `tran_del_chln` tdc 
        inner join Cylinders cy on tdc.cy_id=cy.cy_id 
        inner join Gases gs On cy.gas_id=gs.gas_id where tdc.`action`=1 and gs.gas_id='$gas_id';";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch['delivered_gas'];
    }
    function getTotGasDeliveredSup(){
         $query = "SELECT count(gs.gas_id) as delivered_gas FROM `tran_refill` tdc 
        inner join Cylinders cy on tdc.cy_id=cy.cy_id 
        inner join Gases gs On cy.gas_id=gs.gas_id where tdc.`action`=1 and gs.gas_id='$gas_id';";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch['delivered_gas'];
    }
       function getTotEmptyGas($gas_id){
        $query = "SELECT count(gas_id) as empty_gas FROM Cylinders where gas_id='$gas_id' and filled_status=1;";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch['empty_gas'];
    }
    
         function getTotGas($gas_id){
        $query = "SELECT count(gas_id) as totgas FROM Cylinders where gas_id='$gas_id'";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch['totgas'];
    }
     function getTotFilledGas($gas_id){
        $query = "SELECT count(gas_id) as filled_gas FROM Cylinders where gas_id='$gas_id' and filled_status=2;";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch['filled_gas'];
    }
    	function insertCylinderRangewise($cust_id,$gas_id,$cy_no) {
        $query = "INSERT INTO `Cylinders`(`gas_id`, `cust_id`, `cy_no`) VALUES ('$gas_id','$cust_id','$cy_no')";
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();
		 $insertid = $this->connection->lastInsertId();
		 return $insertid;
    }
    
    function getEmptyCylinderforsup() {
     $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.cust_id='1' and cy.filled_status=1 order by gs.name,cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    
    function getCylinderforReturnSupplier($supl_id) {
       $query = "select cy.*,gs.name from Cylinders cy inner join Gases gs On cy.gas_id=gs.gas_id where cy.supl_id='$supl_id' and cy.filled_status=2 order by gs.name,cy.cy_no";
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetchAll(); 		
        return $fetch;
    }
    
    
    // added by sakshi on 06-11-2024
    function checkUserName($username)
    {
         $query ="SELECT * FROM login_master WHERE username = '$username'";
        //  echo $query;
        $stmt = $this->connection->prepare($query);
 
$stmt->execute();
$fetch=$stmt->fetch(PDO::FETCH_ASSOC);
return $fetch;

    }
    
    function updatePassword($new_password,$username){
        $query = "UPDATE login_master SET `password` = '$new_password' WHERE username = '$username'";
        // echo $query; exit;
        $stmts = $this->connection->prepare($query);         
		$stmts->execute();	       
		return 1;
    }
    
    // added on 08-11-2024 by sakshi 
    public function chalanDate() {
    //   echo "111111";exit;
        $query = "SELECT * FROM mast_del_chln ORDER BY id DESC LIMIT 1";  // Fetch the earliest record
        // echo $query;exit;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $fetch = $stmt->fetch();  
        // Return the 'chln_date' of the first occurrence
        return $fetch ? $fetch['chln_date'] : null;  // Return date, or null if no record found
    }
    // Added on 13-11-2024 by sakshi
    function displayLastCust() {
       $query = "SELECT 
    mast_del_chln.chln_date, 
    mast_del_chln.chln_no, 
    customer.name 
FROM 
    mast_del_chln 
INNER JOIN 
    customer 
ON 
    mast_del_chln.cust_id = customer.cust_id 
ORDER BY 
    mast_del_chln.id DESC 
LIMIT 1;";
echo $query;
        $stmt = $this->connection->prepare($query);
		$stmt->execute();
		$fetch = $stmt->fetch(); 		
        return $fetch;
    }
    
}
?>