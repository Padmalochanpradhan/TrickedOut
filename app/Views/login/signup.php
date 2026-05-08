<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SIGN UP :: TRICKEDOUT</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/css/intlTelInput.css">
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
  .iti{
  width:100%;
}
.back_blue{width: 100%;}
.fs-7{font-size:10px;}
.fs-14{font-size:14px;}
.text-g{color:#4bb649;font-size:18px;}
.border1{border:1px solid #fff;border-radius:10px;}
.border2{border:1px solid #4bb649;border-radius:10px;}
@media (min-width: 768px) {
.back_blue{width: 70%;}
}
@media (min-width: 1024px) {
.back_blue{width:60%;}
}
@media (min-width: 1280px) {
.back_blue{width: 50%;}
}
@media (min-width: 1536px) {
.back_blue{width:35%;}
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
  .tick-icon {
  transition: transform 0.2s ease;
}

.plan-card:hover .tick-icon {
  transform: scale(1.1);
}
</style>

</head>
<body class="login_bg">
  <div class="px-4">
    <div class="row">
      <div class="back_blue">
        <form action="<?= base_url('signup_without_otp') ?>" method="POST" onsubmit="return signupFormSubmit();">  

          <?= csrf_field() ?>
          <input type="hidden" name="form_token" value="<?= session()->get('form_token') ?>">
          <input type="text" name="website" style="display:none">
          <div class="login_space">
            <div class="py-3 px-2">
             <div><img src="<?= base_url('assets/images/logo_new.svg') ?>" class="img-fluid" style="width:300px;"></div>
             <!-- <div style="font-weight:lighter;font-size:20px;letter-spacing:2px;" class="text-white mt-2">MAGIC VAULT</div> -->
           </div>
           <div class="px-3">
            <div style="color: #f74747; text-align: center; font-size: 15px;"> 
              <?php if(service('validation')->listErrors()){ ?>                        
                <?= service('validation')->listErrors() ?>   
              <?php } ?>

              <?php if(session()->getFlashdata('err_msg')){ ?>
                <?= session()->getFlashdata('err_msg'); ?>
              <?php } ?>
            </div>
            <div class="row">
              <div class="col-lg-12 text-white my-3">
                <h4 class="fw-bold">Sign up to Tricked Out</h4>
<!-- <div class="mt-3">1,060,000-d hak cards/term  rickhere/rlpst <u>Bitose</u></div> -->
              </div>
            <div class="form-group col-lg-6 mt-2">
              <div class="text-white"><i class="fa fa-user me-2" aria-hidden="true"></i><span>First Name</span></div>
                     <input type="text" class="form-control" placeholder="First Name" name="first_name" style="height:40px;" required pattern="^[A-Za-z][A-Za-z0-9.' \-]{0,29}$"  oninvalid="InvalidMsg(this,'Invalid first name remove special characters if any.')" oninput="InvalidMsg(this,'Invalid first name remove special characters if any.')">
            </div> 
            <div class="form-group col-lg-6 mt-2">
               <div class="text-white">Last Name</div>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" style="height:40px;" required pattern="^[A-Za-z][A-Za-z0-9.' \-]{0,29}$"  oninvalid="InvalidMsg(this,'Invalid last name remove special characters if any.')" oninput="InvalidMsg(this,'Invalid last name remove special characters if any.')">
            </div> 
           
        <div class="form-group  col-lg-6 mt-2">
 <div class="text-white"><i class="fa fa-mobile me-2"></i><span>Mobile Number</span></div>
<input type="tel" class="form-control" id="phone" name="phone" autocomplete="tel" required style="height:40px;">

<input type="hidden" name="country_code" id="country_code">
</div>

            <div class="form-group  col-lg-6 mt-2">
           <div class="text-white">Email</div>
              <input type="email" class="form-control" placeholder="Email" name="email_id" style="height:40px;" required  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" oninvalid="InvalidMsg(this,'Invalid email address.')" oninput="InvalidMsg(this,'Invalid email address.')">
            </div> 
            <div class="form-group col-lg-6 mt-2">
               <div class="text-white"><i class="fa fa-lock me-2" aria-hidden="true"></i><span>Password</span></div>
                          <input type="password" class="form-control" placeholder="Password" name="password" id="password" style="height:40px;" autocomplete="new-password" oncopy="return false;" onpaste="return false;" minlength="6" required>
            </div>
            <div class="form-group col-lg-6 mt-2">
               <div class="text-white">Confirm Password</div>
                           <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="password_confirm" style="height:40px;" autocomplete="new-password" oncopy="return false;" onpaste="return false;" oninput="checkPasswordMatch();" minlength="6" required>
            </div>
            <div >
              <div id="password_confirm-error" class="error" for="password_confirm"
              style="line-height:24px;color:red;"></div>
            </div>
            </div> 
            <div class="form-group mt-2">
              <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="terms"
                    name="terms"
                    required
                    oninvalid="this.setCustomValidity('You must agree to the Terms & Conditions')"
                    oninput="this.setCustomValidity('')"
                  >
                  <label class="form-check-label text-white" for="terms" style="font-size:10px;">
                    I agree to the
                    <a href="<?= base_url('assets/term_condition/Tricked Out Terms and Privacy Policy-1.pdf') ?>" class="text-success text-decoration-underline" target="_blank" title="Terms & Conditions">
                      Terms & Service
                    </a>
                    and
                    <a href="<?= base_url('assets/term_condition/Tricked Out Terms and Privacy Policy-1.pdf') ?>"  class="text-success text-decoration-underline"  target="_blank">
                      Privacy Policy
                    </a> 
                  </label>
                </div> 
            </div> 
              <div class="form-group mt-2">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    id="content_confirm"
                    name="content_confirm"
                    required
                    oninvalid="this.setCustomValidity('You must confirm responsibility for uploaded content')"
                    oninput="this.setCustomValidity('')"
                  >
                  <label class="form-check-label text-white" for="content_confirm" style="font-size:10px;">
                    I will only upload files that iI own or have the legal right to store and use, and I understand I am solely responsible for any content I upload.
                  </label>
                </div>
              </div>

              <div class="row">
              <!-- <div class="col-lg-4 mt-2">
                <div  class="p-2 text-center text-white border2">
                  <div><h5 class="fw-bold"><img src="<?= base_url('assets/images/tick3.svg') ?>" class="img-fluid" style="width:20px;"><span class="ms-2">Prestige</span></h5></div>
                  <div class="fs-14">500GB-Monthly</div>
                  <hr/>
                  <div class="text-g">$9.99<span class="fs-7 text-white">/month</span></div>
                </div>
              </div>
               <div class="col-lg-4 mt-2">
                 <div  class="p-2 text-center text-white border1">
                  <div><h5 class="fw-bold">Mastery</h5></div>
                  <div class="fs-14">1TB-Monthly</div>
                  <hr/>
                  <div class="text-g">$14.99<span class="fs-7 text-white">/month</span></div>
                </div>
               </div>
                <div class="col-lg-4 mt-2">
                    <div  class="p-2 text-center text-white border1">
                  <div><h5 class="fw-bold">Legacy</h5></div>
                  <div class="fs-14">2TB-Monthly</div>
                  <hr/>
                  <div class="text-g">$19.99<span class="fs-7 text-white">/month</span></div>
                </div>
                </div> -->
                <div id="plans_container">
                  <?php echo view('login/SubscriptionCardsView', ['subscriptions' => $subscriptions]); ?>
                </div>
              </div>
               
              <!-- Coupon Code Section (Hidden by default) -->
              
              <!-- Promo Code Toggle Message -->
              <div id="promo_toggle" class="mt-2 text-center">
                <a href="javascript:void(0);" onclick="showCouponBox()" 
                   style="color:#4bb649; font-size:14px; text-decoration:underline;">
                   Have you any promo code?
                </a>
                <!-- <input type="hidden" name="promotion_code_id" id="promotion_code_id"> -->
              </div>

              <!-- Coupon Code Section (Hidden by default) -->
              <div id="coupon_section" class="form-group mt-2 d-none">

                  <!-- Hide Option -->
                  <div class="text-end mb-1">
                    <a href="javascript:void(0);" onclick="hideCouponBox()" 
                       style="color:#ff4d4d; font-size:13px; text-decoration:underline;">
                       Hide promo code
                    </a>
                  </div>

                  <div class="d-flex">
                    <!-- Coupon Input -->
                    <input type="text"
                      class="form-control"
                      placeholder="Enter Promo Code"
                      name="coupon_code"
                      id="coupon_code"
                      style="height:50px;"
                      maxlength="20"
                    >

                    <!-- Apply Button -->
                    <button type="button"
                      id="applyCouponBtn"
                      class="btn btn-success ms-2"
                      style="height:50px;"
                      onclick="applyCoupon()">

                      <span class="btn-text">Apply</span>

                      <span class="btn-loader d-none">
                        <span class="spinner-border spinner-border-sm"></span>
                        Applying...
                      </span>

                    </button>
                  </div>

                  <!-- Coupon Message -->
                  <!-- <div id="coupon_msg" style="font-size:13px; margin-top:5px;"></div> -->

                </div> 
              <div id="coupon_success_wrapper" 
                   class="d-flex justify-content-center align-items-center mt-2 d-none"
                   style="gap:10px; font-size:14px;">

                <!-- Message -->
                <span id="coupon_success_msg" style="color:#4bb649;"></span>

                <!-- Cross Icon -->
                <span id="remove_icon"
                      onclick="removeCoupon()" 
                      style="cursor:pointer; color:#ff4d4d; font-size:16px;">
                      <i class="fa fa-times"  title="Remove promo code"></i>
                </span>
                <!-- Loader -->
                <span id="remove_loader" class="d-none">
                  <span class="spinner-border spinner-border-sm"></span>
                </span>

              </div>
        <!-- <div id="otp_section" class="form-group mt-2 d-none"> -->
        <div id="otp_section" class="form-group mt-2 d-none">

          <div class="form-group otp-wrapper" style="display:flex;justify-content:center;gap:10px;">
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
          <input type="text" name="otp[]" maxlength="1" class="otp-input " required>
        </div>

          <!-- Hidden combined OTP -->
          <input type="hidden" id="email_otp" name="email_otp" required
       oninvalid="this.setCustomValidity('Enter OTP')"
       oninput="this.setCustomValidity('')">

          <button type="button"
                  class="btn btn-success w-100 mt-3 br0 botton-h text-white" style="background-color:#4bb649;font-size:20px;letter-spacing:2px;"
                  onclick="verifyOtp()">
              <span id="verifyBtnText">Verify OTP</span>
              <span id="verifyBtnLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>
          </button>

          <div id="otp_msg" style="font-size:13px; margin-top:5px;"></div>

        </div>
        <div id="otp_success_msg" style="color:green; font-size:13px; margin-top:5px;text-align: center;"></div>
<!-- SEND OTP BUTTON -->
<button type="button" id="sendOtpBtn" onclick="sendOtp()" 
class="btn btn-success w-100 mt-3">
  SEND OTP
</button>
<input type="hidden" id="price_id" name="price_id">
<input type="hidden" id="payment_link" name="payment_link">
<!-- SIGNUP BUTTON -->




<button type="submit" id="signupBtn" disabled
class="btn btn-success w-100 mt-3 br0 botton-h text-white"
style="background-color:#4bb649;font-size:20px;letter-spacing:2px;">
  <span id="btnText">SIGN UP</span>
  <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none"></span>
</button>



               <div style="font-size:10px;" class="text-white mt-4">By subscribing you agree to Tricked Outs 
             <a href="<?= base_url('assets/term_condition/Tricked Out Terms and Privacy Policy-1.pdf') ?>" class="text-success text-decoration-underline" target="_blank" title="Terms & Conditions">Terms of Service</a> and 
             <a href="<?= base_url('assets/term_condition/Tricked Out Terms and Privacy Policy-1.pdf') ?>"  class="text-success text-decoration-underline"  target="_blank">Privacy Policy.
             </a>
             </div>
            <!-- <a href="<?= base_url('login') ?>" style="float:left; color:#fff;text-decoration: none;">Login</a> -->
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
      <script src="https://www.google.com/recaptcha/api.js?render=<?= getenv('RECAPTCHA_SITE_KEY') ?>"></script>

        <input type="hidden" name="recaptcha_token" id="recaptcha_token">

        <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('<?= getenv('RECAPTCHA_SITE_KEY') ?>', {action: 'contact'})
            .then(function(token) {
                document.getElementById('recaptcha_token').value = token;
            });
        });
        </script>        
      </form>

    </div>




  </div>
</div>
<!-- Modal for trick info data ----- -->
<div class="modal fade" id="term_condation_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><i class="fa fa-plus"></i> Term Condation <span id="err_msg" style="color: red;padding-left: 100px;"></span></h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('contactUsModal');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="<?= base_url('contactUs') ?>" method="POST" id="form-supplier" name="form-supplier">  
          <?= csrf_field() ?>
        

      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <input type="text" name="name" class="form-control form-bg ht inputcolor" placeholder="Name" value="" required>
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <input type="text" name="contact_phone" id="contact_phone" 
            class="form-control form-bg ht inputcolor" 
            placeholder="Contact Phone" 
            maxlength="16"
             pattern="^\(\d{3}\)\s\d{3}-\d{4}"
                  required
                  oninvalid="InvalidMsg(this,'Enter valid phone number')"
                  oninput="InvalidMsg(this,'Enter valid phone number')">
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <input type="email" name="email" class="form-control form-bg ht inputcolor" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" oninvalid="InvalidMsg(this,'Invalid email address.')" oninput="InvalidMsg(this,'Invalid email address.')" required>
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <textarea name="message" class="form-control form-bg inputcolor" placeholder="Message" rows="5"></textarea>
          </div>
                                       
        </div>
      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="contactBtn">
          <span class="btn-text">Send</span>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
        
        <button type="button" class="btn btn-secondary" onclick="cross('addSupplier');">Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/js/intlTelInput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.21/js/utils.js"></script>

<!-- ========================== Footer section end ========================== -->

<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".plan-card").first().click();
  });
  let billingType = "monthly";


$(document).on("click", "#monthlyBtn", function () {

  billingType = "monthly"; // ✅ IMPORTANT

  $("#monthlyBtn").addClass("active");
  $("#yearlyBtn").removeClass("active");

  updatePlans();
});
$(document).on("click", "#yearlyBtn", function () {

  billingType = "yearly"; // ✅ IMPORTANT

  $("#yearlyBtn").addClass("active");
  $("#monthlyBtn").removeClass("active");

  updatePlans();
});

function updatePlans(){
  $(".plan-card").each(function(){
    let price = $(this).data(billingType + "-price");
    let priceId = $(this).data(billingType + "-price-id");
    $(this).find(".price-text").html(
      `$${parseFloat(price).toFixed(2)} <span class="fs-7 text-white">/${billingType === 'monthly' ? 'month' : 'year'}</span>`
    );
    $(this).find(".plan-type").text(
      billingType === 'monthly' ? '-Monthly' : '-Yearly'
    );
    // ✅ UPDATE SELECTED PLAN PRICE ID
    if($(this).hasClass("border2")){
      $("#price_id").val(priceId);
    }
  });
}

$(document).on("click", ".plan-card", function(){

  // remove selection from all
  $(".plan-card")
    .removeClass("border2")
    .addClass("border1");

  $(".tick-icon").addClass("d-none");

  // add selection to clicked
  $(this)
    .removeClass("border1")
    .addClass("border2");

  $(this).find(".tick-icon").removeClass("d-none");

  // store selected plan
  //let priceId = $(this).data("price");
    // ✅ GET CORRECT PRICE ID BASED ON BILLING TYPE
  let priceId = billingType === "monthly"
    ? $(this).data("monthly-price-id")
    : $(this).data("yearly-price-id");
  $("#price_id").val(priceId);

  let paymentLink = billingType === "monthly"
  ? $(this).data("monthly-link")
  : $(this).data("yearly-link");

$("#payment_link").val(paymentLink);

});
</script>
<script>



  $(document).ready(function(){
    $(".plan-card").first().click();
  });

$(document).ready(function(){
  $("#signupBtn").prop("disabled", false);
  $("#signupBtn").hide();
  const emailInput = $("input[name='email_id']");
  const sendOtpBtn = $("#sendOtpBtn");

  // Disable initially
  sendOtpBtn.prop("disabled", true);

  emailInput.on("input", function(){

    let email = $(this).val().trim();

    // Simple email regex check
    let isValidEmail = /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email);

    if(isValidEmail){
      sendOtpBtn.prop("disabled", false);
    } else {
      sendOtpBtn.prop("disabled", true);
    }

  });
  emailInput.on("input", function(){

    let email = $(this).val().trim();
    let isValidEmail = /^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email);

    if(isValidEmail){
      sendOtpBtn.prop("disabled", false);
    } else {
      sendOtpBtn.prop("disabled", true);
    }

    // Reset OTP UI if user changes email
    $("#otp_section").addClass("d-none");
    $("#otp_msg").html("");
    $("#otp_success_msg").html("");
    $("#otp_verified").remove();

    $("#sendOtpBtn").show().text("SEND OTP").prop("disabled", !isValidEmail);
    $("#signupBtn").hide().prop("disabled", true);

  }); 

  $(".otp-input").on("input", function(){
    $(this).removeClass("border-danger");
    $("#otp_msg").html("");
  });

}); 
$(document).ready(function(){

  const inputs = document.querySelectorAll(".otp-input");
  const verifyBtn = document.querySelector("#otp_section button");

  inputs.forEach((input, index) => {

    input.addEventListener("input", function(){

      // allow only numbers
      this.value = this.value.replace(/[^0-9]/g, '');

      // move to next
      if(this.value.length === 1 && index < inputs.length - 1){
        inputs[index + 1].focus();
      }

      // ✅ Check if all boxes filled
      let allFilled = true;
      let otp = "";

      inputs.forEach(inp => {
        if(inp.value === ""){
          allFilled = false;
        }
        otp += inp.value;
      });

      // set hidden value
      $("#email_otp").val(otp);

      // 🎯 If all filled → focus Verify button
      if(allFilled){
        verifyBtn.focus();
      }

    });

    // ⬅️ Backspace handling
    input.addEventListener("keydown", function(e){
      if(e.key === "Backspace" && this.value === "" && index > 0){
        inputs[index - 1].focus();
      }
    });

  });

});

function sendOtp() {

  let email = $("input[name='email_id']").val();

  if(!email){
    alert("Enter email first");
    return;
  }

  $("#sendOtpBtn").prop("disabled", true).text("Sending OTP...");

  $.ajax({
    url: "<?= base_url('verify-user') ?>",
    type: "POST",
    dataType: "json",
    data: {
      verify_type: 'email',
      verifyto: email,
      "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
    },
    success: function(res){
      if(res.status){
        $("#otp_section").removeClass("d-none");
        $("#otp_msg").css("color","green").html("OTP sent to your email");
        $("#sendOtpBtn").hide(); // hide send otp
      }else{
        $("#sendOtpBtn").prop("disabled", false).text("SEND OTP");
        alert(res.message);
      }
    }
  });
}


  function verifyOtp(){

  let otp = "";
  let isValid = true;

  $(".otp-input").each(function(){
    let val = $(this).val().trim();

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

  $("#email_otp").val(otp);
  let email = $("input[name='email_id']").val();

  // ✅ START LOADER
  $("#verifyOtpBtn").prop("disabled", true);
  $("#verifyBtnText").text("Verifying...");
  $("#verifyBtnLoader").removeClass("d-none");

  $.ajax({
    url: "<?= base_url('verify-user-otp') ?>",
    type: "POST",
    dataType: "json",
    data: {
      otp: otp,
      email: email,
      "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
    },
    success: function(res){

      // ❗ STOP LOADER
      $("#verifyOtpBtn").prop("disabled", false);
      $("#verifyBtnText").text("Verify OTP");
      $("#verifyBtnLoader").addClass("d-none");

      if(res.status){
        $("#otp_section").addClass("d-none");

        $("#otp_success_msg").css("color","green").html("✔ " +"OTP verified");
        $("#signupBtn").show().prop("disabled", false);
        $("#sendOtpBtn").prop("disabled", true).text("OTP VERIFIED");

        if(!$("#otp_verified").length){
          $("<input>").attr({
            type: "hidden",
            id: "otp_verified",
            name: "otp_verified",
            value: "1"
          }).appendTo("form");
        }

      }else{
        $(".otp-input").addClass("border-danger");
        $("#otp_msg").css("color","red").html("Invalid OTP");
      }
    },
    error: function(){

      // ❗ STOP LOADER (on error too)
      $("#verifyOtpBtn").prop("disabled", false);
      $("#verifyBtnText").text("Verify OTP");
      $("#verifyBtnLoader").addClass("d-none");

      $("#otp_msg").css("color","red").html("Something went wrong. Try again.");
    }
  });
}
document.addEventListener("DOMContentLoaded", function(){

const input = document.querySelector("#phone");

window.iti = window.intlTelInput(input, {
  initialCountry: "us",
  nationalMode: true,
  autoPlaceholder: "polite",
  formatOnDisplay: true,
  preferredCountries: ["us","gb","in","ca"]
});

input.addEventListener("input", function () {

  if (!window.intlTelInputUtils) return;

  // get only digits
  let digits = input.value.replace(/\D/g,'');

  // get example number for selected country
  const country = window.iti.getSelectedCountryData().iso2;

  const exampleNumber = intlTelInputUtils.getExampleNumber(
    country,
    true,
    intlTelInputUtils.numberType.MOBILE
  );

  const maxLength = exampleNumber.replace(/\D/g,'').length;

  // block extra digits
  if(digits.length > maxLength){
   // alert(1);
    digits = digits.substring(0,maxLength);
    input.value = digits;   // THIS LINE WAS MISSING
  }

  // format number
  const formatted = window.iti.getNumber(
      intlTelInputUtils.numberFormat.NATIONAL
  );

  if(formatted){
      input.value = formatted;
  }

});
// CLEAR PHONE WHEN COUNTRY CHANGES
input.addEventListener("countrychange", function () {

    // clear the number completely
    window.iti.setNumber("");

    // clear input field
    input.value = "";

});
});
document.getElementById("phone").addEventListener("input", function(){
    this.setCustomValidity("");
});
function signupFormSubmit(){


  if(!window.iti.isPossibleNumber()){
      alert("Please enter a valid phone number");
      return false;
  }

  document.getElementById("country_code").value =
  "+" + window.iti.getSelectedCountryData().dialCode;



  let password  = $("#password").val();
  let cpassword = $("#password_confirm").val();

  if(password !== cpassword){
      $("#password_confirm-error").html("Passwords do not match.");
      return false;
  }

  $("#password_confirm-error").html("");

  $("#signupBtn").prop("disabled", true);
  $("#btnText").text("PLEASE WAIT");
  $("#btnLoader").removeClass("d-none");

  return true;
}

</script>
<script type="text/javascript">
  function showCouponBox(){

    $("#promo_toggle").fadeOut(200, function(){
      $("#coupon_section").hide().removeClass("d-none").fadeIn(300);
      $("#coupon_code").focus();
    });

  }
 function hideCouponBox(){

  $("#coupon_section").fadeOut(200, function(){

    // Clear input + message
    $("#coupon_code").val("");
    $("#coupon_msg").html("");

    // Remove hidden promotion id if exists
    $("#promotion_code_id").remove();

    // Show toggle again
    $("#promo_toggle").fadeIn(300);

    // Hide section again
    $(this).addClass("d-none");

  });

} 
  
  function applyCoupon(){

  var coupon = $("#coupon_code").val().trim();

  if(coupon === ""){
    $("#coupon_success_msg")
      .css("color","red")
      .html("Please enter promo code");
    return;
  }

  // 🔥 START LOADER
  $("#applyCouponBtn").prop("disabled", true);
  $("#applyCouponBtn .btn-text").addClass("d-none");
  $("#applyCouponBtn .btn-loader").removeClass("d-none");

  $("#coupon_success_msg")
    .css("color","blue")
    .html("Checking promo code...");

  $.ajax({
    url: "<?= base_url('validate-coupon') ?>",
    type: "POST",
    dataType: "json",
    data: {
      coupon_code: coupon,
      "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
    },

    success: function(response){


      if(response.status === true){

        // $("#coupon_success_msg")
        //   .css("color","green")
        //   .html("✔ " + response.message);

        // remove old hidden field (avoid duplicates)
        $("#promotion_code_id").remove();

        if(response.data && response.data.promotion_code_id){
          $("<input>").attr({
            type: "hidden",
            id: "promotion_code_id",
            name: "promotion_code_id",
            value: response.data.promotion_code_id
          }).appendTo("form");
          refreshPlansSection(response.data.promotion_code_id, function(){

            $("#coupon_success_msg")
              .css("color","green")
              .html("✔ " + response.message)
              .fadeIn(300);

            // ✅ Hide coupon section
            $("#coupon_section").fadeOut(200);

            // ✅ Hide toggle
            $("#promo_toggle").hide();

            // ✅ Show remove option
            //$("#remove_coupon_box").removeClass("d-none");
            $("#coupon_success_wrapper").removeClass("d-none");
            $("#remove_icon").show(); // ✅ ADD THIS

            // ✅ STOP LOADER
            $("#applyCouponBtn").prop("disabled", false);
            $("#applyCouponBtn .btn-text").removeClass("d-none");
            $("#applyCouponBtn .btn-loader").addClass("d-none");

          });
        }
      }else{
        refreshPlansSection('', function(){
        $("#coupon_success_msg")
            .css("color","red")
            .html("✖ " + response.message)
            .fadeIn(300);
        });
          // refreshPlansSection('');
          // $("#coupon_success_msg")
          // .css("color","red")
          // .html("✖ " + response.message);
               // ✅ STOP LOADER

      // $("#applyCouponBtn").prop("disabled", false);
      // $("#applyCouponBtn .btn-text").removeClass("d-none");
      // $("#applyCouponBtn .btn-loader").addClass("d-none");
      }
    },

    error: function(xhr){

      // ✅ STOP LOADER
      $("#applyCouponBtn").prop("disabled", false);
      $("#applyCouponBtn .btn-text").removeClass("d-none");
      $("#applyCouponBtn .btn-loader").addClass("d-none");

      let msg = "Error validating promo code";

      if(xhr.responseJSON && xhr.responseJSON.message){
        msg = xhr.responseJSON.message;
      }

      $("#coupon_success_msg")
        .css("color","red")
        .html("✖ " + msg);
    }
  });
}   
function removeCoupon(){

  // 🔒 Disable click + hide icon
  $("#remove_icon").hide();

  // 🔄 Show loader
  $("#remove_loader").removeClass("d-none");

  // Optional: show processing message
  $("#coupon_success_msg")
    .css("color","blue")
    .html("Removing promo code...");

  refreshPlansSection('', function(){

    // Remove data
    $("#promotion_code_id").remove();
    $("#coupon_code").val("");

    // Hide loader
    $("#remove_loader").addClass("d-none");

    // Show final message
    $("#coupon_success_msg")
      .css("color","orange")
      .html("Promo code removed");

    $("#coupon_success_wrapper").removeClass("d-none");

    // Show toggle again
    $("#promo_toggle").show();
  });
}
  // function refreshPlansSection(promotion_code_id, callback){

  //   $.ajax({
  //     url: "<?= base_url('get-subscription-plans') ?>", // new endpoint
  //     type: "POST",
  //     data: {
  //       promotion_code_id: promotion_code_id,
  //       "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
  //     },
  //     success: function(response){

  //       $("#plans_container").html(response);
  //     // ✅ STOP LOADER HERE
  //     $("#applyCouponBtn").prop("disabled", false);
  //     $("#applyCouponBtn .btn-text").removeClass("d-none");
  //     $("#applyCouponBtn .btn-loader").addClass("d-none");
  //     if(typeof callback === "function"){
  //       callback();
  //     }
  //     }
  //   });
  // } 
function refreshPlansSection(promotion_code_id, callback){
    $.ajax({
      url: "<?= base_url('get-subscription-plans') ?>",
      type: "POST",
      data: {
        promotion_code_id: promotion_code_id,
        "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
      },
      success: function(response){
        $("#plans_container").html(response);
        // ✅ FIX: Force select first plan properly
        let firstCard = $(".plan-card").first();
        $(".plan-card")
          .removeClass("border2")
          .addClass("border1");
        $(".tick-icon").addClass("d-none");
        firstCard
          .removeClass("border1")
          .addClass("border2");

        firstCard.find(".tick-icon").removeClass("d-none");

        // ✅ Set price_id + payment_link
        let priceId = billingType === "monthly"
          ? firstCard.data("monthly-price-id")
          : firstCard.data("yearly-price-id");

        let paymentLink = billingType === "monthly"
          ? firstCard.data("monthly-link")
          : firstCard.data("yearly-link");

        $("#price_id").val(priceId);
        $("#payment_link").val(paymentLink);

        // STOP loader if any
        $("#applyCouponBtn").prop("disabled", false);
        $("#applyCouponBtn .btn-text").removeClass("d-none");
        $("#applyCouponBtn .btn-loader").addClass("d-none");

        if(typeof callback === "function"){
          callback();
        }
      }
    });
}
  function InvalidMsg(textbox,msg) {
   if(textbox.validity.patternMismatch){
     textbox.setCustomValidity(msg);
   }
   else {
     textbox.setCustomValidity('');
   }
   return true;
 }





function checkPasswordMatch(){
  var password  = $("#password").val();
  var cpassword = $("#password_confirm").val();

  if(cpassword && password && password !== cpassword){
    $("#password_confirm-error").html("Passwords do not match.");
  } else {
    $("#password_confirm-error").html("");
  }
}


  function toggleSignupButton() {
    const termsChecked   = document.getElementById('terms').checked;
    const contentChecked = document.getElementById('content_confirm').checked;

    document.querySelector('button[type="submit"]').disabled = !(termsChecked && contentChecked);
  }

  document.getElementById('terms').addEventListener('change', toggleSignupButton);
 document.getElementById('content_confirm').addEventListener('change', toggleSignupButton);

   // Disable submit initially
  document.querySelector('button[type="submit"]').disabled = true;
document.getElementById("phone").addEventListener("input", function(){
    this.setCustomValidity("");
});
</script>

</body>

</html>