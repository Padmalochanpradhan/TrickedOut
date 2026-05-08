<?php
$plans = [];
//echo "<pre>";print_r($subscriptions);exit;
foreach ($subscriptions as $item) {

    // Normalize plan name (Legacy - Monthly → Legacy)
    $baseName = trim(
        str_ireplace(['- Monthly', '- Annual', '- Yearly'], '', $item['product_name'])
    );

    if (!isset($plans[$baseName])) {
        $plans[$baseName] = [
            'name'            => $baseName,
            'description'     => $item['product_description'] ?? '',
            'promo_code' => $item['promo_code'] ?? '',
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


    }

    /** YEARLY */
    if ($item['interval'] === 'year') {
        $plans[$baseName]['yearly'] = $item;


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
foreach ($plans as $key => $plan) {

    $monthlyValid = $plan['monthly']['promoCodeValid'] ?? 0;
    $yearlyValid  = $plan['yearly']['promoCodeValid'] ?? 0;

    if ($monthlyValid == 1) {
        $plans[$key]['default_type'] = 'monthly';
    } 
    elseif ($monthlyValid == 0 && $yearlyValid == 1) {
        $plans[$key]['default_type'] = 'yearly';
    } 
    else {
        $plans[$key]['default_type'] = 'monthly';
    }
}
/** Reindex for views */
$plans = array_values($plans);
//echo "<pre>$currentPriceId";print_r($plans);exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SUBSCRIPTION :: TRICKEDOUT</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <style>
@font-face {
    font-family: 'Gotham';
    src: url('<?= base_url("fonts/Gotham-Book.woff2") ?>') format('woff2'),
          url('<?= base_url("fonts/Gotham-Book.woff") ?>') format('woff'),
          url('<?= base_url("fonts/Gotham-Book.ttf") ?>') format('truetype');
          font-weight: normal;
          font-display: swap
}
@font-face {
    font-family: 'GothamBold';
    src: url('<?= base_url("fonts/Gotham-Bold.ttf") ?>') format('truetype');
}
body,
.form-control{
 font-family: "Gotham", sans-serif !important;
}
.pricing-toggle {background: #e9ecef;border-radius: 30px;padding: 4px;display: inline-flex;gap: 4px;}
.pricing-toggle button {border-radius: 25px;padding: 6px 18px; border: none;background: transparent;font-weight: 600;}
.pricing-toggle .active {background: #8dc63f;color: #fff;}
.pricing-card {background: #fff;border-radius: 12px;padding: 24px;height: 100%;
  box-shadow: 0 0 0 1px #e0e0e0;}
.pricing-card h5 {font-weight: 700;}
.app-icons img {width: 26px;margin-right: 6px; }
.price {font-weight: 700;}
.old-price {text-decoration: line-through;color: #6c757d;font-size: 1rem; }
.feature-list li {margin-bottom: 8px;font-size: 0.95rem;}
.badge-offer {background-color: #ffb900;color: #000;font-size: 0.75rem;padding: 4px 8px;
  border-radius: 4px;display: inline-block;margin-bottom: 8px;}
.toggle-btn .btn {min-width: 120px;}
.logo_subs{position:absolute;width:200px;margin-left:160px;margin-top:0px;}
.sub_box{border: 2px dashed #dc3545;
  position: relative; /* REQUIRED */
  overflow: hidden;   /* hides ribbon overflow */
  }
.top-right1{ position:absolute; right:10px;top:25px;}
.img-box {position: relative;z-index:-1;}
.img-box img {width: 100%;display: block;}
.text {position: absolute; }
.signup_bot{padding:10px;margin-top:5px;font-size:24px;font-weight: 500;width:200px;border-radius:20px;text-align: center;color:#fff}
.blank1{margin-top:70px;}
.w-part{background-color: #fff;border-radius:0px 0px 35px 35px;padding-bottom:30px;margin-bottom:20px;margin-top: -1px;}
.h_text{font-size: 50px;position:absolute;top:63%;left:50%; transform: translate(-50%, -50%);}
.f-10 {font-size: 36px;bottom:6%;position: absolute;align-items: baseline; justify-content: center;display: flex;width: 100%;font-weight: bold;}
.text_g{font-size:18px;color:#8dc63f;position: absolute; bottom: 2%;justify-content: center;display: flex;width: 100%;}
 .price{font-size: 1.5rem;font-weight: bold;}
 .tick_cloud{margin-top: -2%;}
 .gb_space{font-size:42px;font-weight: bold;}
 .fs-7{font-size:1rem;font-weight: 500;}
/* Media Query */

@media (min-width: 768px) {
  .h_text{font-size: 90px;}
  .f-10{font-size:70px;}
  .text_g {font-size: 30px;} 
  .price{font-size: 3rem;}
  .tick_cloud{margin-top:0%;}
  .gb_space{font-size:70px}
  .fs-7{font-size: 2rem;}
}
@media (min-width: 1024px)  {
.ipad-landscape { color: blue; } /* your css rules for ipad landscape */
.h_text{font-size: 40px;}
.f-10{font-size:28px; bottom:7%;}
.text_g {font-size: 18px;bottom:0%;}
.price{font-size: 1.3rem;}
.tick_cloud{margin-top:0%;}
.gb_space{font-size:50px}
.tick_cloud{margin-top:-1%;}
.fs-7{font-size: 1rem;}
}

@media (min-width: 1280px) {
  .ipad-landscape { color: blue; } /* your css rules for ipad landscape */
  .h_text{font-size: 50px;}
   .f-10{font-size:40px; bottom:6%;}
   .text_g {font-size: 24px;bottom:0%;}
   .price{font-size: 2rem;}
   .f-7{font-size: .7rem;}
   .tick_cloud{margin-top:-1%;}
   .fs-7{font-size: 1rem;}
}
@media (min-width: 1536px) {
  .h_text{font-size: 50px;}
  .f-10 {font-size: 40px;}
 .text_g{font-size:20px;bottom: 2%;}
 .price{font-size: 1.5rem;}
 .f-7{font-size: .7rem;}
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
.promo-valid{
    color:#8dc63f;
    font-weight:500;
}

.promo-invalid{
    color:#dc3545;
    font-weight:500;
}
  </style>
</head>
<body class="login_bg">
  <div class="container py-5">

  <!-- Toggle -->
  <div class="text-center mb-4" style="margin-top:70px;">
     <div class="pricing-toggle">
    <button id="yearlyBtn">Paid yearly</button>
    <button id="monthlyBtn" class="active">Paid monthly</button>
  </div>
  </div>
<div class="container">
    <div class="row">


<?php foreach ($plans as $plan): 
  $yearly  = $plan['yearly'];
  $monthly = $plan['monthly'];
  //$isCurrent = $plan['current'];
  //$currentSub = $plan['current_subscription'];
  //echo "<pre>";print_r($plan);exit;
  ?>        
<div class="col-lg-4 col-md-12">
          <div class="img-box">    
 <img src="<?= base_url('assets/images/'.$plan['bg_image']) ?>" class="img-fluid">
  <div class="text-white fst-italic fw-bold h_text"><?= esc($plan['name']) ?></div>
  <div class="fw-bold f-10 price-div"
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
<h5 class="text_g fst-italic mb-0">First Month Free!</h5>
     </div>
     <div class="text-center">
<div class="w-part">
     

      <div class="price alt-buy"
           data-yearly="<?= $plan['monthly'] ? 'Or, $' . number_format($plan['monthly']['amount'], 2) . '/month' : '' ?>"
           data-monthly="<?= $plan['yearly'] ? 'Or, $' . number_format($plan['yearly']['amount'], 2) . '/year (10% off)' : '' ?>">

        <?php if (!empty($plan['yearly'])): ?>
          Or, $<?= number_format($plan['yearly']['amount'], 2) ?>
          <span class="fs-7">/year (10% off)</span>
        <?php endif; ?>

      </div>
    <div class="my-1 plan-desc"><?= $plan['description'] ?></div>
    <!-- <div class="my-1 plan-desc preview-message p-1"
     data-monthly="<?= esc($plan['monthly']['preview_message'] ?? '') ?>"
     data-yearly="<?= esc($plan['yearly']['preview_message'] ?? '') ?>">

      <?php if (!empty($plan['monthly']['preview_message'])): ?>
          <?= esc($plan['monthly']['preview_message']) ?>
      <?php elseif (!empty($plan['yearly']['preview_message'])): ?>
          <?= esc($plan['yearly']['preview_message']) ?>
      <?php endif; ?>

      </div> -->
      <div class="my-1 plan-desc preview-message p-1"
           data-monthly="<?= esc($plan['monthly']['preview_message'] ?? '') ?>"
           data-yearly="<?= esc($plan['yearly']['preview_message'] ?? '') ?>"
           data-monthly-valid="<?= esc($plan['monthly']['promoCodeValid'] ?? 0) ?>"
           data-yearly-valid="<?= esc($plan['yearly']['promoCodeValid'] ?? 0) ?>">

      <?php if (!empty($plan['monthly']['preview_message'])): ?>
          <?= esc($plan['monthly']['preview_message']) ?>
      <?php elseif (!empty($plan['yearly']['preview_message'])): ?>
          <?= esc($plan['yearly']['preview_message']) ?>
      <?php endif; ?>

      </div>
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
      $activePlan = $plan['monthly'] ?? $plan['yearly'];
      ?>
      <?php
        echo form_open('stripe/checkout', ['method' => 'post']);
        ?>

<!-- <input type="hidden" name="payment_url" value="<?= esc($activePlan['payment_url']) ?>">
<input type="hidden" name="price_id" value="<?= esc($activePlan['price_id']) ?>"> -->
<input type="hidden" name="payment_url" class="payment-url" value="<?= esc($monthly['payment_url'] ?? $yearly['payment_url']) ?>">

<input type="hidden" name="price_id" class="price-id" value="<?= esc($monthly['price_id'] ?? $yearly['price_id']) ?>">

<input type="hidden" name="promo_code" class="promo_code-id" value="<?= esc($monthly['promo_code'] ?? $yearly['promo_code']) ?>">

        <button type="submit" class="btn signup_bot buy-btn"
        data-default="<?= $plan['default_type'] ?>"
          style="background-color:<?= esc($plan['button_color']) ?>;"
          data-monthly-url="<?= esc($monthly['payment_url'] ?? '') ?>"
          data-monthly-price="<?= esc($monthly['price_id'] ?? '') ?>"
          data-monthly-promo="<?= ($monthly['promoCodeValid'] ?? 0) == 1 ? esc($monthly['promo_code']) : '' ?>"
          data-yearly-url="<?= esc($yearly['payment_url'] ?? '') ?>"
          data-yearly-price="<?= esc($yearly['price_id'] ?? '') ?>"
          data-yearly-promo="<?= ($yearly['promoCodeValid'] ?? 0) == 1 ? esc($yearly['promo_code']) : '' ?>">
            <span class="btn-text">Buy now</span>
  <span class="btn-loader d-none">
      <span class="spinner-border spinner-border-sm" role="status"></span>
      Processing...
  </span>
        </button>

        </form>

 </div>
     </div>
  </div>
</div>

<?php endforeach; ?>
 </div>
</div>
  
</div>
</body>
<!-- ========================== Footer section end ========================== -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script>
  const yearlyBtn = document.getElementById('yearlyBtn');
  const monthlyBtn = document.getElementById('monthlyBtn');
  const prices = document.querySelectorAll('.price-div');
  const altBuys = document.querySelectorAll('.alt-buy');
  const previewMessages = document.querySelectorAll('.preview-message');
yearlyBtn.addEventListener('click', () => {
  yearlyBtn.classList.add('active');
  monthlyBtn.classList.remove('active');

  prices.forEach(price => {
    const yearly = price.dataset.yearly.split('/');
    price.innerHTML = `$${yearly[0]}<span class="fs-7">/${yearly[1]}</span>`;
  });

  altBuys.forEach(link => {
    const links = link.dataset.yearly.split('/');
    link.innerHTML = `${links[0]}<span class="fs-7">/${links[1]}</span>`;
  });
  // previewMessages.forEach(msg => {
  //     msg.innerHTML = msg.dataset.yearly;
  //     if(msg.dataset.yearlyValid == "1"){
  //         msg.classList.remove('promo-invalid');
  //         msg.classList.add('promo-valid');
  //     }else{
  //         msg.classList.remove('promo-valid');
  //         msg.classList.add('promo-invalid');
  //     }
  // });
  previewMessages.forEach(msg => {

      msg.innerHTML = msg.dataset.yearly;

      msg.classList.remove('promo-valid','promo-invalid');

      if(msg.dataset.yearlyValid == "1"){
          msg.classList.add('promo-valid');
      }else{
          msg.classList.add('promo-invalid');
      }

  });  
  updateCheckoutFields('yearly');
});

monthlyBtn.addEventListener('click', () => {
  monthlyBtn.classList.add('active');
  yearlyBtn.classList.remove('active');

  prices.forEach(price => {
    const monthly = price.dataset.monthly.split('/');
    price.innerHTML = `$${monthly[0]}<span class="fs-7">/${monthly[1]}</span>`;
  });

  altBuys.forEach(link => {
    const links = link.dataset.monthly.split('/');
    link.innerHTML = `${links[0]}<span class="fs-7">/${links[1]}</span>`;
  });
  // previewMessages.forEach(msg => {
  //     msg.innerHTML = msg.dataset.monthly;
  //     if(msg.dataset.monthlyValid == "1"){
  //         msg.classList.remove('promo-invalid');
  //         msg.classList.add('promo-valid');
  //     }else{
  //         msg.classList.remove('promo-valid');
  //         msg.classList.add('promo-invalid');
  //     }
  // });
  previewMessages.forEach(msg => {

      msg.innerHTML = msg.dataset.monthly;

      msg.classList.remove('promo-valid','promo-invalid');

      if(msg.dataset.monthlyValid == "1"){
          msg.classList.add('promo-valid');
      }else{
          msg.classList.add('promo-invalid');
      }

  });
  updateCheckoutFields('monthly');
});

function updateCheckoutFields(type) {
  document.querySelectorAll('.buy-btn').forEach(btn => {
    const form = btn.closest('form');
    if (!form) return;

    const paymentUrl = btn.dataset[type + 'Url'];
    const priceId    = btn.dataset[type + 'Price'];
    const promoCode  = btn.dataset[type + 'Promo'];

    if (!paymentUrl || !priceId) return;

    form.querySelector('.payment-url').value = paymentUrl;
    form.querySelector('.price-id').value    = priceId;
    form.querySelector('.promo_code-id').value = promoCode ? promoCode : '';
  });
}

yearlyBtn.addEventListener('click', () => updateCheckoutFields('yearly'));
monthlyBtn.addEventListener('click', () => updateCheckoutFields('monthly'));

document.addEventListener('DOMContentLoaded', function () {
    // Set default billing type based on promo validity
    let defaultType = 'monthly';
    document.querySelectorAll('.buy-btn').forEach(btn => {
        const type = btn.dataset.default;
        if (type === 'yearly') {
            defaultType = 'yearly';
        }
    });
    // trigger correct toggle
    if (defaultType === 'yearly') {
        yearlyBtn.click();
    } else {
        monthlyBtn.click();
    }



    document.querySelectorAll('.buy-btn').forEach(function (btn) {

        btn.addEventListener('click', function () {
            const form = btn.closest('form');

            // prevent double click
            btn.disabled = true;

            // toggle loader
            btn.querySelector('.btn-text').classList.add('d-none');
            btn.querySelector('.btn-loader').classList.remove('d-none');

            // submit form
            form.submit();
        });

    });
    // previewMessages.forEach(msg => {

    //     if(msg.dataset.monthlyValid == "1"){
    //         msg.classList.add('promo-valid');
    //     }else{
    //         msg.classList.add('promo-invalid');
    //     }

    // });
    // previewMessages.forEach(msg => {

    //     msg.classList.remove('promo-valid','promo-invalid');
    //     alert(msg.dataset.monthlyValid);
    //     if(msg.dataset.monthlyValid == "1"){
    //         msg.classList.add('promo-valid');
    //     }else{
    //         msg.classList.add('promo-invalid');
    //     }

    // });
    previewMessages.forEach(msg => {

        msg.classList.remove('promo-valid','promo-invalid');

        let valid = monthlyBtn.classList.contains('active') 
            ? msg.dataset.monthlyValid 
            : msg.dataset.yearlyValid;

        if(valid == "1"){
            msg.classList.add('promo-valid');
        }else{
            msg.classList.add('promo-invalid');
        }

    });    
});
</script>

</body>

</html>