<?php
$qrData = session()->get('qrData');
//var_dump($qrData);exit();
if(session()->get('qrCode') != NULL) {
    $cafe = $qrData["cafe"];
    $qrInfo = $qrData["data"];
}else{
    return redirect()->to('auth');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="X Cafe">
    <meta name="keywords" content="X Cafe">
    <meta name="author" content="X Cafe">
    <link rel="icon" href="<?= base_url('public/assets/images/logo/favicon.png') ?>" type="image/x-icon">
    <title>X Cafe App</title>
    <link rel="apple-touch-icon" href="<?= base_url('public/assets/images/logo/favicon.png') ?>">
    <meta name="theme-color" content="#1a365d">
    <meta name="mobile-web-app-capable" content="yes">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="X Cafe">
    <meta name="msapplication-TileImage" content="<?= base_url('public/assets/images/logo/favicon.png') ?>">
    <meta name="msapplication-TileColor" content="#FFFFFF">

    <!-- font link -->
    <link rel="stylesheet" href="<?= base_url('public/assets/css/br-hendrix.css') ?>">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/vendors/bootstrap.css') ?>">
    <!-- iconsax icon css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/vendors/iconsax.css') ?>">
    <!-- swiper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/vendors/swiper-bundle.min.css') ?>">
    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/css/custom.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("public/assets/css/toastify.min.css") ?>">

    <script src="<?= base_url("public/assets/js/jquery.min.js") ?>"></script>

    <script src="<?= base_url("public/assets/js/jsQR.min.js") ?>"></script>

    <!-- bootstrap js -->
    <script src="<?= base_url('public/assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/toastify-js.js') ?>"></script>
</head>

<body>
<!-- loader start-->
<div class="loader-wrapper" id="loader">
    <span class="loader"></span>
</div>
<!-- loader end -->
<?php include(APPPATH . 'Views/sections/header.php'); ?>
<div class="content" >
    <?= $this->renderSection('content') ?>
</div>

<?php include(APPPATH . 'Views/sections/bottom.php'); ?>
<?php include(APPPATH . 'Views/sections/sidebar.php'); ?>
<?php include(APPPATH . 'Views/sections/footer.php'); ?>
<!-- swiper js -->
<script src="<?= base_url('public/assets/js/swiper-bundle.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/custom-swiper.js') ?>"></script>
<!-- iconsax icon -->
<script src="<?= base_url('public/assets/js/iconsax-icon.js') ?>"></script>
<!-- template-setting js -->
<script src="<?= base_url('public/assets/js/template-setting.js') ?>"></script>
<!-- range slider js -->
<script src="<?= base_url('public/assets/js/range-slider.js') ?>"></script>
<!-- timer js -->
<script src="<?= base_url('public/assets/js/timer.js') ?>"></script>
<!-- tap to tap js -->
<script src="<?= base_url('public/assets/js/tap-to-top.js') ?>"></script>
<!-- script js -->
<script src="<?= base_url('public/assets/js/script.js') ?>"></script>
<script src="<?= base_url('public/assets/js/custom.js') ?>"></script>
</body>

</html>