<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LOGIN :: TRICKEDOUT</title>
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
.otp-input {
    width: 40px;          /* keep width fixed */
    height: 50px;         /* height for uniform size */
    font-size: 22px;      /* large number */
    font-weight: bold;
    text-align: center;   /* center the number */
    border: 2px solid #fff;
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
</style>
</head>
<body class="login_bg">
  <div class="px-4">
    <div class="row">
      <div class="col-lg-3">
        <form action="<?= base_url('verifyOtp') ?>" method="POST">  
        <?= csrf_field() ?>
        <div class="login_space">
          <div class="py-5 px-2" align="center">
         <div><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid" style="width:300px;"></div>
            <div style="font-weight:lighter;font-size:20px;letter-spacing:2px;" class="text-white mt-2">MAGIC VAULT</div>
          </div>
          <div class="px-3">
            
                <?php if(service('validation')->listErrors()){ ?>                        
                      <?= service('validation')->listErrors() ?>   
                <?php } ?>

                <?php if(session()->getFlashdata('err_msg')){ ?>
                  <div  class="alert alert-danger"> 
                  <?= session()->getFlashdata('err_msg'); ?>
                  </div>
                <?php } ?>
              
            
                

                <?php if(session()->getFlashdata('success_msg')){ ?>
                  <div class="alert alert-success"> 
                  <?= session()->getFlashdata('success_msg'); ?>
                  </div>
                <?php } ?>
              

            <!-- <div class="form-group">
              <span class="form-control-icon"><img src="<?= base_url('assets/images/user.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;"></span>
              <input type="text" class="form-control" placeholder="OTP" name="otp" style="height:50px;" required>
            </div>  -->
            <div class="text-center text-white mb-3" style="font-size:14px;">
  Enter the 6-digit OTP sent to your registered email/mobile number.<br>
  <small style="opacity:0.8;">OTP is valid for 5 minutes.</small>
</div>
<div class="form-group otp-wrapper" style="display:flex;justify-content:center;gap:10px;">
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
  <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
</div>            
            <button type="submit" id="verifyBtn" class="btn btn-success w-100 mt-3 br0 botton-h text-white" style="background-color:#4bb649;font-size:20px;letter-spacing:2px;">
              <span id="btnText">Verify</span>
              <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none"
          role="status" aria-hidden="true"></span>
            </button>
            <div>
            <a href="login" style="float:left; color:#fff;text-decoration: none;">LOG IN</a>
             <!-- <a href="resend_otp" 
               id="resendOtp" 
               style="float:right;color:#aaa;text-decoration:none;pointer-events:none;">
               Resend OTP (<span id="timer">30</span>s)
            </a> -->
            <a href="resend_otp"
               id="resendOtp"
               style="float:right;color:#aaa;text-decoration:none;pointer-events:none;">

               <span id="resendText">
                 Resend OTP (<span id="timer">30</span>s)
               </span>

               <span id="resendLoader"
                     class="spinner-border spinner-border-sm ms-1 d-none"
                     role="status"
                     aria-hidden="true"></span>
            </a>
           </div>
           <div style="clear:both;"></div>
            <div class="text-white mt-2">
              <div class="fs1 float-start">
                <div class="form-check">
                  
                  
                </div>
              </div>
             
            </div>
           <div style="font-size:9px;" class="text-center text-white mt-4"> <?= date('Y')?> © Tricked Out Magic Vault. all rights reserved</div>
           
          </div>
        </div>
        </form>

      </div>
    </div>
  </div>
</body>
<!-- ========================== Footer section end ========================== -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script>
const otpInputs = document.querySelectorAll('.otp-input');
otpInputs[0].focus();
otpInputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        if (input.value.length > 0) {
            if (index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            } else {
                const allFilled = [...otpInputs].every(i => i.value.length === 1);
                if (allFilled) {
                    verifyBtn.disabled = true;
                    btnText.textContent = 'Verifying...';
                    btnLoader.classList.remove('d-none');
                    form.submit();
                }
            }
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === "Backspace" && input.value.length === 0 && index > 0) {
            otpInputs[index - 1].focus();
        }
    });
});

let timeLeft = 30;
const timerEl = document.getElementById('timer');
const resendLink = document.getElementById('resendOtp');
const resendText = document.getElementById('resendText');
const resendLoader = document.getElementById('resendLoader');

const countdown = setInterval(() => {
    timeLeft--;
    timerEl.textContent = timeLeft;

    if (timeLeft <= 0) {
        clearInterval(countdown);
        resendLink.style.pointerEvents = 'auto';
        resendLink.style.color = '#fff';
        resendText.textContent = 'Resend OTP';
    }
}, 1000);


const form = document.querySelector('form');
const verifyBtn = document.getElementById('verifyBtn');
const btnText = document.getElementById('btnText');
const btnLoader = document.getElementById('btnLoader');

form.addEventListener('submit', () => {
    verifyBtn.disabled = true;
    btnText.textContent = 'Verifying...';
    btnLoader.classList.remove('d-none');
});
resendLink.addEventListener('click', function (e) {

    // prevent double click
    if (resendLink.dataset.loading === '1') {
        e.preventDefault();
        return;
    }

    resendLink.dataset.loading = '1';

    // show loader
    resendLoader.classList.remove('d-none');
    resendText.textContent = 'Sending...';

    // disable link
    resendLink.style.pointerEvents = 'none';
    resendLink.style.color = '#aaa';

    // allow navigation to resend_otp
});

</script>


</body>

</html>