<?php $this->includeFile( '_view/common/htmlhead.php' );
$newsrssContentRecords = $this->getValue( 'newsrssContentRecords', array() );
?>
<div class="wrapper">
	<?php $this->includeFile( '_view/common/left.php' ); ?>
    <section class="background-grey p-10">
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="12" data-isotope-item=".post-item">
            <div class="post-item">
                <div class="post-content-details">
                    <div class="post-title">
                        <h2><?= $newsrssContentRecords->getTitle() ?></h2>
                    </div>
                    <div class="fb-like"
                         data-href="https://<?= $_SERVER['HTTP_HOST'] ?><?= $_SERVER['REQUEST_URI'] ?>"
                         data-layout="standard" data-action="like" data-size="small" data-show-faces="true"
                         data-share="true"></div>
                    <div class="post-info">
                                <span class="post-autor"><a
                                            href="<?= $newsrssContentRecords->getTypeUrl() ?>"><?= $newsrssContentRecords->getTypeTitle() ?></a></span>
                    </div>
                    <div class="post-description">
                        <p><?= $newsrssContentRecords->getIntro() ?></p>
                    </div>
                </div>
                <div class="post-meta">
                    <div class="text-right">
                        <h3>
                            <a href="<?= $newsrssContentRecords->getLink() ?>" target="_blank">Tovább a teljes
                                cikkhez</a>
                        </h3>
                    </div>

                </div>
            </div>
        </div>
		<?php $this->includeFile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includeFile( '_view/common/htmlbottom.php' ); ?>
