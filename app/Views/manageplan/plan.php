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
          <div class="col-lg-12 mt-3 p-0">
           <h3>Manage Plan</h3>
           <div align="right"><a style="text-decoration:underline;padding-right: 20px;" href="javascript:void(0);" onclick="add_paln();">+Add</a></div>  
           <div class="col-lg-12 col-md-12">
            <table id="example1" class="display" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Plan</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Storage(GB)</th>
                  <th>Price</th>
                  <th>Month</th>
                  <th>Year</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($manageplan as $key => $value) { 
                  $startdate = new DateTime($value->start_date, new DateTimeZone("UTC"));
                  $enddate = new DateTime($value->end_date, new DateTimeZone("UTC"));
                  ?> 
                  <tr>
                    <td><?php echo $value->subscription; ?></td>
                    <td><?php echo $startdate->format('m/d/Y'); ?></td>
                    <td><?php echo $enddate->format('m/d/Y'); ?></td>
                    <td><?php echo $value->volume_inGB; ?></td>
                    <td><?php echo $value->price; ?></td>
                    <td><?php echo $value->for_month; ?></td>
                    <td><?php echo $value->for_year; ?></td>
                    <td><?php 
                            if($value->status==0){ 
                              echo 'Active';
                            }else if($value->status==1){ 
                              echo 'Inactive'; 
                            }else if($value->status==-1){
                              echo 'Default'; 
                            }
                        ?>                  
                    </td>
                    <td><a title="Edit" style="cursor: pointer;" onclick="update_plan('<?php echo $value->id; ?>');">Edit</a>
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
      <form action="<?= base_url('addupdate_plan') ?>" method="POST" id="form" name="form">  
        <?= csrf_field() ?>
        <input type="hidden" name="plan_id"  id="plan_id">

        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
               <input type="text" name="subscription" id="subscription" class="form-control" placeholder="Plan" required>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
               <input type="text" name="start_date" id="start_date" class="form-control datepicker" placeholder="Start Date" required>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
               <input type="text" name="end_date" id="end_date" class="form-control datepicker" placeholder="End Date" required>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
               <input type="text" name="volume" id="volume" class="form-control" placeholder="Storage(GB)" required>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
               <input type="text" name="price" id="price" class="form-control" placeholder="Price" required>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
                <select class="form-select" name="month" id="month" required style="color: #000;">
                 <option value="">Month</option>
                  <?php for ($i=0; $i < 21; $i++) {  ?> 
                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                 <?php } ?>
               </select>
                
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group">
               <select class="form-select" name="year" id="year" required style="color: #000;">
                 <option value="">Year</option>
                  <?php for ($i=0; $i < 21; $i++) {  ?> 
                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                 <?php } ?>
               </select>
             </div>
           </div>
            <div class="col-lg-4">
              <div class="form-group"> 
               <select class="form-select" name="status" id="status" required style="color: #000;">
                 <option value="0">Active</option>
                 <option value="1">Inactive</option>
                 <option value="-1">Default</option>
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
$('.datepicker').datepicker({ changeMonth: true,changeYear: true });
function formatDate(dateStr) {
  const date = new Date(dateStr);
  const month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are 0-based
  const day = ('0' + date.getDate()).slice(-2);
  const year = date.getFullYear();
  return `${month}/${day}/${year}`;
}

function update_plan(plan_id){
  $("#ReleasenoteId").modal('show'); 
  $('#releasenote_title').html('Update Plan');
  $('#plan_id').val(plan_id); 

  var parameters = {
    plan_id: plan_id
  }
  $.ajax({ 
    type: "POST",
    url: '<?php echo APIURL; ?>TrickedOutSubscriptionMasterList',         
    data: JSON.stringify(parameters),
    contentType: 'application/json',       
    async: false ,
  }).done(function (data, textStatus, xhr){  
    console.log(data.data[0]);

    $('#subscription').val(data.data[0].subscription);
    $('#start_date').val(formatDate(data.data[0].start_date));
    $('#end_date').val(formatDate(data.data[0].end_date));
    $('#volume').val(data.data[0].volume_inGB);
    $('#price').val(data.data[0].price);
    $('#month').val(data.data[0].for_month);
    $('#year').val(data.data[0].for_year); 
    $('#status').val(data.data[0].status);

  }).fail(function (jqXHR, textStatus, errorThrown){         

  });
}
function add_paln(){
  $("#ReleasenoteId").modal('show');
  $('#releasenote_title').html('Add Plan');
  $('#plan_id').val(''); 
}
 
function close_modal_by_id(modal_id){
  $("#"+modal_id).modal('hide');
}

</script>

