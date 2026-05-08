<style>

table td, table th {
    white-space: normal !important;
    word-break: break-word !important;
}
.action-icon-link {
    margin: 0 8px;
    cursor: pointer;
    text-decoration: none !important; /* remove underline */
}

.action-icon-link i {
    text-decoration: none !important; /* extra safety */
}
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
/* Remove Bootstrap default spacing */
.modal-dialog {
  margin: 0 auto !important;
}

/* Modal container */
.modal-fullscreen {
  width: 70vw;
  max-width: 70vw;
  height: 95vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Vertical centering */
.modal-dialog-centered {
  min-height: 95vh;
  display: flex;
  align-items: center;
}

/* Modal content */
.modal-fullscreen .modal-content {
  width: 95%;
  height: 95vh;
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
table thead th {
    white-space: nowrap !important;
    word-break: keep-all !important;
    text-align: center;
    vertical-align: middle;
}
</style>
<div class="main-panel">
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row" style="margin-top:80px;">
        <div class="col-lg-12 mt-3">
          <div style="background:url(<?= base_url('assets/images/bg2.png') ?>);background-size:cover;background-position:top center;" class="p-2 text-white">
            <div class="p-4">
              <div class="float-start">
              <div class="d-flex align-items-center">
                  <div><img src="<?= base_url('assets/images/magic.svg') ?>" / width="70"></div>
               <div class="ms-2"><h1 class="text-white fw-bold" style="font-family: GothamMedium!important;"> My Performances </h1>
               
             </div>
               </div>
              </div>
              <div class="float-end">
                <h1 class="text-white fw-bold" style="font-family: GothamMedium!important;">Hello <?php echo $_SESSION['first_name']; ?>!</h1>
                <div style="font-weight:400;font-size:24px;text-align:right;margin-top:-10px;"><?php echo date("D M d"); ?></div>
              </div>
            </div>
            <div style="height:180px;"></div>
          </div>
          



          <div class="mt-5 d-flex flex-wrap justify-content-between">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/category.svg') ?>"  width="30" class="me-2"> My Performances</h2></div>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>
            <div>
              <a href="<?= base_url('MyPerformanceAdd') ?>" title="Add Performance"><button type="button" class="btn btn-danger" style="background-color:#c41c24">Add a Performance</button></a>
             <!-- <input class="switch" type="checkbox" checked name="category_show" id="category_show" onclick="categort_show_click();" title="Show/Hide Categories"> -->

            </div>
          </div>

          <div class="row" id="category_list_div_id">

            <div class="col-lg-12 mt-3 table-responsive">
              <table class="table table-striped" id="example">
                <thead>
                  <tr>
                    <th width="10%" class="text-center">Title</th>
                    <th width="10%" class="text-center">Location</th>
                    <th width="8%" class="text-center">Date</th>
                    <th width="10%" class="text-center">Contact Name</th>
                    <th width="12%" class="text-center">Contact Phone</th>
                    <th width="20%" class="text-center">Feedback</th>
                    <th width="20%" class="text-center">Details</th>
                    <th width="10%" class="text-center">Action</th>
                    
                  </tr> 
                </thead>
                <tbody>
                <?php foreach($performanceList AS $performance){ 
                  $contact_phone ="";
                    if (!empty($performance->contact_phone)) {
                        $rawPhone = preg_replace('/\D/', '', $performance->contact_phone); // Remove non-digits

                        if (strlen($rawPhone) == 10) {
                            $areaCode = substr($rawPhone, 0, 3);
                            $middle   = substr($rawPhone, 3, 3);
                            $last     = substr($rawPhone, 6, 4);
                            $contact_phone = "($areaCode) $middle-$last";
                        } else {
                            $contact_phone = $rawPhone; // Keep as is if not 10 digits
                        }
                    }
                  ?>
                <tr>
                  <td class="text-center"><?php echo $performance->name; ?></td>
                  <td class="text-center"><?php echo $performance->location; ?></td>
                  <td class="text-center"><?php 
                      echo ($performance->performance_date == "0000-00-00" || $performance->performance_date == null)
                          ? ""
                          : date('m/d/Y', strtotime($performance->performance_date));
                  ?></td>
                  <td><?php echo $performance->contact_name; ?></td>
                  <td><?php echo $contact_phone; ?></td>
                  <td><?php echo $performance->feedback; ?></td>
                  <td><?php echo $performance->details; ?></td>

                  <td class="text-center">
                      <a href="javascript:void(0)" class="action-icon-link" onclick="openVideo('<?= esc($performance->performance_file) ?>', <?php echo $performance->id; ?>, '<?php echo $performance->name; ?>',<?= $performance->current_time ?? 0 ?>)">
                          <i class="fa fa-play action-icon"></i>
                      </a>

                      <a href="<?= base_url('MyPerformanceAdd/'.$performance->id) ?>" class="action-icon-link">
                          <i class="fa fa-pencil action-icon"></i>
                      </a>

                      <a href="javascript:void(0)" class="action-icon-link" onclick="confirmDelete(<?= $performance->id?>)">
                          <i class="fa fa-trash action-icon"></i>
                      </a>
                  </td>

                </tr>
              <?php }?>
              </tbody>
              </table>
            </div>


            
          </div> 

          
 
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Full Screen Loader -->
<div id="fullLoader" class="loader-overlay" style="display:none;">
  <div class="spinner"></div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this performance? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- <div id="videoModal" style="display:none; position:fixed; top:0; left:0; 
     width:100%; height:100%; background:rgba(0,0,0,0.8); 
     justify-content:center; align-items:center;">

    <video id="myVideo" width="600" controls></video>
</div> -->
<!-- Video Modal -->
<div class="modal fade" id="play_trick_video" tabindex="-1">
  <div class="modal-dialog modal-fullscreen modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">My Performances -> <span id="title_performance_name"></span>        <!-- Success message -->
        </h5>
        <span id="noteSavedMsg"
              style="
                display:none;
                
                font-size:16px;
                color:#28a745;
                text-align: center;
              ">
            ✔ Note saved successfully
        </span>
        <button type="button" class="close"
                onclick="video_modal_close('play_trick_video')">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body p-0 d-flex flex-column align-items-center">

        <!-- VIDEO -->
        <video id="videoPlayer"
               controls
               style="
                 width:99%;
                 height:70%;
                 background:black;
                 margin-bottom:20px;   /* ✅ space below video */
               ">
            <source id="videoSource" src="" type="video/mp4">
        </video>

        <!-- NOTE + SAVE BUTTON -->
        <div style="
            width:99%;                /* ✅ same width as video */
            position:relative;
            margin-bottom:10px;
        ">
            <textarea id="videoNote"
                      placeholder="Write a note..."
                      style="
                        width:100%;
                        height:120px;
                        padding:10px 80px 10px 10px;
                        resize:none;
                      ">
            </textarea>

            <button type="button"
                  id="saveVideoNoteBtn"
                  class="btn btn-primary"
                  disabled
                  style="
                    position:absolute;
                    right:10px;
                    bottom:10px;
                    padding:5px 12px;
                    font-size:14px;
                  ">
              <span id="saveBtnText">Save</span>
              <span id="saveBtnLoader" style="display:none;">
                  <i class="fa fa-spinner fa-spin" style="margin-left:5px;"></i>
              </span>
          </button>

        </div>

    </div>


    </div>
  </div>
</div>




<!-- content-wrapper ends --> 
<script type="text/javascript">
  let videoProgressTimer = null;
setTimeout(function () {
    $(".alert").fadeOut("slow");
}, 3000);  

function openVideo(filename, videoId, name, currentTime = 0) {

    const modal    = $('#play_trick_video');
    const video    = document.getElementById('videoPlayer');
    const source   = document.getElementById('videoSource');
    const textarea = document.getElementById('videoNote');

    $('#title_performance_name').html(name);
    document.getElementById('noteSavedMsg').style.display = 'none';
    document.getElementById('fullLoader').style.display = 'flex';

    textarea.value = '';
    textarea.dataset.videoId = videoId;
    video.dataset.videoId    = videoId;
    video.dataset.currentTime = currentTime;

    fetch('<?= base_url('getPerformanceFileUrl') ?>/' + encodeURIComponent(filename))
        .then(function (res) { return res.json(); })
        .then(function (data) {
            document.getElementById('fullLoader').style.display = 'none';
            if (!data.url) { alert('Could not load video. Please try again.'); return; }

            source.src = data.url;
            video.load();

            modal.modal('show');
            modal.on('shown.bs.modal', function () { video.play(); });

            loadVideoNote(videoId);
        })
        .catch(function () {
            document.getElementById('fullLoader').style.display = 'none';
            alert('Could not load video. Please try again.');
        });
}
// function video_modal_close(modalId) {

//     const modal = $('#' + modalId);
//     const video = document.getElementById('videoPlayer');

//     video.pause();
//     video.currentTime = 0;

//     modal.modal('hide');
// }
function video_modal_close(modalId) {

    const modal = $('#' + modalId);
    const video = document.getElementById('videoPlayer');

    saveVideoProgress();

    clearInterval(videoProgressTimer);
    videoProgressTimer = null;

    video.pause();

    modal.modal('hide');
}
function loadVideoNote(video_id) {

    $.ajax({
        url: "<?= base_url('getVideoNote') ?>",
        type: "POST",
        dataType: "json",
        data: {
            video_id: video_id,
            video_type: 'MyPerformance'
        },
        success: function (res) {

            const textarea = document.getElementById('videoNote');

            if (res.data && res.data.length > 0) {
                textarea.value = res.data[0].note || '';
                textarea.dataset.videoNoteId = res.data[0].id;
                setOriginalNote(textarea.value);   // ✅ store original
            } else {
                textarea.value = '';
                textarea.dataset.videoNoteId = '';
                setOriginalNote('');               // ✅ no note yet
            }
        }
        
    });  
    
}

function confirmDelete(id) {
    $('#confirmDeleteModal').modal('show');
    document.getElementById('confirmDeleteBtn').onclick = function () {
        $('#confirmDeleteModal').modal('hide');
        document.getElementById('fullLoader').style.display = 'flex';
        $.ajax({
            type: 'POST',
            url: '<?= base_url('DeletePerformance') ?>',
            data: { id: id },
        })
        .done(function () {
            window.location.href = '<?= base_url('MyPerformance') ?>';
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            document.getElementById('fullLoader').style.display = 'none';
            alert('Delete failed: ' + textStatus);
        });
    };
}
// Close modal when clicking outside video
window.onclick = function(e) {
    if (e.target.id === "videoModal") {
        const modal = document.getElementById("videoModal");
        const video = document.getElementById("myVideo");

        modal.style.display = "none";
        video.pause();
        video.src = ""; // Clear video src to stop audio issues
    }
};


document.getElementById('saveVideoNoteBtn').addEventListener('click', function () {

    const textarea     = document.getElementById('videoNote');
    const note         = textarea.value;
    const videoId      = textarea.dataset.videoId;
    const videoNoteId  = textarea.dataset.videoNoteId;

    if (!videoId) {
        alert('Video not loaded');
        return;
    }

    const btn      = document.getElementById('saveVideoNoteBtn');
    const btnText  = document.getElementById('saveBtnText');
    const btnLoader= document.getElementById('saveBtnLoader');

    // Disable button and show loader
    btn.disabled = true;
    btnText.style.display = 'none';
    btnLoader.style.display = 'inline-block';

    $.ajax({
        url: "<?= base_url('saveVideoNote') ?>",
        type: "POST",
        dataType: "json",
        data: {
            note_id: videoNoteId,
            video_id: videoId,
            note: note,
            video_type: 'MyPerformance'
        },
        success: function (res) {

            if (!videoNoteId && res.note_id) {
                textarea.dataset.videoNoteId = res.note_id;
            }

            setOriginalNote(textarea.value); // reset change tracker

            // Show success message next to title
            const msg = document.getElementById('noteSavedMsg');
            msg.style.display = 'inline';
            setTimeout(() => { msg.style.display = 'none'; }, 3000);
        },
        error: function() {
            alert('Failed to save note. Try again.');
        },
        complete: function() {
            // Re-enable button and hide loader
            btnText.style.display  = 'inline';
            btnLoader.style.display = 'none';
        }
    });
});




const videoNoteTextarea = document.getElementById('videoNote');
const saveBtn = document.getElementById('saveVideoNoteBtn');

let originalNote = "";

/* When note is loaded, store original value */
function setOriginalNote(value) {
    originalNote = value;
    saveBtn.disabled = true;
}

/* Detect changes */
videoNoteTextarea.addEventListener('input', function () {
    if (this.value.trim() !== originalNote.trim()) {
        saveBtn.disabled = false;
    } else {
        saveBtn.disabled = true;
    }
});

const videoPlayer = document.getElementById('videoPlayer');

videoPlayer.addEventListener('loadedmetadata', function(){

    const lastTime = parseFloat(videoPlayer.dataset.currentTime || 0);

    if(lastTime > 0){
        videoPlayer.currentTime = lastTime;
    }

}); 
function saveVideoProgress(){

    const video = document.getElementById('videoPlayer');
    const videoId = video.dataset.videoId;
//alert(videoId);
    if(!videoId) return;

    $.ajax({
        url: "<?= base_url('savePerformanceVideoProgress') ?>",
        type: "POST",
        data: {
            video_id: videoId,
            current_time: video.currentTime
        }
    });
}
//const videoPlayer = document.getElementById('videoPlayer');

videoPlayer.addEventListener('play', function () {

    if (!videoProgressTimer) {
      //alert(1);
        videoProgressTimer = setInterval(function () {
//alert(2);
            saveVideoProgress();

        }, 10000); // every 10 seconds

    }

});
videoPlayer.addEventListener('pause', function () {

    clearInterval(videoProgressTimer);
    videoProgressTimer = null;

});

videoPlayer.addEventListener('ended', function () {

    clearInterval(videoProgressTimer);
    videoProgressTimer = null;

    saveVideoProgress(); // final save

});
</script>
