<style>
th
{color:#fff!important;}
td, th
{text-align:center;}
#trick_list_view td img, .jsgrid .jsgrid-table td img {
     width: 200px!important;
     height: 200px!important;
     border-radius: unset; 
    }

  .list-view {
      list-style-type: none;
      padding: 0;
  }
  .list-item {
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      background-color: #f9f9f9;
  }
  .list-item span {
      font-weight: bold;
  }
 
.dataTables_wrapper .dataTables_length {
    display: none!important;
}

.serchst{
  margin-bottom: 13px!important;
  /*margin-right:5%!important;*/
  margin-top:-37px;
}

.dataTables_wrapper .dataTables_filter input {
    border: 2px solid #aaa !important;
    border-radius: 0px !important;  
    padding: 0px 0px 0px 5px !important;     
    width: 218px !important;
  height:23px!important;
  }

.me-1 {
    margin-right: 0.10rem !important;
} 
table.dataTable tbody th, table.dataTable tbody td {
    padding: 8px 2px!important;
    font-size: 12px!important;
}
.myword {
    word-wrap: break-word;
    white-space: normal;
    text-align: left;
    font-weight: normal;
}

</style>
<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<div class="main-panel">
  <div class="content-wrapper" style="margin-top:50px;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3">
            <div class="row"> 
              <div class="col-lg-12 col-md-12">

                <form action="<?= base_url('AddBugSubmit') ?>" method="POST" enctype="multipart/form-data" id="uploadtrick" name="uploadtrick" onSubmit="disabled_upload_button();">  
                  <?= csrf_field() ?>
                  <input type="hidden" name="bugId" id="bugId">
                  <div class="row mt-3">
                    <div class="col-lg-3 col-md-3">
                    </div>
                    <div class="col-lg-6 col-md-6" style="border: 1px solid #dedede;padding: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.19) !important;">
                      <div class="col-lg-12 col-md-12">
                        <h3 style="text-align:center;font-weight: bold;">Submit Bug</h3>
                      </div>
                      <div class="col-lg-12 col-md-12">
                        <input type="text" name="title" id="title" class="form-control form-bg ht" value="" placeholder="Title" required style="color:#000!important;">
                      </div>
                      <div class="col-lg-12 col-md-12 mt-3">
                        <textarea name="notes" id="notes" class="form-control form-bg" placeholder="Notes" rows="5" style="color:#000!important;font-size:20px!important;"></textarea>
                      </div>
                     
                   
                      <div class="col-lg-12 col-md-12">
                        <div class="drop-area2 mt-3" id="dropArea2">
                          <div id="dropAreaText2" style="font-size:20px;"> 
                            <label for="featured_image" style="width:100%;">
                              <div class="form-control form-bg ht">
                                <div class="float-start" style="color:#a7a8ab;" id="featured_image_name">Bug Screenshot</div>
                                <div class="float-end"><img src="<?= base_url('assets/images/cloud.svg') ?>" / width="35"></div>
                              </div></label>
                            </div>
                            <input type="file" id="featured_image" name="featured_image" multiple style="height:40px;">
                          </div>                        
                        </div> 
<?php if($_SESSION['employee_role']=="Admin"){?>
                      <div class="col-lg-12 col-md-12 mt-3">
                        <select class="form-select form-bg ht" aria-label="Large select example" name="status" id="status" >
                        <option value="">Status</option>
                        <?php foreach($bugStatusList AS $bugStatus){?>
                          <option value="<?php echo $bugStatus->id?>" style="color:#000!important;"><?php echo $bugStatus->status_name?></option>
                        <?php }?>
                      </select>
                      </div>
<?php }else{?>
<input type="hidden" name="status" value="1">
<?php }?>
                        <div class="col-lg-12 col-md-12 mt-4">
                          <button type="submit" class="bot-submit" id="uploadBtn" style="font-family:'Gotham'!important;"></button>
                        </div>
                    
                    </div>
                    <div class="col-lg-3 col-md-3">
                    </div>
                    </div>
                  </form>
                  <div class="row mt-3">
                    <div class="col-lg-12 col-md-12">
<div class="mt-3 d-flex flex-wrap justify-content-between align-items-center">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/bugblack.svg') ?>"  width="38" class="me-2">Bug List</h2></div>
            <div style="margin-top:-5px;">
             <div> 
             </div>
            </div>
          </div>

<div id="all_trick_table_view" class="all_trick_list">
          <table id="example" class="table table-sm table-responsive" style="width:100%">
              <thead style="background-color:#0076b9;">
                  <tr style="color:#fff!important;">
                       <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Title</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;width: 55%;">Notes</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Added On</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Screenshot</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Status</th>
                        <?php if($_SESSION['employee_role']=="Admin"){?>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Added By</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Action</th>
                        <?php }?>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($bugList AS $bug){?>
                    <tr>
                      <td style="text-align:center"><?php echo $bug->title?></td>
                      <td style="text-align:center;"><div class="myword"><?php echo $bug->notes; ?></div></td>
                     <td style="text-align:center;"><?php echo date("m/d/Y", strtotime($bug->added_on));?></td>
                      <td style="text-align:center;"><?php if($bug->file_name){?><a href="<?= base_url("trick_bug_image/".$bug->file_name) ?>" target="_blank">View</a><?php }?></td>
                     <td style="text-align:center;"><?php echo $bug->status_name;?></td>
                  <?php if($_SESSION['employee_role']=="Admin"){?>
                     <td style="text-align:center;"><?php echo $bug->added_by_name;?></td>
                     <td style="text-align:center;"><a href="<?= base_url("Bug/".$bug->id) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                  <?php }?>
                    </tr>
                  <?php } ?>
              </tbody>
          </table>
          </div>



                    </div>

                  </div>
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


 


    <script>
      <?php if(isset($bugDetails)){?>
        $(document).ready(function(){
          $("#title").val('<?php echo $bugDetails[0]->title?>');
          $("#notes").val('<?php echo $bugDetails[0]->notes?>');
          $("#status").val('<?php echo $bugDetails[0]->status?>');
          $("#bugId").val(<?php echo $bugDetails[0]->id?>)
        });
      <?php }?>
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
      //$(document).ready(function () {
    document.addEventListener('DOMContentLoaded', () => {
        const dropArea = document.getElementById('dropArea');
        const trickfile = document.getElementById('trickfile');
        const dropAreaText = document.getElementById('dropAreaText');
        const errorMessage = document.getElementById('error-message');
        const uploadBtn = document.getElementById('uploadBtn'); 
        const sizeErrorMessage = document.getElementById('size-error-message');
        const MAX_FILE_SIZE = 26 * 1024 * 1024; // 8MB in bytes       
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
</script>


   
 
  
 
 
 

