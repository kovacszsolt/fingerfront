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
                            <h2>Hír beküldés</h2>
                        </div>
                        <div class="post-description">
                            <form id="newsadd_form" data-name="newsadd" class="user_form" method="post"
                                  data-finger_valid="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="upper" for="url">URL</label>
                                            <input type="text" data-finger_type="url" id="url"
                                                   class="form-control required"
                                                   name="url" placeholder="url" value=""
                                                   data-finger_message_required="Az URL mező kitöltése kötelező"
                                                   data-finger_message_url="A mező csak URL-t tartalmazhat"
                                                   aria-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="upper" for="type">Típus</label>
                                            <select class="form-control required" name="type">
												<?php foreach ( $this->getValue( 'contentTypeRecords' ) as $contentTypeRecord ) : ?>
                                                    <option value="<?= $contentTypeRecord->getId(); ?>"><?= $contentTypeRecord->getTitle(); ?></option>
												<?php endforeach; ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                        <button type="submit" class="button green effect icon-left"><span><i class="fa fa-save"></i>Beküldés</span></button>
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