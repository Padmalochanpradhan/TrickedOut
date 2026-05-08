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
.container3 {position: relative;}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.top-left {
  position: absolute;
  top: 10%;
  left: 16px;
  position: absolute;
}
.top-right {
  position: absolute;
  top:18%;
  right: 16px;
}
.gtop-left {
  position: absolute;
  top: 10%;
  left: 16px;
  position: absolute;
}
.gtop-right {
  position: absolute;
  top:10%;
  right: 16px;
}
.gtop-rightb {
  position: absolute;
  top:15%;
  right: 16px;
}
.r-bot-font{font-size:55px;line-height:50px;}
.g-bot-font{font-size:45px;line-height:50px;}
.y-bot-font{font-size:42px;line-height:35px;}
.img-width{width:70px;}
.dis{margin-top:-70px;}
.space_1{height:230px;}

@media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
.r-bot-font{font-size:25px;line-height:24px;}
.g-bot-font{font-size:22px;line-height:20px;}
.y-bot-font{font-size:20px;line-height:10px;}
.dis{margin-top:-30px;}
}

@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
.r-bot-font{font-size:55px;line-height:50px;}
.g-bot-font{font-size:45px;line-height:45px;}
.y-bot-font{font-size:42px;line-height:30px;}
.dis{margin-top:-60px;}
}

@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
.r-bot-font{font-size:25px;line-height:20px;}
.g-bot-font{font-size:22px;line-height:18px;}
.y-bot-font{font-size:18px;line-height:10px;}
.dis{margin-top:-30px;}
}

@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
.r-bot-font{font-size:36px;line-height:28px;}
.g-bot-font{font-size:28px;line-height:22px;}
.y-bot-font{font-size:22px;line-height:10px;}
.dis{margin-top:-60px;}
}

@media only screen and (max-width: 767px) {
.r-bot-font{font-size:47px;line-height:38px;}
.g-bot-font{font-size:45px;line-height:37px;}
.y-bot-font{font-size:38px;line-height:30px;}
.dis{margin-top:-70px;}
}

.desc_wrap {
    word-break: break-word; /* breaks long words */
    white-space: normal;    /* allow wrapping */
}
#example {
    table-layout: fixed;
    width: 100%;
}
#example td,
#example th {
    overflow: hidden;
    text-overflow: ellipsis;
    vertical-align: top;
}
.desc_wrap,
.note_span {
    white-space: normal !important;
    word-break: break-word;
    overflow-wrap: break-word;
}
</style>

<div class="main-panel">
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin">
      <div class="row" style="margin-top:80px;">
        <div class="col-lg-12 mt-3">
          <div style="background:url(<?= base_url('assets/images/bg2.png') ?>);background-size:cover;background-position:top center;position:relative;" class="p-2 text-white">
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
            <div class="space_1"></div>
          </div>
          <div class="mx-4 text-white dis">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="container3">
                <img src="<?= base_url('assets/images/red1.svg') ?>" /  class="img-fluid">
                              <div class="top-left">
                                   <div class="text-white fw-bold mb-0 r-bot-font" style="font-family: GothamMedium!important;">
                        <?php echo count($trickList); ?></div> 
                        <div>Vaulted tricks</div>
                   
              </div>
             <!--  <div class="top-right">
                      <img src="<?= base_url('assets/images/vaulted.svg') ?>" / class="img-width">
                    </div> -->
            </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="<?php echo base_url()?>/UploadTrickStart"  style="color:#fff; text-decoration: none;">
                <div class="container3">
                <img src="<?= base_url('assets/images/green1.svg') ?>" /  class="img-fluid">
                              <div class="gtop-left">
                        
                        <div class="text-white fw-bold mb-0 g-bot-font" style="font-family: GothamMedium!important;">Upload</div> 
                
                        <div style="font-size:20px;">Tricks</div>
                    </div>
              <!-- <div class="gtop-right">
                      <img src="<?= base_url('assets/images/up.svg') ?>" / class="img-width">
                    </div> -->
            </div>
          </a>
             </div>

             <?php if($backstageCount){?>
               <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="<?php echo base_url()?>/TrickBackstage"  style="color:#fff; text-decoration: none;">
                <div class="container3">
                <img src="<?= base_url('assets/images/yellow1.svg') ?>"  class="img-fluid">
                              <div class="gtop-left">
                            <div class="text-white fw-bold y-bot-font mb-0" style="font-family: GothamMedium!important;"><?php echo $backstageCount?></div> 
                                   <div>Backstage</div>
                        <div style="font-size:12px; line-height:10px;">Files yet to be categorized</div>
                    </div>
            <!--   <div class="gtop-rightb">
                      <img src="<?= base_url('assets/images/backstageb.svg') ?>" /  class="img-width">
                    </div> -->
            </div>
              </a>

             </div>
           <?php }?>

              <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 pe-0">
                </div>
            </div>
          </div>

          <div class="mt-5 d-flex flex-wrap justify-content-between">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/category.svg') ?>"  width="30" class="me-2"> Categories</h2></div>
            <div>
             <input class="switch" type="checkbox" checked name="category_show" id="category_show" onclick="categort_show_click();" title="Show/Hide Categories">
            </div>
          </div>

          <div class="row" id="category_list_div_id">
            <?php foreach($trickCategoryList AS $trickCategory){ ?>
              <div class="vault1">
                <div class="container1">
                  <a href="<?php echo base_url()?>/CategoryTricks/<?php echo $trickCategory->id?>">
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
                  </a>
                </div>
                <div class="text-center mb-4" style="color:#58595b;text-align:center;"><?php echo $trickCategory->category_name; ?></div>
              </div>

            <?php } ?> 
          </div> 

          
          <div class="mt-3 d-flex flex-wrap justify-content-between align-items-center">
            <div><h2 style="font-family: GothamMedium!important;"><img src="<?= base_url('assets/images/tricks.svg') ?>"  width="38" class="me-2">All Tricks</h2></div>
            <div style="margin-top:-5px;">
             <div><a href="javascript:void(0);" onclick="all_trick_view_click('all_trick_table_view');">
             <img src="<?= base_url('assets/images/icon1.svg') ?>" alt="logo" style="width:22px;" class="mx-1"></a>   <a href="javascript:void(0)" onclick="all_trick_view_click('all_trick_list_view');"><img src="<?= base_url('assets/images/search.svg') ?>" alt="logo" style="width:22px;"></a>
             </div>
            </div>
          </div>
          <div id="all_trick_table_view" class="all_trick_list">
          <div class="table-responsive">
          <table id="example" class="table table-sm table-responsive" style="width:100%">
              <thead style="background-color:#0076b9;">
                  <tr style="color:#fff!important;">
                       <th style="width:12%">Name</th>
                        <th style="width:18%">Description</th>
                        <th style="width:10%">Category</th>
                        <th style="width:10%">Supplier</th>
                        <th style="width:10%">Artist</th>
                        <th style="width:10%">Date Purchased</th>
                        <th style="width:18%">Note</th>
                        <th style="width:8%">Date Uploaded</th>
                        <th style="width:4%">Favorites</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($trickList AS $trick){?>
                    <tr>
                      <td style="text-align:center"><a href="<?php echo base_url();?>/TricksDetails/<?php echo $trick->id?>"><?php echo $trick->name?></a></td>
                      
                      <td  style="width:15%; text-align:center;" class="desc_wrap" >
<?php if(mb_strlen(strip_tags($trick->description)) > 30){ ?>
    <span class="desc_span_<?php echo $trick->id?>" id="trick_desc_less_<?php echo $trick->id?>">
        <?php echo $trick->short_description; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('desc_span_<?php echo $trick->id?>','trick_desc_more_<?php echo $trick->id?>');">More</a>
    </span>
    <span class="desc_span_<?php echo $trick->id?>  desc_wrap" id="trick_desc_more_<?php echo $trick->id?>" style="display: none;">
        <?php echo $trick->description; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('desc_span_<?php echo $trick->id?>','trick_desc_less_<?php echo $trick->id?>');">Less</a>
    </span>
<?php } else { ?>
    <span class="desc_span"><?php echo $trick->description; ?></span>
<?php } ?>
</td>
                     <td style="text-align:center;"><?php echo $trick->category_name?></td>
                      <td style="text-align:center;"><?php echo $trick->supplier_name?></td>
                     <td style="text-align:center;"><?php echo $trick->artist_name?></td>
                      <!-- <td><?php //echo $trick['']?></td> -->

                      <td style="text-align:center;"><?php if($trick->purchased_date!="0000-00-00" AND $trick->purchased_date!=null){ echo date("m/d/Y", strtotime(substr($trick->purchased_date,0,10)));}?></td>
                      <!-- <td style="text-align:center;">
<?php if(mb_strlen(strip_tags($trick->trick_video_note)) > 45){ ?>
    <span class="note_span_<?php echo $trick->id?>" id="trick_note_less_<?php echo $trick->id?>">
        <?php echo $trick->short_video_note; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('note_span_<?php echo $trick->id?>','trick_note_more_<?php echo $trick->id?>');">More</a>
    </span>
    <span class="note_span_<?php echo $trick->id?>  desc_wrap" id="trick_note_more_<?php echo $trick->id?>" style="display: none;">
        <?php echo $trick->trick_video_note; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('note_span_<?php echo $trick->id?>','trick_note_less_<?php echo $trick->id?>');">Less</a>
    </span>
<?php } else { ?>
    <span class="note_span"><?php echo $trick->trick_video_note; ?></span>
<?php } ?>
                        </td> -->
                        <td  class="desc_wrap" style="width:15%; text-align:center;">
<?php if(mb_strlen(strip_tags($trick->trick_video_note)) > 30){ ?>
    <span class="note_span_<?php echo $trick->id?>" id="trick_note_less_<?php echo $trick->id?>">
        <?php echo $trick->short_video_note; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('note_span_<?php echo $trick->id?>','trick_note_more_<?php echo $trick->id?>');">More</a>
    </span>

    <span class="note_span_<?php echo $trick->id?> desc_wrap" id="trick_note_more_<?php echo $trick->id?>" style="display:none;">
        <?php echo $trick->trick_video_note; ?>
        <a href="javascript:void(0);" onclick="show_more_less_click('note_span_<?php echo $trick->id?>','trick_note_less_<?php echo $trick->id?>');">Less</a>
    </span>
<?php } else { ?>
    <span class="note_span"><?php echo $trick->trick_video_note; ?></span>
<?php } ?>
</td>
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
                <td style="width: 200px!important;height: 200px!important;border-radius: none!important;">
                <div class="list-item">
                  <li class="row">
                  <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12 mt-2">
                    <?php if($trick->featured_image){?>
                    <img src="<?php echo base_url();?>/trick_featured_image/<?php echo $trick->featured_image?>" style="border-radius: none!important;">
                    <?php }else{?>
                    <img src="<?php echo base_url();?>/assets/images/trick1.png" style="border-radius: none!important;">
                    <?php }?>
                  </div>
                  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-2" align="left" >
                    <div>
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
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends --> 
<script type="text/javascript">
    function show_more_less_click(close_class,show_id){
    $("."+close_class).hide();
    $("#"+show_id).show();
  }

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

</script>
