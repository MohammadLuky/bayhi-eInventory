<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title><?= $title; ?></title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/error404/') ?>css/style.css" />

</head>

<body>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>Oops! This Page Could Not Be Found</h2>
            <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p>
            <?php if ($this->session->userdata('peran_id') == 1) : ?>
                <a href="<?= base_url('admin'); ?>">Go To Homepage</a>
            <?php elseif ($this->session->userdata('peran_id') == 2) : ?>
                <a href="<?= base_url('adminaset'); ?>">Go To Homepage</a>
            <?php elseif ($this->session->userdata('peran_id') == 3) : ?>
                <a href="<?= base_url('adminatk'); ?>">Go To Homepage</a>
            <?php elseif ($this->session->userdata('peran_id') == 4) : ?>
                <a href="<?= base_url('unit'); ?>">Go To Homepage</a>
            <?php elseif ($this->session->userdata('peran_id') == 5) : ?>
                <a href="<?= base_url('subunit'); ?>">Go To Homepage</a>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>