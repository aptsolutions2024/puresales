<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <!-- Bootstrap CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/bootstrap-extended.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/css/icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.5.0/font/bootstrap-icons.css">

  <!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />

  <title>Puresales - Sign In</title>
</head>

<body>

  <!--start wrapper-->
  <div class="wrapper">
    
       <!--start content-->
       <main class="authentication-content">
        <div class="container-fluid">
          <div class="authentication-card">
            <div class="card shadow rounded-0 overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                  <img src="assets/images/error/auth-img-7.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                  <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title">Sign In</h5>
                    <p class="card-text ">See your growth and get consulting support!</p>
                    <form class="form-body" method="POST" onsubmit="return validation();" action="/login-process" method="post">
                      
                      <div class="login-separater text-center mb-4"> <span> SIGN IN WITH USERNAME</span>
                        <hr>
                      </div>
                        <div class="row g-3">
                          <div class="col-12">
                            <label for="username" class="form-label">Enter Username</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-envelope-fill"></i></div>
                              <input type="text" class="form-control radius-30 ps-5" id="username" name="username" placeholder="Enter Username">
                            </div>
                          </div>
                          <div class="col-12">
                            <label for="password" class="form-label">Enter Password</label>
                            <div class="ms-auto position-relative">
                              <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-lock-fill"></i></div>
                              <input type="password" class="form-control radius-30 ps-5" id="password" name="password" placeholder="Enter Password">
                            </div>
                          </div>
                          <!--<div class="col-6">-->
                          <!--  <div class="form-check form-switch">-->
                          <!--    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">-->
                          <!--    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>-->
                          <!--  </div>-->
                          <!--</div>-->
                          <div class="col-6 text-end">	<a href="/authentication-forgot-password">Forgot Password ?</a>
                          </div>
                          <div class="col-12">
                            <div class="d-grid">
                              <button type="submit" class="btn btn-primary radius-30">Sign In</button>
                            </div>
                          </div>
                         
                        </div>
                    </form>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       </main>
        
       <!--end page main-->

  </div>
  <!--end wrapper-->


  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/pace.min.js"></script>
<script>
 function validation()
{
var username=$("#username").val();
var password=$("#password").val();
$("#username").removeClass('bordererror');
$("#password").removeClass('bordererror');
var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
if(username ==""){
   $("#username").focus();
   errors ="Please enter username";
   $("#username").val('');
   $("#username").addClass('bordererror');
   $("#username").attr("placeholder", errors);
   return false;
} 
else if(password ==""){
    $("#email").addClass('valid');
   $("#password").focus();
   errors ="Please enter email";
   $("#password").val('');
   $("#password").addClass('bordererror');
   $("#password").attr("placeholder", errors);
   return false;
}
}
</script>

</body>

</html>