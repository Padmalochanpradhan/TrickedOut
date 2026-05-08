<style type="text/css">
  .form-control{
    color: #000 !important;
    border: 1px solid #ccc !important;
  }
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/jquery-ui.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/jquery.timepicker.min.css') ?>"> 
<script src="<?= base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.timepicker.min.js') ?>"></script> 
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row" style="margin-top:80px;">
      <div class="col-md-12 grid-margin">

       
          <div class="row">
          <div class="col-lg-5 col-md-12"><h3>Manage Category</h3></div>

           <div class="col-lg-5 col-md-12 text-center" style="color: #f74747;"><?php if(session()->getFlashdata('err_msg')){ ?>
                  <?= session()->getFlashdata('err_msg'); ?>
                <?php } ?></div>           
                <div class="col-lg-2 col-md-12 text-end" >
                  <a style="text-decoration:underline;" href="javascript:void(0);" onclick="add_category();">
                    +Add
                  </a></div>

              </div>
<div class="row">
                <div class="col-lg-12 p-0">
           
           <!-- <div align="right"><a style="text-decoration:underline;padding-right: 20px;" href="javascript:void(0);" onclick="add_category();">+Add</a></div>  --> 
           <div class="col-lg-12 col-md-12">
            <table id="example1" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">Category Name</th>
                  <th class="text-center">Category Icon</th>
                  <th class="text-center">Category Banner</th>
                  <th class="text-center">Trick Default Icon</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($CategoryList as $key => $value) { ?> 
                  <tr>
                    <td class="text-center"><?php echo $value->category_name; ?></td>
                    <td class="text-center"><?php if($value->category_icon){?> <a href="<?php echo base_url('trick_categary_image/'.$value->category_icon);?>" target="_blank">View</a> <?php }?></td>
                    <td class="text-center"><?php if($value->category_banner){?> <a href="<?php echo base_url('trick_categary_image_banner/'.$value->category_banner);?>" target="_blank">View</a> <?php }?></td>
                    <td class="text-center"><?php if($value->trick_default_icon){?> <a href="<?php echo base_url('trick_default_icon/'.$value->trick_default_icon);?>" target="_blank">View</a> <?php }?></td>
                    <td class="text-center"><?php 
                            if($value->status==0){ 
                              echo 'Active';
                            }else if($value->status==1){ 
                              echo 'Inactive'; 
                            }else if($value->status==-1){
                              echo 'Default'; 
                            }
                        ?></td>
                    <td class="text-center"><a title="Edit" style="cursor: pointer;" onclick="update_category('<?php echo $value->id; ?>');">Edit</a>
                    </td>                    
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
      <form action="<?= base_url('addupdate_category') ?>" method="POST" id="form" name="form" enctype="multipart/form-data" >  
        <?= csrf_field() ?>
        <input type="hidden" name="category_id"  id="category_id">

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
                <label>Category Name</label>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
               <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Category Name*" required>
             </div>
           </div>
           <div class="col-lg-6">
                <label>Category Icon</label>
           </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="file" name="category_icon" id="category_icon" accept="image/*" onchange="imageFileOnly(this);">
               <!-- <input type="text" name="start_date" id="start_date" class="form-control datepicker" placeholder="Start Date" required> -->
             </div>
           </div>
           <div class="col-lg-6">
                <label>Category Banner</label>
           </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="file" name="category_banner" id="category_banner" accept="image/*" onchange="imageFileOnly(this);">
             </div>
           </div>
           <div class="col-lg-6">
                <label>Trick Default Icon</label>
           </div>

            <div class="col-lg-6">
              <div class="form-group">
                <input type="file" name="trick_default_icon" id="trick_default_icon" accept="image/*" onchange="imageFileOnly(this);">
             </div>
           </div>
           <div class="col-lg-6">
                <label>Status</label>
           </div>
            
            <div class="col-lg-6">
              <div class="form-group"> 
               <select class="form-select" name="status" id="status" required style="color: #000;">
                 <option value="0">Active</option>
                 <option value="1">Inactive</option>
               </select>
             </div>
           </div>
         </div>
       </div> 
       <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>        
        <button type="button" class="btn btn-secondary" onclick="close_modal_by_id('ReleasenoteId');">Cancel</button>
      </div>
    </form>
  </div>
</div>
</div> 

<script type="text/javascript">
 $(document).ready(function() {  
   $('#example1').DataTable(); 
 });
//$('.datepicker').datepicker({ changeMonth: true,changeYear: true });
 function imageFileOnly(a){
 // alert(1);
    const file = a.files[0];
    if (file) {
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Only image files are allowed.');
            a.value = ''; // Clear the file input
        }
    }
 }

function formatDate(dateStr) {
  const date = new Date(dateStr);
  const month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are 0-based
  const day = ('0' + date.getDate()).slice(-2);
  const year = date.getFullYear();
  return `${month}/${day}/${year}`;
}

function update_category(category_id){
  $("#ReleasenoteId").modal('show'); 
  $('#releasenote_title').html('Update Category');
  $('#category_id').val(category_id); 

  var parameters = {
    category: category_id
  }
  $.ajax({ 
    type: "POST",
    url: '<?php echo APIURL; ?>TrickedOutGetCategoryById',         
    data: JSON.stringify(parameters),
    contentType: 'application/json',       
    async: false ,
  }).done(function (data, textStatus, xhr){  
    //console.log(data.data[0]);

    $('#category_name').val(data.data[0].category_name);
    $('#status').val(data.data[0].status);
    

  }).fail(function (jqXHR, textStatus, errorThrown){         

  });
}
function add_category(){
  $("#ReleasenoteId").modal('show');
  $('#releasenote_title').html('Add Category');
  $('#plan_id').val(''); 
}
 
function close_modal_by_id(modal_id){
  $("#"+modal_id).modal('hide');
}

</script>

