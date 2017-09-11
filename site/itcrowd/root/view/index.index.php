<?php $this->includeFile( '_view/common/htmlhead.php' ); ?>
<div class="wrapper">
	<?php $this->includeFile( '_view/common/left.php' ); ?>
    <section class="background-grey p-10">
        <div id="cookiepolicy" role="alert" class="alert alert-success hidden"><strong>Az oldal sütit használ!</strong>
            <a href="/adatkezelesi-nyilatkozat/">Az adatkezelési nyilatkozatot itt olvashatod el.</a> <a href="#"
                                                                                                         id="cookiepolicy_ok"
                                                                                                         class="btn btn-info btn-xs">Megértettem.</a>
        </div>
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="3" data-isotope-item=".post-item">
			<?php foreach ( $this->getValue( 'newsrssContentRecords' ) as $newsrssContentRecord ) : ?>
				<?php $newsrssContentImageRecords = $newsrssContentRecord->getImages();
				$_image                           = '/site/itcrowd/images/default.jpg';
				if ( ! is_null( $newsrssContentImageRecords ) ) {
					$newsrssContentImageRecords = $newsrssContentImageRecords[0];
					$_image                     = '/itcrowd/root/index/read/newsrss/thumb/' . $newsrssContentImageRecords->getId() . '.' . $newsrssContentImageRecords->getExtension();
				}
				?>
                <div class="post-item">
                    <div class="post-image">
                        <a href="/<?= $newsrssContentRecord->getUrl() ?>">
                            <img alt="<?= $newsrssContentRecord->getTitle(); ?>" src="<?= $_image ?>">
                        </a>
                    </div>
                    <div class="post-content-details">
                        <div class="post-title">
                            <h3>
                                <a href="/<?= $newsrssContentRecord->getUrl() ?>"><?= $newsrssContentRecord->getTitle(); ?></a>
                            </h3>
                        </div>
                        <div class="post-info">
                            <span class="post-autor"><a
                                        href="<?= $newsrssContentRecord->getTypeUrl(); ?>"><?= $newsrssContentRecord->getTypeTitle() ?></a></span>
                        </div>
                        <div class="post-description">
                            <p><?= $newsrssContentRecord->getIntro(); ?></p>

                            <div class="post-info">
                                <a class="read-more" href="/<?= $newsrssContentRecord->getUrl() ?>">bővebben <i
                                            class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
			<?php endforeach; ?>
        </div>
    </section>
	<?php $this->includeFile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includeFile( '_view/common/htmlbottom.php' ); ?>
