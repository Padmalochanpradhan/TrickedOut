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
.big-font1.centered {
  position: absolute;
  left: 50%;
  font-size: 100px;
  bottom: 50%;             
  transform: translateX(-50%);
   font-weight: bold;
  line-height: 1;
  pointer-events: none!important;
}
{font-size:100px;
font-weight:bold;
}
.centered {
  position: absolute;
  left: 50%;
  bottom: 50%;             
  transform: translateX(-50%);
   font-weight: bold;
  line-height: 1;
  pointer-events: none!important;
}
.bottom-left {
  position: absolute;
  bottom:35%;
  left: 34%;
}
.container3{position:relative;}
.bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 100vh;
}
.dice {
  position: absolute;
  bottom: 25%;           /* aligns with stage floor */
  width: 95%;
}

.dice_space {
  position: absolute;
  width: 250px;
}

/* Green light */
.dice_space.green {
  left: 25%;
  transform: translateX(-50%);
}

/* Red light */
.dice_space.red {
  left: 50%;
  transform: translateX(-50%);
}

/* Yellow light */
.dice_space.yellow {
  left: 75%;
  transform: translateX(-50%);
}
.lower-font{margin-top:-25px;}

@media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
  .dice_space.green {
  left:20%;
  transform: translateX(-50%);
}

/* Red light */
.dice_space.red {
  left: 47%;
  transform: translateX(-50%);
}

/* Yellow light */
.dice_space.yellow {
  left:72%;
  transform: translateX(-50%);
}
  .bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 35vh;
}
.dice {
  position: absolute;
  bottom: 25%;           /* aligns with stage floor */
  width: 100%;
}
 
  .big-font1.centered{font-size:100px;}
  .lower-font{margin-top:-23px;}
  .dice_space{width: 200px;}
}

@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
  .dice_space.green {
  left: 24%;
  transform: translateX(-50%);
}

/* Red light */
.dice_space.red {
  left: 47%;
  transform: translateX(-50%);
}

/* Yellow light */
.dice_space.yellow {
  left:70%;
  transform: translateX(-50%);
}
.bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 62vh;
}
.dice {
  position: absolute;
  bottom: 20%;           /* aligns with stage floor */
  width: 100%;
}
 
    .big-font1.centered{font-size:100px;}
  .lower-font{margin-top:-23px;}
  .dice_space{width: 250px;}
}
  

@media (max-width: 1024px) {
  .centered { font-size: 60px;bottom: 50%; }
}

@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  .dice_space.green {
  left:17%;
  transform: translateX(-50%);
}

/* Red light */
.dice_space.red {
  left: 47%;
  transform: translateX(-50%);
}

/* Yellow light */
.dice_space.yellow {
  left:77%;
  transform: translateX(-50%);
}
   .bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 50vh;
}
.dice {
  position: absolute;
  bottom: 25%;           /* aligns with stage floor */
  width:100%;
}
 
    .big-font1.centered{font-size:100px;}
  .lower-font{margin-top:-23px;}
  .dice_space{width: 200px;}
}
@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
  /* Green light */
.dice_space.green {
  left: 20%;
  transform: translateX(-50%);
}

/* Red light */
.dice_space.red {
  left: 47%;
  transform: translateX(-50%);
}

/* Yellow light */
.dice_space.yellow {
  left:73%;
  transform: translateX(-50%);
}
  .bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 65vh;
}
.dice {
  position: absolute;
  bottom: 22%;           /* aligns with stage floor */
  width: 100%;
}
 
  .big-font1.centered{font-size:100px;}
  .lower-font{margin-top:-23px;}
  .dice_space{width: 200px;}
}

@media only screen and (max-width: 767px) {
   .bg-light {
  position: relative;
  background-image: url(<?= base_url('assets/images/light-bg.jpg') ?>);
  background-size: cover;
  background-position: center top;
  min-height: 46vh;
}
.dice {
  position: absolute;
  bottom: 14%;           /* aligns with stage floor */
  width: 100%;
}
 
  .big-font1.centered{font-size:50px;}
  .lower-font{margin-top:-20px;}
  .dice_space{width: 100px;}
}
</style>
<div class="main-panel " >
  <div>
    <div class="row  bg-light">
      <div class="col-md-12">
        <div class="row">
          <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="150"></div>
        </div>
          <div class="col-lg-8 col-md-12 offset-lg-2 ">
            <div class="row"> 
            <div class="text-center " >
<div><img src="<?= base_url('assets/images/tikr.svg') ?>" / width="50"></div>
<div class="mt-2"><img src="<?= base_url('assets/images/allcomplete.svg') ?>" / width="300" class="img-fluid"></div>
         <div class="text-center text-white">Tricks that couldn’t be matched are in red, allowing you to click, review and update their settings to ensure they’re categorized correctly.</div>     
            </div>
              </div>
            </div>
            <div class="row">
        <div class="col-lg-12  mt-4">
           
           <div class="dice">
  <div class="dice_space green">
                <img src="<?= base_url('assets/images/g1.png') ?>" class="img-fluid"   >
                  <div class="text-white fw-bold mb-0  big-font1 centered " style="font-family: GothamMedium!important;"><?php echo $matchCount?></div> 
                  <div class="text-white  text-center">
                    <div class="lower-font">Vaulted</div>
                  </div>
                          </div>     
  <div class="dice_space red">
                <img src="<?= base_url('assets/images/r1.png') ?>" class="img-fluid">
                <div class="text-white fw-bold mb-0  big-font1 centered " style="font-family: GothamMedium!important;"><?php echo $backstageCount?></div> 
                <div class="text-white  text-center">
                  <div class="lower-font">Backstage</div>
                </div>
                    </div>   
                  <div class="dice_space yellow">
                <img src="<?= base_url('assets/images/y1.png') ?>" class="img-fluid" >
             <div class="text-white fw-bold mb-0  big-font1 centered " style="font-family: GothamMedium!important;"><?php echo $duplicateCount?></div> 
             <div class="text-white  text-center">
              <div class="lower-font">Duplicates</div>
            </div>
                          </div>     
                          </div>
                </div>
              </div>
              <div>
            </div>
         </div>
      </div>
              </div>
          <div class="row mt-2">
            <div class="col-lg-12 col-md-12 text-center" style="color: #f74747;">
                    <?php if(session()->getFlashdata('err_msg')){ ?>
                  <?= session()->getFlashdata('err_msg'); ?>
                  <?php } ?>
                  </div>
            <div>
              <form action="<?= base_url('UploadTrickMultiple') ?>" method="POST" enctype="multipart/form-data" id="addtrick" name="addtrick" class="p-4">  
                <?= csrf_field() ?>
                <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
                <?php if(!empty($masterDataList)){ ?>
                  <table id="example" class="table table-sm table-responsive" style="width:100%" >
                    <thead>
                      <tr>
                        <th>Trick Name</th> 
                        <th>Matched Column</th> 
                        <th>Already Exists</th>
                        <!-- <th>Description</th> -->
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $i = 0;
                      foreach ($masterDataList as $key => $value) { 
                        
                          ?>                      
                          <tr>
                            <td><?php echo $value->filename.' (.'.$value->extension.')'; ?></td>
                            <td <?php if($value->status == 'Matched'){ echo 'class="text-success"'; }elseif($value->status == 'Partially Matched'){ echo 'class="text-warning"'; }else{ echo 'class="text-danger"'; } ?>><?php echo $value->status;
                            if($value->status != 'Backstage'){
                             echo ' (<span style="text-transform:capitalize;">'.$value->matched_field.'</span>)';
                           } ?></td>
                           <td><?php if($value->match_trick_id && $value->record_status == 0)echo 'Yes'; ?></td>
                           <!-- <td><a style="cursor: pointer;" onclick="viewModal('<?php echo $value->source_id; ?>','<?php echo $value->filename; ?>','<?php echo $value->status; ?>','<?php echo $value->matched_field; ?>','<?php echo $value->match_trick_id; ?>','<?php echo $value->extension; ?>');" >View</a></td> -->
                           <td><?php if($value->record_status == 1){?> 
                            <span class="text-success">Vaulted</span>
                           <?php }else if($value->match_trick_id){?>
                            <span class="text-warning">Duplicate</span>
                           <?php }else{?>
                            <span class="text-danger"><a href="javascript:void(0)" onclick="trick_insert_modalShow('<?php echo $value->id?>','<?php echo $value->filename?>','<?php echo $trickFileLinkArray[$i]?>','<?php echo $value->extension?>')" class="text-danger">Update</a></span>
                            <?php } ?></td>
                         </tr>
                       <?php 
                       $i++;
                          }?>

                        
                 </tbody>
               </table>

               
           </form>
         <?php } ?>
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
<div class="modal fade" id="view_note">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
       <h5 class="modal-title"> <span id="title"><img src="http://localhost/tricked_out_prod/assets/images/logow.svg"></span></h5> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('view_note');">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> 
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12 col-md-12"> 
          <!-- <div id="filename"></div> -->

        </div>
      </div>
    </div> 
  </div>
</div>
</div> 

<script>
$(document).ready(function() {
  $("#addtrick").submit(function(event) {
      if ($("input[name='filelist[]']:checked").length === 0) {
          alert('Choose at least one file.');
          event.preventDefault(); // Prevent form submission
      }else {
         return true;
      }
  });
});
  function viewModal(source_id,file_name,status,matched_field,match_trick_id,extension){
 
    $.ajax({
     type: "POST",
     url: "<?php echo base_url();?>/get_master_desc",
     data: {source_id:source_id} ,
     async: false ,
   })
    .done(function (data, textStatus, xhr){  
      var result = JSON.parse(data);  
      $('#name').html('<b>Name</b>: '+result.data[0].Name);
      $('#artist').html('<b>Artist</b>: '+result.data[0].Artist);
      $('#title').html('<b>File Name</b>: '+file_name+'.'+extension);
      $('#matched_column').html('<b>Matched Column</b>: '+status+' ('+matched_field+')');
      if(match_trick_id){
        var exists = 'Yes';
      }else{
        var exists = 'No';
      }
      $('#exists').html('<b>Already Exists</b>: '+exists);
      $('#desc').html('<b>Description</b>: '+result.data[0].Description); 

    })      
    .fail(function (jqXHR, textStatus, errorThrown){
     alert("The following error occurred: "+jqXHR.status+",   "+textStatus+",   "+errorThrown+"");
   }); 

    $("#view_note").modal("show");
  }
var number_of_file = '<?php echo $number_of_file?>';
  function selected_tricks(id,source_id){
    //var count = parseInt($('#selected_tricks').text()) || 0; // Ensure count is a number
    //alert(count);
    //var selected_tricks_count = 0; 
    if ($('#check' + id).is(':checked')) {
       // selected_tricks_count = count + 1; // Correct addition
        $('#source' + id).val(source_id);
    } else {
        // if (count > 0) { // Ensure count doesn't go negative
        //     selected_tricks_count = count - 1; // Correct subtraction
        // } else {
        //     selected_tricks_count = 0; // Prevent negative values
        // }
        $('#source' + id).val("");
    }
    var checkedCount = $(".check_class:checked").length;
    var checkedPer = Math.round(checkedCount/number_of_file*100);
    var checkedStr = checkedCount + " (" + checkedPer + "%)";
    $('#selected_tricks').text(checkedStr); // Update the HTML content
  }
  function radio_click(id,source_id){
    $("#check"+id).attr('checked','checked');
    selected_tricks(id,source_id);
  }
  function changeColor(id)
  {  
    var values=$("#"+id).val();
    if(values==""){
      $("#"+id).css('color', '#a6a8ab');
    }
    else{
      $("#"+id).css('color', '#000');   
    }   
  }
  function supplier_change(){
    var values=$("#supplier").val();
    if(values=="add"){
      $("#addSupplier").modal("show");
    }
  }
  function disabled_upload_button(){
    $('#uploadBtn').attr('disabled','disabled');
  }
  function AddSupplierSubmit(){
    var supplierName = $("#name").val().trim();
    var websiteUrl = $("#website").val().trim();

    if (supplierName === '') {
      alert('Please enter the Supplier Name.');
      return false;
    }else{
     $.ajax({
       type: "POST",
       url: "<?php echo base_url();?>/GetSupplierByName",
       data: {name:supplierName} ,
       async: false ,
     })
     .done(function (data, textStatus, xhr){ 
          // alert(data[0]['dob']);
      var result = JSON.parse(data);
      if(result.data.length){
        $("#err_msg").html("Supplier already exists!!!");
        return false;
      }else{
        supplierAdd(supplierName,websiteUrl);
      }
    })      
     .fail(function (jqXHR, textStatus, errorThrown){
       alert("The following error occurred: "+jqXHR.status+",   "+textStatus+",   "+errorThrown+"");
     });
   }
        //alert(1);
 }
 function supplierAdd(supplierName,websiteUrl){
  $.ajax({
   type: "POST",
   url: "<?php echo base_url();?>/AddSupplier",
   data: {name:supplierName,website:websiteUrl} ,
   async: false ,
 })
  .done(function (data, textStatus, xhr){ 
          // alert(data[0]['dob']);
    var result = JSON.parse(data);
    if(result.data.insertId){
      $('#supplier').append($("<option></option>").attr("value", result.data.insertId).text(supplierName)); 
      $('#supplier').val(result.data.insertId);
      $('#name').val('');
      $('#website').val('');
      $('#err_msg').html('');

      $("#addSupplier").modal("hide");
    }
  })      
  .fail(function (jqXHR, textStatus, errorThrown){
   alert("The following error occurred: "+jqXHR.status+",   "+textStatus+",   "+errorThrown+"");
 });         
}
function supplierNameChange(){
  $('#err_msg').html('');
}
function insertLogAPIFunction(log_type_id,log_type,log_details,log_title){

  let logFormData = new FormData();
  logFormData.append('log_type', log_type);
  logFormData.append('log_title', log_title);
  logFormData.append('log_details', log_details);
  logFormData.append('log_type_id', log_type_id);

// Send chunk using Fetch API
  fetch("<?php echo base_url('insertLogAPI/')?>", {
    method: 'POST',
    body: logFormData
  })
  .then(response => response.json())
  .then(data => {

  })
  .catch(error => console.error(`Error inserting log  ${log_details} :`, error));


}
///////////Split upload file
document.getElementById('uploadtrickpupup1').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    alert(22);
    });
      //$(document).ready(function () {
document.addEventListener('DOMContentLoaded', () => {
  const dropArea = document.getElementById('dropArea');
  const trickfile = document.getElementById('trickfile');
  const dropAreaText = document.getElementById('dropAreaText');
  const errorMessage = document.getElementById('error-message');
  const uploadBtn = document.getElementById('uploadBtn'); 
  const sizeErrorMessage = document.getElementById('size-error-message');
        //const MAX_FILE_SIZE = 100 * 1024 * 1024; // 8MB in bytes
        const MAX_FILE_SIZE = 10 * 1024 * 1024 * 1024; // 3.2GB in bytes       
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
          dropArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
          e.preventDefault();
          e.stopPropagation();
        }

        // Highlight drop area when file is dragged over it
        ['dragenter', 'dragover'].forEach(() => {
          dropArea.classList.add('highlight');
        });

        // Remove highlight when file is dragged out or dropped
        ['dragleave', 'drop'].forEach(() => {
          dropArea.classList.remove('highlight');
        });

        // Handle dropped files
        dropArea.addEventListener('drop', (e) => {
          const dt = e.dataTransfer;
          const files = dt.files;

            // Assign files to input control
          trickfile.files = files;
            //alert(1);

            // Display the names of the dropped files
          displayFileNames(files);
            // Hide error message if files are dropped
          errorMessage.style.display = 'none';
            // Check for file size errors
          if (checkFileSize(files)) {
            sizeErrorMessage.style.display = 'block';
          } else {
            sizeErrorMessage.style.display = 'none';
          }

        });

        // Handle file selection via the input element
        trickfile.addEventListener('change', (e) => {
          const files = e.target.files;
            //alert(2);
            // Display the names of the selected files
          displayFileNames(files);
            // Hide error message if files are selected
          errorMessage.style.display = 'none'; 
            // Check for file size errors
          if (checkFileSize(files)) {
            sizeErrorMessage.style.display = 'block';
          } else {
            sizeErrorMessage.style.display = 'none';
          }

        });

        // Function to display file names
        function displayFileNames(files) {
          //alert(files.length);
          if (files.length > 0) {
            let fileNames = Array.from(files).map(file => file.name).join(', ');
            let fileSize = Array.from(files).map(file => file.size).join(', ');
                //console.log(fileSize);
            dropAreaText.textContent = `${fileNames}`;
            $('#dropAreaText').css('color', '#000');
          } else {
            dropAreaText.textContent = 'DROP YOUR FILES HERE OR BROWSE';
            $('#dropAreaText').css('color', '#cccccc');
          }
        }
        // Function to check if all files are > 8MB
        function checkFileSize(files) {
          if(files.length){
            let allFilesTooLarge = true;
            for (let i = 0; i < files.length; i++) {
              if (files[i].size <= MAX_FILE_SIZE) {
                allFilesTooLarge = false;
                break;
              }
            }
            return allFilesTooLarge;
          }else{
            //console.log("no file");
            return false;
          }

        }

        // Prevent form submission if no files are selected
        uploadBtn.addEventListener('click', (e) => {
          //alert(6);
          if (trickfile.files.length === 0) {
            e.preventDefault();
            errorMessage.style.display = 'block';
          }else if (checkFileSize(trickfile.files)) {
            e.preventDefault();

            sizeErrorMessage.style.display = 'block';
          }
        });

        // Optional: Trigger input click when clicking the drop area
        dropArea.addEventListener('click', () => trickfile.click());
      });
    //});
document.addEventListener('DOMContentLoaded', () => {
  const dropArea2 = document.getElementById('dropArea2');
  const featured_image = document.getElementById('featured_image');
  const dropAreaText2 = document.getElementById('dropAreaText2');

// Prevent default drag behaviors
  ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea2.addEventListener(eventName, preventDefaults, false);
  });

  function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
  }

// Highlight drop area when file is dragged over it
  ['dragenter', 'dragover'].forEach(() => {
    dropArea2.classList.add('highlight');
  });

// Remove highlight when file is dragged out or dropped
  ['dragleave', 'drop'].forEach(() => {
    dropArea2.classList.remove('highlight');
  });


// Handle file selection via the input element
  featured_image.addEventListener('change', (e) => {
    const files = e.target.files;
//alert(2);
// Display the names of the selected files
    if (validateImageFiles(files)) {
      displayFileNames(files);
    } else {
      alert('Please select image files only.');
      featured_image.value = ''; // Clear the selection
    }
  });

// Function to display file names
  function displayFileNames(files) {
//alert(files.length);
    if (files.length > 0) {
      let fileNames = Array.from(files).map(file => file.name).join(', ');
      var fileNameStr = `${fileNames}`;
      $("#featured_image_name").html(fileNameStr);
      $("#featured_image_name").css('color', '#000');
    } else {
      $("#featured_image_name").html('Featured Image');
      $("#featured_image_name").css('color', '#a6a8ab');
  //dropAreaText2.textContent = 'Drag & drop files here or browse';
    }
  }
 // Function to validate that only image files are selected
  function validateImageFiles(files) {
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    return Array.from(files).every(file => allowedTypes.includes(file.type));
  }

// Optional: Trigger input click when clicking the drop area
//dropArea2.addEventListener('click', () => trickfile.featured_image());
});

$(document).ready(function() {
  $('#example1').DataTable({
    language: { search: "" },
  });
  $('input[type="search"]').attr('placeholder', 'Search...');
  $(".dataTables_filter").addClass("serchst");

});
</script>
