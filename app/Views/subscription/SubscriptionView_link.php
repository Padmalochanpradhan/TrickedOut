<link rel="stylesheet" href="<?= base_url('assets/css/uploadtrick.css') ?>">
<style type="text/css">
  .borderless td, .borderless tr {
    border: none;
  }
  .video-wrapper video {
  width: 100%;
  aspect-ratio: 16 / 9;
  height: auto;
}
.big-font1
{font-size:100px;
font-weight:bold;
}
.centered {
  position: absolute;
  top: 7%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.bottom-left {
  position: absolute;
  bottom:35%;
  left: 34%;
}
.container3
{position:relative;}
.m-magic
{margin-top:80px;}
.bg-backstage
{background-image:url(assets/images/backstage-bg.jpg);background-size: contain;background-repeat:no-repeat;background-color: #fff;}
.rabbit
{margin-top:5%;}
@media (min-width: 768px) and (max-width: 1024px) {
  .m-magic
{margin-top:50px;}
.bg-backstage
{background-image:url(assets/images/backstage-bg-ipad.jpg);background-size: contain;background-repeat:no-repeat;background-color: #fff;}
.rabbit
{margin-top:60px;}
}
</style>
<div class="main-panel bg-backstage">
  <div class="content-wrapper" style="background:rgba(0,0,0,0)!important;background-repeat:no-repeat!important;">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="250"></div>
          <div class="col-lg-12 col-md-12">
            <div class="row"> 
            <div class="text-center " >
<div  class="m-magic"><img src="<?= base_url('assets/images/subscription.svg') ?>" / width="100"></div>
<div class="mt-2 text-white"><h1 style="font-family: GothamMedium!important;">Subscription</h1></div>
         <div class="text-center text-white">Your current plan is active.</div>     
            </div>
              </div>
            </div>
                </div>
                <div class="row rabbit">
                 <?php foreach($subscriptionList AS $subscription){
    //echo "<pre>";print_r($subscription->status);exit;
    $validate_str = "";
    if($subscription->for_year!=0){
        $validate_str = $subscription->for_year. " year";
    }
    if($subscription->for_month!=0){
        $validate_str = $subscription->for_month. " month";
    }
  ?>
          <div class="col-lg-4 mt-3">
          
          <div style="margin-top:70px;" class="mx-4 text-white">

<div class="card" style="width: 18rem;">

    <?php if($subscription->user_subscription_id){?>
    <div  style="position:absolute;right:0;margin-right:-29px;margin-top: 16px;"><img src="<?= base_url('assets/images/active-plan.png') ?>" / width="120" style="transform: rotate(45deg);"></div>

<?php }?>
  <div class="card-body">
    <h5 class="card-title"><?php echo $subscription->subscription?></h5>
    <h6 class="card-subtitle mb-2 text-muted">$<?php echo number_format($subscription->price,2);?> / <?php echo $validate_str?></h6>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $subscription->volume_inGB;?> GB</h6>
    
    <!-- <a href="<?php echo base_url('Payment/'.$subscription->id);?>" class="card-link">Book</a> -->
<?php
$price = $subscription->price;
$price2 = round($subscription->price*100);

$attributes = array( 'name' => 'add_item_in_module', 'role' => 'form', 'method' => 'post');        
echo form_open('payment_submit', $attributes); 
?>
<!--  -->
<input type="hidden"  class="form-control"  name="h_price" id="h_price" value="<?php echo $price; ?>">
<input type="hidden"  class="form-control"  name="subceription_id" id="subceription_id" value="<?php echo $subscription->id; ?>">
    <?php if($subscription->status == -1){?>
        <span style="font-size: 24px;color: #296e01;">Free Plan</span>
    <?php }else if($subscription->user_subscription_id){?>
        <h6 style="color:#0000FF;">Current Plan</h6>
    <?php }else{?>
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo "pk_test_BQJ0GBhYhbWzIk94znYGWOl2"; ?>"
data-amount="<?php echo $price2;?>"  data-currency="USD"  data-description="Payment for Trick-out($<?php echo $price;?> per year)" data-label="Pay  $<?php echo $price;?> per <?php echo $validate_str?>"  data-image="<?php echo base_url();?>/assets/images/logo-mini.png" ></script>
<?php }?>
</form> 
    <!-- <a href="#" class="card-link">Another link</a> -->
  </div>
</div>
        </div>
      </div>

  <?php }?>       
                  

                </div>
            

          


  </div>

      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- content-wrapper ends -->

<!-- Modal for trick info data ----- -->
 


