<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="text-center">
    <h2 class="text-danger">⚠️ Error</h2>
    <p><?= $message ?? 'Something went wrong.' ?></p>
    <a href="<?= base_url() ?>" class="btn btn-primary mt-2">Go Home</a>
</div>

</body>
</html>