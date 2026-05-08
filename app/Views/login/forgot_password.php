<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FORGOT PASSWORD :: TRICKEDOUT</title>
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
</style>
</head>
<body class="login_bg">
  <div class="px-4">
    <div class="row">
      <div class="col-lg-3">
        <form action="<?= base_url('forgot_password') ?>" method="POST">  

          <?= csrf_field() ?>
          <div class="login_space">
            <div class="py-5 px-2" align="center">
             <div><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid" style="width:300px;"></div>
             <div style="font-weight:lighter;font-size:20px;letter-spacing:2px;" class="text-white mt-2">MAGIC VAULT</div>
           </div>
           <div class="px-3">
            <div style="color: #f74747; text-align: center; font-size: 15px;height: 65px;"> 
              <?php if(service('validation')->listErrors()){ ?>                        
                <?= service('validation')->listErrors() ?>   
              <?php } ?>

              <?php if(session()->getFlashdata('err_msg')){ ?>
                <?= session()->getFlashdata('err_msg'); ?>
              <?php } ?>
              
            </div>
            <div style="color:#fff; text-align:center;">Enter email and click SUBMIT to reset password</div>
              
            <div class="form-group mt-3">
              <span class="form-control-icon"><img src="<?= base_url('assets/images/email-icon.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;"></span>
              <input type="email" class="form-control" placeholder="Username" name="email_id" style="height:50px;" required  pattern="[^@\s]+@[^@\s]+\.[^@\s]+" oninvalid="InvalidMsg(this,'Invalid email address.')" oninput="InvalidMsg(this,'Invalid email address.')">
            </div>  
            <button type="submit" class="btn btn-success w-100 mt-3 br0 botton-h text-white" style="background-color:#4bb649;font-size:20px;letter-spacing:2px;">SUBMIT</button>
            <a href="<?= base_url('login') ?>" style="float:left; color:#fff;text-decoration: none;">Login</a>
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
<?= date('Y')?>
    </div>
  </div>
</div>
</body>
<!-- ========================== Footer section end ========================== -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script type="text/javascript">
  function InvalidMsg(textbox,msg) {
   if(textbox.validity.patternMismatch){
     textbox.setCustomValidity(msg);
   }
   else {
     textbox.setCustomValidity('');
   }
   return true;
 }

 function phoneFormatter() {
   $('#phone').on('input', function() {
     var number = $(this).val().replace(/[^\d]/g, '')
     if (number.length == 7) {
       number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
     } else if (number.length == 10) {
       number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
     }
     $(this).val(number)
   });
 };

 phoneFormatter();

 function signupFormSubmit(){
   var password= $("#password").val();
   var cpassword= $("#password_confirm").val();
   if(cpassword && password){
     if(password!=cpassword){
       $("#password_confirm-error").html("Passwords do not match.");
       return false;
     }else{
       $("#password_confirm-error").html("");
       return true;
     }
   }else{
     $("#password_confirm-error").html("");
   }
 }


 const isNumericInput = (event) => {
   const key = event.keyCode;
   return ((key >= 48 && key <= 57) || // Allow number line
   (key >= 96 && key <= 105) // Allow number pad
   );
 };

 const isModifierKey = (event) => {
   const key = event.keyCode;
const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only

return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
(key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
(key > 36 && key < 41) || // Allow left, up, right, down
(
// Allow Ctrl/Command + A,C,V,X,Z
 (event.ctrlKey === true || event.metaKey === true) &&
 (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
 )
};

const enforceFormat = (event) => {

 if(!isNumericInput(event) && !isModifierKey(event)){
   event.preventDefault();
 }
};

const formatToPhone = (event) => {
 if(isModifierKey(event)) {return;}

const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
//alert(input);
const areaCode = input.substring(0,3);
const middle = input.substring(3,6);
const last = input.substring(6,10);

if(input.length > 6){event.target.value = `(${areaCode}) ${middle}-${last}`;}
else if(input.length > 3){event.target.value = `(${areaCode}) ${middle}`;}
else if(input.length > 0){event.target.value = `(${areaCode}`;}
else if(input.length == 0){event.target.value = `${areaCode}`;}
};

const inputElement = document.getElementById('phone');
inputElement.addEventListener('keydown',enforceFormat);
inputElement.addEventListener('keyup',formatToPhone);
inputElement.addEventListener('change',formatToPhone); 

</script>
</body>

</html>