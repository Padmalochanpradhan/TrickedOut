<?php
$plans = [];

foreach ($subscriptions as $item) {

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

/** Reindex for views */
$plans = array_values($plans);
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Tricked Out is a vault for magicians to organize and annotate their tricks and performances for easy access. Every magician faces the same problem: tricks scattered across drives, downloads, sites, and devices. Tricked Out changes that. More than storage, it's your personal Magic Vault a single place to organize routines, track performances, capture notes on your favorite trick explanations or lectures, and fine-tune every detail.">
  <title>HOME :: TRICKEDOUT</title>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<style>
@font-face { font-family: Gotham; src: url("<?= base_url('assets/fonts/Gotham-Book.woff') ?>") format("woff"), url("<?= base_url('assets/fonts/Gotham-Book.woff2') ?>") format("woff2"), url("<?= base_url('assets/fonts/Gotham-Book.ttf') ?>") format("truetype"); font-weight: normal; }
@font-face { font-family: GothamBold; src: url("<?= base_url('assets/fonts/Gotham-Bold.ttf') ?>") format("truetype"); }
@font-face { font-family: GothamMedium; src: url("<?= base_url('assets/fonts/Gotham-Medium.ttf') ?>") format("truetype"); }
@font-face {
font-family: 'Gotham Condensed Medium';
src: url('<?= base_url('assets/fonts/GothamCondensed-Medium.otf') ?>') format('opentype');
src: url('<?= base_url('assets/fonts/GothamCondensed-Medium.woff2') ?>') format('woff2');
src: url('<?= base_url('assets/fonts/GothamCondensed-Medium.woff') ?>') format('woff');
src: url('<?= base_url('assets/fonts/GothamCondensed-Medium.ttf') ?>') format('truetype');

/* You can also specify other font formats (e.g., woff, woff2) for better browser compatibility */
font-weight: normal;
font-style: normal;
}


body {
font-family: "Myriad Pro", Arial, sans-serif !important;
}
/* Remove default arrow */
.accordion-button::after {
background-image: none !important;
content: '+'; /* Plus sign */
font-size: 2rem;
font-weight: bold;
color: #fff;
margin-left: auto; /* Push to right side */
margin-top: -20px;
}

/* Change + to – when accordion is open */
.accordion-button:not(.collapsed)::after {
content: '–'; /* Minus sign */
margin-top: 20px;
}
.accordion-item {
  background-color: transparent !important; /* Transparent item */
  border: none; /* Remove borders if you want */
}
.accordion-button {
 background-color: transparent !important; /* Transparent body */
  color: #fff;
}
.accordion-button:not(.collapsed) {
background-color: transparent !important; /* Transparent body */
  color: #fff;
}
.accordion-body {
  background-color: transparent !important; /* Transparent body */
  color: #fff;
}
.accordion-button:focus {
box-shadow: none;
outline: none;
}

.head{
    background:url("<?= base_url('assets/images/header_new.png') ?>") ;
    background-position: center bottom;
    background-size: cover;
    padding:40px 0 200px;
    position:relative;
}


.header-top{
    display:flex;
    justify-content:space-between;
    align-items:center;
}


.logo1{
    width:200px;
}

.vault-login{
    display:flex;
    align-items:center;
    gap:8px;
    color:#fff;
    font-size:18px;
    text-decoration:none;
}


.rabbit{
    width:160px;
    margin:40px auto 0px;
    display:block;
}


.head-text{
    
    font-size:clamp(32px,6vw,72px);
    font-weight:600;
    letter-spacing:2px;
    text-align:center;
    color:#fff;
}


.head-text-sm{
    font-size:clamp(16px,2.5vw,28px);
    text-align:center;
    color:#fff;
    font-style:italic;

}


.hero-btn{
    margin-top:40px;
}



.hero-note{
    font-size:14px;
    margin-top:10px;
}

.brush-underline{
position:relative;
display:inline-block;
}

.brush-underline::after{
content:"";
position:absolute;
left:0;
bottom:-15px;
width:100%;
height:20px;
background:url("<?= base_url('assets/images/finally.svg') ?>") no-repeat center;
background-size:cover;
pointer-events:none;
}

@media (max-width:768px){

    .logo1{
        width:140px;
    }

    .rabbit{
        width:100px;
        margin-top:20px;
    }

    .head{
        padding-bottom:120px;
    }

}
.learn{border:2px solid #fff;letter-spacing: 1px;font-size:16px;padding-left:50px; padding-right:50px;}
.learn1{letter-spacing: 0px;font-size:30px;padding-left:80px; padding-right:80px;}
::placeholder {font-style: italic;color:#cccccc!important;}
.light-font{ font-weight: 100;}
.socialicon-space{padding: 0px 7px;}
.icon-space{padding: 0px 2px;}
.f-font{font-size:24px;}
.img-accord{width:500px;}
.video-container {
    max-width: 70%;
    aspect-ratio: 16 / 9;   /* keeps correct ratio */
    }
    .video-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
    display: block;
    }
 
.copy-font
{ margin-top:50px;font-size:24px;font-weight:200;text-align: left;} 
.f_contact{padding:0px 80px;}
/* Button loader */
.btn-loading {
  pointer-events: none;
  opacity: 0.8;
}

.btn-loading .btn-text {
  display: none;
}

.btn-loading .spinner-border {
  display: inline-block;
}

.spinner-border {
  display: none;
  width: 1.2rem;
  height: 1.2rem;
  vertical-align: middle;
}
    .pricing-toggle {
      background: #e9ecef;
      border-radius: 30px;
      padding: 4px;
      display: inline-flex;
      gap: 4px;
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

    .pricing-card {
      background: #fff;
      border-radius: 6px;
      padding: 24px;
      height: 100%;
      box-shadow: 0 0 0 1px #e0e0e0;
    }

    .pricing-card h5 {
      font-weight: 700;
    }

    .price {
      font-size: 1.5rem;
      font-weight: 600;
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
  z-index: -1;

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
.blank1{margin-top:70px;}
.head{padding: 20px 0px 220px;}
.finally{position:absolute;left:22%;}
.finally_img{width:180px;}
.magician{position:absolute;left:54%;}
.magician_img{width:150px;}
.but1{margin-top:50px;}
h1{font-family:'Gotham Condensed Medium';}
.plan-desc {
    line-height: 1.5em;
    min-height: 3em;   /* 2 lines × 1.5em */
    display: flex;
    align-items: center; /* vertically center 1-line text */
    justify-content: center;
    text-align: center;
}
.otp-container {
    gap: 10px;
}

.otp-box {
    width: 45px;
    height: 50px;
    text-align: center;
    font-size: 22px;
    border-radius: 6px;
    border: 2px solid #ccc;
}

.otp-box:focus {
    border-color: #ffc107;
    outline: none;
}
#verifyOtpBtn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
@media only screen and (max-width: 767px) {
    .brush-underline::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 100%;
    height: 10px;
    background: url(assets/images/finally.png) no-repeat center;
    background-size: cover;
    pointer-events: none;
}
.hero-note {font-size: 10px;}
.logo1{width:120px;}
.vault1{width:30px;}
.rabbit{width:100px;margin-top:5px;}
.head-text-body{font-weight: 500;;letter-spacing:0px;font-size:2rem;}
.head{padding: 20px 0px 80px;}
.head-text {font-size:22px;letter-spacing:0px;}
.head-text-sm{font-size:16px;letter-spacing:0px;}
.learn1{letter-spacing: 0px;font-size:16px; padding-left:60px; padding-right:60px;}
.learn{border:2 px solid #fff;letter-spacing: 0px;font-size:16px; padding-left:30px; padding-right:30px;}
.light-font{ font-weight:200;}
.f-font{ont-size:22px;}
.img-accord{width:300px;}
.text5{font-size:10px;}
.but1{margin-top:20px;}
.video-container {
    max-width: 100%;
    aspect-ratio: 16 / 9;   /* keeps correct ratio */
    }
    .copy-font
   { text-align:center;}
   .f_contact{padding:0px 0px;}
    .blank1{margin-top:50px;}
}

/* Mobile first */
.h_text{font-size:60px;}
.f-10{font-size:43px;margin-top:-22%;}
.text_g{color:#8dc63f;font-size:20px;margin-top:-3%;}
.price{font-size:1.5rem;}
.gb_space{font-size:50px;}
.fs-7{font-size:1rem;}
.tick_cloud {margin-top: -2%;}

 /* Tablet */
@media (min-width: 768px) {
  .h_text { font-size: 90px; }
  .f-10 { font-size:60px; margin-top: -18%; }
  .text_g { font-size: 40px; margin-top: -3%; }
  .price { font-size: 3rem; }
  .tick_cloud { margin-top: -0%; }
  .gb_space { font-size:80px; }
  .fs-7 { font-size:1.5rem; font-weight: 500; }
  .tick_cloud {margin-top: -2%;}
}
/* iPad / small laptop */
@media (min-width: 1024px) {
  .ipad-portrait { color: red; }
  .h_text { font-size: 55px; }
  .f-10 { font-size: 35px; margin-top: -20%; }
  .text_g { font-size: 20px; }
  .price { font-size: 1.7rem; }
  .tick_cloud { margin-top: -2%; }
  .gb_space { font-size: 50px; }
  .fs-7 { font-size: 1rem; }
}
/* Laptop */
@media (min-width: 1280px) {
  .ipad-landscape { color: blue; }
  .h_text { font-size: 60px; }
  .f-10 { font-size: 42px; margin-top: -22%; }
  .text_g { font-size: 22px; }
  .price { font-size: 2rem; }
  .tick_cloud { margin-top: -2%; }
  .fs-7 { font-size: 1.2rem; }
}
/* Large Desktop */
@media (min-width: 1536px) {
  .h_text { font-size: 70px; }
  .f-10 { font-size: 45px; margin-top: -22%; }
  .text_g { font-size: 24px; }
  .price { font-size: 2rem; }
  .tick_cloud { margin-top: -2%; }
  .fs-7 { font-size: 1.5rem; }
}


</style>
</head>
<body background="#000">
    <!--Header Section-->
    <div class="container-fluid head">

<div class="container">

<!-- TOP BAR -->
<div class="header-top">

<img src="<?= base_url('assets/images/logo_new.svg') ?>" class="logo1">

<a href="<?= base_url('login') ?>" target="_blank" class="vault-login" style="color:#fff">
<img src="<?= base_url('assets/images/lock.png') ?>" width="24">
<span style="margin-top:8px;"><em>Vault Login</em></span>
</a>

</div>

<img src="<?= base_url('assets/images/rabbit1.svg') ?>" class="rabbit">

<h1 class="head-text text-center text-white" style="font-family: 'Gotham Condensed Medium'!important;
">
<span class="brush-underline">Finally.</span> 
One Place For All Your Magic.
</h1>

<p class="head-text-sm">
Organize your tricks. Rediscover forgotten gems.<br>
Built by magicians <b>for <span class="brush-underline">magicians</span></b>
</p>


<!-- CTA -->
<div class="text-center hero-btn">
<a href="#plan">
<button  class="btn btn-danger learn1" style="background-color:#ed2024;">
<em>Start Free - 30 Days</em>
</button>
</a>
</div>


<div class="text-center text-white hero-note">
<em>Cancel anytime. Plans start as low as $9.99/month</em>
</div>

</div>
</div>
    <!--Why do you need Tricked Out-->
    <div class="container blank1">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h3 class="text-center fst-italic light-font" id="c1">Why do you need Tricked Out?</h3>
                <h1 class="text-center head-text-body">Your magic deserves more than a folder.</h1>
                <p class="mb-0">Every magician faces the same problem: tricks scattered across drives, downloads, sites, and devices. Tricked Out changes that. More than storage, it's your personal Magic Vault a single place to organize routines, track performances,
                    capture notes on your favorite trick explanations or lectures, and fine-tune every detail. From street magic to stage illusions, Tricked Out brings your entire collection together, turning clutter into not just precision, but inspiration.
                    Because you deserve to get the most out of the magic you've already invested in.</p>
            </div>
            <div class="col-lg-12">
            <div align="center"  id="video" class="blank1">
                <!-- <img src="images/video.png" / class="img-fluid"> -->
                <div class="video-container">
                    <iframe
                      src="https://player.vimeo.com/video/1117910123?h=c880a24523"
                        allow="autoplay; fullscreen; picture-in-picture"
                      allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!--Tricked Out-->
    <div class="container-fluid blank1">
        <div class="row" style="background-color:#231e1e;">
            <div class="col-lg-6 col-md-12">
                <div class="py-4"><img src="<?= base_url('assets/images/Trickedout_tablet.png') ?>" class="img-fluid"></div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="text-white mt-4">
                    <div align="center" class="mb-5">
                    <img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid img-accord">
                    </div>
                    <div>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#flush-collapseOne"
              aria-expanded="true"
              aria-controls="flush-collapseOne"
              style="font-size:24px;">
        What is Tricked Out Magic Vault?
      </button>
    </h2>

                                <div id="flush-collapseOne"
         class="accordion-collapse collapse show"
         data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Tricked Out is more than storage. It is your personal vault for magic, built by magicians for magicians. Every trick, lecture, and note you have collected becomes part of a living library you can carry anywhere. Whether you are refining a sleight, building a full routine, or revisiting a forgotten gem, the Vault keeps your entire repertoire organized, searchable, and ready when inspiration strikes.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight" style="font-size:24px;">
     How is Tricked Out different from what I'm currently doing? 
      </button>
    </h2>
                                <div id="flush-collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body"> Most magicians rely on their favorite magic sites to host the effects they’ve purchased, leaving their libraries scattered across multiple sites and logins and never fully centralized.<br/>
                                        <b>Tricked Out lets you build your own secure cloud library for the magic you’ve purchased from everywhere</b>. Your content lives in your Magic Vault, where you can organize it, add notes, and work with it. All in one place, behind a single password you control.<br/>
                                        It’s a simpler, more organized way to engage with the magic you already own.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="font-size:24px;">
      How does the Vault help me organize my magic tricks and routines?
      </button>
    </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body"> Your Tricked Out Vault turns chaos into clarity. Every trick can be cataloged with personal notes, tags, and performance details, making it easy to find what you need in seconds. You can track the refinements that make each effect uniquely yours. Your entire library lives here, evolves with you, and stays organized exactly the way you want.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="font-size:24px;">
       Can I upload my own videos, notes, and custom instructions?
      </button>
    </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Absolutely. The Vault is built to be your personal library, not just a place to store what you have bought. You can upload your own videos, add written notes, attach images, or create custom instructions for every effect. Whether it is a quick idea, a detailed walkthrough, or a full performance rehearsal, everything you create has a home here ready to review, refine, and make your magic truly your own.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour" style="font-size:24px;">
       How secure is my content inside the Magic Vault?
      </button>
    </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Your secrets stay secret. The Vault is built with strong security and privacy in mind, so your tricks, videos, and notes remain yours alone. Only you hold the keys to your Vault. Think of it as a digital lockbox for your magic always accessible when you need it but invisible to anyone else.</div>
                                </div>
                            </div>
                           <!--  <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive" style="font-size:24px;">
        What makes Tricked Out different from a regular cloud storage or note-taking app?
      </button>
    </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Tricked Out is not just storage. It is built for magicians and built to evolve. Every feature is designed around how magicians actually learn, rehearse, and perform. From tagging effects by type to adding personal notes that grow with your style, your Vault helps you interact with your collection in ways generic apps cannot. Instead of being a folder that holds your files, Tricked Out becomes the workspace where your magic grows.</div>
                                </div>
                            </div> -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" style="border-bottom:1px solid #fff;background-color:#ffae34;">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix" style="font-size:24px;" id="plan">
      How do I get started?
      </button>
    </h2>
                                <div id="flush-collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">For as low as <b>$9.99</b> per month, you get plenty of storage to begin building your personal Tricked Out vault, organizing your tricks, lectures, and files, you already own in one secure place.   Sign up in minutes, start with a <b>30-day free trial</b>, and scale your storage as your library grows. <a href="<?= base_url('signup') ?>"><b> Click here to get started</b></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Subscription-->
    <div class="container blank1">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                 <h3 class="text-center fst-italic " style="color:#8dc63f;">Your first month is free!</h3>
                    <h1 class="text-center head-text-body">No Smoke, No Mirrors—Just One Simple Subscription.</h1>
                </div>
                     <div class="col-lg-6 offset-lg-3 col-md-12">
                <p class="text-center" >One Subscription that gives you full access to YOUR vault. Choose the storage plan that fits your collection, with no hidden fees or confusing add-ons. Start organizing, rediscovering, and enjoy your magic from day one.</p></div>
                 <div class="col-lg-12 col-md-12">
                <!-- Toggle -->
  <div class="text-center mb-2">
     <div class="pricing-toggle">
        <button id="monthlyBtn" class="active ">Paid monthly</button>
    <button id="yearlyBtn" >Paid yearly</button>
      </div>     
  </div>


</div>
<div class="container">
    <div class="row">


<?php foreach ($plans as $plan): 
  $yearly  = $plan['yearly'];
  $monthly = $plan['monthly'];
  //$isCurrent = $plan['current'];
  //$currentSub = $plan['current_subscription'];
  ?>        
<div class="col-lg-4 col-md-12">
          <div class="img-box ">    
 <img src="<?= base_url('assets/images/'.$plan['bg_image']) ?>" class="img-fluid">
  <div class="text center text-white fst-italic fw-bold h_text"><?= esc($plan['name']) ?></div>
     </div>
     <div class="text-center">
        
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
        
<a href="<?= base_url('signup') ?>" style="text-decoration: none;">
    <div class="signup_bot  fst-italic mt-2" style="background-color:<?= esc($plan['button_color']) ?>;">Sign Up
    </div></a>

 </div>
     </div>
  </div>


<?php endforeach; ?>
 </div>
</div>
</div>
</div>
    <!--magic-->
    <div class="blank1">
            <div style="background-image:url(<?= base_url('assets/images/magicman.jpg') ?>);background-size:cover;background-position:center;">
                <div style="background-color:rgba(0,0,0,.2);">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1 col-md-12">
                                <div style="padding:150px 0px 0px;" class="text-center text-white">
                                     <h3 class="text-center fst-italic light-font">And this is just the beginning...</h3>
                                      <h1 class="text-center head-text-body">We have so much more up our sleeves</h1>
                                    <p style="padding:10px 0px 40px;;">Future updates will bring even more ways to get the most out of your collection, from personalized feeds showcasing the latest in magic from your favorite sites and dealers to advanced customization tools for building
                                        and refining your acts. Best of all, we're listening. The Tricked Out Family helps shape what comes next, with your tips and feature requests guiding every enhancement. Our goal is simple: to give you exactly what
                                        you need to unlock the full potential of your magic.</p>
                                   </div>
                            </div>
                            <div class="col-lg-8 offset-lg-2 col-md-12">
                            <div style="background-color:#dc3545;text-align:center;" class="py-4 px-2" >
                                        <h5 class="mb-4 text-white" >Sign up today to be first in line when new magic is revealed.</h5>
                                        <form action="<?= base_url('newsletter') ?>" method="POST" id="newsletterForm">
                                          <?= csrf_field() ?>
                                        <input type="hidden" name="form_token" value="<?= session()->get('form_token') ?>">
                                          <input type="text" name="website" style="display:none">
                                            <div class="px-5">
                                            <div class="row">
                                            <div class="col-lg-5 offset-lg-1  col-md-6 mb-2"> 
                                              <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Name" required>
                                            </div>
                                            <div class="col-lg-5  col-md-6 mb-2">
                                              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" oninvalid="InvalidMsg(this,'Invalid email address.')" oninput="InvalidMsg(this,'Invalid email address.')" required>
                                            </div>
                                            </div>
                                                
                                            </div>
                                            <div class="mt-2" align="center">
                                                <button type="submit" class="btn btn-outline-light learn" id="newsletterBtn">
                                                  <span class="btn-text"><em>Subscribe to the newsletter</em></span>
                                                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                            <script src="https://www.google.com/recaptcha/api.js?render=6Ld8OW0sAAAAADHIRWWJOl75uc4SAhJy6oxpedIo"></script>

                                            <input type="hidden" name="recaptcha_token2" id="recaptcha_token2">

                                            <script>
                                            grecaptcha.ready(function() {
                                                grecaptcha.execute('6Ld8OW0sAAAAADHIRWWJOl75uc4SAhJy6oxpedIo', {action: 'contact'})
                                                .then(function(token) {
                                                    document.getElementById('recaptcha_token2').value = token;
                                                });
                                            });
                                            </script>                                            
                                        </form>
                                    </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!--footer-->
    <div style="background-color:#231e1e; padding-bottom:50px;">
            <div class="container">
                <div class="row text-white">
                    <div class="col-lg-3 col-md-6 " style="margin-top:50px;text-align: center;"><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid" width="250px;"></div>
                    <div class="col-lg-3 col-md-6" align="center">
                        <div style="font-size:14px;margin-top:50px;" class="pb-2">get connected:</div>
                       <div class="row mt-2">
                        <div class="d-flex justify-content-center align-items-center">
                   <a href="https://www.instagram.com/trickedoutmagic/#" target="_blank">
                   <div class="socialicon-space"><img src="<?= base_url('assets/images/instagram.svg') ?>" class="img-fluid" ></div>
                    </a>
                    <!-- <div class="socialicon-space"><img src="<?= base_url('assets/images/facebook.svg') ?>" class="img-fluid"></div> -->
                   <a href="https://x.com/TrickedOutMagic" target="_blank">
                   <div class="socialicon-space"><img src="<?= base_url('assets/images/twitter.svg') ?>" class="img-fluid"></div>
                    </a>
                    <!-- <div class="socialicon-space"><img src="<?= base_url('assets/images/tictok.svg') ?>" class="img-fluid"></div>
                     <div class="socialicon-space"><img src="<?= base_url('assets/images/linkedin.svg') ?>" class="img-fluid"></div>
                     <div class="socialicon-space"><img src="<?= base_url('assets/images/youtube.svg') ?>" class="img-fluid"></div> -->
                     </div>
                   </div>
                    </div>
                    <div class="col-lg-3 col-md-6" align="center">
                        <div style="font-size:14px;margin-top:50px;" class="pb-2">reach out:</div>
                        <div>
                            <button type="button" class="btn btn-warning" style="padding:0px 50px;margin-top:5px;font-size:22px;background-color:#ffae34;font-weight: 500;" onclick="showContactUs();">Contact Us</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6" align="center">
                        <div style="font-size:14px;margin-top:50px;" class="pb-2">policies and terms:</div>
                        <div class="f-font">
        <a href="http://localhost/Dev_tricked_out/assets/term_condition/Tricked%20Out%20Terms%20and%20Privacy%20Policy-1.pdf" target="_blank" style="color: #ffae34;"> Terms of Service
                            <br> Privacy Policy</a>
                            <br/> GDPR & Data Protection
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="copy-font">copyright © <?= date('Y')?> Tricked Out LLC</div>
                    </div>
                    <div class="col-lg-5 mt-5">
                        <div class="row">
                    <div class="col icon-space"><img src="<?= base_url('assets/images/visa.svg') ?>" class="img-fluid" ></div>
                <div class="col icon-space"><img src="<?= base_url('assets/images/mastro.svg') ?>" class="img-fluid"></div>
                <div class="col icon-space"><img src="<?= base_url('assets/images/paypal.svg') ?>" class="img-fluid"></div>
                <div class="col icon-space"><img src="<?= base_url('assets/images/amex.svg') ?>" class="img-fluid"></div>
                        <div class="col icon-space"><img src="<?= base_url('assets/images/googlepay.svg') ?>" class="img-fluid"></div>
                        <div class="col icon-space"><img src="<?= base_url('assets/images/discover.svg') ?>" class="img-fluid"></div>
                        <div class="col icon-space"><img src="<?= base_url('assets/images/stripe.svg') ?>" class="img-fluid"></div>
                        <div class="col icon-space"><img src="<?= base_url('assets/images/venmo.svg') ?>" class="img-fluid"></div>
                   </div>
                    </div>
            </div>
        </div>
    </div>
<!-- Modal for trick info data ----- -->
<!-- Modal for trick info data ----- -->
<div class="modal fade" id="contactUsModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-image:url(<?= base_url('assets/images/Tricked-Out-Contact-Us.png') ?>);
    background-size:cover;background-position: top center;border:5px solid #fff;"> 
          <div class="modal-header"  style="border-bottom:none;justify-content: end;">
                <!-- <h5 class="modal-title"><i class="fa fa-plus"></i> Contact Us <span id="err_msg" style="color: red;padding-left: 100px;"></span></h5>  -->
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cross('contactUsModal');" style="border-radius: 50%;width:30px;height:30px;background-color:transparent;border:2px solid #fff;" >
          <span aria-hidden="true"  class="text-white">&times;</span>
        </button>

      </div>
      <!-- Modal body -->
       <div align="center"><img src="<?= base_url('assets/images/logo.svg') ?>" class="img-fluid "  width="200"></div>
        <div align="center"><h4 class="text-white mt-2" style="font-style: italic;">Have questions or need support?<br/>
The Tricked Out teams is here and happy to help!</h4>
        </div>
 <?php
$contactData = session()->get('contact_data');

?>   <?php if(session()->getFlashdata('showOtpPopup')): ?>
<form method="POST" action="<?= base_url('contactUs') ?>" id="varify-otp" name="varify-otp">

<?= csrf_field() ?>

<div class="modal-body">

<h5 class="text-white text-center">Enter OTP sent to your email</h5>

<div class="otp-container d-flex justify-content-center">

    <input type="text" class="otp-box" maxlength="1" required />
    <input type="text" class="otp-box" maxlength="1" required />
    <input type="text" class="otp-box" maxlength="1" required />
    <input type="text" class="otp-box" maxlength="1" required />
    <input type="text" class="otp-box" maxlength="1" required />
    <input type="text" class="otp-box" maxlength="1" required />

</div>
<input type="hidden" name="otp" id="otp" required>
</div>

<div class="modal-footer">
<!-- <button type="submit" class="btn btn-warning">Verify OTP</button> -->
<button type="submit" class="btn btn-warning" id="verifyOtpBtn">
    <span class="btn-text">Verify OTP</span>

    <span class="spinner-border spinner-border-sm d-none"
          role="status"
          aria-hidden="true">
    </span>
</button>

<!-- <button type="submit" class="btn btn-warning" id="contactBtn" style="width:100px">
          <span >Send</span>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button> -->

</div>

</form>
<?php else: ?>  
      <form action="<?= base_url('contactUs') ?>" method="POST" id="form-supplier" name="form-supplier">  
          <?= csrf_field() ?>
          <input type="hidden" name="form_token" value="<?= session()->get('form_token') ?>">
          <input type="text" name="website" style="display:none">

       <div class="modal-body">
        <div class="f_contact">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <input type="text" name="name" class="form-control form-bg ht inputcolor" placeholder="Name" value="" required>
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <input type="text" name="contact_phone" id="contact_phone" 
            class="form-control form-bg ht inputcolor" 
            placeholder="Contact Phone" 
            maxlength="16"
             pattern="^\(\d{3}\)\s\d{3}-\d{4}"
                  required
                  oninvalid="InvalidMsg(this,'Enter valid phone number')"
                  oninput="InvalidMsg(this,'Enter valid phone number')" >
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <input type="email" name="email" class="form-control form-bg ht inputcolor" placeholder="Email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" oninvalid="InvalidMsg(this,'Invalid email address.')" oninput="InvalidMsg(this,'Invalid email address.')" value="" required>
          </div>
          <div class="col-lg-12 col-md-12 mt-2">
            <textarea name="message" class="form-control form-bg inputcolor" placeholder="Message" rows="5"></textarea>
          </div>               
        </div>
        <div>
      </div> 
      <div class="modal-footer mt-1" style="border-top:none; padding:0px;margin:0px">
        <button type="submit" class="btn btn-warning" id="contactBtn" style="width:100px">
          <span >Send</span>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
                <!-- <button type="button" class="btn btn-secondary" onclick="cross('contactUsModal');">Cancel</button> -->
      </div>

      <script src="https://www.google.com/recaptcha/api.js?render=6Ld8OW0sAAAAADHIRWWJOl75uc4SAhJy6oxpedIo"></script>

        <input type="hidden" name="recaptcha_token" id="recaptcha_token">

        <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6Ld8OW0sAAAAADHIRWWJOl75uc4SAhJy6oxpedIo', {action: 'contact'})
            .then(function(token) {
                document.getElementById('recaptcha_token').value = token;
            });
        });
        </script>
    </form>
    <?php endif; ?>
    </div>
  </div>

</body>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){

    <?php if(session()->getFlashdata('showOtpPopup')): ?>

        // First hide contact modal
    $("#contactUsModal").modal("show");
    <?php endif; ?>

});
</script>
<script>

document.querySelectorAll(".otp-box").forEach((input, index, inputs) => {

    input.addEventListener("input", function() {

        if (this.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

        updateOTP();
    });

    input.addEventListener("keydown", function(e) {

        if (e.key === "Backspace" && this.value === "" && index > 0) {
            inputs[index - 1].focus();
        }

    });

});

function updateOTP()
{
    let otp = "";

    document.querySelectorAll(".otp-box").forEach(input => {
        otp += input.value;
    });

    document.getElementById("otp").value = otp;
}
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("verifyOtpBtn");
    const form = btn.closest("form");

    form.addEventListener("submit", function () {

        if (!form.checkValidity()) return;

        // disable button
        btn.disabled = true;

        // hide text
        //btn.querySelector(".btn-text").classList.add("d-none");

        // show spinner
        btn.querySelector(".spinner-border").classList.remove("d-none");

    });

});

</script>
<?php if (session()->getFlashdata('success')): ?>
    <script>
        alert("<?= session()->getFlashdata('success'); ?>");
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <script>
        alert("<?= session()->getFlashdata('error'); ?>");
    </script>
<?php endif; ?>
<script type="text/javascript">
function InvalidMsg(textbox,msg) {
   if(textbox.validity.patternMismatch){
     textbox.setCustomValidity(msg);
   }
   else {
     textbox.setCustomValidity('');
   }
   return true;
 }
function showContactUs(){
  $("#contactUsModal").modal("show");
}
function cross(id) {
  $('#'+id).modal('hide');
}
// Allow only numeric input + control keys
const isNumericInput = (event) => {
  const key = event.keyCode;
  return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105));
};

const isModifierKey = (event) => {
  const key = event.keyCode;
  return (event.shiftKey === true || key === 35 || key === 36) || // Shift, Home, End
         (key === 8 || key === 9 || key === 13 || key === 46) || // Backspace, Tab, Enter, Delete
         (key > 36 && key < 41) || // Arrow keys
         ((event.ctrlKey === true || event.metaKey === true) &&
         (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)); // Ctrl/Command + A,C,V,X,Z
};

const enforceFormat = (event) => {
  if(!isNumericInput(event) && !isModifierKey(event)) {
    event.preventDefault();
  }
};

// Format input to (123) 456-7890
const formatToPhone = (event) => {
  if(isModifierKey(event)) return;

  const input = event.target.value.replace(/\D/g,'').substring(0,10);
  const areaCode = input.substring(0,3);
  const middle = input.substring(3,6);
  const last = input.substring(6,10);

  if(input.length > 6) {
    event.target.value = `(${areaCode}) ${middle}-${last}`;
  } else if(input.length > 3) {
    event.target.value = `(${areaCode}) ${middle}`;
  } else if(input.length > 0) {
    event.target.value = `(${areaCode}`;
  } else {
    event.target.value = '';
  }
};

// Attach events
const contactPhoneInput = document.getElementById('contact_phone');
contactPhoneInput.addEventListener('keydown', enforceFormat);
contactPhoneInput.addEventListener('keyup', formatToPhone);
contactPhoneInput.addEventListener('change', formatToPhone);

/* Generic loader handler */
function enableLoader(formId, buttonId) {
  const form = document.getElementById(formId);
  const btn = document.getElementById(buttonId);

  if (!form || !btn) return;

  form.addEventListener('submit', function () {
    if (!form.checkValidity()) {
      return; // stop loader if form invalid
    }
    btn.classList.add('btn-loading');
  });
}

/* Newsletter form */
enableLoader('newsletterForm', 'newsletterBtn');

/* Contact Us form */
enableLoader('form-supplier', 'contactBtn');
</script>
<script>
  const yearlyBtn = document.getElementById('yearlyBtn');
  const monthlyBtn = document.getElementById('monthlyBtn');
  const prices = document.querySelectorAll('.price-div');
  const altBuys = document.querySelectorAll('.alt-buy');

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
  });

  function updateCheckoutFields(type) {
  document.querySelectorAll('.pricing-card').forEach(card => {
    const btn = card.querySelector('.buy-btn');
    if (!btn) return;

    card.querySelector('[name="subscription_id"]').value =
      btn.dataset[type + 'Id'];

    card.querySelector('[name="product_price_id"]').value =
      btn.dataset[type + 'PriceId'];
  });
}

yearlyBtn.addEventListener('click', () => updateCheckoutFields('yearly'));
monthlyBtn.addEventListener('click', () => updateCheckoutFields('monthly'));
</script>
</html>