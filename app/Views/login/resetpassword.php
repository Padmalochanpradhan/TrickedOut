<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RESET PASSWORD :: TRICKEDOUT</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
   @font-face { font-family: Gotham; src: url("<?= base_url('fonts/Gotham-Book.woff') ?>") format("woff"), url("fonts/Gotham-Book.woff2") format("woff2"), url("fonts/Gotham-Book.ttf") format("truetype"); font-weight: normal; }
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
        <form action="<?= base_url('resetpassword_submit') ?>" method="POST" onsubmit="return validatePasswords();"> 
          <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">

          <?= csrf_field() ?>
          <div class="login_space">
            <div class="py-5 px-2" align="center">
             <div><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid" style="width:300px;"></div>
             <div style="font-weight:lighter;font-size:20px;letter-spacing:2px;" class="text-white mt-2">MAGIC VAULT</div>
           </div>
           <div class="px-3">
            <div style="color: #f74747; text-align: center; font-size: 15px;height: 50px;" id="error-message"> 
              <?php if(service('validation')->listErrors()){ ?>                        
                <?= service('validation')->listErrors() ?>   
              <?php } ?>

              <?php if(session()->getFlashdata('err_msg1')){ ?>
                <?= session()->getFlashdata('err_msg1'); ?>
              <?php } ?>
               
            </div> 

            <div class="form-group mt-3">
              <span class="form-control-icon">
                <img src="<?= base_url('assets/images/password.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;">
              </span>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" style="height:50px;margin-top:-5px;" autocomplete="new-password" oncopy="return false;" onpaste="return false;" minlength="6" required>
            </div>
            <div class="form-group mt-3">
              <span class="form-control-icon"><img src="<?= base_url('assets/images/password.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;"></span>
              <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="password_confirm" style="height:50px;margin-top:-5px;" autocomplete="new-password" oncopy="return false;" onpaste="return false;" minlength="6" required>
            </div>


            <button type="submit" class="btn btn-success w-100 mt-3 br0 botton-h text-white" style="background-color:#4bb649;font-size:20px;letter-spacing:2px;">SUBMIT</button>
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
<script type="text/javascript">
  function validatePasswords() {
    var password= $("#password").val();
    var confirmPassword= $("#password_confirm").val();
    if (password !== confirmPassword) {
        $("#error-message").html("Passwords must match.");
        return false;
    } else {
        $("#error-message").html("");
        return true;
    }
}
</script>
</body>

</html>