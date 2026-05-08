<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ORGANIZATION :: TRICKEDOUT</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
   @font-face { font-family: Gotham; src: url("fonts/Gotham-Book.woff") format("woff"), url("fonts/Gotham-Book.woff2") format("woff2"), url("fonts/Gotham-Book.ttf") format("truetype"); font-weight: normal; }
   @font-face { font-family: GothamBold; src: url("fonts/Gotham-Bold.ttf") format("truetype"); }
   @font-face { font-family: GothamMedium; src: url("fonts/Gotham-Medium.ttf") format("truetype"); }
   body
   {
    font-family:"Gotham"!important;
  }
  .form-control {
    font-family:"Gotham"!important;
  }

  .box23 {
    width: 500px;
  }
  @media (max-width: 767px) {
    .box23 {
      width: 360px;
    }
  }
  .back_blue{width: 100%;}
  .login_space {
    background-color: rgba(0, 0, 0, 0.3);
    min-height: 100vh;
    ::placeholder
    {color:#000!important;}
  </style>
</head>
<body class="login_bg">
  <div class="login_space">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12">
          <div class="py-4 px-3 box23">
           <!--  <img src="<?= base_url('org_image/'.$organization->org_logo); ?>" class="img-fluid" style="width:100px;">
            <div class="text-white mt-4">
                <h4 class="fw-bold">Welcome</h4> </div>
            <div class="text-white"><h4 class="fw-bold">"<?php echo $organization->org_name; ?>"</h4></div>
            <div class="text-white"><h4 class="fw-bold">Members!</h4></div> -->
            <div style="background-color:rgba(0,0,0,.7);">
            <div class="text-white mt-3 text-center">
              <h4 class="fw-bold">Welcome</h4> 
            </div>

            <div class="text-center"><img src="<?= base_url('org_image/'.$organization->org_logo); ?>" class="img-fluid text-center" style="height:80px;"></div>

            <div class="text-white">
              <h4 class="fw-bold mt-3 text-center">
                <?php 
                if($organization->association_or_not == 1){
                  echo "Members!";
                }else{
                  echo "Customers";
                }
                ?>
              </h4>
            </div>


            <div class="text-white text-center mt-3 pb-2">
              <h6>Create your free Tricked Out Magic Vault account to receive <?php echo $organization->org_memory; ?>GB of secure cloud storage</h6>
            </div>
</div>
            <form action="<?= base_url('orgdetailssubmit') ?>" method="POST" id="loginForm">  
              <?= csrf_field() ?>
              <input type="hidden" name="orgid" value="<?php echo $orgid; ?>">        
              <input type="hidden" name="email_id" value="<?= $email ?? '' ?>">
              <input type="hidden" name="coupon" value="<?= $organization->coupon ?? '' ?>">
              <input type="hidden" name="phone" value="<?= $userdetails->phone ?? '' ?>">

              <div class="card fw-bold">
                <div class="d-flex align-items-top p-3" style="background-color:#E1F2E6;">
                  <?php 
                if($organization->association_or_not == 1){ ?>
                 <div class="ms-2" style="color:green;">
                  <div class="d-flex align-items-center justify-content-start">
                    <div class="me-1"><img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:20px;"></div>                    
                    <div>Membership Verified!</div>
                  </div>
                  <div class="mt-3">You've unlocked <?php echo $organization->org_memory; ?>GB Tricked Out Magic for <?php echo $organization->month; ?> months as a <?php echo $organization->org_name; ?> Customer</div>

                </div>

              <?php }else{ ?>
                <div class="ms-2" style="color:green;">
                  <div class="d-flex justify-content-start">
                    <div class="me-1"><img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:50px;">
                    </div>                    
                    <div >
                  Success! As a "<?php echo $organization->org_name; ?>"  customer, you qualify for <?php echo $organization->org_memory; ?>GB of free cloud storage. Auto- filled information is shown below:
                </div>
                  </div>

                </div> 
              <?php } ?> 

                  </div>
                  <div class=" mt-1 p-3">
                    <div class="row">
                      <div class="col-lg-6 col-md-12 mt-2"  style="color:#B2B2B2;">
                        First Name
                        <input type="text" class="form-control" name="first_name" value="<?= $userdetails->firstname ?? '' ?>"  style="height:40px;" required="">
                      </div>
                      <div class="col-lg-6 col-md-12 mt-2" style="color:#B2B2B2;">
                        Last Name
                        <input type="text" class="form-control" name="last_name"  value="<?= $userdetails->lastname ?? '' ?>" style="height:40px;" required="">
                      </div>
                    </div>

                    <input type="password" class="form-control mt-2" name="password" placeholder="Password" style="height:40px;" required="">
                    <div id="password_error" style="color:red;font-size:13px;"></div>
                    <input type="password" class="form-control mt-2" placeholder="Confirm Password" id="confirm_password" name="confirm_password" style="height:40px;" required="">
                    <!-- <div class="float-end mt-2">
                        Password Strength <img src="<?= base_url('assets/images/password-strength.svg') ?>" class="img-fluid" style="width:100px;">
                    </div> -->
                    <button type="submit" id="loginBtn" class="btn btn-success w-100 mb-2 mt-3 br0 text-white" style="font-size:20px;letter-spacing:2px; height: 40px;">
                      <span id="btnText">GET STARTED</span>
                      <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                    </button>
                    <div class="d-flex justify-content-center align-items-center">
                      <div>
                        <img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:20px;"> 
                      </div>
                      <div class="ms-2" style="font-size:14px;">
                        8 or more characters
                      </div>
                      <div class="ms-5">
                        <img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:20px;"> </div>
                        <div class="ms-2" style="font-size:14px;">
                          Includes a number
                        </div>
                      </div>
                      <div style="font-size:10px;" class="ms-2 mt-2">
                        <a href="#/">Privacy Policy</a>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="mt-5" >
                  <div class="text-center text-white box23">
                    <div style="font-size:9px;" class="text-center text-white mt-5"> © <?= date('Y')?> Tricked Out Magic Vault. all rights reserved.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
<!-- ========================== Footer section end ========================== -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
 
<script>
  document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('loginForm');
    const btn  = document.getElementById('loginBtn');
    const text = document.getElementById('btnText');
    const loader = document.getElementById('btnLoader');

    const password = document.querySelector('input[name="password"]');
    const confirmPassword = document.getElementById('confirm_password');
    const errorBox = document.getElementById('password_error');

    function validatePassword() {

      const pass = password.value;

      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

      if(!regex.test(pass)){
        errorBox.innerText = "Passwords must contain 8 characters, 1 uppercase, 1 lowercase, 1 number and 1 special character.";
        return false;
      }

      if(pass !== confirmPassword.value){
        errorBox.innerText = "Password and Confirm Password do not match.";
        return false;
      }

      errorBox.innerText = "";
      return true;
    }

    password.addEventListener('keyup', validatePassword);
    confirmPassword.addEventListener('keyup', validatePassword);

    form.addEventListener('submit', function (e) {

      if(!validatePassword()){
        e.preventDefault();
        return false;
      }

      btn.disabled = true;
      text.innerText = 'Sign up...';
      loader.classList.remove('d-none');

    });

  });
</script>
</body>

</html>