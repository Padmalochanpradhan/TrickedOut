<?php
$plans = [];

foreach ($subscriptions as $item) {

    $baseName = trim(str_ireplace(['- Monthly','- Annual','- Yearly'], '', $item['product_name']));

    if (!isset($plans[$baseName])) {
        $plans[$baseName] = [
            'name' => $baseName,
            'monthly' => null,
            'yearly' => null,
            'volume' => $item['volume'] ?? ''
        ];
    }

    if ($item['interval'] === 'month') {
        $plans[$baseName]['monthly'] = $item;
    }

    if ($item['interval'] === 'year') {
        $plans[$baseName]['yearly'] = $item;
    }
}

$plans = array_values($plans);
// ✅ ADD SORT HERE
$planOrder = [
    'Prestige' => 1,
    'Mastery'  => 2,
    'Legacy'   => 3,
];
usort($plans, function ($a, $b) use ($planOrder) {

    $orderA = $planOrder[$a['name']] ?? 999;
    $orderB = $planOrder[$b['name']] ?? 999;

    return $orderA <=> $orderB;
});
?>
<style type="text/css">
.pricing-toggle {background: #e9ecef;border-radius: 30px;padding: 4px;display: inline-flex;gap: 4px;}
.pricing-toggle button {border-radius: 25px;padding: 6px 18px; border: none;background: transparent;font-weight: 600;}
.pricing-toggle .active {background: #8dc63f;color: #fff;}
</style>
<div class="text-center mb-3">
  <div class="pricing-toggle">
    <button type="button" id="monthlyBtn" class="active">Monthly</button>
    <button type="button" id="yearlyBtn">Yearly</button>
  </div>
</div>
<div class="row">

<?php foreach ($plans as $index => $plan): 
  $monthly = $plan['monthly'];
  $yearly  = $plan['yearly'];
  $price   = $monthly['amount'] ?? 0;
  $priceId = $monthly['price_id'] ?? '';

  // convert GB → TB if needed
  $volumeGB = (int) $plan['volume'];
  if ($volumeGB >= 1024) {
      $volumeText = ($volumeGB / 1024);
      $volumeUnit = 'TB';
  } else {
      $volumeText = $volumeGB;
      $volumeUnit = 'GB';
  }

  // Highlight first plan (Prestige)
  $activeClass = ($index == 0) ? 'border2' : 'border1';
?>

<div class="col-lg-4 mt-2">
  <div class="p-2 text-center text-white <?= $activeClass ?> plan-card position-relative"
     
     data-monthly-price="<?= esc($monthly['amount'] ?? 0) ?>"
     data-yearly-price="<?= esc($yearly['amount'] ?? 0) ?>"

     data-monthly-link="<?= esc($monthly['payment_url'] ?? '') ?>"
      data-yearly-link="<?= esc($yearly['payment_url'] ?? '') ?>"
     
     data-monthly-price-id="<?= esc($monthly['price_id'] ?? '') ?>"
     data-yearly-price-id="<?= esc($yearly['price_id'] ?? '') ?>">

  <!-- Tick -->
  <div><h5 class="fw-bold"><img src="<?= base_url('assets/images/tick3.svg') ?>" 
       class="tick-icon position-absolute d-none"
       style="width:20px; top:10px; left:10px;">

  <span class="ms-2"><?= esc($plan['name']) ?></span></h5></div>

  <div class="fs-14">
    <?= esc($volumeText) . $volumeUnit ?>
    <span class="plan-type">-Monthly</span>
  </div>

  <hr/>

  <div class="text-g price-text">
    $<?= number_format($monthly['amount'] ?? 0, 2) ?>
    <span class="fs-7 text-white">/month</span>
  </div>

</div>
</div>

<?php endforeach; ?>

</div>
