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
.back_blue{width: 100%;}
@media (min-width: 768px) {
.back_blue{width: 50%;}
}
@media (min-width: 1024px) {
.back_blue{width: 43%;}
}
@media (min-width: 1280px) {
.back_blue{width: 30%;}
}
@media (min-width: 1536px) {
.back_blue{width:25%;}
}
</style>
</head>
<body class="login_bg">
  <div class="px-4">
    <div class="row">
      <div class="back_blue">
        <form action="<?= base_url('login') ?>" method="POST" id="loginForm">  
        <?= csrf_field() ?>
        <div class="login_space">
          <div class="py-5 px-2" align="center">
         <div><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid" style="width:300px;"></div>
            <div style="font-weight:lighter;font-size:20px;letter-spacing:2px;" class="text-white mt-2">MAGIC VAULT</div>
          </div>
          <div class="px-3">
            <div style="color: #f74747; text-align: center; font-size: 15px;height: 50px;"> 
                <?php if(service('validation')->listErrors()){ ?>                        
                      <?= service('validation')->listErrors() ?>   
                <?php } ?>

                <?php if(session()->getFlashdata('err_msg')){ ?>
                  <?= session()->getFlashdata('err_msg'); ?>
                <?php } ?>
                
              </div>

            <div class="form-group">
              <span class="form-control-icon"><img src="<?= base_url('assets/images/user.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;"></span>
              <input type="text" class="form-control" placeholder="Username" name="userName" style="height:50px;" required>
            </div> 
            <div class="form-group mt-3">
              <span class="form-control-icon"><img src="<?= base_url('assets/images/password.svg') ?>" class="img-fluid" style="width:25px;margin-top:-5px;"></span>
              <input type="password" class="form-control" placeholder="Password" name="password" style="height:50px;margin-top:-5px;" required autocomplete="new-password" oncopy="return false;" onpaste="return false;">
            </div>
            <button type="submit" id="loginBtn" class="btn btn-success w-100 mt-3 br0 botton-h text-white" style="background-color:#4bb649;font-size:20px;letter-spacing:2px;">
              <span id="btnText">LOG IN</span>
              <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
            </button>
            <div>
            <a href="signup" style="float:left; color:#fff;text-decoration: none;">Sign up</a>
             <a href="forgot_password" style="float:right;color:#fff;text-decoration: none;">Forgot Password</a>
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
document.addEventListener('DOMContentLoaded', function () {

  const form = document.getElementById('loginForm');
  const btn  = document.getElementById('loginBtn');
  const text = document.getElementById('btnText');
  const loader = document.getElementById('btnLoader');
//alert(1);
  if (!form || !btn) return; // 🔐 safety check
//alert(2);
  form.addEventListener('submit', function () {
    //alert(3);
    btn.disabled = true;
    text.innerText = 'Logging in...';
    loader.classList.remove('d-none');
    //alert(4);
  });

});
</script>

</body>

</html>