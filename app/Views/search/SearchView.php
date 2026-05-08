<style>
th
{color:#fff!important;}
td, th
{text-align:center;}
#trick_list_view td img, .jsgrid .jsgrid-table td img {
     width: 100%!important;
     height: auto!important;
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
  margin-right:60px!important;
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
.text5
{font-size:12px!important;font-weight:lighter!important;text-align:center!important;}
.myword{word-wrap:break-word;white-space:normal;text-align:left;font-weight:normal;}
</style>
<div class="main-panel">
<div class="content-wrapper">
  <div class="row mt-5">
    <div class="col-md-12 grid-margin">
      <div class="row mt-4">
        <div class="col-lg-12 mt-3">
          
          
          <?php if(count($trickList)){?>
          
        <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/tricks.svg') ?>"  width="38" class="me-2">All Tricks</h2></div>
            <div style="margin-top:-5px;">
             <div><a href="javascript:void(0);" onclick="all_trick_view_click('all_trick_table_view');"><img src="<?= base_url('assets/images/icon1.svg') ?>" alt="logo" style="width:22px;" class="mx-1"></a>   <a href="javascript:void(0)" onclick="all_trick_view_click('all_trick_list_view');"><img src="<?= base_url('assets/images/icon2.svg') ?>" alt="logo" style="width:22px;"></a>
             </div>
            </div>
          </div>
          <div id="all_trick_table_view" class="all_trick_list">
          <div class="table-responsive">
          <table id="example" class="table table-sm table-responsive" style="width:100%">
              <thead style="background-color:#0076b9;">
                  <tr style="color:#fff!important;">
                       <th class="text5">Name</th>
                        <th class="text5">Description</th>
                        <th class="text5">Category</th>
                        <th class="text5">Supplier</th>
                        <th class="text5">Artist</th>
                        <!-- <th>Media Type</th> -->
                        <th class="text5">Date Purchased</th>
                        <th class="text5">Date Uploaded</th>
                        <th class="text5">Favorites</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($trickList AS $trick){?>
                    <tr>
                      <td style="text-align:center"><a href="<?php echo base_url();?>/TricksDetails/<?php echo $trick->id?>"><?php echo $trick->name?></a></td>
                      <td style="text-align:center;"><?php if(strlen($trick->description)>45){?>
                        <span class="desc_span_<?php echo $trick->id?>" id="trick_desc_less_<?php echo $trick->id?>"><?php echo substr($trick->description,0,45); ?>... <a href="javascript:void(0);" onclick="show_more_less_click('desc_span_<?php echo $trick->id?>','trick_desc_more_<?php echo $trick->id?>');">More</a></span>
                        <span class="desc_span_<?php echo $trick->id?>" id="trick_desc_more_<?php echo $trick->id?>" style="display: none;"><?php echo wordwrap($trick->description,45,"<br>\n"); ?><a href="javascript:void(0);" onclick="show_more_less_click('desc_span_<?php echo $trick->id?>','trick_desc_less_<?php echo $trick->id?>');">Less</a></span>
                      <?php }else{?>
                        <span class="desc_span" ><?php echo $trick->description; ?></span>
                      <?php }?></td>
                     <td style="text-align:center;"><?php echo $trick->category_name?></td>
                      <td style="text-align:center;"><?php echo $trick->supplier_name?></td>
                     <td style="text-align:center;"><?php echo $trick->artist_name?></td>
                      <!-- <td><?php //echo $trick['']?></td> -->

                      <td style="text-align:center;"><?php if($trick->purchased_date!="0000-00-00"){ echo date("m/d/Y", strtotime(substr($trick->purchased_date,0,10)));}?></td>
                         <td style="text-align:center;"><?php echo date("m/d/Y", strtotime($trick->added_on))?></td>  
                        <td style="text-align: center;"><?php if($trick->favorite_flag){?><img src="<?= base_url('assets/images/tick.svg') ?>" style="width:20px;"> <?php }?></td> 
                    </tr>
                  <?php } ?>
              </tbody>
          </table>
          </div>
          </div>
<div id="all_trick_list_view" class="all_trick_list" style="display:none;">
            <ul class="list-view">
              <table id="trick_list_view" class="table table-sm table-responsive" style="width:100%">
                <thead>
                  <tr><th>Trick</th></tr>
                </thead>
                <tbody>
              <?php foreach($trickList AS $trick){
                $featured_image_path = base_url()."/trick_featured_image/".$trick->featured_image;
                ?>
                <tr>
                <td style="width: 200px!important;
     height: 200px!important;border-radius: none!important;">
                <li class="list-item">
                  
                  <div class="row">
                  <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-2">
                    <?php if($trick->featured_image){?>
                    <img src="<?php echo base_url();?>/trick_featured_image/<?php echo $trick->featured_image?>" width="200" style="border-radius: none!important;">
                    <?php }else{?>
                    <img src="<?php echo base_url();?>/assets/images/trick1.png" width="200" style="border-radius: none!important;">
                    <?php }?>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-2" align="left" >
                    <div class="ps-2">
                    <span>Name:</span> <a href="<?php echo base_url();?>/TricksDetails/<?php echo $trick->id?>"><?php echo $trick->name?></a> <br>
                    <span>Categoary:</span> <?php echo $trick->category_name?><br>
                    <span>Artist:</span> <?php echo $trick->artist_name?><br>
                    <span>Supplier:</span> <?php echo $trick->supplier_name?><br>
                    <span>Date Purchased:</span> <?php if($trick->purchased_date!="0000-00-00"){ echo date("m/d/Y", strtotime(substr($trick->purchased_date,0,10)));}?><br>
                    <span>Date Uploaded:</span> <?php echo date("m/d/Y", strtotime($trick->added_on))?><br>
                    <span>Favorite:</span> <?php if($trick->favorite_flag){?><i class="fa fa-check" style="color: green;" aria-hidden="true"></i> <?php }?>
                  </div>
                  </div>
                  <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 mt-2" style="text-align: left;">
                      <div class="myword"><span>Description:</span> <?php echo $trick->description;//wordwrap(,80,"<br>\n"); ?></div>
                  </div>
                </div>

                    
                    
                    
                    
                    
                    
                </li>
              </td></tr>
              <?php } ?>
            </tbody>
          </table>
            </ul>
          </div>


        <?php }elseif(isset($search_input) AND $search_input!=""){?>

          <h4 align="center" class="mt-5">No tricks found for '<?php echo $search_input?>'.</h4>
        <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->
<script>
    function show_more_less_click(close_class,show_id){
    $("."+close_class).hide();
    $("#"+show_id).show();
  }
  
  $(document).ready(function() {
      $('#all_trick_list').DataTable();
  });
  function all_trick_view_click(div_id){
    $(".all_trick_list").hide();
    $("#"+div_id).show();
  }
    $(document).ready(function() {
    //alert(1);
  $('#trick_list_view').DataTable({
    language: { search: "" },
});
});
</script>
