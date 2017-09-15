<?php
$currentUser           = $this->getValue( 'currentuser', null );
$newsrssContentRecords = $this->getValue( 'newsrssContentRecords', array() );
?>
<?php $this->includeFile( '_view/common/htmlhead.php' ); ?>
<div class="wrapper">
	<?php $this->includeFile( '_view/common/left.php' ); ?>
    <section class="background-grey p-10">
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="12" data-isotope-item=".post-item">
            <div class="post-item">
                <div class="post-content-details">
                    <div class="post-title">
                        <h2>Adataid</h2>
                    </div>
                    <div class="post-description">
                        <form id="login_form" data-valid="0" class="user_form" method="post" action=""
                              data-finger_valid="0" data-name="profile">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="name">Név</label>
                                        <input type="text" class="form-control required" name="name" placeholder="Név"
                                               value="<?= $currentUser->getTitle(); ?>"
                                               data-finger_message_required="A név mező kitöltése kötelező" id="name"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="name">e-mail</label>
                                        <input type="email" class="form-control required" name="email"
                                               placeholder="e-mail" value="<?= $currentUser->getEmail(); ?>"
                                               id="email" disabled
                                               aria-required="true"/>
										<?php if ( ! is_null( $currentUser->getSociailFacebook() ) ) : ?>
                                            <p>
                                                <img src="//graph.facebook.com/<?= $currentUser->getSociailFacebook()->getSocialid(); ?>/picture"
                                                ><code>Facebook fiók hozzákapcsolva!</code>
                                            </p>
										<?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="upper" for="password">jelszó</label>
                                        <input type="password" class="form-control" name="password"
                                               value=""
                                               data-finger_message_required="A jelszó mező kitöltése kötelező"
                                               placeholder="jelszó" id="password" aria-required="true">
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
                                    <button type="submit" class="button green effect icon-left"><span><i
                                                    class="fa fa-save"></i>Módosítás</span></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="login_ok" class="col-md-12 hidden">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="/adataid/" class="btn btn-info">Adataid</a>
                            </div>
                            <div class="col-md-4">
                                <a href="/hirbekuldes/" class="btn btn-info">Hír beküldés</a>
                            </div>
                            <div class="col-md-4">
                                <a href="/kijelentkezes/" class="btn btn-info">Kijelentkezés</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
		<?php $this->includeFile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includeFile( '_view/common/htmlbottom.php' ); ?>





