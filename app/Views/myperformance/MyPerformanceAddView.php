<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<style type="text/css">
  .loader-overlay {
  position: fixed;
  inset: 0;
  background: rgba(255,255,255,0.9);
  z-index: 9999;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.spinner {
  width: 70px;
  height: 70px;
  border: 8px solid #ddd;
  border-top-color: #3498db;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

.loader-overlay p {
  margin-top: 15px;
  font-size: 20px;
  color: #000;
}
.inputcolor {
  color: #000!important;
}
</style>
<div class="main-panel">
  <div class="content-wrapper" style="margin-top:50px;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="row"> 
              <div class="col-lg-12 col-md-12">

                <form action="<?= base_url('PerformanceSubmit') ?>" method="POST" enctype="multipart/form-data" id="uploadtrick" name="uploadtrick" onSubmit="disabled_upload_button();">  
                  <?= csrf_field() ?>
                  
                  
                     <input type="hidden" name="performance_id" value="<?= $performanceDetails->id ?? '' ?>">
                  <div class="row justify-content-center mt-4">
            <div class="col-lg-8 col-md-10">

              <h2 class="text-center mb-4"><?php echo $actionStr?> Performance</h2>

              <!-- File -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Select File</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="file" name="performanceFile" class="form-control form-bg inputcolor" accept="video/*" <?= empty($performanceDetails->performance_file) ? 'required' : '' ?>>
                </div>
              </div>

              <!-- Title -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Performance Title</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="name" class="form-control form-bg ht inputcolor" placeholder="Title" value="<?= $performanceDetails->name ?? '' ?>">
                </div>
              </div>
              <!-- Contact Name -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Contact Name</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="contact_name" class="form-control form-bg ht inputcolor" placeholder="Contact Name" value="<?= $performanceDetails->contact_name ?? '' ?>">
                </div>
              </div>
              <!-- Contact Phone -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Contact Phone</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="contact_phone" id="contact_phone" class="form-control form-bg ht inputcolor" placeholder="Contact Phone" value="<?= $performanceDetails->contact_phone ?? '' ?>" maxlength="16"
                  pattern="^\(\d{3}\)\s\d{3}-\d{4}">
                </div>
              </div>
              <!-- Feedback -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Feedback</h5></label>
                <div class="col-lg-8 col-md-8">
                  <!-- <input type="text" name="feedback" class="form-control form-bg ht inputcolor" placeholder="Feedback" value="<?= $performanceDetails->feedback ?? '' ?>"> -->
                  <textarea name="feedback" class="form-control form-bg inputcolor" placeholder="Feedback" rows="5"><?= $performanceDetails->feedback ?? '' ?></textarea>
                </div>
              </div>

              <!-- Location -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Performance Location</h5></label>
                <div class="col-lg-8 col-md-8">
                  <input type="text" name="location" class="form-control form-bg ht inputcolor" placeholder="Location" value="<?= $performanceDetails->location ?? '' ?>">
                </div>
              </div>

              <!-- Description -->
              <div class="row mb-3">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Performance Details</h5></label>
                <div class="col-lg-8 col-md-8">
                  <textarea name="description" class="form-control form-bg inputcolor" placeholder="Description" rows="5"><?= $performanceDetails->details ?? '' ?></textarea>
                </div>
              </div>

              <!-- Date -->
              <div class="row mb-4">
                <label class="col-lg-4 col-md-4 mt-2"><h5>Performance Date</h5></label>
                <div class="col-lg-8 col-md-8">
                  <div class="input-group date datepicker" id="datepicker-popup">
                    <?php 
                      $performanceDate = '';
                      if (!empty($performanceDetails->performance_date)) {
                          $performanceDate = date("m/d/Y", strtotime($performanceDetails->performance_date));
                      }
                      ?>
                    <input type="text" class="form-control form-bg inputcolor" name="performance_date" placeholder="Performance Date"
                           style="background: transparent; height:45px; border:none;" value="<?= $performanceDate?>">
                    <span class="input-group-addon input-group-append border-left px-2 pt-1">
                      <img src="<?= base_url('assets/images/calender.svg') ?>" width="20">
                    </span>
                  </div>
                </div>
              </div>

              <!-- Submit -->
              <div class="row">
                <div class="col-lg-8 offset-lg-4 col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Upload</button>
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
    </div>
    <!-- content-wrapper ends -->

<!-- Full Screen Loader -->
<div id="fullLoader" class="loader-overlay" style="display:none;">
  <div class="spinner"></div>
  <p>Uploading... Please wait</p>
</div>
<script>
document.getElementById("uploadtrick").addEventListener("submit", function () {

    // Show loader
    document.getElementById("fullLoader").style.display = "flex";

    // Disable submit button
    const btn = document.querySelector("button[type='submit']");
    if (btn) btn.disabled = true;
});
 // function phoneFormatter() {
 //   $('#contact_phone').on('input', function() {
 //     var number = $(this).val().replace(/[^\d]/g, '')
 //     if (number.length == 7) {
 //       number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
 //     } else if (number.length == 10) {
 //       number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
 //     }
 //     $(this).val(number)
 //   });
 // };

 // phoneFormatter();
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

</script>

