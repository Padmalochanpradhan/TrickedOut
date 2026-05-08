<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<style type="text/css">
.green_circle
 {width:50px;height:50px;border-radius:50%;background-color:#1faf1a;text-align: center;}
 .tick2{font-size:30px;line-height: 50px;color:#fff;text-align: center;}
  .multiple_page_bg
  {background-image:url(<?= base_url('assets/images/page-bg.jpg') ?>);background-size: cover;background-position: top center;}
.progress-bar-warning {
    background-color: #f0ad4e!important;
}
.box_process
{width:120px;border-radius:8px;background-color: #fff; font-size:14px;line-height: 16px;}
.centered-div{
display: flex;
justify-content: center;  /* Horizontally center */
align-items: center;      /* Vertically center */
height: 50px;            /* Required to see vertical centering */
 }
.triangle-up {
  width: 0;
  height: 0;
  border-left: 18px solid transparent;
  border-right: 18px solid transparent;
  border-bottom: 20px solid #fff;
  position: absolute;
  margin-top: -20px;
  margin-left: 38px;
}
.space-7
  {margin-left:12%;margin-right: 12%;}
  .bg-warning
  {background-color:#fbb03b!important;}
  @media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  .ipad-portrait { color: red; } /* your css rules for ipad portrait */
   .space-7
  {margin-left:9%;margin-right:9%;}
}
@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
  .ipad-landscape { color: blue; } /* your css rules for ipad landscape */
  .space-7
  {margin-left:3%;margin-right:3%;}
}

  @media (min-width: 768px) and (max-width: 1024px) {
    .multiple_page_bg
  {background-image:url(<?= base_url('assets/images/page-bg.jpg') ?>);background-size: cover;background-position: top center;}


 
}
</style>

<div class="main-panel multiple_page_bg">
   <div class="content-wrapper "  style="background-color:transparent!important;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="150"></div>
          <div class="col-lg-8 offset-lg-2 ">
            <div class="row"> 
            <div class="text-center " >
              <img src="<?= base_url('assets/images/wheel.svg') ?>" / width="300">
            </div>
            <div class="d-flex justify-content-between text-white mt-5 fs-4 fw-bold;" style="font-family:GothamMedium">          
              <div>Vault Upload</div>
              <div><?php echo $complitePercentge?>% Completed</div>
            </div>
            <div class="mt-4">
<div class="progress-stacked">
  <div class="progress" role="progressbar" aria-label="Segment one" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $compArr[0]?>%">
   <div class="progress-bar bg-warning"></div>
    </div>
  <div class="progress" role="progressbar" aria-label="Segment two" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $compArr[1]?>%">
    <div class="progress-bar bg-warning"></div>
  </div>
  <div class="progress" role="progressbar" aria-label="Segment three" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $compArr[2]?>%">
    <div class="progress-bar bg-warning"></div>
  </div>
    <div class="progress" role="progressbar" aria-label="Segment three" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $compArr[3]?>%">
    <div class="progress-bar bg-warning"></div>
  </div>
 </div>
  <div class="d-flex justify-content-evenly " style="margin-top:-30px;">
  <div class="green_circle">
      <i class="fa fa-check tick2" aria-hidden="true"></i>
  </div>
  <div class="green_circle">
      <i class="fa fa-check tick2" aria-hidden="true"></i>
  </div>
  <div class="green_circle">
      <i class="fa fa-check tick2" aria-hidden="true"></i>
  </div>
</div>

<div class="d-flex justify-content-center mt-4 ">
  <div class="box_process p-1 text-center">
    <div class="triangle-up"></div>
      <div class="centered-div"><?php echo $totalfileCount?> files<br/><?php echo $totalFileSize?> MB</div>
  </div>
  
<div class="box_process p-1 text-center space-7" >
  <div class="triangle-up"></div>
      <div class="centered-div">Categorizing<br/>Tricks</div>
  </div>
<div class="box_process  p-1 text-center">
  <div class="triangle-up"></div>
     <div class="centered-div">Finalizing</div>
  </div>
</div>
            

          

     

  </div>
<div class="mt-4" style="color:#fff;">
For details <a href="<?= base_url('UploadTrickComplete/'.$session_id)?>" >Click Here
</div>

<!-- content-wrapper ends -->

<!-- Modal for trick info data ----- -->


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
document.getElementById('uploadtrick').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    //alert("Starting upload");
    insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','START - Upload Process','INFO');
    var fileInput = document.getElementById('trickfile');
    var numberOfFiles = fileInput.files.length;
     //alert(`Number of files: ${numberOfFiles}`);
    insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','STEP 1 - Upload to backstage - '+numberOfFiles+' Files','INFO');

    let uploadedFiles = []; // Array to store the names of successfully uploaded files
    let completedUploads = 0; // Counter to track completed uploads

  // Function to execute after all files are uploaded
    function allFilesUploaded() {
        //console.log("All files uploaded:", uploadedFiles);
      document.getElementById('trickfile').value = "";
    // Create a new FormData object without the `trickfile` input
      $('#uploadedFiles').val(JSON.stringify(uploadedFiles));
    //console.log(JSON.stringify(uploadedFiles));
      $('#trickfile').val('');
      insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','STEP 1 - Files loaded to backstage','INFO');

      document.getElementById('uploadtrick').submit();

    }

    // Iterate over all files selected
    for (let i = 0; i < numberOfFiles; i++) {
      let file = fileInput.files[i];
        let chunkSize = 100 * 1024 * 1024; // 1MB per chunk
        let totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;

        //console.log(`Uploading file: ${file.name}`);
        //console.log(`Total chunks for ${file.name}: ${totalChunks}`);

        // Start uploading chunks
        uploadChunk();

        function uploadChunk() {
          let start = currentChunk * chunkSize;
          let end = Math.min(start + chunkSize, file.size);
          let chunk = file.slice(start, end);

          let formData = new FormData();
          formData.append('chunk', chunk);
          formData.append('filename', file.name);
          formData.append('currentChunk', currentChunk);
          formData.append('totalChunks', totalChunks);
          formData.append('session_id', '<?php echo $session_id?>');

            // Display and update progress
          document.getElementById('progress-container').style.display = 'block';
          let progressBar = document.getElementById('progress-bar');
          let progressText = document.getElementById('progress-text');
            //progressText.textContent = `${completedUploads+1}/${numberOfFiles} Uploading... 0%`;

            // Send chunk using Fetch API
          fetch("<?php echo base_url('uploadMultipleFileBySplitTemp/')?>", {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              currentChunk++;
              let percentage = Math.round((currentChunk / totalChunks) * 100);
              progressBar.style.width = percentage + '%';
              progressText.textContent = `${completedUploads+1}/${numberOfFiles} Uploading... ${percentage}%`;

              if (currentChunk < totalChunks) {
                        uploadChunk(); // Continue uploading the next chunk
                      } else {
                        // File upload complete
                        uploadedFiles.push(data.fileName);
                        completedUploads++;
                        if (completedUploads === numberOfFiles) {
                          allFilesUploaded();
                        }
                      }
                    } else {
                      console.error(`Upload failed for chunk ${currentChunk} of ${file.name}`);
                    }
                  })
          .catch(error => console.error(`Error uploading chunk ${currentChunk} of ${file.name}:`, error));
        }

      }
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
