
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
  {margin-top:95px;}
  .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .rabbit
  {margin-top:5%;}
  @media (min-width: 768px) and (max-width: 1024px) {
    .m-magic
    {margin-top:50px;}
    .bg-backstage
    {background-image:url(assets/images/backstage.jpg);background-size: cover;background-repeat:no-repeat;background-color: #fff;background-position: top center;}
    .rabbit
    {margin-top:60px;}
  }

    .pricing-toggle {
      background: #e9ecef;
      border-radius: 30px;
      padding: 4px;
      display: inline-flex;
      gap: 4px;
      z-index: 99999;
      position: relative;
    }

    .pricing-toggle button {
      border-radius: 25px;
      padding: 6px 18px;
      border: none;
      background: transparent;
      font-weight: 600;
    }

    .pricing-toggle .active {
      background: #8dc63f;
      color: #fff;
    }

 /*   .pricing-card {
      background: #fff;
      border-radius: 6px;
      padding: 24px;
      height: 100%;
      box-shadow: 0 0 0 1px #e0e0e0;
    }

    .pricing-card h5 {
      font-weight: 700;
    }
*/
    .price1 {
      font-size: 28px;
      font-weight: 700;
    }

    .app-icons img {
      width: 26px;
      margin-right: 6px;
    }

    .badge-offer {
      background: #ffc107;
      color: #000;
      font-weight: 600;
      font-size: 12px;
    }
/*   .pricing-card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      height: 100%;
    }
*/
    .price1 {
      font-size: 1.5rem;
      font-weight: 600;
    }

    .old-price {
      text-decoration: line-through;
      color: #6c757d;
      font-size: 1rem;
    }

    .feature-list li {
      margin-bottom: 8px;
      font-size: 0.95rem;
    }

    .badge-offer {
      background-color: #ffb900;
      color: #000;
      font-size: 0.75rem;
      padding: 4px 8px;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 8px;
    }

    .toggle-btn .btn {
      min-width: 120px;
    }  
    .sub_box{border: 2px dashed #dc3545;}
    .logo_subs{position:absolute;width:160px;margin-left:160px;margin-top:0px;}
    .active-ribbon {
  position: absolute;
  top: 0px;
  right: -90px;        /* pushes ribbon to corner */
  width: 140px;
  transform: rotate(45deg);
  z-index: 9999;
}
    .toggle-btn .btn {
    min-width: 120px;
    }
    .sub_box{
        border: 2px dashed #dc3545;
        position: relative; /* REQUIRED */
        overflow: hidden;   /* hides ribbon overflow */
   }
    .top-right1{ 
    position:absolute; 
    right:10px;
    top:25px;}
   .img-box {
  position: relative;
 

}

.img-box img {
  width: 100%;
  display: block;
}

.text {
  position: absolute;
 }

/* Center */
.center {
  top: 65%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Top */
.top {
  top: 10px;
  left: 50%;
  transform: translateX(-50%);
}

/* Bottom */
.bottom {
  bottom: 10px;
  left: 50%;
  transform: translateX(-50%);
}

/* Left */
.left {
  top: 50%;
  left: 10px;
  transform: translateY(-50%);
}

/* Right */
.right {
  top: 50%;
  right: 10px;
  transform: translateY(-50%);
}
.signup_bot{padding:10px;margin-top:5px;font-size:24px;font-weight: 500;width:170px;border-radius:20px;text-align: center;color:#fff}
.f-10{font-size:48px;margin-top:-20%;position: relative;z-index: 1}
.text_g{color:#8dc63f;margin-top:-3%;position: relative;z-index: 1}
.fs-7{font-size: 1.2rem;font-weight: 500;}
.blank1{margin-top:70px;}
.h_text{font-size: 60px;}
.gb_space{font-size:42px}
.tick_cloud{margin-top: -2%;}

.subscription-upgrade{
  width: 35%;
}
@media all and (device-width: 1024px) and (device-height: 1366px) and (orientation:portrait) {
    .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .ipad-portrait { color: red; } /* your css rules for ipad portrait */
.h_text{font-size: 40px;}
.f-10{font-size:30px;margin-top:-18%}
.text_g {font-size: 18px;}
.gb_space{font-size:26px}
.tick_cloud{margin-top: -2%;}
.price1{font-size:1.5rem;}
.f-10{font-size:20px;}
.fs-7{font-size:1rem;}
.subscription-upgrade{
  width: 65%;
}
}
@media all and (device-width: 1366px) and (device-height: 1024px) and (orientation:landscape) {
    .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .ipad-landscape { color: blue; } /* your css rules for ipad landscape */
   .h_text{font-size: 40px;}
   .f-10{font-size:36px;margin-top:-22%}
   .text_g {font-size: 20px;}
   .f-7{font-size: .7rem;}
   .price1{font-size: 1.5rem;}
   .f-10{font-size: 36px;}
   .tick_cloud{margin-top:-2%;}
   .fs-7{font-size: 1rem;}
    .m-magic
  {margin-top:70px;}
  .subscription-upgrade{
  width: 50%;
}
}
@media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
    .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .ipad-portrait { color: red; } /* your css rules for ipad portrait */
.h_text{font-size: 90px;}
.f-10{font-size:80px;margin-top:-18%}
.text_g {font-size: 30px;}
.gb_space{font-size:56px}
.tick_cloud{margin-top: -2%;}
.price1{font-size:3rem;}
.f-10{font-size:80px;}
.fs-7{font-size:2rem;}
.signup_bot{width: 150px;}
  .subscription-upgrade{
  width: 65%;
}
}
@media all and (device-width: 1024px) and (device-height: 768px) and (orientation:landscape) {
    .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .ipad-landscape { color: blue; } /* your css rules for ipad landscape */
   .h_text{font-size: 40px;}
   .f-10{font-size:36px;margin-top:-22%}
   .text_g {font-size: 16px;}
   .f-7{font-size: .7rem;}
   .price1{font-size: 1.5rem;}
   .f-10{font-size: 20px;}
   .tick_cloud{margin-top:-2%;}
   .fs-7{font-size: 1rem;}
    .m-magic
  {margin-top:75px;}
    .subscription-upgrade{
  width: 50%;
}
}
@media only screen and (max-width: 767px) {
   .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
.logo1{width:120px;}
.vault1{width:30px;}
.rabbit{width:90px;}
.head-text-body{font-weight: 500;;letter-spacing:0px;font-size:2rem;}
.head{padding: 90px 0px;}
.head-text {font-size:30px;letter-spacing:0px;}
.head-text-sm{font-size:16px;letter-spacing:0px;}
.learn1{border:2 px solid #fff;letter-spacing: 0px;font-size:16px; padding-left:60px; padding-right:60px;}
.learn{border:2 px solid #fff;letter-spacing: 0px;font-size:16px; padding-left:30px; padding-right:30px;}
.light-font{ font-weight:200;}
.f-font{ont-size:22px;}
.img-accord{width:300px;}
.video-container {
    max-width: 100%;
    aspect-ratio: 16 / 9;   /* keeps correct ratio */
    }
    .copy-font
   { text-align:center;}
   .f_contact{padding:0px 0px;}
    .blank1{margin-top:50px;}
     .h_text{font-size: 60px;}
     .f-10{font-size:36px;margin-top:-18%;}
     .text_g {font-size: 30px;}
.signup_bot{width: 150px;}
  .subscription-upgrade{
  width: 99%;
}
}
.form-control{
  color: #000!important;
}

.spinner {
  width: 18px;
  height: 18px;
  border: 3px solid #fff;
  border-top: 3px solid transparent;
  border-radius: 50%;
  display: inline-block;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}


</style>
<div class="main-panel ">
  

        <div class="row bg-backstage">
          <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="150"></div>
          <div class="col-lg-12 col-md-12">
            <div class="row"> 
            <div class="text-center my-5" >
<div  class=""><img src="<?= base_url('assets/images/subscription.svg') ?>" / width="100"></div>
<div class="mt-2 text-white"><h1 style="font-family: GothamMedium!important;">Upgrade Subscription</h1></div>
              
            </div>
              </div>
            </div>
                </div>

<div class="content-wrapper" style="background:rgba(0,0,0,0)!important;background-repeat:no-repeat!important;">


                <div class="row mb-5 " >
                  <div align="center">
<?php foreach ($subscriptionList as $plan): 
  //echo $_POST['product_price_id'];

    if ($plan['price_id']==$_POST['product_price_id']):
      //echo "<pre>";print_r($plan);exit;
        $price = $plan['amount'];
        $baseName = trim(str_ireplace(['- Monthly', '- Annual', '- Yearly'], '', $plan['product_name']));
        
  ?> 
<div class="subscription-upgrade ">
          <div class="img-box pricing-card">    
 <img src="<?= base_url('assets/images/'.$plan['bg_image']) ?>" class="img-fluid">
  <div class="text center text-white fst-italic fw-bold h_text"><?= esc($baseName) ?></div>
     </div>
     <div class="text-center">
        
<div class="price fw-bold f-10 price-div">

 
    $<?= number_format($amount_due, 2) ?>
    <span class="fs-7">/<?= $plan['interval']?></span>

  

</div>

       <h5 class="text_g fst-italic">Next billing period </h5>
        <h6 class="fw-bold"><?= $period_start ?> - <?= $period_end ?></h6>

      <div class="price alt-buy">

        

      </div>
    <div class="my-1"><?= $plan['product_description'] ?></div>
  <div class="price1" >
    <div class="d-flex align-items-center justify-content-center">
        <div class="tick_cloud"> <img src="<?= base_url('assets/images/tick.png') ?>" class="img-fluid" width="30"></div>
        <?php
          $volumeGB = (int) $plan['volume'];

          if ($volumeGB >= 1024) {
              $volumeText = ($volumeGB / 1024) . '';
              $volumeMeasurText = 'TB';
          } else {
              $volumeText = $volumeGB . '';
              $volumeMeasurText = 'GB';
          }
          ?>
          <div class="fst-italic gb_space"><?= esc($volumeText) ?><span class="fs-7"><?= esc($volumeMeasurText) ?></span></div>
    </div>
  </div>
        <div class="fst-italic tick_cloud">cloud storage</div>

        
<div class="text-center">

<?= form_open('subscriptionUpgrade', ['id' => 'promoForm']) ?>

<input type="hidden" name="product_price_id" value="<?= esc($plan['price_id']) ?>">

<!-- 🔗 Promo toggle -->
<a href="javascript:void(0)"
   id="togglePromoLink"
   class="text-decoration-underline text-primary">
   Have a promo code?
</a>

<!-- 🎯 Promo message -->
<?php if (!empty($promoMessage)) : ?>
  <div class="mt-2 alert <?= $promoSuccess ? 'alert-success' : 'alert-danger' ?> d-inline-flex align-items-center gap-2">
    <span style="font-size:18px;">
      <?= $promoSuccess ? '✔️' : '❌' ?>
    </span>
    <span><?= esc($promoMessage) ?></span>
  </div>
<?php endif; ?>

<!-- 🎟 Promo box -->
<div id="promoBox" class="mt-2 d-none">
  <div class="d-flex justify-content-center gap-2 mb-2">

    <input type="text"
           name="promo_code"
           class="form-control text-center"
           placeholder="Enter promo code"
           value="<?= isset($_POST['promo_code']) ? esc($_POST['promo_code']) : '' ?>"
           style="max-width:180px;height:40px;border:1px solid #ccc;border-radius:5px;">

    <button type="submit"
            id="applyPromoBtn"
            style="background-color:#8dc63f;height:40px;color:#fff;border:none;border-radius:5px;">
      <span class="btn-text">Apply</span>
      <span class="spinner d-none"></span>
    </button>

  </div>
</div>

</form>
</div>

    <div align="center">

<!-- BUY -->
<?php
$attributes = array( 'name' => 'add_item_in_module', 'role' => 'form', 'method' => 'post');        
echo form_open('upgradeSubscriptionCheckout', $attributes); 
?>
<input type="hidden" name="product_price_id" value="<?= esc($plan['price_id']) ?>">
<input type="hidden" name="promo_code" value="<?= isset($_POST['promo_code']) ? esc($_POST['promo_code']) : '' ?>">

<div style="float:left;"> 
  <button class="btn signup_bot  buy-btn" type="submit" style="background-color:<?= esc($plan['button_color']) ?>;" id="upgradeBtn">
  <span class="btn-text">Upgrade</span>
  <span class="spinner d-none"></span>
</button>
</div>
<div style="float:right;">
<button class="btn btn-secondary signup_bot buy-btn" type="button" data-href="<?= base_url('Subscription'); ?>" id="cancelBtn">
    <span class="btn-text">Cancel</span>
  <span class="spinner d-none"></span>
</button>
</div>
</form>


 </div>
     </div>
  </div>

<?php endif; ?>
 <?php endforeach; ?>      
                  
</div>
                </div>
            </div>

          




  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- content-wrapper ends -->

<!-- Modal for trick info data ----- -->
 
<script>
document.getElementById('showPromoLink')?.addEventListener('click', function () {
    document.getElementById('promoBox').classList.remove('d-none');
    this.style.display = 'none';
});
document.getElementById('togglePromoLink').addEventListener('click', function () {
  const promoBox = document.getElementById('promoBox');

  promoBox.classList.toggle('d-none');
  this.innerText = promoBox.classList.contains('d-none')
    ? 'Have a promo code?'
    : 'Hide promo code';
});

document.getElementById('promoForm').addEventListener('submit', function () {
  const btn = document.getElementById('applyPromoBtn');
  btn.disabled = true;
  btn.querySelector('.btn-text').classList.add('d-none');
  btn.querySelector('.spinner').classList.remove('d-none');
});

/*  Upgrade button loader */
const upgradeBtn = document.getElementById('upgradeBtn');

if (upgradeBtn) {
  const form = upgradeBtn.closest('form');

  form.addEventListener('submit', function () {
    upgradeBtn.disabled = true;
    upgradeBtn.querySelector('.btn-text').classList.add('d-none');
    upgradeBtn.querySelector('.spinner').classList.remove('d-none');
  });
}
/*  Cancel button loader + redirect */
document.getElementById('cancelBtn')?.addEventListener('click', function () {
  this.disabled = true;
  this.querySelector('.btn-text').classList.add('d-none');
  this.querySelector('.spinner').classList.remove('d-none');

  const redirectUrl = this.getAttribute('data-href');

  setTimeout(() => {
    window.location.href = redirectUrl;
  }, 300); // small delay so spinner is visible
});
</script>

