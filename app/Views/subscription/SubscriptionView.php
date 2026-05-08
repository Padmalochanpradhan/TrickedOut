<?php

$plans = [];

foreach ($subscriptionList as $item) {

    // Normalize plan name (Legacy - Monthly → Legacy)
    $baseName = trim(
        str_ireplace(['- Monthly', '- Annual', '- Yearly'], '', $item['product_name'])
    );

    if (!isset($plans[$baseName])) {
        $plans[$baseName] = [
            'name'            => $baseName,
            'description'     => $item['product_description'] ?? '',
            'bg_image'        => $item['bg_image'] ?? '',
            'button_color'    => $item['button_color'] ?? '',
            'monthly'         => null,
            'yearly'          => null,
            'is_current'      => false,
            'current_type'    => null,   // month | year
            'subscription_id' => null,   // Stripe sub_xxx
            'volume'          => $item['volume'] ?? ''
        ];
    }

    /** MONTHLY */
    if ($item['interval'] === 'month') {
        $plans[$baseName]['monthly'] = $item;

        if ($item['price_id'] === $currentPriceId) {
            $plans[$baseName]['is_current']      = true;
            $plans[$baseName]['current_type']    = 'month';
            $plans[$baseName]['subscription_id'] = $stripeSubscriptionId;
        }
    }

    /** YEARLY */
    if ($item['interval'] === 'year') {
        $plans[$baseName]['yearly'] = $item;

        if ($item['price_id'] === $currentPriceId) {
            $plans[$baseName]['is_current']      = true;
            $plans[$baseName]['current_type']    = 'year';
            $plans[$baseName]['subscription_id'] = $stripeSubscriptionId;
        }
    }
}

/**
 * Sort order: Prestige → Mastery → Legacy
 */
$planOrder = [
    'Prestige' => 1,
    'Mastery'  => 2,
    'Legacy'   => 3,
];

uksort($plans, function ($a, $b) use ($planOrder) {
    return ($planOrder[$a] ?? 999) <=> ($planOrder[$b] ?? 999);
});

/** Reindex for views */
$plans = array_values($plans);
//echo "<pre>";print_r($subscription);exit;
$_SESSION['member_link_signup'] = 0;
$status = $subscription->stripe_status ?? '';
//$status = 'active';
// Format dates
$startDate = !empty($subscription->startdate) ? $subscription->startdate : '';
$endDate = !empty($subscription->current_period_end) 
    ? date("m/d/Y", strtotime($subscription->current_period_end)) 
    : '';
$trialEnd = !empty($subscription->trial_end) 
    ? date("m/d/Y", strtotime($subscription->trial_end)) 
    : '';
$canceledOn = !empty($subscription->updated_at) 
    ? date("m/d/Y", strtotime($subscription->updated_at)) 
    : '';
?>
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
  {margin-top:100px;}
  .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
  .rabbit
  {margin-top:5%;}
  @media (min-width: 768px) and (max-width: 1024px) {
    .m-magic
    {margin-top:50px;}
      .bg-backstage
  {background-image:url(assets/images/backstage-bg.jpg);background-size: cover;background-repeat:no-repeat;background-position: top center;}
    .rabbit
    {margin-top:60px;}
  }

    .pricing-toggle {
      background: #e9ecef;
      border-radius: 30px;
      padding: 4px;
      display: inline-flex;
      gap: 4px;
      z-index: 9999;
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
.signup_bot{padding:10px;margin-top:5px;font-size:24px;font-weight: 500;width:200px;border-radius:20px;text-align: center;color:#fff}
.f-10{font-size:43px;margin-top:-20%;position: relative;z-index: 1}
.text_g{color:#8dc63f;margin-top:-3%;position: relative;z-index: 1}
.fs-7{font-size: 1.2rem;font-weight: 500;}
.blank1{margin-top:70px;}
.h_text{font-size: 60px;}
.gb_space{font-size:42px}
.tick_cloud{margin-top: -2%;}


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

}
.plan-desc {
    line-height: 1.5em;
    min-height: 3em;   /* 2 lines × 1.5em */
    display: flex;
    align-items: center; /* vertically center 1-line text */
    justify-content: center;
    text-align: center;
}
.btn-loader {
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
</style>
<div class="main-panel ">
  
   
        <div class="row bg-backstage">
          <div class="mt-3"><img src="<?= base_url('assets/images/logo.svg') ?>" / width="150"></div>
          <div class="col-lg-12 col-md-12">
            <div class="row"> 
              <div class="text-center my-3" >
                <div  ><img src="<?= base_url('assets/images/subscription.svg') ?>" / width="100"></div>
                <div class="mt-2 text-white"><h1 style="font-family: GothamMedium!important;">Subscription</h1></div>
                <div class="text-center text-white"></div>     
              </div>
            </div>
          </div>
        </div>
        <div class="content-wrapper" style="background:rgba(0,0,0,0)!important;background-repeat:no-repeat!important;">
        <div class="row mb-5">
          <div class="col-lg-12 col-md-12 text-center mt-5" style="color: #f74747;">


    <?php if ($status === 'trialing') { ?>

    <!-- Trial UI -->
    <div class="col-lg-10 offset-lg-1 p-3 mb-4 fw-bold" 
         style="background-color:#fff3cd;border-radius:10px;">
         
        Trial Period: <?= $startDate ?> to <?= $trialEnd ?>,  
        Storage: <?= $subscription->volume_inGB ?? '' ?> GB <br>
        <span>You are currently on a free trial. Upgrade before the trial ends.</span>

    </div>

<?php } else { ?>

    <!-- Normal Subscription UI -->
    <div class="col-lg-10 offset-lg-1 p-3 mb-4 fw-bold" 
         style="background-color:#e9ecef;border-radius:10px;">
         
        Current Subscription: 
        Started: <?= $startDate ?>, 
        Ends: <?= $endDate ?>, 
        Storage: <?= $subscription->volume_inGB ?? '' ?> GB
        <br>

        <span>
        <?php
            if ($status === 'active') {
                echo "Your subscription is active.";
            } elseif ($status === 'canceled') {
                echo "Your subscription was canceled on {$canceledOn}.";
            } else {
                echo "No active subscription found.";
            }
        ?>
        </span>

    </div>

<?php } ?>

            <?php if(session()->getFlashdata('err_msg')){ ?>
            <?= session()->getFlashdata('err_msg'); ?>
            <?php } ?></div>
            <div class="text-center">
              <div class="pricing-toggle text-center mb-4">
                <button id="yearlyBtn">Paid yearly</button>
                <button id="monthlyBtn" class="active">Paid monthly</button>
              </div>
            </div>
<?php foreach ($plans as $plan): 
  $yearly  = $plan['yearly'];
  $monthly = $plan['monthly'];
  //$isCurrent = $plan['current'];
  //$currentSub = $plan['current_subscription'];
  ?>        
<div class="col-lg-4 col-md-12">
          <div class="img-box pricing-card">    
 <img src="<?= base_url('assets/images/'.$plan['bg_image']) ?>" class="img-fluid">
  <div class="text center text-white fst-italic fw-bold h_text"><?= esc($plan['name']) ?></div>
     </div>
     <div class="text-center">
        
<div class="price fw-bold f-10 price-div"
     data-yearly="<?= !empty($plan['yearly']) 
         ? number_format($plan['yearly']['amount'], 2) . '/year (10% off)' 
         : '' ?>"
     data-monthly="<?= !empty($plan['monthly']) 
         ? number_format($plan['monthly']['amount'], 2) . '/month' 
         : '' ?>">

  <?php if (!empty($plan['monthly'])): ?>
    $<?= number_format($plan['monthly']['amount'], 2) ?>
    <span class="fs-7">/month</span>

  <?php elseif (!empty($plan['yearly'])): ?>
    $<?= number_format($plan['yearly']['amount'], 2) ?>
    <span class="fs-7">/year</span>
  <?php endif; ?>

</div>

       <h5 class="text_g fst-italic">First Month Free!</h5>
     

      <div class="price alt-buy"
           data-yearly="<?= $plan['monthly'] ? 'Or, $' . number_format($plan['monthly']['amount'], 2) . '/month' : '' ?>"
           data-monthly="<?= $plan['yearly'] ? 'Or, $' . number_format($plan['yearly']['amount'], 2) . '/year (10% off)' : '' ?>">

        <?php if (!empty($plan['yearly'])): ?>
          Or, $<?= number_format($plan['yearly']['amount'], 2) ?>
          <span class="fs-7">/year (10% off)</span>
        <?php endif; ?>

      </div>
    <div class="my-1 plan-desc"><?= $plan['description'] ?></div>
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
    <div align="center">
        
<?php
$monthly = $plan['monthly'] ?? null;
$yearly  = $plan['yearly'] ?? null;
?>

<?php if ($plan['is_current']): ?>

<!-- CURRENT PLAN + CANCEL -->
<div class="d-flex justify-content-between align-items-center">

  <button class="btn btn-secondary signup_bot" disabled>
    Current Plan
    <!-- <small>(<?= ucfirst($plan['current_type']) ?>)</small> -->
  </button>

  <?php if (!empty($plan['subscription_id'])): ?>
    <div class="dropdown">
      <button class="btn p-0" data-bs-toggle="dropdown">
        <i class="fa fa-ellipsis-v"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <button
            class="dropdown-item text-danger"
            data-bs-toggle="modal"
            data-bs-target="#confirmCancelModal<?= esc($plan['subscription_id']) ?>">
            Cancel Subscription
          </button>
        </li>
      </ul>
    </div>
  <?php endif; ?>

</div>

<?php elseif (!empty($currentSubscriptionDetails)): ?>

<!-- UPGRADE -->
<?= form_open('subscriptionUpgrade') ?>
  <input type="hidden" name="subscription_id" value="<?= esc($plan['subscription_id'] ?? '') ?>">
  <input type="hidden" name="product_price_id">

  <button type="submit"
    class="btn signup_bot buy-btn  upgrade-btn"
    style="background-color:<?= esc($plan['button_color']) ?>"
    data-monthly-price-id="<?= $monthly['price_id'] ?? '' ?>"
    data-yearly-price-id="<?= $yearly['price_id'] ?? '' ?>">
      <span class="btn-text">Upgrade</span>
  <span class="btn-loader d-none">
      <span class="spinner-border spinner-border-sm" role="status"></span>
      Upgrading...
  </span>
  </button>
</form>

<?php else: ?>

<!-- BUY -->
<?= form_open('stripe/checkout') ?>
  <input type="hidden" name="product_price_id">

  <button
    class="btn signup_bot buy-btn"
    style="background-color:<?= esc($plan['button_color']) ?>"
    data-monthly-price-id="<?= $monthly['price_id'] ?? '' ?>"
    data-yearly-price-id="<?= $yearly['price_id'] ?? '' ?>">
    <?php if($_SESSION['member_link_signup'] == 1){ 
      echo "Upgrade";
    }else{
      echo "Buy now";
    }

    ?>
    
    
  </button>
</form>

<?php endif; ?>

 </div>
     </div>
  </div>
  <!-- CANCEL MODAL -->
<?php if ($plan['is_current'] && !empty($plan['subscription_id'])): ?>

<div class="modal fade"
     id="confirmCancelModal<?= esc($plan['subscription_id']) ?>"
     tabindex="-1">
     
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Confirm Cancellation</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Cancel <strong><?= esc($plan['name']) ?></strong> plan?
      </div>

      <div class="modal-footer">
        <?= form_open('cancel_subscription') ?>
          <input type="hidden"
                 name="stripe_subscription_id"
                 value="<?= esc($plan['subscription_id']) ?>">

          <button class="btn btn-danger">Yes</button>
        </form>
      </div>

    </div>
  </div>
</div>

<?php endif; ?>

<?php endforeach; ?>

      
   

 </div>
 

 


</div>
</div>
<!-- partial -->

<!-- page-body-wrapper ends -->
</div>


<script>
let selectedBilling = 'monthly';

const yearlyBtn = document.getElementById('yearlyBtn');
const monthlyBtn = document.getElementById('monthlyBtn');
const prices = document.querySelectorAll('.price-div');
const altBuys = document.querySelectorAll('.alt-buy');
document.addEventListener('click', function (e) {
  if (!e.target.classList.contains('buy-btn')) return;

  const btn = e.target;
  const form = btn.closest('form');

  if (!form) return;

  const subInput   = form.querySelector('[name="subscription_id"]');
  const priceInput = form.querySelector('[name="product_price_id"]');

  if (selectedBilling === 'monthly') {
    //subInput.value   = btn.dataset.monthlyId;
    priceInput.value = btn.dataset.monthlyPriceId;
  } else {
    //subInput.value   = btn.dataset.yearlyId;
    priceInput.value = btn.dataset.yearlyPriceId;
  }
});

yearlyBtn.onclick = () => {
  selectedBilling = 'yearly';
  yearlyBtn.classList.add('active');
  monthlyBtn.classList.remove('active');

  prices.forEach(p => {
    const y = p.dataset.yearly.split('/');
    p.innerHTML = `$${y[0]}<span class="fs-6">/${y[1]}</span>`;
  });
    altBuys.forEach(link => {
        const links = link.dataset.yearly.split('/');
      link.innerHTML = `${links[0]}<span class="fs-7">/${links[1]}</span>`;

      //link.textContent = link.dataset.yearly;
    });
  updateCheckoutFields();
};

monthlyBtn.onclick = () => {
  selectedBilling = 'monthly';
  monthlyBtn.classList.add('active');
  yearlyBtn.classList.remove('active');

  prices.forEach(p => {
    const m = p.dataset.monthly.split('/');
    p.innerHTML = `$${m[0]}<span class="fs-6">/${m[1]}</span>`;
  });
    altBuys.forEach(link => {
        const links = link.dataset.monthly.split('/');
      link.innerHTML = `${links[0]}<span class="fs-7">/${links[1]}</span>`;

      //link.textContent = link.dataset.monthly;
    });
  updateCheckoutFields();
};

// init → monthly default
monthlyBtn.classList.add('active');
yearlyBtn.classList.remove('active');

prices.forEach(p => {
  const m = p.dataset.monthly.split('/');
  p.innerHTML = `$${m[0]}<span class="fs-6">/${m[1]}</span>`;
});
function updateCheckoutFields() {
    document.querySelectorAll('.buy-btn').forEach(function (btn) {
        const form = btn.closest('form');
        if (!form) return;

        const priceInput = form.querySelector('[name="product_price_id"]');
        if (!priceInput) return;

        if (selectedBilling === 'monthly') {
            priceInput.value = btn.dataset.monthlyPriceId || '';
        } else {
            priceInput.value = btn.dataset.yearlyPriceId || '';
        }
    });
}
updateCheckoutFields();

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.buy-btn').forEach(function (btn) {

        btn.addEventListener('click', function () {
            const form = btn.closest('form');
            alert
            btn.disabled = true;

            btn.querySelector('.btn-text')?.classList.add('d-none');
            btn.querySelector('.btn-loader')?.classList.remove('d-none');

            form.submit();
        });

    });
});
</script>


