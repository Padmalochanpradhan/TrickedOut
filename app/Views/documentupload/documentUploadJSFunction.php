 
<script type="text/javascript">
$("body").on("click",".add-more",function(){ 
    var html = $(".after-add-more").first().clone();  
    html.find("input").val('');
    $(html).find(".change").html("<a class='btn btn-danger remove'>- Remove</a>");  
    $(".after-add-more").last().after(html); 
});
$("body").on("click", ".remove", function () {
      $(this).parents("#tab_logic").remove();
}); 
function OpenDoumnetModal(id,name) {
    $('#addDocument').modal({backdrop: 'static', keyboard: false});  
    $('#addDocument').modal('show');  
    $('#module_element_id').val(id);
    $('#modal-sucess-msg-doc').html(""); 
    var s_name="("+name+")";
    $('#d_heading').html(s_name);
    GetDocumentList(id)

}
/* get documnet list by id and type */
function GetDocumentListSuccess(data){
     //console.log(11);
     $('#submit-document').show(500);
     $('#small-spiiner').hide(500);
     $('#big-spiiner').hide(500);
     if(data.statusCode==200){
       $('#document_list').empty(); 
          if(data.data.length == 0){
               $('#document_list').html('<tr><td colspan="4" align="center">No record found.</td></tr>'); 
          }else{
               for(var a=0; a<data.data.length; a++){ 
                    var fullpath='<?php echo base_url().'/trick_files/'?>'+data.data[a].file_name;
                    var fileName = data.data[a].file_name;
                    /*$('#document_list').append('<tr><td align="center"> <a target="_blank" href="<?php echo base_url().'/trick_files/'?>'+data.data[a].file_name+'">'+data.data[a].media_type+'</a></td><td align="center"> ...'+fileName.substr(fileName.length - 15)+'</td><td align="center">'+dtConvert(data.data[a].added_on)+'</td><td align="center"><a onclick="open_confirm_delete_document_modal('+data.data[a].id +','+fileName +');"  class="dropdown-item delete_data" href="javascript:void(0)" ><span class="fa fa-trash text-danger"></span> Delete</a></td></tr>');*/
                    $('#document_list').append(
    '<tr>' +
        '<td align="center">' + data.data[a].media_type + '</td>' +
        '<td align="center">...' + fileName.substr(fileName.length - 15) + '</td>' +
        '<td align="center">' + dtConvert(data.data[a].added_on) + '</td>' +
        '<td align="center">' +
            '<a onclick="open_confirm_delete_document_modal(' + data.data[a].id + ', \'' + fileName + '\');" class="dropdown-item delete_data" href="javascript:void(0)">' +
                '<span class="fa fa-trash text-danger"></span> Delete' +
            '</a>' +
        '</td>' +
    '</tr>'
);
               }
          }
     }else{
          var msg = '<?php echo GET_DOCUMENT_LIST_FAILED?>';
          $('#messageSpanId').html(msg);
     }
}
function dtConvert(dt) {
    var dtToday = new Date(dt);    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
      month = '0' + month.toString();
    if(day < 10)
      day = '0' + day.toString();

    var maxDate = month + '/' + day + '/' + year;
    return maxDate;
}
function GetDocumentList(id){
    //alert(id);
    //alert('<?php echo $documentType?>');
     var parameters = {type: '<?php echo $documentType?>',typeId:id} 
     ajaxFunc('<?php echo APIURL; ?>TrickedOutgetDocumentListByTypeAndTypeId',parameters,GetDocumentListSuccess);
}
/* Delete document function delete */
var element_id = 0;
function DeleteDocument() { 
     var document_id =$("#document_id").val();
     element_id =$("#module_element_id").val();
     var fileName = $("#fileName").val();
     var updateData = {status:'1'};
     var parameters={id_field_name:"id",id_field_value:document_id,table_name:"document",update_field:"status",update_value:1};
     ajaxFunc('<?php echo APIURL.API_UPDATE_DATA; ?>',parameters,DeleteDocumentSuccess);
    deleteDropboxFile(fileName);
}
function deleteDropboxFile(filename){
    $.ajax({
         type: "POST",
         url: "<?php echo base_url();?>/deleteFileFromDropbox",
         data: {filePath:'/uploads/'+filename} ,
         async: false ,
         })
         .done(function (data, textStatus, xhr){ 
          // alert(data[0]['dob']);
          console.log(data);
         })      
         .fail(function (jqXHR, textStatus, errorThrown){
           alert("The following error occurred: "+jqXHR.status+",   "+textStatus+",   "+errorThrown+"");
          });
}
function DeleteDocumentSuccess(data){
     $('#confirm').modal('hide'); 
     if(data.statusCode==200){
          msg='<?php echo UPLOAD_DELETE_MSG; ?>';    
          $('#modal-sucess-msg-doc').html(msg); 
          GetDocumentList(element_id)
     }else{

     }
     element_id = 0;
}     
/* open confirm delete documnet modal */
function open_confirm_delete_document_modal(id,fileName)
 {  
     $('#confirm').modal({backdrop: 'static', keyboard: false});  
     $('#confirm').modal('show'); 
     $('#document_id').val(id);
     $('#fileName').val(fileName);
}
/* Document submit through ajax form data and check the validation */
function DocumentSubmit(){
  
    $('#form-document-upload').validate({
        rules: {
            "file[]": {
                maxsize: 7000000,
                maxsizetotal: 7000000
            }
        }
    });
    var valid = $("#form-document-upload").valid();
    if(valid==false){
        return false;
    }else{
   //Calling Spiiner 
     spinner();
         var pageAction = '<?php echo $documentType?>';

     // Get the selected file
////////////////////////////////////////////////////////////
    //var fileInput = document.getElementById('files');
    //console.log(fileInput.files);
    // Display and update progress
    document.getElementById('progress-container').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    let progressText = document.getElementById('progress-text');


    var numberOfFiles = 0;
    //alert(`Number of files: ${numberOfFiles}`);
    let uploadedFiles = []; // Array to store the names of successfully uploaded files
    let uploadedFileSize = [];
    let totalUploaded = 0;
    let totalSize = 0;
    let completedUploads = 0; // Counter to track completed uploads
 // Function to execute after all files are uploaded
    function allFilesUploaded() {
        //console.log("All files uploaded:", uploadedFiles);
        /////////////////////////////////////////////////
            //console.log(uploadedFiles[0]);
            //console.log(uploadedFiles[1]);
            let formData = new FormData();
            formData.append('document_type', $('#document_type').val());
            formData.append('module_element_id', $('#module_element_id').val());
            formData.append('uploadedFiles1', JSON.stringify(uploadedFiles));
            formData.append('uploadedFileSize', JSON.stringify(uploadedFileSize));
            // Send chunk using Fetch API
            fetch("<?php echo base_url('insertUploadedFilesInTable/')?>", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.replace("<?php echo base_url();?>/TricksDetails/"+$('#module_element_id').val());
                }
            })
            .catch(error => console.error(`Error in uploading :`, error));
        /////////////////////////////////////////////
        //document.getElementById('uploadtrick').submit();
        //console.log("totalChunks : ".$totalChunks);
    }
    //console.log("numberOfFiles : "+numberOfFiles);
    // Iterate over all files selected
    $('input[id="files"]').each(function(index, element) {
        if (element.files.length > 0) {
            numberOfFiles++;
            let oneFile = element.files[0];
            totalSize += oneFile.size;
        }
    });
    $('input[id="files"]').each(function(index, element) {
        //console.log(element.files[0]);
    //});
    //for (let i = 0; i < numberOfFiles; i++) {
        let file = element.files[0];
        let formData = new FormData();
        formData.append('file', file);
        formData.append('filename', file.name);
        formData.append('session_id', '<?php echo date('YmdHis')?>');

        fetch("<?php echo base_url('uploadToDropbox')?>", {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                uploadedFiles.push(data.uploadFileName);
                //fileName.push(data.fileName);
                uploadedFileSize.push(file.size);
                completedUploads++;


              // Calculate progress percentage
              totalUploaded += file.size;
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

    });

 /*   $('input[id="files"]').each(function(index, element) {
        //console.log(element.files[0]);
    //});
    //for (let i = 0; i < numberOfFiles; i++) {
        let file = element.files[0];
        let chunkSize = 100 * 1024 * 1024; // 1MB per chunk
        let totalChunks = Math.ceil(file.size / chunkSize);
        let currentChunk = 0;
        //console.log(`Uploading file: ${file.name}`);
        //console.log(`Total chunks for ${file.name}: ${totalChunks}`);
        // Start uploading chunks
    //console.log("totalChunks : "+totalChunks);

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

            // Send chunk using Fetch API
            fetch("<?php echo base_url('uploadFileBySplit/')?>", {
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

    });
*/

     ///////////////////////////////////////////////////////
 
    }
}
function spinner()
{
     $('#submit-document').hide(500);
     $('#small-spiiner').show(500);
     $('#big-spiiner').show(500);
}
function clear()
{
     $("#form-document-upload").trigger('reset'); 
    // $("div").removeClass("remove"); 
    // $("div").removeClass("btn btn-danger remove");
}
  
</script> 