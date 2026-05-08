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
}
.otp-input {
    width: 40px;          /* keep width fixed */
    height: 50px;         /* height for uniform size */
    font-size: 22px;      /* large number */
    font-weight: bold;
    text-align: center;   /* center the number */
    border: 2px solid #d3d3d3;
    border-radius: 5px;
    background-color: #fff;
    color: #000;
    outline: none;
    /* remove padding */
}
.otp-input:focus {
    border-color: #4bb649;
    box-shadow: 0 0 5px rgba(75,182,73,0.5);
}
@media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
  .otp-wrapper .otp-input {
    width: 25px;
    height: 30px;
  }
}
@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
  .otp-wrapper .otp-input {
    width: 30px;
    height: 45px;
  }
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  .otp-wrapper .otp-input {
    width: 45px;
    height: 55px;
  }
  .tick-icon {
  transition: transform 0.2s ease;
}

</style>
</head>
<body class="login_bg">
<div class="login_space">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="py-3 box23">
            
            <div style="background-color:rgba(0,0,0,.7);">
            <div class="text-white mt-3 text-center">
                <h4 class="fw-bold">Welcome</h4> 
                </div>
               
            <div class="text-center">
                <img src="<?= base_url('org_image/'.$organization->org_logo); ?>" class="img-fluid" style="height:80px;">
            </div>
            
          
         <div class="text-white mt-3 text-center">
                <h4 class="fw-bold"> 
                    <?php 
                        if($organization->association_or_not == 1){
                            echo "Members!";
                        }else{
                            echo "Customers";
                        }
                    ?>
              </h4> 
                </div>


            <div class="text-warning mt-3 text-center">
                <h5 class="fw-bold">Exclusive Member Benefit</h5>
            </div>
           
            <div class="text-white text-center pb-2">
            
                    <div class="fw-bold text-center" style="font-size:20px;"><?php echo $organization->org_memory; ?>GB Free Storage 
                      <span style="font-size:16px;">- Included Through <?php echo $organization->org_upto; ?></span>
                    </div>
         </div>
     
         </div>    
          <form action="<?= base_url('orgdetailssubmit') ?>" method="POST" id="loginForm">  
        <?= csrf_field() ?>
        <input type="hidden" name="orgid" value="<?php echo $orgid; ?>">        
         <input type="hidden" name="association" value="<?= $organization->association_or_not ?? '' ?>">
         <input type="hidden" name="org_code" value="<?= $organization->org_code ?? '' ?>">
            <input type="hidden" name="coupon" value="<?= $organization->coupon ?? '' ?>">
            <div class="card p-3  fw-bold box23">
              <div style="font-size: 12px;color:red;text-align: center;" id="error-message"></div>
              
                Enter your email address
                <div class="mt-2">
                    
                    

                    <input type="email" id="email" class="form-control" name="userName" style="height:40px;" required>

                    <button type="button" id="sendOtpBtn"
                        class="btn btn-success w-100 my-2" disabled>
                        CONTINUE
                    </button>

                    <!-- OTP Section -->
                    <div id="otpSection" class="mt-2 d-none">
                        
                    <div class="form-group otp-wrapper" style="display:flex;justify-content:center;gap:10px;">
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                      <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
                    </div>
                        <button type="button" id="verifyOtpBtn"
                            class="btn btn-primary w-100 my-2">
                            VERIFY OTP
                        </button>
                    </div>
                    <div id="otp_msg" style="font-size:13px; margin-top:5px;"></div>
                    <!-- User Info Section -->

                    <div id="userInfoSection" class="d-none">
                        
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
                    <div class="row">
                      <div class="col-lg-6 col-md-12 mt-2"  style="color:#B2B2B2;">
                        First Name
                        <input type="text" class="form-control" name="first_name" id="first_name" value=""  style="height:40px;" required="">
                      </div>
                      <div class="col-lg-6 col-md-12 mt-2" style="color:#B2B2B2;">
                        Last Name
                        <input type="text" class="form-control" name="last_name"  value="" style="height:40px;" required="" id="last_name">
                      </div>
                    </div>
                        
                        <input type="password" class="form-control mt-2" name="password" placeholder="Password" style="height:40px;" required="" id="password">
                        <div id="password_error" style="color:red;font-size:13px;"></div>
                        <input type="password" class="form-control mt-2" placeholder="Confirm Password" id="confirm_password" name="confirm_password" style="height:40px;" required="">
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
                    <div style="font-size:10px;">
                        By continuing, you agree to the Tricked Out Magic Vault. <a href="#/">Terms of Service</a> and <a href="#/">Privacy Policy</a>
                    </div>
                </div>
            </div>
          </form>
            <div class="mt-3 ms-3">
                <div class="d-flex align-items-top">
                    <div>
                        <img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:25px;"> </div>
                    <div class="text-white ms-2">
                        Enjoy <?php echo $organization->org_memory; ?>GB of secure cloud storage
                        <br/> (included through <?php echo $organization->org_upto; ?>)
                    </div>
                </div>
                <div class="d-flex align-items-top mt-2">
                    <div>
                        <img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:25px;"> </div>
                    <div class="text-white ms-2">
                        Auto-fill your profile for easy setup
                    </div>
                </div>
                <div class="d-flex align-items-top mt-2">
                    <div>
                        <img src="<?= base_url('assets/images/tick-img.svg') ?>" class="img-fluid" style="width:25px;"> </div>
                    <div class="text-white ms-2">
                        Exclusive benefit for association members!
                    </div>
                </div>
             </div>
        </div>
         <div class="text-center text-white box23">
                    <div style="font-size:9px;" class="text-center text-white mt-4"> © <?= date('Y')?> Tricked Out Magic Vault. all rights reserved.</div>
                </div>
    </div>
  </div>
</div>
</div>

<!-- ========================== Footer section end ========================== -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

  const form = document.getElementById('loginForm');
  const btn  = document.getElementById('loginBtn');
  const text = document.getElementById('btnText');
  const loader = document.getElementById('btnLoader');
//alert(1);
  if (!form || !btn) return; // 🔐 safety check
//alert(2);
  // form.addEventListener('submit', function () {
  //   //alert(3);
  //   btn.disabled = true;
  //   text.innerText = 'Checking...';
  //   loader.classList.remove('d-none');
  //   //alert(4);
  // });

});
document.addEventListener('DOMContentLoaded', function () {

    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const verifyOtpBtn = document.getElementById('verifyOtpBtn');

    const otpSection = document.getElementById('otpSection');
    const userInfoSection = document.getElementById('userInfoSection');

    // ✅ Send OTP
    sendOtpBtn.addEventListener('click', function () {
        let email = document.getElementById('email').value;

        if (!email) {
            alert("Enter email");
            return;
        }

        sendOtpBtn.disabled = true;
        sendOtpBtn.innerText = "Sending...";

//verifyEmailInOrganization
        $.ajax({
            url: "<?= base_url('verify-email-in-organization') ?>",
            method: "POST",
            data: {
                email: email,
                orgid: '<?php echo $orgid; ?>',
                association: '<?= $organization->association_or_not ?? '' ?>',
                <?= csrf_token() ?>: "<?= csrf_hash() ?>"
            },
            success: function (res) {

                if(res.status){
                    $('#error-message').html('');
                    if(res.userdata){
                        $('#first_name').val(res.userdata.firstname || '');
                        $('#last_name').val(res.userdata.lastname || '');
                    }

                    verify_user('email',email);
                }else{
                    $('#error-message').html(res.err_msg);
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.innerText = "CONTINUE";
                }
                // sendOtpBtn.innerText = "OTP Sent";
                // otpSection.classList.remove('d-none');
            },
            error: function () {
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerText = "CONTINUE";
                //alert("Failed to send OTP");
            }
        });
    });

    // ✅ Verify OTP
    verifyOtpBtn.addEventListener('click', function () {
        let email = document.getElementById('email').value;
        let otp = "";
        let isValid = true;
          $(".otp-input").each(function(){
            //console.log(1);
            let val = $(this).val().trim();
            //console.log(2);

            if(val === ""){
              isValid = false;
              $(this).addClass("border-danger");
            } else {
              $(this).removeClass("border-danger");
              otp += val;
            }
          });
          if(!isValid || otp.length !== 6){
            $("#otp_msg").css("color","red").html("Enter valid 6-digit OTP");
            return;
          }
        verifyOtpBtn.disabled = true;
        verifyOtpBtn.innerText = "Verifying...";

        $.ajax({
            url: "<?= base_url('verify-user-otp') ?>",
            method: "POST",
            dataType: "json",
            data: {
                email: email,
                otp: otp,
                <?= csrf_token() ?>: "<?= csrf_hash() ?>"
            },
            success: function (res) {
                if (res.status) {
                    document.getElementById('otp_msg').innerHTML = "";
                    otpSection.classList.add('d-none');
                    userInfoSection.classList.remove('d-none');
                    sendOtpBtn.classList.add('d-none');
                } else {
                    document.getElementById('otp_msg').style.color = "red";
                    document.getElementById('otp_msg').innerHTML = "Invalid OTP. Please try again.";                    
                    verifyOtpBtn.disabled = false;
                    verifyOtpBtn.innerText = "VERIFY OTP";

                    // ✅ Focus first OTP and select content
                    setTimeout(function () {
                      const firstInput = document.querySelector('.otp-input');
                      firstInput.focus();
                      firstInput.select(); // highlight existing value
                    }, 100);
                }
            },
            error: function () {
                alert("Error verifying OTP");
                verifyOtpBtn.disabled = false;
                verifyOtpBtn.innerText = "VERIFY OTP";
            }
        });
    });

});
function verify_user(verify_type,verifyto){
    let sendOtpBtn = document.getElementById('sendOtpBtn');
    let otpSection = document.getElementById('otpSection');
        $.ajax({
            url: "<?= base_url('verify-user') ?>",
            method: "POST",
            data: {
                verifyto: verifyto,
                verify_type: verify_type,
                <?= csrf_token() ?>: "<?= csrf_hash() ?>"
            },
            success: function (res) {
                sendOtpBtn.innerText = "OTP Sent";
                otpSection.classList.remove('d-none');
                // ✅ Show message
                document.getElementById('otp_msg').style.color = "green";
                document.getElementById('otp_msg').innerHTML = "OTP sent to your email. Please verify.";

                // Focus first OTP box
                setTimeout(() => {
                  document.querySelector('.otp-input').focus();
                }, 100);                
            },
            error: function () {
                sendOtpBtn.disabled = false;
                sendOtpBtn.innerText = "CONTINUE";
                //alert("Failed to send OTP");
            }
        });    
}
$(document).ready(function () {
$(".otp-input").on("focus", function () {
  if ($(this).val() !== "") {
    $(this).select(); // ✅ select existing value
  }
});
  const inputs = $(".otp-input");

  inputs.on("input", function () {
    let current = $(this);
    let value = current.val();

    // Allow only numbers
    if (!/^\d$/.test(value)) {
      current.val("");
      return;
    }

    // Move to next input
    let next = current.next(".otp-input");
    if (next.length) {
      next.focus();
    } else {
      // Last box → focus Verify button
      //$("#verifyOtpBtn").focus();
      $("#verifyOtpBtn").focus().click();
    }
  });

  // Handle backspace
  inputs.on("keydown", function (e) {
    let current = $(this);

    if (e.key === "Backspace") {
      if (current.val() === "") {
        let prev = current.prev(".otp-input");
        if (prev.length) {
          prev.focus();
        }
      }
    }
  });

});
////////////For continu button
document.addEventListener('DOMContentLoaded', function () {

  const emailInput = document.getElementById('email');
  const sendOtpBtn = document.getElementById('sendOtpBtn');
  const otpSection = document.getElementById('otpSection');
  const userInfoSection = document.getElementById('userInfoSection');
  const otpInputs = document.querySelectorAll('.otp-input');

  let lastVerifiedEmail = "";

  function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }

  // ✅ Email input handler (validation + reset logic)
  emailInput.addEventListener('input', function () {

    const currentEmail = emailInput.value.trim();

    // ✅ Enable/Disable button based on valid email
    sendOtpBtn.disabled = !validateEmail(currentEmail);

    // ✅ If email changed after OTP
    if (currentEmail !== lastVerifiedEmail) {

      // Reset sections
      otpSection.classList.add('d-none');
      userInfoSection.classList.add('d-none');

      // Clear OTP
      otpInputs.forEach(input => input.value = "");

      // Reset button text
      sendOtpBtn.innerText = "CONTINUE";

      // Clear messages
      document.getElementById('otp_msg').innerHTML = "";
      document.getElementById('error-message').innerHTML = "";
    }
  });

  // ✅ On CONTINUE click
  sendOtpBtn.addEventListener('click', function () {
    lastVerifiedEmail = emailInput.value.trim();
  });

});
</script>
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