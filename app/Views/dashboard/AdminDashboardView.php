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
  margin-right:5%!important;
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
</style>
<div class="main-panel">
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
 
      <div class="row" style="margin-top:80px;">
        <div class="col-lg-12 mt-3">
          <div style="background:url(assets/images/bg2.png);background-size:cover" class="p-2 text-white">
            <div class="p-4">
              <div class="float-start">
              <div class="d-flex align-items-center">
                  <div><img src="<?= base_url('assets/images/magic.svg') ?>" / width="70"></div>
               <div class="ms-2"><h1 class="text-white fw-bold" style="font-family: GothamMedium!important;"> My Magic </h1>
               <div style="font-weight:100;margin-top:-10px;"><h1>Vault</h1></div>
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
          <div style="margin-top:-70px;" class="mx-4 text-white">
            <div class="row">
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="float-left grad1 p-2">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-1">
                      <div class="text-white fw-bold mb-0" style="font-size:50px;line-height:55px;font-family: GothamMedium!important;""><?php echo count($trickList); ?></div> <div>Current tricks</div>
                    </div>
                    <div>
                      <img width="70" src="<?= base_url('assets/images/current.svg') ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="float-left grad2 p-2">
                  <a href="<?php echo base_url()?>/UploadTrick"  style="color:#fff; text-decoration: none;">
                  <div class="d-flex justify-content-between">
                    <div class="mb-1">
                      <h1 class="text-white fw-bold mb-0" style="font-family: GothamMedium!important;">Upload</h1> <span style="font-size:24px;">a Trick</span>
                    </div>
                    <div>
                      <img src="<?= base_url('assets/images/up.svg') ?>" width="100" style="margin-top:-30px;"> 
                    </div>
                  </div>
                </a>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pe-0">
                
              </div>
            </div>
          </div>
<form action="<?= base_url('Dashboard') ?>" method="POST" enctype="multipart/form-data" id="dashboardsearch" name="dashboardsearch">  
                  <?= csrf_field() ?>
          <div class="row mt-5"> 
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
                <input type="text" name="name" class="form-control form-bg ht"  placeholder="Trick Name"  style="color:#000!important;" value="<?php echo $name?>">
              </div> 
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
                <input type="text" name="artist" class="form-control form-bg ht"  placeholder="Artist"  style="color:#000!important;" value="<?php echo $artist?>">
              </div> 
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
                <select class="form-select form-bg ht" aria-label="Large select example"  name="user" id="user" onchange="changeColor('user');" <?php if($selected_user){?>  style="color:#000!important;"<?php }?>>
                        <option value="">User</option>
                        <?php foreach($userList AS $user){?>
                          <option value="<?php echo $user->employee_id?>" style="color:#000!important;" <?php if($user->employee_id == $selected_user){?> selected<?php }?>><?php echo $user->first_name." ".$user->last_name?></option>
                        <?php }?>
                </select>
              </div> 
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
                <select class="form-select form-bg ht" aria-label="Large select example"  name="catagory" id="catagory" onchange="changeColor('catagory');" <?php if($selected_catagory){?>  style="color:#000!important;"<?php }?>>
                        <option value="">Category</option>
                        <?php foreach($trickCategoryList AS $Category){?>
                          <option value="<?php echo $Category->id?>" style="color:#000!important;" <?php if($Category->id ==$selected_catagory){?> selected<?php }?>><?php echo $Category->category_name?></option>
                        <?php }?>
                </select>
              </div>               
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
                <select class="form-select form-bg ht" aria-label="Large select example" name="supplier" id="supplier" onchange="changeColor('supplier');" <?php if($selected_supplier){?>  style="color:#000!important;"<?php }?>>
                  <option value="">Supplier</option>
                  <?php foreach($supplierList AS $supplier){?>
                    <option value="<?php echo $supplier->id?>" style="color:#000!important;" <?php if($supplier->id ==$selected_supplier){?> selected<?php }?>><?php echo $supplier->name?></option>
                  <?php }?>
                </select>
              </div> 
              <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0">
              </div>
              <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0 mt-3">Upload Date From
              </div>
              <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0 mt-3">
                <!-- <div class="form-bg ht">
                  <div id="datepicker-popup" class="input-group date datepicker">
                    <input type="text" class="form-control"   placeholder="Uploaded From" style="background-color:transparent;height:45px;border:none;color:#000!important;font-size:20px!important;" name="uploaded_date_from" id="uploaded_date_from">
                    <span class="input-group-addon input-group-append border-left px-2 pt-1">
                    <img src="<?= base_url('assets/images/calender.svg') ?>" alt="logo" width="20" class="ms-1">
                    </span>
                  </div> 
                </div> -->
                <!-- <input type="date" class="form-control form-bg"   placeholder="Uploaded From" style="background-color:transparent;height:45px;border:none;color:#000!important;font-size:20px!important;" name="uploaded_date_from" id="uploaded_date_from"> -->
                 <input type="date" name="uploaded_date_from" class="form-control form-bg ht" placeholder="Uploaded From"  style="color:#000!important;" id="uploaded_date_from" value="<?php echo $uploaded_date_from?>"> 
                <!--<input type="date" name="uploaded_date_from" class="form-control form-bg ht" value="2023-09-23">-->
              </div> 
             <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 pe-0 mt-3" style="text-align:center;"> To
             </div>
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0 mt-3">
                <!-- <div class="form-bg ht">
                  <div id="datepicker-popup-2" class="input-group date datepicker">
                    <input type="text" class="form-control"   placeholder="Uploaded To" style="background-color:transparent;height:45px;border:none;color:#000!important;font-size:20px!important;" name="uploaded_date_to" id="uploaded_date_to">
                    <span class="input-group-addon input-group-append border-left px-2 pt-1">
                    <img src="<?= base_url('assets/images/calender.svg') ?>" alt="logo" width="20" class="ms-1">
                    </span>
                  </div> 
                </div> --> 
                <input type="date" name="uploaded_date_to" class="form-control form-bg ht"  placeholder="Uploaded To"  style="color:#000!important;" id="uploaded_date_to" value="<?php echo $uploaded_date_to?>">
              </div> 
             <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 pe-0 mt-3">
                <button type="submit" name="search" value="Search" class="btn btn-primary">Search</button>
              </div> 
          </div>
</form>
          <div class="mt-5 d-flex flex-wrap justify-content-between">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/category.svg') ?>"  width="30" class="me-2"> Categories</h2></div>
            <div>
             <input class="switch" type="checkbox" checked name="category_show" id="category_show" onclick="categort_show_click();">
			      </div>
          </div>

          <div class="row" id="category_list_div_id">
            <?php foreach($trickCategoryList AS $trickCategory){ ?>
              <div class="vault1">
                <div class="container1">
                  <!-- <a href="<?php echo base_url()?>/CategoryTricks/<?php echo $trickCategory->id?>"> -->
                    <?php if($trickCategory->category_icon){?>
                      <img src="<?= base_url('trick_categary_image/'.$trickCategory->category_icon) ?>" class="img_style_vault">
                     <?php }else{ ?>
                    <img src="<?= base_url('assets/images/1.jpg') ?>" class="img_style_vault">
                     <?php } ?> 
                    <div class="top-right">
                      <?php if($trickCategory->trick_count){ ?>
                      <span class="notify-badge"><?php echo $trickCategory->trick_count; ?></span>
                      <?php } ?> 
                    </div>
                  <!-- </a> -->
                </div>
                <div class="text-center mb-4" style="color:#58595b;text-align:center;"><?php echo $trickCategory->category_name; ?></div>
              </div>

            <?php } ?> 
          </div> 



          
          <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/tricks.svg') ?>"  width="38" class="me-2">All Tricks</h2></div>
            <div style="margin-top:-5px;">
             <div><a href="javascript:void(0);" onclick="all_trick_view_click('all_trick_table_view');"><img src="<?= base_url('assets/images/icon1.svg') ?>" alt="logo" style="width:22px;" class="mx-1"></a>   <a href="javascript:void(0)" onclick="all_trick_view_click('all_trick_list_view');"><img src="<?= base_url('assets/images/icon2.svg') ?>" alt="logo" style="width:22px;"></a>
             </div>
            </div>
          </div>
          <div id="all_trick_table_view" class="all_trick_list">
          <table id="example" class="table table-sm table-responsive" style="width:100%">
              <thead style="background-color:#0076b9;">
                  <tr style="color:#fff!important;">
                       <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Name</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Description</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Category</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Supplier</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Artist</th>
                        <!-- <th>Media Type</th> -->
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Date Purchased</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Date Uploaded</th>
                        <th style="font-size:12px!important;font-weight:lighter!important;text-align:center!important;">Favorites</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($trickList AS $trick){?>
                    <tr>
                      <td style="text-align:center"><a href="<?php echo base_url();?>/TricksDetails/<?php echo $trick->id?>"><?php echo $trick->name?></a></td>
                      <td style="text-align:center;"><?php echo wordwrap($trick->description,50,"<br>\n"); ?></td>
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
                <tr><td style="width: 200px!important;
     height: 200px!important;border-radius: none!important;">
                <li class="list-item">
                  
                  <div class="row">
                  <div class="col-lg-2 mt-2">
                    <?php if($trick->featured_image){?>
                    <img src="<?php echo base_url();?>/trick_featured_image/<?php echo $trick->featured_image?>" width="200" style="border-radius: none!important;">
                    <?php }else{?>
                    <img src="<?php echo base_url();?>/assets/images/trick1.png" width="200" style="border-radius: none!important;">
                    <?php }?>
                  </div>
                  <div class="col-lg-3 mt-2" align="left" >
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
                  <div class="col-lg-7 mt-2" style="text-align: left;">
                      <span>Description:</span> <?php echo wordwrap($trick->description,80,"<br>\n"); ?> <br>
                  </div>
                </div>

                    
                    
                    
                    
                    
                    
                </li>
              </td></tr>
              <?php } ?>
            </tbody>
          </table>
            </ul>
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends --> 
<script type="text/javascript">
  function all_trick_view_click(div_id){
    $(".all_trick_list").hide();
    $("#"+div_id).show();
  }
  function categort_show_click(){
    $("#category_list_div_id").toggle();
  }
  $(document).ready(function() {
    //alert(1);
    $('#trick_list_view').DataTable({
      language: { search: "" },
    });
  });
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

</script>
