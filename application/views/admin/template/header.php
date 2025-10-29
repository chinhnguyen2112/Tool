<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title><?= $title ?? 'Admin Panel' ?> | Quản trị</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="<?= base_url('assets/media/logos/favicon.ico') ?>" />
    <base href="<?= base_url() ?>">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" rel="stylesheet">

    <!-- Metronic CSS -->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet">
    <link href="assets/css/style.bundle.css" rel="stylesheet">
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet">

    <!-- Anti-Clickjacking -->
    <script>
        if (window.top !== window.self) window.top.location.replace(window.self.location.href);
    </script>
</head>

<body id="kt_body" class="header-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="page d-flex flex-row flex-column-fluid">