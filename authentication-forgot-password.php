<!doctype html>
<html lang="en" class="light-theme">

<head>
  <!-- Required meta tags and links -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <title>Puresales - Forgot Password</title>
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
                  <h5 class="card-title">Forgot Password</h5>
                  <!-- Message area -->
                  <div id="message" class="mb-3"></div>
                  
                  <form id="forgot-password-form" class="form-body" method="POST">
                    <div class="login-separater text-center mb-4"> 
                      <span> Re-set Your Password</span>
                      <hr>
                    </div>
                    <div class="row g-3">
                      <div class="col-12">
                        <label for="username" class="form-label">Enter Username</label>
                        <input type="text" class="form-control radius-30" id="username" name="username" placeholder="Enter Username">
                      </div>
                      <div class="col-12">
                        <label for="password" class="form-label">Enter New Password</label>
                        <input type="password" class="form-control radius-30" id="password" name="password" placeholder="Enter Password">
                      </div>
                      <div class="col-12">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control radius-30" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button type="submit" class="btn btn-primary radius-30">Change Password</button>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                           <button type="button" class="btn radius-30" style="background-color: #adcbf1; color: black;" onclick="window.location.href='/home';">Login</button>
  
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
  </div>
  
  <!--plugins-->
  <script src="assets/js/jquery.min.js"></script>
  <script>
    // JavaScript to handle form submission and display messages
    $(document).ready(function() {
      $('#forgot-password-form').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
          url: '/forgot-process.php',
          type: 'POST',
          data: $(this).serialize(),
          success: function(response) {
            const messageElement = $('#message');
            if (response.includes("successfully")) {
              messageElement.html(response).css('color', 'green');
            } else {
              messageElement.html(response).css('color', 'red');
            }
          }
        });
      });
    });
  </script>
</body>
</html>
