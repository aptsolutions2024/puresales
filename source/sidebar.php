<?php
if($_SESSION['name']=='')
{
 echo '<script type="text/javascript">window.location="/home"; </script>';   
}
?>
<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!--plugins-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
  <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link href="assets/plugins/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
   <!--<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />-->
      <link href="assets/css/datatables.min.css" rel="stylesheet" />
  <!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
  <!--Theme Styles-->
  <link href="assets/css/dark-theme.css" rel="stylesheet" />
  <!--<link href="assets/css/light-theme.css" rel="stylesheet" />
  <link href="assets/css/semi-dark.css" rel="stylesheet" />-->
  <link href="assets/css/header-colors.css" rel="stylesheet" />
  <style>
     .top-header .navbar .user-img{
         width:40px;
         height:40px;
      }
      
  </style>
</head>

<body>


  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
      <header class="top-header">        
        <nav class="navbar navbar-expand gap-3">
          <div class="mobile-toggle-icon fs-3">
              <i class="bi bi-list"></i>
            </div>
            <form class="searchbar">
                <div class="position-absolute top-50 translate-middle-y search-icon ms-3"><i class="bi bi-search"></i></div>
                <input class="form-control" type="text" placeholder="Type here to search">
                <div class="position-absolute top-50 translate-middle-y search-close-icon"><i class="bi bi-x-lg"></i></div>
            </form>
            <div class="top-navbar-right ms-auto">
              <ul class="navbar-nav align-items-center">
                <li class="nav-item search-toggle-icon">
                  <a class="nav-link" href="#">
                    <div class="">
                      <i class="bi bi-search"></i>
                    </div>
                  </a>
              </li>
              <li class="nav-item dropdown dropdown-user-setting">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                  <div class="user-setting d-flex align-items-center">
                    <img src="assets/images/avatars/FB2.jpg" class="user-img" alt=""  >
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                     <a class="dropdown-item" href="#">
                       <div class="d-flex align-items-center">
                          <img src="assets/images/avatars/FB2.jpg" alt="" class="rounded-circle" width="150px" height="150px">
                          <div class="ms-3">
                            <h6 class="mb-0 dropdown-user-name"><?=$_SESSION['name'];?></h6>
                            <small class="mb-0 dropdown-user-designation text-secondary">Management</small>
                          </div>
                       </div>
                     </a>
                   </li>
                   <li><hr class="dropdown-divider"></li>
                   <li>
                      <a class="dropdown-item" href="#">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-person-fill"></i></div>
                           <div class="ms-3"><span>Profile</span></div>
                         </div>
                       </a>
                    </li>
                    
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <a class="dropdown-item" href="/logout">
                         <div class="d-flex align-items-center">
                           <div class=""><i class="bi bi-lock-fill"></i></div>
                           <div class="ms-3"><span>Logout</span></div>
                         </div>
                       </a>
                    </li>
                </ul>
              </li>
              
              <!--<li class="nav-item dropdown dropdown-large">-->
              <!--  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">-->
              <!--    <div class="messages">-->
              <!--      <span class="notify-badge">5</span>-->
              <!--      <i class="bi bi-chat-right-fill"></i>-->
              <!--    </div>-->
              <!--  </a>-->
              <!--  <div class="dropdown-menu dropdown-menu-end p-0">-->
              <!--    <div class="p-2 border-bottom m-2">-->
              <!--        <h5 class="h5 mb-0">Messages</h5>-->
              <!--    </div>-->
              <!--   <div class="header-message-list p-2">-->
              <!--       <a class="dropdown-item" href="#">-->
              <!--         <div class="d-flex align-items-center">-->
              <!--            <img src="assets/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="50" height="50">-->
              <!--            <div class="ms-3 flex-grow-1">-->
              <!--              <h6 class="mb-0 dropdown-msg-user">Amelio Joly <span class="msg-time float-end text-secondary">1 m</span></h6>-->
              <!--              <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">The standard chunk of lorem...</small>-->
              <!--            </div>-->
              <!--         </div>-->
              <!--       </a>-->
                   
              <!--  </div>-->
              <!--  <div class="p-2">-->
              <!--    <div><hr class="dropdown-divider"></div>-->
              <!--      <a class="dropdown-item" href="#">-->
              <!--        <div class="text-center">View All Messages</div>-->
              <!--      </a>-->
              <!--  </div>-->
              <!-- </div>-->
              <!--</li>-->
              <!--<li class="nav-item dropdown dropdown-large">-->
              <!--  <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">-->
              <!--    <div class="notifications">-->
              <!--      <span class="notify-badge">8</span>-->
              <!--      <i class="bi bi-bell-fill"></i>-->
              <!--    </div>-->
              <!--  </a>-->
              <!--  <div class="dropdown-menu dropdown-menu-end p-0">-->
              <!--    <div class="p-2 border-bottom m-2">-->
              <!--        <h5 class="h5 mb-0">Notifications</h5>-->
              <!--    </div>-->
              <!--    <div class="header-notifications-list p-2">-->
              <!--        <a class="dropdown-item" href="#">-->
              <!--          <div class="d-flex align-items-center">-->
              <!--             <div class="notification-box bg-light-primary text-primary"><i class="bi bi-basket2-fill"></i></div>-->
              <!--             <div class="ms-3 flex-grow-1">-->
              <!--               <h6 class="mb-0 dropdown-msg-user">New Orders <span class="msg-time float-end text-secondary">1 m</span></h6>-->
              <!--               <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center">You have recived new orders</small>-->
              <!--             </div>-->
              <!--          </div>-->
              <!--        </a>-->
                     
              <!--   </div>-->
              <!--   <div class="p-2">-->
              <!--     <div><hr class="dropdown-divider"></div>-->
              <!--       <a class="dropdown-item" href="#">-->
              <!--         <div class="text-center">View All Notifications</div>-->
              <!--       </a>-->
              <!--   </div>-->
              <!--  </div>-->
              <!--</li>-->
              </ul>
              </div>
        </nav>
      </header>
       <!--end top header-->
		<aside class="sidebar-wrapper" data-simplebar="true">
          <div class="sidebar-header">
            <div>
              <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
              <h4 class="logo-text">Pure Sales</h4>
            </div>
            <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
            </div>
          </div>
          <!--navigation-->
          <ul class="metismenu" id="menu">
           
            <li class="menu-label">Dashboard</li>
			<li>
              <a href="/dashboard">
                <div class="parent-icon"><i class="bi bi-tags-fill"></i>
                </div>
                <div class="menu-title">Dashboard</div>
              </a>
            </li>
            <li class="menu-label">Customer Details</li>
			<li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Customer</div>
              </a>
             <ul>
                <li> <a href="/add-customer"><i class="bi bi-circle"></i>Add</a></li>
                <li> <a href="/view-customers"><i class="bi bi-circle"></i>View / Edit</a></li>
                <li> <a href="/cust-cylinder-details"><i class="bi bi-circle"></i>Cylinder Details</a>            </li>
               
              </ul>
            </li>
			    <li class="menu-label">Supplier Details</li>
			<li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-grid-fill"></i>
                </div>
                <div class="menu-title">Supplier</div>
              </a>
             <ul>
                <li> <a href="/add-supplier"><i class="bi bi-circle"></i>Add</a></li>
                <li> <a href="/view-suppliers"><i class="bi bi-circle"></i>View / Edit</a></li>
                <li> <a href="/supl-cylinder-details"><i class="bi bi-circle"></i>Cylinder Details</a>            </li>
               
              </ul>
            </li>
			 <li class="menu-label">Cylinder Details</li>
            <li>
             <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-droplet-fill"></i>
                </div>
                <div class="menu-title">Cylinder</div>
              </a>
              <ul>
			   <li> <a href="/add-cylinder"><i class="bi bi-circle"></i>Add</a></li>
                <li> <a href="/view-cylinder"><i class="bi bi-circle"></i>View / Edit</a>          </li>
                 <li> <a href="/track-cylinder"><i class="bi bi-circle"></i>Track Cylinder</a></li>
               
              </ul>
            </li>
			 <li class="menu-label">Cust. Delivery Challan</li>
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-basket2-fill"></i>
                </div>
                <div class="menu-title">Cust. Delivery Challan</div>
              </a>
              <ul>
			  <li> <a href="/add-delivery-chln"><i class="bi bi-circle"></i>Add </a></li>
			  <li> <a href="/edit-delivery-chln"><i class="bi bi-circle"></i>Edit </a>   </li>
			  <li> <a href="/view-delivery-chln"><i class="bi bi-circle"></i>View</a>   </li>
              <li> <a href="/delete-delivery-chln"><i class="bi bi-circle"></i>Delete </a>
            </li>
          </ul>
        </li>
			 <!--<li class="menu-label">Inox Cylinder</li>-->
    <!--        <li>-->
    <!--          <a class="has-arrow" href="javascript:;">-->
    <!--            <div class="parent-icon"><i class="bi bi-award-fill"></i>-->
    <!--            </div>-->
    <!--            <div class="menu-title">Inox Cylinder</div>-->
    <!--          </a>-->
    <!--          <ul>-->
			 <!-- <li> <a href="/add-inox-cylinder"><i class="bi bi-circle"></i>Add Inox Cylinder</a></li>-->
    <!--            <li> <a href="/view-inox-cylinder"><i class="bi bi-circle"></i>View Inox Cylinder</a>-->
    <!--            </li>-->
               
    <!--          </ul>-->
    <!--        </li>-->
			 <li class="menu-label">Refill Cylinder( For Sending / Receiving )</li>
            <li>
              <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi-file-arrow-up-fill"></i>
                </div>
                <div class="menu-title">Refill Cylinder( For Sending / Receiving )</div>
              </a>
              <ul>
			   <li> <a href="/add-refill-cylinder"><i class="bi bi-circle"></i>Add</a></li>
                <li> <a href="/edit-refill-chln"><i class="bi bi-circle"></i>Edit </a>   </li>
                <li> <a href="/view-refill-cylinder"><i class="bi bi-circle"></i>View</a></li>
                <li> <a href="/delete-refill-chln"><i class="bi bi-circle"></i>Delete </a> </li>
               
              </ul>
            </li>
  
			 <!--<li class="menu-label">Reports</li>-->
    <!--        <li>-->
    <!--          <a href="javascript:;" class="has-arrow">-->
    <!--            <div class="parent-icon"><i class="bi bi-droplet-fill"></i>-->
    <!--            </div>-->
    <!--            <div class="menu-title">Reports</div>-->
    <!--          </a>-->
    <!--          <ul>-->
			 <!--  <li> <a href="/track-cylinder"><i class="bi bi-circle"></i>Track Cylinder</a></li>-->
              
               
    <!--          </ul>-->
    <!--        </li>-->
          </ul>
          <!--end navigation-->
       </aside>