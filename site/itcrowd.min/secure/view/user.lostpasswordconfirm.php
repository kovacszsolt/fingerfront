<?php $this->includeFile( '_view/common/htmlhead.php' );
$newsrssContentRecords = $this->getValue( 'newsrssContentRecords', array() );
?>
<div class="wrapper">
	<?php $this->includeFile( '_view/common/menu.php' ); ?>
    <section class="background-grey p-10">
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="12" data-isotope-item=".post-item">
            <div class="post-item">
                <div class="post-content-details">
                    <div class="post-title">
                        <h2>Elfelejtett jelszó</h2>
                    </div>
                    <div class="post-description">
                        <form id="registration_form" class="user_form" data-valid="0" method="post"
                              data-finger_valid="0" data-name="registration">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="email">email</label>
                                        <input type="text" class="form-control required" name="email"
                                               placeholder="email" value=""
                                               data-finger_type="email"
                                               id="email" aria-required="true"
                                               data-finger_message_email="Az email mező csak heyles e-mailt tartalmazhat"
                                               data-finger_message_required="Az e-mail mező kitöltése kötelező">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="newpassword">Új jelszó</label>
                                        <input type="password" class="form-control required" name="newpassword"
                                               placeholder="Új jelszó" value=""
                                               data-finger_equal="newpassword2"
                                               id="newpassword" aria-required="true"
                                               data-finger_message_required="Az Új jelszó mező kitöltése kötelező">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="newpassword2">Új jelszó megismétlése</label>
                                        <input type="password" class="form-control required" name="newpassword2"
                                               placeholder="Új jelszó megismétlése" value=""
                                               id="newpassword2" aria-required="true"
                                               data-finger_equal="newpassword"
                                               data-finger_message_required="Az Új jelszó megismétlése mező kitöltése kötelező"/>
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
                                    <button type="submit" class="button green effect icon-left"><span><i class="fa fa-save"></i>Jelszó frissítése</span></button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
		<?php $this->includeFile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includeFile( '_view/common/htmlbottom.php' ); ?>


