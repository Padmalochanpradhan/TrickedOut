<?php 
if(!isset($search_input)){
  $search_input = "";
  $v = 9;
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title; ?></title>
  <!-- plugins:css -->
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style2.css?v='.$v) ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/mystyle.css?v='.$v) ?>">
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css?v='.$v) ?>">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/jquery.dataTables.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datepicker.min.css') ?>">
    <!-- jQuery -->
  <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
  <style>
@font-face {
    font-family: 'Gotham';
    src: url('<?= base_url("fonts/Gotham-Book.woff") ?>') format('woff'),
         url('<?= base_url("fonts/Gotham-Book.woff2") ?>') format('woff2'),
         url('<?= base_url("fonts/Gotham-Book.ttf") ?>') format('truetype');
    font-weight: normal;
}

@font-face {
    font-family: 'GothamBold';
    src: url('<?= base_url("fonts/Gotham-Bold.ttf") ?>') format('truetype');
}

@font-face {
    font-family: 'GothamMedium';
    src: url('<?= base_url("fonts/Gotham-Medium.ttf") ?>') format('truetype');
}

body
{
font-family:"Gotham"!important;
}
.form-control {
color: #dedede!important;
font-family:"Gotham"!important;
}
/*==================my style========*/
.custom-navbar {
  background: transparent;
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

/* After scroll */
.custom-navbar.scrolled {
  background: transparent;
   z-index: 999;
}
.navbar .navbar-menu-wrapper{height: 60px!important;}
@media only screen and (max-width: 991px) {
  .custom-navbar {
  background: transparent;
  transition: background 0.3s ease, box-shadow 0.3s ease;
}
.custom-navbar.scrolled {
  background: rgba(0, 0, 0, 0.85);
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  z-index: 99999;
}
}
/*==================my style========*/
</style>

</head>
<body style="background-color:#ffffff!important;">
  <div class="container-scroller" >
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row custom-navbar">
  <div class="text-center navbar-brand-wrapper d-flex d-none d-lg-flex align-items-center">
  <!-- <a class="navbar-brand brand-logo me-5" href="#"><img src="images/logo.jpg" class="me-2" alt="logo"></a> -->
  <!-- <a class="navbar-brand brand-logo-mini" href="#"><img src="images/logo-mini.jpg" alt="logo"></a> -->
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between" style="background-color:transparent!important;">
        <!-- <div class="d-none d-md-flex"><img src="<?= base_url('assets/images/logow.svg') ?>" / width="250"></div> -->
        <div>
               
        </div>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="fa-solid fa-bars text-secondary" ></span>
    </button>
  </div>
</nav>
    <script type="text/javascript">
        function searchBtnClick(){
          var search_input = $("#search_input").val();
          if(search_input){
            $("#search_form").submit();
          }
        }
          window.addEventListener("scroll", function () {
            const navbar = document.querySelector(".custom-navbar");
            navbar.classList.toggle("scrolled", window.scrollY > 50);
          });
    </script>