<!-- partial -->
<div class="page-body-wrapper">
  <nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index:999999;">
    <ul class="nav">
    <li class="nav-item text-white text-right">
    <div class="pe-2">
      
        <button class="navbar-toggler  d-none d-lg-flex" type="button" data-toggle="minimize" style="float:right;">
        <img id="toggleIcon" src="<?= base_url('assets/images/sideclick.svg') ?>" alt="click" width="8" onclick="changeArrowImage();">
      </button> 
      </div>
    </li>
      <!-- <li class="nav-item text-white text-center mb-5">
      <div><a class="navbar-brand brand-logo-mini mt-2" href="#"><img src="<?= base_url('assets/images/logo-mini.png') ?>" alt="logo"></a>
      </div>
        <div style="font-size:18px; font-weight:lighter!important;font-family:'Gotham'!important"><?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?></div>
        
      </li> -->
      <?php if($_SESSION['employee_role']=="Admin"){?>

      <li class="nav-item" >
        <a class="nav-link" href="<?= base_url('user') ?>">
          <img src="<?= base_url('assets/images/bug.svg') ?>" width="25"/>
          <span class="menu-title ms-2">User List</span>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('plan') ?>">
         <img src="<?= base_url('assets/images/voult.svg') ?>" width="25">
          <span class="menu-title ms-2">Manage Plan</span>
        </a>
      </li> -->
      
      <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('category') ?>">
         <img src="<?= base_url('assets/images/upload.svg') ?>" width="25">
          <span class="menu-title ms-2">Manage Data</span>
        </a>
      </li> -->

      <?php }else{?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('MyVault') ?>">
         <img src="<?= base_url('assets/images/voult.svg') ?>" width="25">
          <span class="menu-title ms-2">My Vault</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('UploadTrickStart') ?>">
          <img src="<?= base_url('assets/images/upload.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Upload</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('TrickBackstage') ?>">
          <img src="<?= base_url('assets/images/backstage.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Backstage</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('FAQ') ?>">
          <img src="<?= base_url('assets/images/faq.svg') ?>" width="25"/>
          <span class="menu-title ms-2">FAQ</span>
        </a>
      </li>
<!--       <li class="nav-item">
        <a class="nav-link" href="https://trickedoutbugtracker.com/" target="_blank">
          <img src="<?= base_url('assets/images/bug.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Submit Bug</span>
        </a>
      </li>
 -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('MyPerformance') ?>">
          <img src="<?= base_url('assets/images/voult.svg') ?>" width="25"/>
          <span class="menu-title ms-2">My Performances</span>
        </a>
      </li>
      <li class="nav-item" >
        <a class="nav-link" href="<?= base_url('Subscription') ?>">
         <img src="<?= base_url('assets/images/subscription.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Subscription</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Category') ?>">
          <img src="<?= base_url('assets/images/category1.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Custom Category</span>
        </a>
      </li>
      <!-- <li class="nav-item" >
        <a class="nav-link" href="<?= base_url('note') ?>">
         <img src="<?= base_url('assets/images/settings.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Settings</span>
        </a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('Support') ?>">
          <img src="<?= base_url('assets/images/support.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Contact Us</span>
        </a>
      </li>

    <?php }?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/signout') ?>">
          <img src="<?= base_url('assets/images/logout.svg') ?>" width="25"/>
          <span class="menu-title ms-2">Logout</span>
        </a>
      </li>           
      <li class="nav-item" style="margin-top:200px;">
        <a class="nav-link d-flex justify-content-center" href="#/" style="background-color:transparent;">
          <span class="menu-title text-center" style="font-size:8px;"><?= date('Y')?> © Tricked Out Magic Vault. <br/>all rights reserved</span>
         
        </a>
      </li>


    </ul>
    
  </nav>

  <!-- Modal video play ----- -->
<div class="modal fade" id="play_learn_video">
  <div class="modal-dialog modal-xl" style="max-width: 90%; max-height: 98%; margin: auto;">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title">Learn</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="learn_video_modal_close('play_learn_video');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      

          
      <div class="modal-body" align="center">
        <div class="row">
        <div class="col-lg-12 col-md-12">
      <video  style="width: 100%; max-height: 70vh; height: auto;" class="trick_video" controls>
        <source src="<?php echo base_url()?>/trick_learn_video/TrickedOut_LearnMore.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
  </div>
</div>
      </div> 
      <div class="modal-footer">
        
        
        <button type="button" class="btn btn-secondary" onclick="learn_video_modal_close('play_learn_video');">Close</button>
      </div>
    
    </div>
  </div>
</div>
<script>
  let sidebarOpen = true;

  function changeArrowImage() {
    const icon = document.getElementById('toggleIcon');
    sidebarOpen = !sidebarOpen;

    // Change icon based on state
    icon.src = sidebarOpen
      ? "<?= base_url('assets/images/sideclick.svg') ?>"
      : "<?= base_url('assets/images/sideclick2.svg') ?>";

    // Optional: toggle sidebar appearance
    document.body.classList.toggle('sidebar-minimized');
  }
</script>
<script type="text/javascript">
function modal_show_click(modal_id){
  $("#"+modal_id).modal('show');
}
function learn_video_modal_close(modal_id){
  $("#"+modal_id).modal('hide');
  $('.trick_video').each(function() {
    this.pause();
  });
}
</script>