<!DOCTYPE html>
<html lang="hu">
<?php $this->includeFile('_view/common/htmlhead.php'); ?>
<body class="wide" style="background-image:url('/site/itcrowd/images/pattern/pattern22.png');">
<div id="fb-root"></div>
<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v2.8&appId=1815247582131012";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

<div class="loader-wrapper">
    <div class="loader"><img width="40" src="/site/itcrowd/images/svg-loaders/puff.svg" alt=""> <span
                class="loader-title">Mindjárt jövök...</span>
    </div>
</div>
<!--END: SITE LOADER-->

<!--WRAPPER-->
<div class="wrapper">
	<?php $this->includeFile('_view/common/menu.php'); ?>
    <section class="p-t-20">
        <section class="p-t-20">
            <div class="container-fluid">
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="upper" for="url">email</label>
                                <input type="text" class="form-control required" name="email" placeholder="email"
                                       id="email" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="upper" for="url">password</label>
                                <input type="password" class="form-control required" name="password"
                                       placeholder="password" id="password" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="g-recaptcha"
                                     data-sitekey="<?= $this->settings->get('secure.googlecaptcaptchapublic') ?>"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="button"><span>Belépés</span></button>
                        </div>
                    </div>

                </form>
            </div>
        </section>

    </section>
    <!-- FOOTER -->
	<?php $this->includeFile('_view/common/footer.php'); ?>
</div>
<?php $this->includeFile('_view/common/htmlbottom.php'); ?>
