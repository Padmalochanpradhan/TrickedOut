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
.storage-modal {
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.2);
  padding: 10px 20px;
}
#storageModal .modal-dialog {
    position: fixed;
    top: 20px;          /* distance from top */
    right: 20px;        /* distance from right */
    margin: 0;
    transform: none !important;
}

#storageModal .modal-content {
    border-radius: 20px;
}
.progress-container {
    position: relative;
    width: 100%;
}

.progress {
    height: 10px;
    border-radius: 12px;
    background: #e6e6e6;
    overflow: visible;
    box-shadow: inset 0px 0px 4px rgba(0,0,0,0.2),
                0px 0px 8px rgba(74,163,255,0.3);
}

.progress-bar {
    border-radius: 12px;
    background: linear-gradient(to right, #4caf50, #ffeb3b, #f44336);
    box-shadow: 0px 0px 6px rgba(74,163,255,0.3);
}

.progress-circle {
    position: absolute;
    top: -4px;
    width: 20px;
    height: 20px;
    background: #ffffff;
    border-radius: 50%;
    border: 3px solid #4aa3ff;
    box-shadow: 0px 0px 8px rgba(74, 163, 255, 0.8);
    transform: translateX(-50%);
}
.storage_space{
    width:400px;
}
@media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
    .storage_space{
    width:300px;
}
}
@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
    .storage_space{
    width:400px;
}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
    .storage_space{
    width:300px;
}
}
@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
    .storage_space{
    width:400px;
}
}
@media only screen and (max-width: 767px) {
    .storage_space{
    width:230px;
}
}
</style>

</head>
<body style="background-color:#ffffff!important;">
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="z-index:99;top:0;background-color:#fff;">
  <div class="text-center navbar-brand-wrapper d-flex d-none d-lg-flex align-items-center">
  <!-- <a class="navbar-brand brand-logo me-5" href="#"><img src="images/logo.jpg" class="me-2" alt="logo"></a>
  <a class="navbar-brand brand-logo-mini" href="#"><img src="images/logo-mini.jpg" alt="logo"></a> -->
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center ">
        <div class="d-none d-md-flex"><img src="<?= base_url('assets/images/logo-black.svg') ?>" / width="150"></div>

            <?php
            $totalGB = 0;
            $usedGB = 0;
            $totalMB = 0;
            $percent = 0;
            $showStorageBar = false;
            if (!empty($storageAvailability)) {
                $usedMB = $storageAvailability[0]->used_volumn_inMB;
                $totalGB = $storageAvailability[0]->volume_inGB;
                

                //$usedMB += 20000;

                // Convert GB to MB
                $totalMB = $totalGB * 1024;
                $percent = $totalMB > 0 ? ($usedMB / $totalMB) * 100 : 0;

                // Convert MB → GB
                $usedGB = $usedMB / 1024;
                // >= 70% → open by default
                if ($percent >= 70) {
                    $showStorageBar = true;
                }


                if ($totalGB >= 1024) {
                    $used  = round($usedGB / 1024, 2);
                    $total = round($totalGB / 1024, 2);
                    $unit  = 'TB';
                } else {
                    $used  = round($usedGB, 2);
                    $total = round($totalGB, 2);
                    $unit  = 'GB';
                }
            ?>        
        <div class="d-flex align-items-center ms-auto storage-wrapper">

    <!-- Storage bar -->
    <div id="storage_avalable_bar"  class="storage_space"
         style="<?= $showStorageBar ? '' : 'display:none;' ?>">
         
        <div class="mb-2 mt-3 text-start">
            <img src="<?= base_url('assets/images/storage.svg') ?>" width="20">
            <strong><?= isset($used) ? $used : 0 ?> <?= isset($unit) ? $unit : 'GB' ?> of <?= isset($total) ? $total : 0 ?> <?= isset($unit) ? $unit : 'GB' ?> used</strong>
        </div>

        <div class="progress-container">
            <div class="progress">
                <div class="progress-bar" style="width: <?= $percent ?>%;"></div>
            </div>
            <div class="progress-circle" style="left: <?= $percent ?>%;"></div>
        </div>

        <div class="text-end mt-1">
            <a href="#" data-bs-toggle="modal" data-bs-target="#storageModal" style="font-size:14px;">
                view details
            </a>
        </div>
    </div>

    <!-- Storage icon -->
    <img src="<?= base_url('assets/images/storage.svg') ?>"
         width="24"
         class="ms-3 storage-toggle"
         title="Storage usage"
         onclick="toggleStorageBar()">
</div>

<!-- <div class=""style="width: 5%;">
    <img src="<?= base_url('assets/images/storage.svg') ?>"
         width="24"
         style="cursor:pointer;"
         title="Storage usage"
         onclick="toggleStorageBar()">
</div> -->
<?php } ?>
          
            


          <!-- <div align="right" class="mb-1"><img src="<?= base_url('assets/images/storage.svg') ?>" / width="20"><span class="ms-1"><?php if(count($storageAvailability)){?>Using <?php echo $storageAvailability[0]->used_volumn_inMB;?> MB of <?php echo $storageAvailability[0]->volume_inGB;?> GB storage<?php }else{?> You do not have an active subscription. <?php }?></span></div> -->
        <!-- <div class="navbar-nav navbar-nav-right d-none d-lg-flex mt-2 text-end">
          <div class="nav-item nav-search">
        <form action="<?= base_url('Search') ?>" method="POST" enctype="multipart/form-data" id="search_form" name="search_form">  
          <?= csrf_field() ?>
          <div>
        <div class="input-group" style="border:1px solid #666;">
        <input type="text" class="form-control search_1" id="search_input" name="search_input" placeholder="Search" aria-label="search" aria-describedby="search" style="color:#000!important;" value="<?php echo $search_input?>" >  
         <div class="input-group-prepend hover-cursor" id="navbar-search-icon" style="padding:0px!important;">
            <span class="input-group-text" id="search">
            <div style="border-left:1px solid #000;padding:5px 0px 5px 5px;">
             <img src="<?= base_url('assets/images/search.svg') ?>" alt="logo" width="20" class="ms-1" onclick="searchBtnClick()">
             </div>
            </span>
          </div>
          </div>
        </div>
      </form>
         </div>
          </div> -->

       

    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="fa-solid fa-bars"></span>
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
    </script>
<div class="modal fade" id="storageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content storage-modal">

      <div class="modal-header border-0">
        <h5 class="modal-title">
          <img src="<?= base_url('assets/images/storage.svg') ?>" width="20" class="me-1">
          <strong>Storage usage</strong>
        </h5>
        <!-- <span class="text-muted small ms-2">Auto-upgrade: ON</span> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

         <h3 class="fw-bold"><?= isset($used) ? $used : 0 ?> <?= isset($unit) ? $unit : 0 ?> of <?= isset($total) ? $total : 0 ?> <?= isset($unit) ? $unit : 0 ?> used</h3>

        <!-- Progress -->
        <div class="progress-container mt-3 mb-1">
          <div class="progress">
            <div class="progress-bar" style="width: <?= $percent ?>%;"></div>
          </div>
          <div class="progress-circle" style="left: <?= $percent ?>%;"></div>
        </div>

        <div class="d-flex justify-content-between mt-2">
          <span class="text-muted"><?= round($percent,0) ?>% of plan capacity</span>
          <span class="text-muted"><?= round($totalGB - $usedGB,2) ?> GB remaining</span>
        </div>

        <!-- Warning box -->
        <?php if ($percent >= 70): ?>
        <div class="alert alert-warning mt-4">
          <strong>⚠ Approaching your limit</strong>
          <p class="mb-0 small">
            Your vault has reached its storage limit. Free up space or upgrade your plan to keep building your collection. "<a href="<?= base_url('Subscription') ?>"> Click to Upgrade</a>" (You're always in control of your vault)
          </p>
        </div>
        <?php endif; ?>

        <!-- <a href="#" class="small text-primary">Change auto-upgrade settings</a> -->

      </div>
    </div>
  </div>
</div>

<script>
function toggleStorageBar() {
    const bar = document.getElementById('storage_avalable_bar');
    if (!bar) return;

    bar.style.display =
        (bar.style.display === 'none' || bar.style.display === '')
            ? 'block'
            : 'none';
}
</script>
