<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-top:80px;">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-lg-12 mt-3 p-0">
            <div style="text-align:center;">
              <h1 style="font-family: GothamMedium!important;">Release Notes</h1>
            </div>
            <div align="right"><a style="text-decoration:underline;padding-right: 20px;" href="javascript:void(0);" onclick="add_notes_click();">+Add</a></div>

              
            <?php foreach($releasenote AS $key => $releasenote){ $key++;?>
              <div class="col-lg-12 col-md-12">
                <div class="d-flex align-items-center">
                 <div> <img src="<?= base_url('assets/images/blacknote.svg') ?>" / width="60">
                  </div>
                 <div class="mx-2 pt-4 fs-4" style="font-family: GothamMedium!important;"><?php echo $releasenote->title; ?></div>
                 <a href="javascript:void(0)" onclick="edit_description_click('<?php echo $releasenote->id; ?>');" class="pt-4">
               <img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;">
             </a>
                 </div>
                 <br>
                <div><?php echo $releasenote->note; ?></div>
              </div><br>
            <?php } ?> 

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->


  <!-- Add Modal ----- -->
  <div class="modal fade" id="ReleasenoteId">
    <div class="modal-dialog modal-lg">
      <div class="modal-content"> 
        <div class="modal-header">
          <h5 class="modal-title" id="releasenote_title"> </h5> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal_by_id('ReleasenoteId');">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="errorMsg" style="color:red;" align="center"></div>
        <!-- Modal body -->
        <form action="<?= base_url('note-update') ?>" method="POST" id="form" name="form">  
          <?= csrf_field() ?>
          <input type="hidden" name="releasenote_id"  id="releasenote_id">

          <div class="modal-body">
            <textarea class="form-control" id="releasenote_description" name="releasenote_description" rows="12" ></textarea>
          </div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="AddUpdateDriverSubmit();">Save</button>        
            <button type="button" class="btn btn-secondary" onclick="close_modal_by_id('ReleasenoteId');">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script src="<?php echo base_url();?>/assets/tinymce_l/tinymce/js/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea',branding: false});</script>

  <script type="text/javascript">

    function AddUpdateDriverSubmit() {
      if(tinymce.get('releasenote_description').getContent() == ''){
        //alert('Release Note can not be empty');
        $('#errorMsg').html('Release Note can not be empty!'); 
        return false;
      }else{
        $('#errorMsg').html(''); 
        $('#form').submit();
        return true;
      }     
    }
    function edit_description_click(id){
      $("#ReleasenoteId").modal('show');
//alert(id);

      var parameters = {
        id: id
      }
      $.ajax({ 
        type: "POST",
        url: '<?php echo APIURL; ?>trickedoutreleasenote',         
        data: JSON.stringify(parameters),
        contentType: 'application/json',       
        async: false ,
      }).done(function (data, textStatus, xhr){ 
//console.log(data.data[0]); 
        $('#releasenote_title').html(data.data[0].title);
//$('#releasenote_description').val('sdfsdfsdfsd');
        tinymce.get('releasenote_description').setContent(data.data[0].note);
//$("textarea#releasenote_description").html('sdadasds');
        $('#releasenote_id').val(data.data[0].id);

      }).fail(function (jqXHR, textStatus, errorThrown){         

      });
    }
    function add_notes_click(){
      $("#ReleasenoteId").modal('show');
      $('#releasenote_title').html('Add Release Note');
      $('#releasenote_id').val('');
      tinymce.get('releasenote_description').setContent('');
    }
    function close_modal_by_id(modal_id){
      $("#"+modal_id).modal('hide');
    }
  </script>

