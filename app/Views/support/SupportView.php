<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<style type="text/css">
  .borderless td, .borderless tr {
    border: none;
  }
  .video-wrapper video {
    width: 100%;
    aspect-ratio: 16 / 9;
    height: auto;
  }
  .big-font1
  {font-size:100px;
    font-weight:bold;
  }
  .centered {
    position: absolute;
    top: 7%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  .bottom-left {
    position: absolute;
    bottom:35%;
    left: 34%;
  }
  .container3
  {position:relative;}
  .m-magic
  {margin-top:80px;}
  .bg-backstage
  {background-image:url(assets/images/Tricked-Out-Contact-Us.png);background-size:cover;background-position: top center;}
  .rabbit
  {margin-top:5%;}
  @media (min-width: 768px) and (max-width: 1024px) {
    .m-magic
    {margin-top:50px;}
    .bg-backstage
    {background-image:url(assets/images/Tricked-Out-Contact-Us.png);background-size: cover;background-position: top center;}
    .rabbit
    {margin-top:60px;}
  }
  .inputcolor {
  color: #000!important;
}
</style>
<div class="main-panel bg-backstage">
  <div class="content-wrapper" style="background:rgba(0,0,0,0)!important;background-repeat:no-repeat!important;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-lg-12 col-md-12">
            <div class="row"> 
              <div class="text-center">
                <div  class="m-magic text-center"><img src="<?= base_url('assets/images/logo.svg') ?>"  width="200"></div>
                <h4 class="text-white mt-2 text-center" style="font-style: italic;">Have questions or need support?<br>
                  The Tricked Out teams is here and happy to help!</h4>              
                <div class="text-center text-white"></div>     
              </div>
            </div>
          </div>
        </div>
        <div class="row ">
          <div class="col-lg-12 col-md-12 text-center mt-5" style="color: #ffffff;"><?php if(session()->getFlashdata('err_msg')){ ?>
            <?= session()->getFlashdata('err_msg'); ?>
            <?php } ?>
            <?php if(session()->getFlashdata('success_msg')){ ?>
              <div class="alert alert-success text-center mt-4">
                  <?= session()->getFlashdata('success_msg'); ?>
              </div>
            <?php } ?>
          </div>
             <div >
 <div class="card-body">           
            <div class="row"> 
              <div class="col-lg-12 col-md-12">
                <form action="<?= base_url('Support') ?>" method="POST" enctype="multipart/form-data" id="support" name="support" onSubmit="disabled_upload_button();">  
                  <?= csrf_field() ?>
                  <?php
                      $phone = $_SESSION['phone'] ?? '';

                  if ($phone) {
                      // Remove non-digits
                      $digits = preg_replace('/\D/', '', $phone);

                      // Remove leading country code (1) if present
                      if (strlen($digits) === 11 && str_starts_with($digits, '1')) {
                          $digits = substr($digits, 1);
                      }

                      // Format if exactly 10 digits
                      if (strlen($digits) === 10) {
                          $phone = sprintf(
                              '(%s) %s-%s',
                              substr($digits, 0, 3),
                              substr($digits, 3, 3),
                              substr($digits, 6)
                          );
                      }
                  }
                  ?>
                                       
                  <div class="row justify-content-center mt-4">
            <div class="col-lg-8 col-md-10">
              <h2 class="text-center mb-4"></h2>
              <!-- Title -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5 class="text-white">Name</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="name" class="form-control form-bg ht inputcolor" placeholder="Name" value="<?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?? '' ?>">
                </div>
              </div>
              
              <!-- Contact Phone -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5 class="text-white">Contact Phone</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="contact_phone" id="contact_phone" class="form-control form-bg ht inputcolor" placeholder="Contact Phone" value="<?= esc($phone) ?>" maxlength="14">
                </div>
              </div>
              <!-- Title -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5 class="text-white">Email</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="email" class="form-control form-bg ht inputcolor" placeholder="Email" value="<?= $_SESSION['email_id'] ?? '' ?>">
                </div>
              </div>              
              <!-- Feedback -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5 class="text-white">Message</h5></label>
                <div class="col-lg-8 col-md-8">
                  <!-- <input type="text" name="feedback" class="form-control form-bg ht inputcolor" placeholder="Feedback" value="<?= $performanceDetails->feedback ?? '' ?>"> -->
                  <textarea name="message" class="form-control form-bg inputcolor" placeholder="Message" rows="5"></textarea>
                </div>
              </div>

              <!-- Submit -->
              <div class="row">
                <div class="col-lg-8 offset-lg-4 col-md-8 offset-md-4">
                  <button type="submit"
                          class="btn btn-warning"
                          id="sendBtn">
                      <span id="sendBtnText">Send</span>
                        <span id="sendBtnLoader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                  </button>
                </div>
              </div>

            </div>
          </div>
                  </form>

                </div>
              </div>          
                      
                      
           </div>

     </div>

      
   

 </div>
 

 


</div>

<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- content-wrapper ends -->

<!-- Modal for trick info data ----- -->
<script type="text/javascript">
// Allow only numeric input + control keys
const isNumericInput = (event) => {
  const key = event.keyCode;
  return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105));
};

const isModifierKey = (event) => {
  const key = event.keyCode;
  return (event.shiftKey === true || key === 35 || key === 36) || // Shift, Home, End
         (key === 8 || key === 9 || key === 13 || key === 46) || // Backspace, Tab, Enter, Delete
         (key > 36 && key < 41) || // Arrow keys
         ((event.ctrlKey === true || event.metaKey === true) &&
         (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)); // Ctrl/Command + A,C,V,X,Z
};

const enforceFormat = (event) => {
  if(!isNumericInput(event) && !isModifierKey(event)) {
    event.preventDefault();
  }
};

// Format input to (123) 456-7890
const formatToPhone = (event) => {
  if(isModifierKey(event)) return;

  const input = event.target.value.replace(/\D/g,'').substring(0,10);
  const areaCode = input.substring(0,3);
  const middle = input.substring(3,6);
  const last = input.substring(6,10);

  if(input.length > 6) {
    event.target.value = `(${areaCode}) ${middle}-${last}`;
  } else if(input.length > 3) {
    event.target.value = `(${areaCode}) ${middle}`;
  } else if(input.length > 0) {
    event.target.value = `(${areaCode}`;
  } else {
    event.target.value = '';
  }
};

// Attach events
const contactPhoneInput = document.getElementById('contact_phone');
contactPhoneInput.addEventListener('keydown', enforceFormat);
contactPhoneInput.addEventListener('keyup', formatToPhone);
contactPhoneInput.addEventListener('change', formatToPhone);

// Format pre-filled value on load
(function () {
    const digits = contactPhoneInput.value.replace(/\D/g, '').substring(0, 10);
    if (digits.length === 10) {
        contactPhoneInput.value = `(${digits.substring(0,3)}) ${digits.substring(3,6)}-${digits.substring(6)}`;
    } else if (digits.length > 0) {
        contactPhoneInput.value = digits;
    }
})();


function disabled_upload_button() {
    const btn = document.getElementById('sendBtn');
    const text = document.getElementById('sendBtnText');
    const loader = document.getElementById('sendBtnLoader');

    // Disable button
    btn.disabled = true;

    // Hide text, show loader
    text.classList.add('d-none');
    loader.classList.remove('d-none');

    return true; // allow form submission
}
</script>


