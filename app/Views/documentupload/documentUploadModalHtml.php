<!-- add document Modal ----- -->
<div class="modal fade" id="addDocument">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title">
          <i class="fa fa-plus"></i> 
          <span id="documentModalTitle">Manage Documents</span>
          <span id="d_heading"></span>
          <span id="modal-sucess-msg-doc" style="color:#228B22"></span>
        </h5>
        <button type="button" class="close"  onclick="cross('addDocument');" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" style="padding: 10px 26px!important;">   
        <form class="row g-3" id="form-document-upload" action="#"  enctype="multipart/form-data"  > 
        <input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />  
          <input type="hidden" name="module_element_id" id="module_element_id">
          <input type="hidden" name="document_type" id="document_type" value="<?php echo $documentType?>">
          <input type="hidden" name="return_url" id="return_url" value="<?php echo current_url()?>">
          <div class="col-md-12">
          </div>

          <div id="tab_logic" class="row after-add-more" > 
            <!-- <div class="col-md-5">
              <input type="text" class="form-control  form-control-sm" placeholder="Title" name="title[]" id="title[]" rows="1" required  minlength="3">
            </div> -->
            <div class="col-md-6">
              <input  class="form-control form-control-sm" type="file"  name="files[]" id=files required style="color: #000!important;"/> 
            </div>
            <div class="col-md-6" >
              <div class="form-group change">
                <a class="btn-success add-more" style="padding: 7px;text-decoration: none;
                border-radius: 5px; cursor: pointer;">+ Add More</a>
              </div>
            </div>
          </div>
          <label ><font color="grey">* Max file size upto 5 GB can be uploaded.<br>* Allowed file types for upload: PNG, JPG, JPEG, WEBP, PDF, MP4, WEBM, AVI, and MOV.</font></label>   
          <div class="row mt-2" >
  <div class="col-md-6" >
    <div id="progress-container" style="display: none; margin-top: 20px;">
      <div class="progress">
        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
        </div>
      <p id="progress-text" style="margin-top: 10px;">Uploading...</p>
    </div>
  </div>
    <div class="col-md-6" align="right" >
          <button class="btn btn-primary" type="button" disabled id="small-spiiner" style="display: none;">
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      <span class="sr-only">Loading...</span>
    </button>
    <button class="btn btn-primary" type="button" disabled id="big-spiiner" style="display: none;">
      <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      Loading...
    </button>

            <button type="button" class="btn btn-primary"  id="submit-document" name="submit-document" onclick="DocumentSubmit();">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="cross('addDocument');">Cancel</button>
          </div>
</div> 
        </form>
      </div> 
      <div class="py-2">
        <table id="example11" class="table table-striped table-bordered" style="width:98%;" align="center">
          <thead>
            <tr>
              <th class="text-sm" width="25%" style="text-align:center;">Media Type</th>
              <th class="text-sm" width="25%" style="text-align:center;">Name</th>
              <th class="text-sm" width="25%" style="text-align:center;">Upload On</th>
              <th class="text-sm"width="25%" style="text-align:center;">Action</th>
            </tr>
          </thead>
          <tbody id="document_list"></tbody> 
        </table> 
      </div>
    </div>
  </div>
</div>
<!-- End ---------------------------------->  
<!-- Open confirm  document modal start -->
<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="#" method="POST" >  

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>       
        </div>
        <div class="modal-body">
          Are you sure you want to remove this file?
          <input type="hidden" name="document_id" id="document_id">
          <input type="hidden" name="fileName" id="fileName">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="DeleteDocument();">Yes</button>
          <button type="button" class="btn btn-secondary" onclick="cross('confirm');">No</button>

        </div>
      </div>
    </form>
  </div>
</div>
<!-- End ---------------------------------->