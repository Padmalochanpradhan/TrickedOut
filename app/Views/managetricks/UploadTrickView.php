<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<div class="main-panel">
  <div class="content-wrapper" style="margin-top:50px;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="row"> 
              <div class="col-lg-12 col-md-12">

                <form action="<?= base_url('UploadTrickSubmit') ?>" method="POST" enctype="multipart/form-data" id="uploadtrick" name="uploadtrick" onSubmit="disabled_upload_button();">  
                  <?= csrf_field() ?>
                  <div class="col-lg-12 col-md-12">

                    <div id="loadingSpinner" style="display:none;">
                      <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Uploading...</span>
                      </div>
                    </div>
                    <div class="drop-area" id="dropArea">
                      <img src="<?= base_url('assets/images/magic1.svg') ?>" / width="100">
                      <div id="dropAreaText" style="font-size:20px;">DROP YOUR FILES HERE OR <label ><span style="color:#49a2da;">BROWSE</span></label>
                      </div>
                      <input type="file" id="trickfile" name="trickfile[]" multiple style="height:40px;" required>
                      <div id="error-message" style="color: red; display: none;">Please select at least one file before submitting.</div>
                      <?php if(count($storageAvailability)){?>
                    <div id="size-error-message" style="color: red; display: none;">Please select files smaller than <?php echo $storageAvailability[0]->avalabile_inMB;?>MB.</div>
                  <?php }else{?>
                    <div id="size-error-message" style="color: red; display: none;">You do not have an active subscription.</div>
                  <?php }?>
                    </div>
      <input type="hidden" name="uploadedFiles" id="uploadedFiles">
      <input type="hidden" name="uploadedFileSize" id="uploadedFileSize">
              
                  </div>
                  
                     
                  <div class="row">
                    <!-- <div class="col-lg-6 col-md-6">
                       <div class="float-end text-danger " style="font-size:14px;">*</div>
                     </div>
                     <div class="col-lg-6 col-md-6">&nbsp;</div> -->
                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-12 col-md-12">
                     
                        <input type="text" name="name" class="form-control form-bg ht" value="" placeholder="Name*" required style="color:#000!important;">

                      </div>
                      
                      <div class="col-lg-12 col-md-12 mt-3">

                            <input type="text" name="artist" class="form-control form-bg ht" value="" placeholder="Artist" required style="color:#000!important;">
                        
                    </div>
                    <div class="col-lg-12 col-md-12 mt-2">
                       <div  style="font-size:14px;">Catagory*</div>
                      <select class="form-select form-bg ht" aria-label="Large select example" required name="catagory[]" id="catagory" onchange="changeColor('catagory');" multiple style="height: 80px;">
                        <!-- <option value="">Category</option> -->
                        <?php foreach($trickCategoryList AS $Category){?>
                          <option value="<?php echo $Category->id?>" style="color:#000!important;"><?php echo $Category->category_name?></option>
                        <?php }?>
                      </select>
                      <div style="font-size:14px;padding-top:5px;">Note: Use CTRL to choose multiple categories</div>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-3">

                      <select class="form-select form-bg ht" aria-label="Large select example" name="supplier" id="supplier" onchange="changeColor('supplier');supplier_change();">
                        <option value="">Supplier</option>
                        <?php foreach($supplierList AS $supplier){?>
                          <option value="<?php echo $supplier->id?>" style="color:#000!important;"><?php echo $supplier->name?></option>
                        <?php }?>
                        <option value="add">Add New</option>
                      </select>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-3">
                    <div class="form-bg ht">
                          <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control"   placeholder="Purchased" style="background-color:transparent;height:45px;border:none;color:#000!important;font-size:20px!important;" name="purchased_date" id="purchased_date">
                            <span class="input-group-addon input-group-append border-left px-2 pt-1">
                              <img src="<?= base_url('assets/images/calender.svg') ?>" alt="logo" width="20" class="ms-1">
                            </span>
                          </div> 
</div>
                      
                     
                    </div>
                    
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <!-- <div class="col-lg-12 col-md-12">
                        <textarea name="notes" id="notes" class="form-control form-bg" placeholder="Notes" style="color:#000!important;"></textarea>
                      </div> -->
                      <div class="col-lg-12 col-md-12 ">
                        <textarea name="description" class="form-control form-bg" placeholder="Description" rows="6" style="color:#000!important;font-size:20px!important;"></textarea>
                      </div>
                      <div class="col-lg-12 col-md-12 mt-2">
                      <div class="float-start mb-3">
                        <label style="font-size:20px;color:#a6a8ab;margin-top:10px;">Favorite</label></div>
                        <div class="float-end mb-3">
                          <div class="radio-item">
                            <input type="radio" id="fy" name="favorite_flag" value="1" checked>
                            <label for="fy" style="color:#a6a8ab;font-size:22px;">Yes</label>
                          </div>

                          <div class="radio-item">
                            <input type="radio" id="fn" name="favorite_flag" value="0" >
                            <label for="fn" style="color:#a6a8ab;font-size:22px;" >No</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <div class="drop-area2" id="dropArea2" style="margin-top:32px;">
                          <div id="dropAreaText2" style="font-size:20px;"> 
                            <label for="featured_image" style="width:100%;">
                              <div class="form-control form-bg ht">
                                <div class="float-start" style="color:#a7a8ab;line-height:34px;" id="featured_image_name">Featured Image</div>
                                <div class="float-end"><img src="<?= base_url('assets/images/cloud.svg') ?>" / width="35"></div>
                              </div></label>
                            </div>
                            <input type="file" id="featured_image" name="featured_image" multiple style="height:36px;">
                          </div>                        
                        </div>

                        <div class="col-lg-12 col-md-12 mt-2">
<div id="progress-container" style="display: none; margin-top: 20px;">
  <div class="progress">
    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
  </div>
  <p id="progress-text" style="margin-top: 10px;">Uploading...</p>
</div>                          
                          <button type="submit" class="bot-back" id="uploadBtn" style="font-family:'Gotham'!important;"></button>
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

    <!-- Modal ----- -->
    <div class="modal fade" id="createdTrickSuccessModalId">
  <div class="modal-dialog modal-md">
   

      <!-- Modal body -->
      <div class="modal-body">
      <div style="position:absolute;right:0;top:0;margin-top:30px;">
      <div class="close" data-dismiss="modal" aria-label="Close">
          <img src="<?php echo base_url()?>/assets/images/cross.svg"/ width="30">
        </div>
        </div>
        
        <img src="<?php echo base_url()?>/assets/images/pop.png" width="500">
      </div>       
 
  </div>
</div>

<!-- Modal for trick info data ----- -->
<div class="modal fade" id="addSupplier">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><i class="fa fa-plus"></i> Add New Supplier <span id="err_msg" style="color: red;padding-left: 100px;"></span></h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('addSupplier');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="<?= base_url('addSupplier') ?>" method="POST" id="form-supplier" name="form-supplier">  
          <?= csrf_field() ?>
        

      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <input type="text" name="name" id="name" class="form-control" value="" placeholder="Supplier Name" required style="color:#000!important;" onchange="supplierNameChange();">
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <input type="text" name="website" id="website" class="form-control" value="" placeholder="Website URL" required style="color:#000!important;">
          </div>
        </div>
      </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" name="trickInfo" onclick="AddSupplierSubmit();" >Add</button>
        
        <button type="button" class="btn btn-secondary" onclick="cross('addSupplier');">Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url();?>/assets/tinymce_l/tinymce/js/tinymce/tinymce.min.js"></script>
<script>tinymce.init({ selector:'#notes',branding: false });
document.getElementById('notes').style.height = '100px';
</script> 
 
    <?php if($url_segment2=="added"){ ?>
      <script type="text/javascript">
        $(document).ready(function () {
          $("#createdTrickSuccessModalId").modal('show'); 
        });
      </script>
    <?php } ?>

    <script>
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

///////////Split upload file
 /*document.getElementById('uploadtrick').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    //alert("Starting upload");

    var fileInput = document.getElementById('trickfile');
    var numberOfFiles = fileInput.files.length;
    //alert(`Number of files: ${numberOfFiles}`);

    let uploadedFiles = []; // Array to store the names of successfully uploaded files
    let completedUploads = 0; // Counter to track completed uploads

 // Function to execute after all files are uploaded
    function allFilesUploaded() {
        //console.log("All files uploaded:", uploadedFiles);
        document.getElementById('trickfile').value = "";
    // Create a new FormData object without the `trickfile` input
    $('#uploadedFiles').val(JSON.stringify(uploadedFiles));

    $('#trickfile').val('');
    document.getElementById('uploadtrick').submit();
    
    }

    // Iterate over all files selected
    for (let i = 0; i < numberOfFiles; i++) {
        let file = fileInput.files[i];
        let chunkSize = 1 * 1024 * 1024; // 1MB per chunk
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

            // Display and update progress
            document.getElementById('progress-container').style.display = 'block';
            let progressBar = document.getElementById('progress-bar');
            let progressText = document.getElementById('progress-text');
            //progressText.textContent = `${completedUploads+1}/${numberOfFiles} Uploading... 0%`;
            let totalSize = 0;
            let totalUploaded = 0;

            // Calculate total size of all files
            for (let i = 0; i < numberOfFiles; i++) {
                totalSize += files[i].size;
            }

            // Send chunk using Fetch API
            fetch("<?php echo base_url('uploadToDropbox/')?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentChunk++;
                    totalSize += files[i].size;
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
});*/
///////////////////////////////////////
/*document.getElementById('uploadtrick').addEventListener('submit', function (e) {
    e.preventDefault();

    function allFilesUploaded() {
        $('#uploadedFiles').val(JSON.stringify(uploadedFiles));
        $('#trickfile').val('');
        document.getElementById('uploadtrick').submit();
    }
    let fileInput = document.getElementById('trickfile');
    // Display and update progress
    document.getElementById('progress-container').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    let progressText = document.getElementById('progress-text');

    let files = fileInput.files;
    let numberOfFiles = files.length;

    let uploadedFiles = [];
    let completedUploads = 0;
    let totalSize = 0;
    let totalUploaded = 0;

    // Calculate total size of all files
    for (let i = 0; i < numberOfFiles; i++) {
        totalSize += files[i].size;
    }

    // Upload each file using XMLHttpRequest
    for (let i = 0; i < numberOfFiles; i++) {
        let file = files[i];
        let formData = new FormData();
        formData.append('file', file);
        formData.append('filename', file.name);

        let xhr = new XMLHttpRequest();

        // Track progress of each file
        xhr.upload.addEventListener('progress', function (e) {
            if (e.lengthComputable) {
                let currentProgress = totalUploaded + e.loaded;
                let percentage = Math.round((currentProgress / totalSize) * 100);

                progressBar.style.width = percentage + '%';
                progressText.textContent = `${i + 1}/${numberOfFiles} Uploading... ${percentage}%`;
            }
        });

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let data = JSON.parse(xhr.responseText);
                    if (data.success) {
                        uploadedFiles.push(data.fileName);
                    } else {
                        console.error('Upload failed:', data);
                    }
                } else {
                    console.error('Upload error:', xhr.statusText);
                }

                // After file upload completes, add its size to totalUploaded
                totalUploaded += file.size;
                completedUploads++;

                if (completedUploads === numberOfFiles) {
                    progressBar.style.width = '100%';
                    progressText.textContent = `Upload complete: ${completedUploads}/${numberOfFiles}`;
                    allFilesUploaded(); // Call your callback if needed
                }
            }
        };

        xhr.open('POST', "<?php echo base_url('uploadToDropbox')?>");
        xhr.send(formData);
    }



});*/

document.getElementById('uploadtrick').addEventListener('submit', function (e) {
    e.preventDefault();

    var fileInput = document.getElementById('trickfile');

    var numberOfFiles = fileInput.files.length;
    let files = fileInput.files;
    // Display and update progress
    document.getElementById('progress-container').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    let progressText = document.getElementById('progress-text');

    let uploadedFiles = [];
    let uploadedFileSize  = [];
    let completedUploads = 0;
    let totalSize = 0;
    let totalUploaded = 0;

    // Calculate total size of all files
    for (let i = 0; i < numberOfFiles; i++) {
        totalSize += files[i].size;
    }

    function allFilesUploaded() {
        $('#uploadedFiles').val(JSON.stringify(uploadedFiles));
        $('#uploadedFileSize').val(JSON.stringify(uploadedFileSize));
        //$('#fileName').val(JSON.stringify(fileName));
        $('#trickfile').val('');
        document.getElementById('uploadtrick').submit();
    }

    for (let i = 0; i < numberOfFiles; i++) {
        let file = fileInput.files[i];

        let formData = new FormData();
        formData.append('file', file);
        formData.append('filename', file.name);
        formData.append('session_id', '<?php echo $session_id?>');

        fetch("<?php echo base_url('uploadToDropbox')?>", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                uploadedFiles.push(data.uploadFileName);
                //fileName.push(data.fileName);
                uploadedFileSize.push(files[i].size);
                completedUploads++;


              // Calculate progress percentage
              totalUploaded += files[i].size;
              let percentage = Math.round((totalUploaded / totalSize) * 100);

              // Update progress bar and text
              progressBar.style.width = percentage + '%';
              progressText.textContent = `${completedUploads}/${numberOfFiles} Uploading... ${percentage}%`;

              if (completedUploads === numberOfFiles) {
                  allFilesUploaded();
              }
            } else {
                console.error('Upload failed', data);
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
        });
    }
});
/////////////////////////////////////////
      //$(document).ready(function () {
    document.addEventListener('DOMContentLoaded', () => {
        const dropArea = document.getElementById('dropArea');
        const trickfile = document.getElementById('trickfile');
        const dropAreaText = document.getElementById('dropAreaText');
        const errorMessage = document.getElementById('error-message');
        const uploadBtn = document.getElementById('uploadBtn'); 
        const sizeErrorMessage = document.getElementById('size-error-message');
        //const MAX_FILE_SIZE = 100 * 1024 * 1024; // 8MB in bytes
        <?php if(count($storageAvailability)){?>
        const MAX_FILE_SIZE = <?php echo $storageAvailability[0]->avalabile_inMB;?> * 1024 * 1024; // 3.2GB in bytes  
        <?php }else{?>
        const MAX_FILE_SIZE = 0; // 3.2GB in bytes  

        <?php }?>     
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
            if (files.length) {
                let totalSize = 0;
                for (let i = 0; i < files.length; i++) {
                    totalSize += files[i].size;
                }
                return totalSize > MAX_FILE_SIZE; // true if total exceeds max
            } else {
                return false;
            }
        }
        /*function checkFileSize(files) {
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

        }*/

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
</script>
