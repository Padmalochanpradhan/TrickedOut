<style>
/* @font-face { font-family: Gotham; src: url("../fonts/Gotham-Book.woff") format("woff"), url("../fonts/Gotham-Book.woff2") format("woff2"), url("../fonts/Gotham-Book.ttf") format("truetype"); font-weight: normal; }
@font-face { font-family: GothamBold; src: url("../fonts/Gotham-Bold.ttf") format("truetype"); }
@font-face { font-family: GothamMedium; src: url("../fonts/Gotham-Medium.ttf") format("truetype"); }*/
body
{
font-family:"Gotham"!important;
}
.form-control {
color: #dedede!important;
font-family:"Gotham"!important;
}
</style>
<div class="main-panel">
<div class="content-wrapper">
  <div class="row" style="margin-top:80px;">
          <a href="<?php echo base_url();?>/MyVault" style="text-decoration:none;cursor: pointer;">
            <div class=" text-info">
              <img src="<?php echo base_url();?>/assets/images/backbotton.svg" width="6"> back
            </div>
          </a>
    <div class="col-md-12 grid-margin" style="margin-top: -12px;">
      <div class="row">
        <div class="col-lg-12 mt-3">
          <div class=" text-white top_img" style="background:url(<?php echo base_url();?>/trick_categary_image_banner/<?php echo $trickCategoryDetails[0]->category_banner?>);background-size:cover;background-position:center;">
            <div class="fw-bold text1" style="font-family: GothamMedium!important;"><?php echo $trickCategoryDetails[0]->category_name?></div>
          </div> 

        <div class="col-lg-12 col-md-12" style="margin-top:35px;">
           <div class="row px-3">
            <?php foreach($trickList AS $trick){ ?>
           <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6">
           <a href="<?php echo base_url();?>/TricksDetails/<?php echo $category?>/<?php echo $trick->id; ?>" class="text-dark" style="text-decoration:none;">

            <div class="text-center">
            <div class="back_img2 mb-2 pb-3">
                         <div>
<?php if($trick->featured_image){ ?>
                
                <img src="<?php echo base_url();?>/trick_featured_image/<?php echo $trick->featured_image; ?>"  class="img_style">
              
              <?php }else{ ?>
                <img src="<?php echo base_url();?>/trick_default_icon/<?php echo $trick->trick_default_icon; ?>" width="100%" class="img_style">
              <?php } ?>

             </div>
               
            </div>
            </div>
            <div class="mt-2" style="color:#58595b;text-align:center;"><?php echo $trick->name; ?></div></a>
            </div>
            <?php } ?> 
            <?php if(count($trickList)==0){?>
                    <h3 style="text-align: center;">No tricks available under this category.</h3>
            <?php }?>            
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- content-wrapper ends -->

