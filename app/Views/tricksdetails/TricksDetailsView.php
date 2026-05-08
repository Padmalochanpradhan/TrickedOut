<style>
/* @font-face { font-family: Gotham; src: url("fonts/Gotham-Book.woff") format("woff"), url("fonts/Gotham-Book.woff2") format("woff2"), url("fonts/Gotham-Book.ttf") format("truetype"); font-weight: normal; }
@font-face { font-family: GothamBold; src: url("fonts/Gotham-Bold.ttf") format("truetype"); }
@font-face { font-family: GothamMedium; src: url("fonts/Gotham-Medium.ttf") format("truetype"); }*/
body
{
font-family:"Gotham"!important;
}
.form-control {
color: #dedede!important;
font-family:"Gotham"!important;
}
.video-note {
    color: #000 !important;          /* text color */
    background-color: #fff !important; /* textarea background */
    font-size: 14px;
}
/* Modal container */
.modal-fullscreen {
  width: 50vw;
  max-width: 50vw;
  /*height: 95vh;*/
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto !important;
}

/* Vertical centering */
.modal-dialog-centered {
  /*min-height: 95vh;*/
  display: flex;
  align-items: center;
}

/* Modal content */
.modal-fullscreen .modal-content {
  width: 95%;
 /* height: 95vh;*/
  border-radius: 0;
}

/* Center video inside modal */
.modal-body {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.trick_video {
  width: 100%;
  height: auto;        /* 👈 KEY FIX */
  max-height: 80vh;    /* Prevents overflow in fullscreen modal */
  object-fit: contain; /* Keeps aspect ratio */
}
#play_trick_video .modal-body{
    padding: 0 !important;
}
#play_trick_video .modal-header{
    padding: 2px 5px !important;
}
#play_trick_video .modal-footer{
    padding: 2px 5px !important;
}
</style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-top:80px;">
      <div class="col-md-12 grid-margin">
        <div class="row mt-3">
          
            <div class="pb-2 text-info">
              <?php if(isset($categoryDetails[0]->id)){?>
              <a href="<?php echo base_url();?>/CategoryTricks/<?php echo $categoryDetails[0]->id;?>"  style="text-decoration:none;">
              
              <?php }else{?>

              <a href="<?php echo base_url();?>/MyVault"  style="text-decoration:none;">

              <?php }?>
              <img src="<?php echo base_url();?>/assets/images/backbotton.svg" width="6"> back
            </a></div>
            <div class="row">

              <div class="col-lg-3 col-md-3">
                <div><?php echo $trickDetails[0]->category_name;?></div>
                <div class="container1">
                  <?php if($trickDetails[0]->featured_image){?>
                    <img src="<?php echo base_url();?>/trick_featured_image/<?php echo $trickDetails[0]->featured_image?>" class="img_style_hydra">
                  <?php }else if(isset($categoryDetails[0]->trick_default_icon)){?>
                    <img src="<?php echo base_url();?>/trick_default_icon/<?php echo $categoryDetails[0]->trick_default_icon; ?>" class="img_style_hydra">
                  <?php }else{?>
                    <img src="<?php echo base_url();?>/trick_default_icon/<?php echo $defaultTrickIcon; ?>" class="img_style_hydra">
                  <?php }?>
                  <div class="bottom-left">           
                    <a href="javascript:void(0)" onclick="edit_trick_modal_show_click('updateTrickFeaturedImageModalId');">
                      <div style="position:absolute;left:0;bottom:0;">
                        <img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;">
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-9 col-md-9">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <h1 class="fw-bold" style="margin-bottom:0px!important;font-family: GothamMedium!important;"><?php echo $trickDetails[0]->name;?></h1>
                    <h4 style="font-weight:400;margin-bottom:0px;">by <?php echo $trickDetails[0]->artist;?></h4>
                    <h5 style="font-weight:400;" ><?php echo $trickDetails[0]->supplier_name;?>
                    <span><a href="javascript:void(0)" onclick="edit_trick_modal_show_click('updateTrickInfoModalId');"><img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;margin-left:20px;" >
                    </a></span>
                  </h5>

                </div>

                <div class="col-lg-6 col-md-6 pe-0" style="text-align: right;">
                  <?php //if($pdf_flag){?>
                  <a href="javascript:void(0);" onclick="edit_trick_modal_show_click('play_trick_pdf_view');">
                  <img src="<?= base_url('assets/images/pdf.png') ?>" width="70"/></a>
                <?php //}?>
                  <?php //if($video_flag){?>
                  <a href="javascript:void(0);" onclick="edit_trick_modal_show_click('play_trick_video');">
                  <img src="<?= base_url('assets/images/video.png') ?>" width="70"/></a>
                <?php //}?>
                  <a href="javascript:void(0);" onclick="edit_trick_modal_show_click('play_trick_file_download');">
                  <img src="<?= base_url('assets/images/download.png') ?>" width="70"/>
                </a>

                  <a href="javascript:void(0);" onclick="OpenDoumnetModal(<?php echo $trickDetails[0]->id;?>,'<?php echo $trickDetails[0]->name;?>');">
                    <div style="float:right;margin-top:30px;"><img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;"></div>
                  </a> 

                </div>

              </div>
              <div class="row mt-3">
              <div class="col-lg-12 col-md-12">
              <div class="container1">
  <?php echo $trickDetails[0]->description;?>
  <div class="bottom-right"><a href="javascript:void(0)" onclick="edit_trick_modal_show_click('updateTrickDescriptionModalId');">
                  
                    <div style="float:right;"><img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;"></div>
                    
                  </a> </div>
</div>
</div>
              
                </div>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-lg-12 col-md-12">
                <h3 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/hand.svg') ?>" width="50"/>My Notes</h3>
                <!-- <div style="position:relative;left:0;margin-left:-20px;">
                  <a href="javascript:void(0)" onclick="edit_notes_click();">
                    <img src="<?= base_url('assets/images/edit.svg') ?>" style="width:15px;">
                  </a>  </div> -->
                  <div  id="trick_my_note"><?php echo $trickDetails[0]->trick_video_note;?></div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->


      <!-- Add Modal ----- -->
<!-- Modal for trick info data ----- -->
<div class="modal fade" id="updateTrickInfoModalId">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> Info</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('updateTrickInfoModalId');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="<?= base_url('TrickFieldUpdate') ?>" method="POST" id="form-driver" name="form-driver">  
          <?= csrf_field() ?>
        <input type="hidden" name="trick_id" value="<?php echo $trickDetails[0]->id;?>">

      <div class="modal-body">
        <div class="row">
<div class="col-lg-12 col-md-12">
                          
                          <input type="text" name="name" class="form-control" value="<?php echo $trickDetails[0]->name;?>" placeholder="Name" required style="color:#000!important;">
                        </div>
                        
                        <div class="col-lg-12 col-md-12 mt-2">
                          <input type="text" name="artist" class="form-control" value="<?php echo $trickDetails[0]->artist;?>" placeholder="Artist" required style="color:#000!important;">
                        </div>
                        <div class="col-lg-12 col-md-12 mt-2">
                          <select name="catagory[]" class="form-control" required style="color:#000!important;" multiple style="height: 80px;">
                            
                            <?php foreach($trickCategoryList AS $Category){?>
                            <option value="<?php echo $Category->id?>" <?php if($Category->mapping_id){ ?>selected<?php }?>><?php echo $Category->category_name?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-2">
                          <select name="supplier" class="form-control" style="color:#000!important;">
                            <option value="">Select Supplier</option>
                            <?php foreach($supplierList AS $supplier){?>
                            <option value="<?php echo $supplier->id?>" <?php if($trickDetails[0]->supplier==$supplier->id){ ?>selected<?php }?>><?php echo $supplier->name?></option>
                          <?php }?>
                          </select>
                        </div>
                        <div class="col-lg-12 col-md-12 mt-2">
                          <select name="status" class="form-control" style="color:#000!important;">
                            <option value="0" <?php if($trickDetails[0]->status==0){ ?>selected<?php }?>>Active</option>
                            <option value="1" <?php if($trickDetails[0]->status==1){ ?>selected<?php }?>>In-active</option>
                          </select>
                        </div>
        </div>
      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="trickInfo" onclick="AddUpdateDriverSubmit();" >Save</button>
        
        <button type="button" class="btn btn-secondary" onclick="cross('updateTrickInfoModalId');">Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>


      <!-- Modal ----- -->
      <div class="modal fade" id="updateTrickDescriptionModalId">
        <div class="modal-dialog modal-lg">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> Description</h5> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal_by_id('updateTrickDescriptionModalId');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url('TrickFieldUpdate') ?>" method="POST" id="form-driver" name="form-driver">  
              <?= csrf_field() ?>
              <input type="hidden" name="trick_id" value="<?php echo $trickDetails[0]->id;?>">

              <div class="modal-body">
                <textarea class="form-control tinymce-editor" id="trick_description" name="trick_description" rows="12"><?php echo $trickDetails[0]->description;?></textarea>
              </div> 
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="AddUpdateDriverSubmit();" >Save</button>

                <button type="button" class="btn btn-secondary" onclick="close_modal_by_id('updateTrickDescriptionModalId');">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal ----- -->
      <div class="modal fade" id="updateTrickNotesModalId">
        <div class="modal-dialog modal-lg">
          <div class="modal-content"> 
            <div class="modal-header">
              <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> Notes</h5> 
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="close_modal_by_id('updateTrickNotesModalId');">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url('TrickFieldUpdate') ?>" method="POST" id="form-driver" name="form-driver">  
              <?= csrf_field() ?>
              <input type="hidden" name="trick_id" value="<?php echo $trickDetails[0]->id;?>">

              <div class="modal-body">
                <textarea class="form-control tinymce-editor" id="trick_notes" name="trick_notes" rows="12"><?php echo $trickDetails[0]->notes;?></textarea>
              </div> 
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="AddUpdateDriverSubmit();" >Save</button>

                <button type="button" class="btn btn-secondary" onclick="close_modal_by_id('updateTrickNotesModalId');">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
 <!-- Modal for trick Featured Image  ----- -->
<div class="modal fade" id="updateTrickFeaturedImageModalId">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> Featured Image</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('updateTrickFeaturedImageModalId');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="<?= base_url('TrickFieldUpdate') ?>" method="POST" id="form-driver" name="form-driver"  enctype="multipart/form-data">  
          <?= csrf_field() ?>
        <input type="hidden" name="trick_id" value="<?php echo $trickDetails[0]->id;?>">

      <div class="modal-body">
        <div class="row">
        <div class="col-lg-12 col-md-12"><label>Featured Image</label>
          <input type="file" class="form-control" name="featured_image" id="featured_image" placeholder="Featured Image">
        </div>
                        
        </div>
      </div> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="trickFeaturedImage" onclick="AddUpdateDriverSubmit();" >Save</button>
        
        <button type="button" class="btn btn-secondary" onclick="cross('updateTrickFeaturedImageModalId');">Cancel</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- Modal PDF view ----- -->
<div class="modal fade" id="play_trick_pdf_view">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> PDF files</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('play_trick_pdf_view');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" align="center">
        <?php 
$i = 0;
        if($pdf_flag){?>
        <table class="table">
        <tr>
          <th>#</th>
          <th>File Name <?php echo count($trickFilesArray)?></th>
          <th></th>
        </tr>
      <?php 
        //echo "<pre>";print_r($trickFilesArray);
      
      foreach($trickFilesArray AS $trickFile){
        if($trickFile->media_type=='pdf'){
          $i++;
          $pdf_link="";
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td><?php echo $trickFile->file_name?></td>
          <td><a href="<?php echo $trickFile->directLink?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
        </tr>
      
      <?php }}?> 
</table> 
<?php }?>
      <?php if($i==0){?>
        No PDF files available for this trick.
      <?php }?>

     </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="cross('play_trick_pdf_view');">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal video play ----- -->
<div class="modal fade" id="play_trick_video">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content"> 
      <div class="modal-header">
         <h6 class="modal-title fw-bold"><?php echo $trickCategoryName;?> - <?php echo $trickDetails[0]->name;?> - Video</h6> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="video_modal_close('play_trick_video');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      

       <div style="overflow:scroll;overflow-x: hidden;">   
      <div class="modal-body" align="center">
      <?php 
       $i = 0;
      foreach($trickFilesArray AS $trickFile){
       //echo "<pre>";print_r($trickFile);
        if($trickFile->media_type=='mp4' || $trickFile->media_type=='webm' || $trickFile->media_type=='avi' || $trickFile->media_type=='mov' || $trickFile->media_type=='mkv'){
          $i++;
        ?>
        <div class="mt-1" style="width:100%;">
        <!-- <h6><?php echo $trickFile->file_name?></h6> -->
      <video width="70%" class="trick_video" controls data-video-id="<?= $trickFile->id ?>" data-current-time="<?= $trickFile->current_time ?? 0 ?>">
        <source src="<?php echo $trickFile->directLink?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>  

        <!-- Video Note -->
    <!-- NOTE + SAVE BUTTON -->
<div style="
    width:99%;
    position:relative;
    margin-bottom:15px;
">
<small class="text-success note-status" style="display:none;">
        ✔ Note saved successfully
    </small>
    <!-- <textarea
        class="video-note tinymce-editor"
        placeholder="Write a note..."
        data-video-id="<?php echo $trickFile->id; ?>"
        data-note-id="<?= $trickFile->note_id ?? '' ?>"
        style="
          width:100%;
          height:120px;
          padding:10px 80px 10px 10px;
          resize:none;
        "
    ><?= $trickFile->note ?? '' ?></textarea> -->
<textarea
    id="video_note_<?= $trickFile->id ?>"
    class="video-note tinymce-editor"
    data-video-id="<?= $trickFile->id ?>"
    data-note-id="<?= $trickFile->note_id ?? '' ?>"
><?= $trickFile->note ?? '' ?></textarea>
    <button type="button"
        class="btn btn-primary save-video-note"
        disabled
        style="
          position:absolute;
          right:10px;
          bottom:10px;
          padding:5px 12px;
          font-size:14px;
        ">
        <span class="saveBtnText">Save</span>
        <span class="saveBtnLoader" style="display:none;">
            <i class="fa fa-spinner fa-spin ml-1"></i>
        </span>
    </button>

    

</div>

    </div>      
      <?php }}if($i==0){?>
        No video files available for this trick.
      <?php }?>
      </div> 
    </div>
      <!-- <div class="modal-footer">
        
        
        <button type="button" class="btn btn-secondary" onclick="video_modal_close('play_trick_video');">Close</button>
      </div> -->
    
    </div>
  </div>
</div>
<!-- Modal file download ----- -->
<div class="modal fade" id="play_trick_file_download">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
         <h5 class="modal-title"><?php echo $trickCategoryName;?> -> <?php echo $trickDetails[0]->name;?> -> Download</h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('play_trick_file_download');">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" align="center">
        <?php if(count($trickFilesArray)){?>
        <table class="table">
        <tr>
          <th>#</th>
          <th>File Name</th>
          <th></th>
        </tr>
      <?php 
      $i = 0;
      foreach($trickFilesArray AS $trickFile){
        
        //if($trickFile->media_type=='pdf'){
          $i++;
        ?>
        <tr>
          <td><?php echo $i?></td>
          <td width="70%"><?php echo substr($trickFile->file_name, -60);?></td>
          <td><a href="<?php echo $trickFile->directLink?>" download><i class="fa fa-download" aria-hidden="true"></i></a></td>
        </tr>
      <!-- <video width="750" class="trick_video" controls>
        <source src="<?php echo base_url()?>/trick_files/<?php echo $trickFile->file_name?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>  -->       
      <?php //}

    }?> 
</table> 
<?php }?>
      <?php if($i==0){?>
        No files available for this trick.
      <?php }?>

     </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="cross('play_trick_file_download');">Close</button>
      </div>
    </div>
  </div>
</div>
      <script src="<?php echo base_url();?>/assets/tinymce_l/tinymce/js/tinymce/tinymce.min.js"></script>
      <script>
      //tinymce.init({ selector:'textarea',branding: false });
      tinymce.init({
        selector: '.tinymce-editor',
        branding: false
      });
    </script> 

      <script type="text/javascript">
        // function edit_description_click(){
        //   $("#updateTrickDescriptionModalId").modal('show');
        // }
        
    function edit_trick_modal_show_click(modal_id){
      if(modal_id=='play_trick_video'){
        initTinyMCE();
      }
      $("#"+modal_id).modal('show');
    }
        function edit_notes_click(){
          $("#updateTrickNotesModalId").modal('show');
        }
        function close_modal_by_id(modal_id){       
          $("#"+modal_id).modal('hide');
        }
    function video_modal_close(modal_id){
      $("#"+modal_id).modal('hide');
      $('.trick_video').each(function() {
        this.pause();
      });
    }
    $(document).ready(function() {
        document.querySelectorAll('.trick_video').forEach(function(video){
            const lastTime = parseFloat(video.dataset.currentTime);
            if(lastTime > 0){
                video.addEventListener('loadedmetadata', function(){
                    video.currentTime = lastTime;
                });
            }
        });
        // Add a 'play' event listener to each video
        $('.trick_video').on('play', function() {
            // Pause all other videos
            $('.trick_video').each(function() {
                if (this !== event.target) {
                    this.pause();
                }
            });
        });
    });
document.querySelectorAll('.trick_video').forEach(function(video){

    const videoId = video.dataset.videoId;

    // // Load saved time
    // fetch('/video/get-progress/'+videoId)
    // .then(res => res.json())
    // .then(data=>{
    //     if(data.current_time){
    //         video.currentTime = data.current_time;
    //     }
    // });

    // Save progress every 5 seconds
    video.addEventListener('timeupdate', function(){

        if(Math.floor(video.currentTime) % 20 === 0){

            // fetch('/video/save-progress',{
            //     method:'POST',
            //     headers:{
            //         'Content-Type':'application/json'
            //     },
            //     body:JSON.stringify({
            //         video_id: videoId,
            //         current_time: video.currentTime,
            //         duration: video.duration
            //     })
            // });
            $.ajax({
                url: "<?= base_url('saveVideoProgress') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    video_id: videoId,
                    current_time: video.currentTime,
                    duration: video.duration
                },
                success: function (res) {

                    
                },
                complete: function () {
                   
                }
            });
        }

    });

});
      </script>
<script>
  $('#play_trick_video').on('shown.bs.modal', function () {
    initTinyMCE();
});

$('#play_trick_video').on('hidden.bs.modal', function () {
    tinymce.remove('.tinymce-editor');
});
// function initTinyMCE() {

//     // Remove existing editors first
//     tinymce.remove('.tinymce-editor');
// //alert(1);
//     tinymce.init({
//         selector: '.tinymce-editor',
//         height: 150,
//         min_height: 150,
//         max_height: 150,
//         //menubar: false,
//         statusbar: false,
//         //branding: false,
//         //resize: false,
//         //toolbar: 'bold italic underline | bullist numlist | undo redo',
//         content_style: `
//             body {
//                 margin: 8px;
//                 font-size: 14px;
//             }
//         `
//     });
// }
function initTinyMCE() {

    tinymce.remove('.tinymce-editor');

    tinymce.init({
        selector: '.tinymce-editor',
        height: 240,
        min_height: 240,
        max_height: 240,
        menubar: false,
        statusbar: false,
        //branding: false,
        //resize: false,
        //toolbar: 'bold italic underline | bullist numlist | undo redo',

        setup: function (editor) {

            // Enable Save button when content changes
            editor.on('input change keyup', function () {
                const textarea = $('#' + editor.id);
                textarea
                    .closest('div')
                    .find('.save-video-note')
                    .prop('disabled', false);
            });
        }
    });
}
</script>

 <script>
/* Enable Save button only when text changes */
$(document).on('input', '.video-note', function () {
    const wrapper = $(this).closest('div');
    wrapper.find('.save-video-note').prop('disabled', false);
});

/* Manual Save */
// $(document).on('click', '.save-video-note', function () {

//     const btn      = $(this);
//     const wrapper  = btn.closest('div');
//     const textarea = wrapper.find('.video-note');
//     const loader   = btn.find('.saveBtnLoader');
//     const status   = wrapper.find('.note-status');

//     const note     = textarea.val();
//     const videoId  = textarea.data('video-id');
//     let noteId     = textarea.data('note-id');

//     btn.prop('disabled', true);
//     loader.show();
//     status.hide();

//     $.ajax({
//         url: "<?= base_url('saveVideoNote') ?>",
//         type: "POST",
//         dataType: "json",
//         data: {
//             note_id: noteId,
//             video_id: videoId,
//             note: note,
//             video_type: 'Trick'
//         },
//         success: function (res) {

//             if (res.note_id && !noteId) {
//                 textarea.data('note-id', res.note_id);
//             }

//             status.fadeIn();

//             setTimeout(() => {
//                 status.fadeOut();
//             }, 2000);
//         },
//         complete: function () {
//             loader.hide();
//         }
//     });
// });
$(document).on('click', '.save-video-note', function () {

    const btn      = $(this);
    const wrapper  = btn.closest('div');
    const textarea = wrapper.find('.video-note');
    const editorId = textarea.attr('id');

    const note     = tinymce.get(editorId).getContent(); // ✅ FIX
    const videoId  = textarea.data('video-id');
    let noteId     = textarea.data('note-id');

    const loader   = btn.find('.saveBtnLoader');
    const status   = wrapper.find('.note-status');

    btn.prop('disabled', true);
    loader.show();
    status.hide();

    $.ajax({
        url: "<?= base_url('saveVideoNote') ?>",
        type: "POST",
        dataType: "json",
        data: {
            note_id: noteId,
            video_id: videoId,
            note: note,
            video_type: 'Trick'
        },
        success: function (res) {

            if (res.note_id && !noteId) {
                textarea.attr('data-note-id', res.note_id);
            }

            status.fadeIn();
            setTimeout(() => status.fadeOut(), 2000);
            refreshTrickNotes();
        },
        complete: function () {
            loader.hide();
        }
    });
});
function refreshTrickNotes() {

    const trickId = <?= (int)$trickDetails[0]->id ?>;

    $.ajax({
        url: "<?= base_url('getTrickDetails') ?>",
        type: "POST",
        dataType: "json",
        data: {
            trick_id: trickId
        },
        success: function (res) {

            if (res.statusCode === 200 && res.data && res.data.length > 0) {

                const trick = res.data[0];
                const noteHtml = trick.trick_video_note || '<em>No notes available</em>';

                $('#trick_my_note').html(noteHtml);

            } else {
                $('#trick_my_note').html('<em>No notes available</em>');
            }
        },
        error: function () {
            console.error('Failed to refresh trick notes');
        }
    });
}

</script>
     
<script>
// let noteTimer = null;

// $(document).on('keyup', '.video-note', function () {

//     const textarea = $(this);
//     const note     = textarea.val();
//     const videoId  = textarea.data('video-id');
//     let noteId     = textarea.data('note-id');
//     //alert(noteId);
//     clearTimeout(noteTimer);
//     noteTimer = setTimeout(() => {
//         $.ajax({
//             url: "<?= base_url('saveVideoNote') ?>",
//             type: "POST",
//             dataType: "json",
//             data: {
//                 note_id: noteId,
//                 video_id: videoId,
//                 note: note,
//                 video_type: 'Trick'
//             },
//             success: function (res) {
//                 // If it was INSERT, backend returns new note_id
//                 if (res.note_id && !noteId) {
//                   textarea.data('note-id', res.note_id);
//                     //textarea.attr('data-note-id', res.note_id);
//                 }
//             }
//         });
//     }, 1200);
// });
</script>
