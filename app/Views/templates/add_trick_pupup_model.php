
<!-- Modal for trick insert ----- -->
<div class="modal fade" id="trick_insert_modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content"> 
      <div class="modal-header">
       <h5 class="modal-title"> <span id="title"><img src="<?= base_url('assets/images/logo-black.svg') ?>" / width="80"></span></h5> 
       <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('trick_insert_modal');">
        <span aria-hidden="true">&times;</span>
      </button>
    </div> 
    <div class="modal-body">
      <div class="row">
        <div class="col-lg-12 col-md-12"> 
          <form action="<?= base_url('BackstageUploadTrickSubmit') ?>" method="POST" enctype="multipart/form-data" id="uploadtrickpupup" name="uploadtrickpupup" onSubmit="disabled_upload_button();">  
                  <?= csrf_field() ?>
                  
                  <input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id?>">
                  <input type="hidden" name="backstage_id" id="backstage_id" value="">
                  <input type="hidden" name="file_full_name" id="file_full_name" value="">
                     
                  <div class="row">
                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-12 col-md-12">
                        <input type="text" name="name" id="add_trick_name" class="form-control form-bg ht" value="" placeholder="Name*" required style="color:#000!important;">
                      </div>
                      <div class="col-lg-12 col-md-12 mt-3">
                        <textarea name="description" id="add_trick_description" class="form-control form-bg" placeholder="Description" rows="4" style="color:#000!important;font-size:20px!important;"></textarea>
                      </div>
                      <div class="col-lg-12 col-md-12 mt-3">

                            <input type="text" name="artist" id="add_trick_artist" class="form-control form-bg ht" value="" placeholder="Artist" required style="color:#000!important;">
                        
                    </div>
                    <div class="col-lg-12 col-md-12 mt-3">
                      <div  style="font-size:14px;">Catagory*</div>
                      <select class="form-select form-bg ht" aria-label="Large select example" required name="catagory[]" id="add_trick_catagory" onchange="changeColor('catagory');" multiple size="4" style="height: 75px;">
                        <!-- <option value="">Category</option> -->
                        <?php foreach($trickCategoryList AS $Category){?>
                          <option value="<?php echo $Category->id?>" style="color:#000!important;"><?php echo $Category->category_name?></option>
                        <?php }?>
                      </select>
                      <div style="font-size:14px;padding-top:5px;">Note: Use CTRL to choose multiple categories</div>
                    </div>
                    <div class="col-lg-12 col-md-12 mt-3">

                      <select class="form-select form-bg ht" aria-label="Large select example" name="supplier" id="add_trick_supplier" onchange="changeColor('supplier');supplier_change();">
                        <option value="">Supplier</option>
                        <?php foreach($supplierList AS $supplier){?>
                          <option value="<?php echo $supplier->id?>" style="color:#000!important;"><?php echo $supplier->name?></option>
                        <?php }?>
                        <option value="add">Add New</option>
                      </select>
                    </div>
                    
                    </div>
                    <div class="col-lg-6 col-md-6">
                      <div class="col-lg-12 col-md-12">
                        <!-- <video width="340" height="200" controls>
                          <source id="vedio_source_id" src="movie.mp4" type="video/mp4">
                          
                        Your browser does not support the video tag.
                        </video> -->
                         <!-- Video Preview -->
                          <video id="preview_video" width="340" height="200" controls style="display:none;"  data-current-time="0" data-video-id="">
                            <source id="vedio_source_id" src="" type="video/mp4">
                            Your browser does not support the video tag.
                          </video>

                          <!-- File Link Preview -->
                          <div id="preview_file" style="display:none; padding: 20px;text-align: center;">
                            <a id="file_link"
                               href="#"
                               target="_blank"
                               style="font-size:16px; font-weight:600;">
                              Open File
                            </a>
                          </div>
                      </div>
                      <!-- <div class="col-lg-12 col-md-12">
                        <textarea name="notes" id="add_trick_notes" class="form-control form-bg" placeholder="Notes" style="color:#000!important;"></textarea>
                      </div> -->
                      <div class="col-lg-12 col-md-12">
                        <div class="drop-area2" id="dropArea2" style="margin-top:22px;">
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
  <div style="text-align: center;">
    <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
      <img src="<?= base_url('assets/images/uploadtrick.png') ?>" alt="upload" id="uploadBtn"  width="300">
    </button>    
  </div>      
      <!-- <button type="submit" class="bot-back" id="uploadBtn" style="font-family:'Gotham'!important;"></button> -->
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
<!-- <script type="text/javascript">
function trick_insert_modalShow(id,fileName,fileFullName,fileType){
    //var filefullPath = '<?php echo base_url()?>/trick_upload_file/'+fileFullName;
    //alert(filefullPath);
    $("#backstage_id").val(id);
    $("#file_full_name").val(fileFullName);
    $('#vedio_source_id').attr('src', fileFullName);
    $('#vedio_source_id')[0].parentNode.load();
        $("#add_trick_name").val(fileName);
      $("#trick_insert_modal").modal("show");
}

</script> -->

<script type="text/javascript">
// function trick_insert_modalShow(id, fileName, fileFullName, fileType, currentTime = 0) {

//     $("#backstage_id").val(id);
//     $("#file_full_name").val(fileFullName);
//     $("#add_trick_name").val(fileName);

//     // Hide all previews first
//     $("#preview_video").hide();
//     $("#preview_file").hide();

//     // Get file extension
//     //var ext = fileFullName.split('.').pop().toLowerCase();
//     //alert(fileType);
//     fileType = fileType.toLowerCase();
//     var videoTypes = [
//           'mp4',   // MP4 (H.264 / H.265)
//           'm4v',   // MP4 variant (Apple)
//           'webm',  // WebM
//           'ogg',   // OGG container
//           'ogv',   // OGV video
//           'mov',   // QuickTime
//           'avi',   // AVI (may not play in browser but still video)
//           'wmv',   // Windows Media
//           'flv',   // Flash video
//           'mkv',   // Matroska
//           '3gp',   // Mobile video
//           '3g2',   // Mobile video
//           'ts',    // MPEG transport stream
//           'mts',   // AVCHD
//           'm2ts',  // Blu-ray stream
//           'mpeg',  // MPEG
//           'mpg'    // MPEG
//         ];

//     if (videoTypes.includes(fileType)) {

//         // Show video
//         $('#vedio_source_id').attr('src', fileFullName);
//         $('#preview_video')[0].load();
//         $("#preview_video").show();

//     } else {

//         // Show simple link only
//         $("#file_link")
//             .attr("href", fileFullName)
//             .attr("target", "_blank")
//             .text("Open File");

//         $("#preview_file").show();
//     }

//     $("#trick_insert_modal").modal("show");
// }
function trick_insert_modalShow(id, fileName, fileFullName, fileType, currentTime = 0) {

    $("#backstage_id").val(id);
    $("#file_full_name").val(fileFullName);
    $("#add_trick_name").val(fileName);

    const video = document.getElementById('preview_video');

    video.dataset.videoId = id;
    video.dataset.currentTime = currentTime;

    $("#preview_video").hide();
    $("#preview_file").hide();

    fileType = fileType.toLowerCase();

    var videoTypes = [
        'mp4','m4v','webm','ogg','ogv','mov','avi','wmv','flv','mkv',
        '3gp','3g2','ts','mts','m2ts','mpeg','mpg'
    ];

    if (videoTypes.includes(fileType)) {

        $('#vedio_source_id').attr('src', fileFullName);
        $('#preview_video')[0].load();
        $("#preview_video").show();

    } else {

        $("#file_link")
            .attr("href", fileFullName)
            .attr("target", "_blank")
            .text("Open File");

        $("#preview_file").show();
    }

    $("#trick_insert_modal").modal("show");
}
const previewVideo = document.getElementById('preview_video');

previewVideo.addEventListener('loadedmetadata', function(){

    const lastTime = parseFloat(previewVideo.dataset.currentTime || 0);

    if(lastTime > 0){
        previewVideo.currentTime = lastTime;
    }

});
let trickVideoTimer = null;

previewVideo.addEventListener('play', function(){

    if(!trickVideoTimer){

        trickVideoTimer = setInterval(function(){

            saveTrickVideoProgress();

        },10000);

    }

});

previewVideo.addEventListener('pause', function(){

    clearInterval(trickVideoTimer);
    trickVideoTimer = null;

});

previewVideo.addEventListener('ended', function(){

    saveTrickVideoProgress();

    clearInterval(trickVideoTimer);
    trickVideoTimer = null;

});
function saveTrickVideoProgress(){

    const video = document.getElementById('preview_video');
    const videoId = video.dataset.videoId;

    if(!videoId) return;

    $.ajax({
        url: "<?= base_url('saveBackStageVideoProgress') ?>",
        type: "POST",
        data:{
            video_id: videoId,
            current_time: video.currentTime
        }
    });

}
</script>

