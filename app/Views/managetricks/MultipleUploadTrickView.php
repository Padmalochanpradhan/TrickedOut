<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<style type="text/css">
  .borderless td, .borderless tr {
    border: none;
  }

    .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
   @media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
    .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
}
@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
  .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
  .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
}
@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
  .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
}
@media only screen and (max-width: 767px) {
  .multiple_page_bg
  {background-image:url(assets/images/page-bg.jpg);background-size: cover;background-position: top center;}
}
</style>
<div class="main-pane multiple_page_bg" >
  <div class="content-wrapper "  style="background-color:transparent!important;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 ">
            <div class="row"> 
             <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="150"></div>
              <div class="text-center " style="margin-top:80px;"><img src="assets/images/batch.png" width="200"></div>
              <div class="col-lg-8 offset-lg-2 text-center text-white mt-2" style="font-weight:200!important;">
              Drag and drop or browse to select files, then review and start the upload. Track progress with status indicators and retry any failed uploads if needed. Tricks that don’t get matched will be placed in your Backstage, where you can refine and re-assign them to the correct category in your vault.</div>
              <div class="col-lg-12 col-md-12">
                      <div class="card-body">
                        <form action="<?= base_url('UploadTrickMultiple') ?>" method="POST" enctype="multipart/form-data" id="uploadtrick" name="uploadtrick" onSubmit="disabled_upload_button();">  
                          <?= csrf_field() ?>
                          <input type="hidden" name="session_id" value="<?php echo $session_id?>">
                          <div class="col-lg-12 col-md-12">
                            <div id="loadingSpinner" style="display:none;">
                              <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Uploading...</span>
                              </div>
                            </div>
                            <div class="drop-area" id="dropArea" style="cursor:pointer;">
                              <img src="<?= base_url('assets/images/magic1.svg') ?>" / width="100">
                              <div id="dropAreaText" style="font-size:20px;">DROP YOUR FILES HERE OR <label ><span style="color:#49a2da;">BROWSE</span></label>
                              </div>
                              <input type="file" id="trickfile" name="trickfile[]" multiple style="height:40px;" required>
                              <div id="error-message" style="color: red; display: none;">Please select at least one file before submitting.</div>
                              <div id="size-error-message" style="color: red; display: none;">Please select files smaller than 5GB.</div>
                            </div>
                            <input type="hidden" name="uploadedFiles" id="uploadedFiles">
                            <input type="hidden" name="uploadedFileSize" id="uploadedFileSize">
                            <input type="hidden" name="fileName" id="fileName">
                          </div>                  

                          <div class="row">
                            <div class="col-lg-3 col-md-3"></div>
                            <div class="col-lg-6 col-md-6">
                              <div class="col-lg-12 col-md-12 mt-2">
                                <div id="progress-container" style="display: none; margin-top: 20px;">
                                  <div class="progress">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                  </div>
                                  <p id="progress-text" style="margin-top: 10px;">Uploading...</p>

                                </div> 

                                <!-- <button type="submit" class="bot-back" id="uploadBtn" style="font-family:'Gotham'!important;"></button> -->
                                <div align="center"><button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                  <img src="assets/images/upload1.png" alt="upload" id="uploadBtn"  width="300">
                                </button></div>
                                <!-- <div align="center"><img src="assets/images/upload1.svg" alt="upload" id="uploadBtn"  width="300"></div>  -->   
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3"></div>
                          </div>
                        </form>
                      </div>
              </div>
            </div>
            <?php if(!empty($masterDataList)){ ?>
              <div class="row mt-2">
                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">TO UPLOAD</h3>
                      <div align="center" style="font-size: 30px;margin-bottom: 10px;"><?php echo $number_of_file; ?></div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">MATCHED</h3>
                      <div align="center" style="font-size: 30px;margin-bottom: 10px;"><?php echo $matched_count; ?> (<?php echo round($matched_count/$number_of_file*100)?>%)</div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">PARTIALLY MATCHED</h3>
                      <div align="center" style="font-size: 30px;margin-bottom: 10px;"><?php echo $partially_matched_count; ?> (<?php echo round($partially_matched_count/$number_of_file*100)?>%)</div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">BACKSTAGE</h3>
                      <div align="center" style="font-size: 30px;margin-bottom: 10px;"><?php echo $backstage; ?> (<?php echo round($backstage/$number_of_file*100)?>%)</div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">SELECTED TRICKS</h3>
                      <div align="center" id="selected_tricks" style="font-size: 30px;margin-bottom: 10px;"><?php echo $selected_trick_count; ?> (<?php echo round($selected_trick_count/$number_of_file*100)?>%)</div>
                    </div>
                  </div>
                </div> 
                <div class="col-xl-2 col-sm-2 mb-xl-0">
                  <div class="card info-card revenue-card"> 
                    <div class="card-body p-2">
                      <h3 class="card-title" align="center" style="font-size: 14px;">UPLOADED</h3>
                      <div align="center" style="font-size: 30px;margin-bottom: 10px;"><?php echo $uploaded_file_count; ?> (<?php echo round($uploaded_file_count/$number_of_file*100)?>%)</div>
                    </div>
                  </div>
                </div>               
              </div>

            </div>
          <?php } ?>

          <div class="row mt-4">
            <div class="col-lg-12">
              <form action="<?= base_url('UploadTrickMultiple') ?>" method="POST" enctype="multipart/form-data" id="addtrick" name="addtrick">  
                <?= csrf_field() ?>
                <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">
                <?php if(!empty($masterDataList)){ ?>
                  <table id="example" class="table table-sm table-responsive" style="width:100%" >
                    <thead>
                      <tr>
                        <th>Trick Name</th> 
                        <th>Matched Column</th> 
                        <th>Already Exists</th>
                        <th>Description</th>
                        <th>File</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($masterDataList as $key => $value) { 
                        if($value->total_count==1){
                          $previous_id="";
                          ?>                      
                          <tr>
                            <td> <?php if($value->status != 'Backstage'){ 

                              if($file_process != 1){
                                ?>
                                <input style="width: 18px;height: 16px;" id="check<?php echo $value->id; ?>" type="checkbox" name="filelist[]" <?php if($value->status == 'Matched' && $value->match_trick_id == ''){ echo 'checked'; } ?> value="<?php echo $value->id; ?>" onclick="selected_tricks('<?php echo $value->id; ?>','<?php echo $value->source_id; ?>');" class="check_class" >
                              <?php } ?>
                              <input type="hidden" id="source<?php echo $value->id; ?>" name="sourceList[]"<?php if($value->status == 'Matched' && $value->match_trick_id == ''){ ?> value="<?php echo $value->source_id;?>" <?php } ?>>
                            <?php }else{ echo "<span style='margin-left: 20px;'></span>";} ?>

                            <?php echo $value->filename.' (.'.$value->extension.')'; ?></td>
                            <td <?php if($value->status == 'Matched'){ echo 'class="text-success"'; }elseif($value->status == 'Partially Matched'){ echo 'class="text-warning"'; }else{ echo 'class="text-danger"'; } ?>><?php echo $value->status;
                            if($value->status != 'Backstage'){
                             echo ' (<span style="text-transform:capitalize;">'.$value->matched_field.'</span>)';
                           } ?></td>
                           <td><?php if($value->match_trick_id)echo 'Yes'; ?></td>
                           <td><a style="cursor: pointer;" onclick="viewModal('<?php echo $value->source_id; ?>','<?php echo $value->filename; ?>','<?php echo $value->status; ?>','<?php echo $value->matched_field; ?>','<?php echo $value->match_trick_id; ?>','<?php echo $value->extension; ?>');" >View</a></td>
                           <td><?php if($value->record_status == 1)echo 'Processed'; ?></td>
                         </tr>
                       <?php }else{ ?>

                        <tr class="borderless">

                          <td><?php if($value->status != 'Backstage'){ 
                            if($file_process != 1){?>
                              
                              <input type="radio" id="html" name="fav_language" value="<?php echo $value->id; ?>" onclick="radio_click('<?php echo $value->id; ?>','<?php echo $value->source_id; ?>')">
                            <?php }

                          }else{ echo "<span style='margin-left: 20px;'></span>";} ?>

                          <?php echo $value->filename.' (.'.$value->extension.')'; ?>
                          <?php if($previous_id==""){ 
                            $previous_id = $value->id;
                            if($file_process != 1){
                              ?>
                              <input style="width: 0px;height: 0px;" id="check<?php echo $value->id; ?>" type="checkbox" name="filelist[]" <?php if($value->status == 'Matched' && $value->match_trick_id == ''){ echo 'checked'; } ?> value="<?php echo $value->id; ?>" onclick="selected_tricks('<?php echo $value->id; ?>','<?php echo $value->source_id; ?>');"  class="check_class" >

                            <?php } ?>
                            <input type="hidden" id="source<?php echo $value->id; ?>" name="sourceList[]">
                          <?php } ?>
                        </td>
                        <td <?php if($value->status == 'Matched'){ echo 'class="text-success"'; }elseif($value->status == 'Partially Matched'){ echo 'class="text-warning"'; }else{ echo 'class="text-danger"'; } ?>><?php echo $value->status;
                        if($value->status != 'Backstage'){
                         echo ' (<span style="text-transform:capitalize;">'.$value->matched_field.'</span>)';
                       } ?></td> 
                       <td><?php if($value->match_trick_id)echo 'Yes'; ?></td>
                       <td>
                        <?php if($value->status != 'Backstage'){ ?>
                            <a style="cursor: pointer;" onclick="viewModal('<?php echo $value->source_id; ?>','<?php echo $value->filename; ?>','<?php echo $value->status; ?>','<?php echo $value->matched_field; ?>','<?php echo $value->match_trick_id; ?>','<?php echo $value->extension; ?>');">View</a>
                        <?php } ?>
                      </td>
                       <td><?php if($value->record_status == 1 && $value->source_id == $value->process_source_id)echo 'Processed'; ?></td>
                     </tr>
                   <?php }} ?>
                 </tbody>
               </table>

               <?php if($file_process != 1){ ?>
                <div style="float: right;" class="mt-4">
                 <button type="submit" class="btn btn-primary" name="process" value="submit" >Process</button>
               </div>
             <?php } ?>
           </form>
         <?php } ?>
       </div>
     </div>

     <?php if(!empty($logData)){ ?>
       <div class="row mt-4">
        <h3 align="center"> Process Log</h3>
        <div class="col-lg-12"> 
          <table id="example1" class="table table-sm table-responsive" style="width:100%" >
            <thead>
              <tr>
                <th>Log Title</th> 
                <th>Details</th> 
                <th>Date</th> 
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logData as $key1 => $value1) { ?>                      
                <tr>
                  <td><?php echo $value1->log_title; ?></td>
                  <td><?php echo $value1->log_details; ?></td>
                  <td><?php echo date('m/d/Y h:i:s',strtotime($value1->added_on)); ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>               
        </div>
      </div>
    <?php } ?>

  </div>


<!-- content-wrapper ends -->

<!-- Modal for trick info data ----- -->
<div class="modal fade" id="view_note">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
       <h5 class="modal-title"> <span id="title"></span></h5> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('view_note');">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> 
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12 col-md-12"> 
          <!-- <div id="filename"></div> -->
          <div id="matched_column"></div>
          <div id="exists"></div><br>
          <div id="name"></div> 
          <div id="artist"></div>
          <div id="desc"></div>            

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
document.getElementById('uploadtrick').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission
  // Function to execute after all files are uploaded
    function allFilesUploaded() {
        //console.log("All files uploaded:", uploadedFiles);
      document.getElementById('trickfile').value = "";
    // Create a new FormData object without the `trickfile` input
      $('#uploadedFiles').val(JSON.stringify(uploadedFiles));
      $('#uploadedFileSize').val(JSON.stringify(uploadedFileSize));
      $('#fileName').val(JSON.stringify(fileName));
    //console.log(JSON.stringify(uploadedFiles));
      $('#trickfile').val('');
      insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','STEP 1 - Files loaded to backstage','INFO');

      document.getElementById('uploadtrick').submit();

    }

    //alert("Starting upload");
    insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','START - Upload Process','INFO');
    var fileInput = document.getElementById('trickfile');
    var numberOfFiles = fileInput.files.length;
     //alert(`Number of files: ${numberOfFiles}`);
    insertLogAPIFunction('<?php echo $session_id?>','UPLOAD','STEP 1 - Upload to backstage - '+numberOfFiles+' Files','INFO');

    //let uploadedFiles = []; // Array to store the names of successfully uploaded files
    //let completedUploads = 0; // Counter to track completed uploads


    // Iterate over all files selected
var fileInput = document.getElementById('trickfile');

    var numberOfFiles = fileInput.files.length;
    let files = fileInput.files;
    // Display and update progress
    document.getElementById('progress-container').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    let progressText = document.getElementById('progress-text');

    let uploadedFiles = [];
    let uploadedFileSize = [];
    let fileName = [];
    let completedUploads = 0;
    let totalSize = 0;
    let totalUploaded = 0;

    // Calculate total size of all files
    for (let i = 0; i < numberOfFiles; i++) {
        totalSize += files[i].size;
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
                fileName.push(data.fileName);
                uploadedFileSize.push(files[i].size);
                completedUploads++;
                //

                //console.log(data);

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
/*document.getElementById('uploadtrick').addEventListener('submit', function (e) {
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

        let formData = new FormData();
        formData.append('file', file);
        formData.append('filename', file.name);

        fetch("<?php echo base_url('uploadToDropbox')?>", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                uploadedFiles.push(data.fileName);
                completedUploads++;
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

    
    });*/
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
            $('#dropAreaText').css('color', '#cccccc');
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
