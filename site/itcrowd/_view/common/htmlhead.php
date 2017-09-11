<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>


    <link rel="shortcut icon" href="/site/itcrowd/images/favicon.png">
    <title><?= $this->page_title; ?></title>
    <meta name="description" content="<?= $this->facebook_description; ?>">
    <meta property="fb:pages" content="<?= $this->facebook_pages; ?>"/>
    <meta property="fb:app_id" content="<?= $this->facebook_appid; ?>"/>
    <meta property="og:type" content="<?= $this->facebook_type; ?>"/>
    <meta property="og:url" content="https://<?= \finger\server::host() ?>/<?= \finger\server::uri() ?>"/>
    <meta property="og:title" content="<?= $this->page_title; ?>"/>
    <meta property="og:description" content="<?= $this->facebook_description; ?>"/>
    <meta property="og:image"
          content="<?= \finger\request::_getProtocol() . '://' . \finger\request::_getServerName() ?><?= $this->facebook_image; ?>"/>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet">


    <!-- Vendor css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
    <link href="/site/itcrowd/css/style.min.css" rel="stylesheet">

    <!-- LOAD GOOGLE FONTS -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,800,700,600%7CRaleway:100,300,600,700,800"
          rel="stylesheet" type="text/css"/>

    <link href="https://fonts.googleapis.com/css?family=Cedarville+Cursive" rel="stylesheet" type="text/css">

    <!-- CSS CUSTOM STYLE -->

    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>

    <!-- <script src="/site/itcrowd/js/jquery-1.11.2.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jRespond/1.0.0/js/jRespond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.stellar/0.6.2/jquery.stellar.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<?php if ( $this->settings->get( 'secure.googlecaptcaptchaenabled', 1 ) == 1 ) : ?>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<?php endif; ?>
</head>


<body class="wide wide side-panel-static">
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.10&appId=1815247582131012";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- SITE LOADER -->
<div class="loader-wrapper vertical-align">
    <div class="loader">
        <img width="40" src="/site/itcrowd/images/svg-loaders/puff.svg" alt="Loading">

        <span class="loader-title">Page is loading, just a sec...</span>
    </div>
</div>

<!-- END: SITE LOADER -->