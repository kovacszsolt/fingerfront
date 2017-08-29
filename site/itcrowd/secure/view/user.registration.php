<?php
$this->includefile( '_view/common/htmlhead.php' );
$newsrsscontentrecords = $this->getvalue( 'newsrsscontentrecords', array() );
?>

<div class="wrapper">
	<?php $this->includefile( '_view/common/left.php' ); ?>
    <section class="background-grey p-10">
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="12" data-isotope-item=".post-item">
            <div class="post-item">
                <div class="post-content-details">
                    <div class="post-title">
                        <h2>bejelentkezés</h2>
                    </div>
                    <div class="post-description">
                        <form id="registration_form" data-valid="0" class="user_form" method="post"
                              action="/user/registration/" data-finger_valid="" data-name="registration">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="name">név</label>
                                        <input type="text" class="form-control required" name="name" placeholder="név"
                                               value=""
                                               data-finger_message_required="a név mező kitöltése kötelező" id="name"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="email">email</label>
                                        <input type="email" class="form-control required" name="email"
                                               placeholder="email" value=""
                                               data-finger_type="email"
                                               id="email" aria-required="true"
                                               data-finger_message_required="az e-mail mező kitöltése kötelező">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="password">jelszó</label>
                                        <input type="password" class="form-control required" name="password"
                                               data-finger_equal="password2"
                                               value=""
                                               data-finger_message_required="a jelszó mező kitöltése kötelező"
                                               placeholder="jelszó" id="password" aria-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="password2">jelszó mégegyszer</label>
                                        <input type="password" class="form-control required" name="password2"
                                               data-finger_equal="password"
                                               value=""
                                               data-finger_message_required="a jelszó ismételt megadása kitöltése kötelező"
                                               placeholder="jelszó mégegyszer" id="password2" aria-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
		                            <?php if ( $this->settings->get( 'secure.googlecaptcaptchaenabled', 1 ) == 1 ) : ?>
                                        <div class="form-group">
                                            <div class="g-recaptcha"
                                                 data-sitekey="<?= $this->settings->get( 'secure.googlecaptcaptchasitekey' ); ?>"></div>
                                        </div>
		                            <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="button"><span>regisztráció</span></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="registration_ok" class="col-md-12 hidden">

                        <h2>a regisztrációt a e-mail címre kapott levéllel tudod véglegesíteni.</h2>
                    </div>
                </div>

            </div>
        </div>
		<?php $this->includefile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includefile( '_view/common/htmlbottom.php' ); ?>




