<?php $newsrssContentRecords = $this->getValue( 'newsrssContentRecords', array() );  ?>
<?php $this->includeFile( '_view/common/htmlhead.php' ); ?>
<div class="wrapper">
	<?php $this->includeFile( '_view/common/menu.php' ); ?>
    <section class="background-grey p-10">
        <div class="isotope" data-isotope-item-space="1" data-isotope-col="12" data-isotope-item=".post-item">
            <div class="post-item">
                <div class="post-content-details">
                    <div class="post-title">
                        <h2>Az oldalról</h2>
                    </div>
                    <div class="post-description">
                        <p>Az IT Crowd. HU azzal a céllal jött létre, hogy a magyar nyelvű IT hírekből
                            összegyüjtse azokat amik a leginkább érdekesek, leginkább figyelemre méltóak. </p>
                        <p>Az oldalt készítette: Kovács Zsolt</p>
                        <p>e-mail: <a href="mailto:info@itcrowd.hu">info@itcrowd.hu</a></p>
                        <p>facebook: <a title="facebook" target="_blank" href="https://www.facebook.com/itcrowddothu">https://www.facebook.com/itcrowddothu</a></p>
                        <p>Chat bot: <a title="facebook" target="_blank" href="https://www.messenger.com/t/itcrowddothu">https://www.messenger.com/t/itcrowddothu</a></p>
                        <p>android kliens: <a target="_blank" href="https://play.google.com/store/apps/details?id=com.seatedclimb.itcrowd">Google Play Store</a></p>
                    </div>
                </div>

            </div>
        </div>
		<?php $this->includeFile( '_view/common/footer.php' ); ?>
</div>
<?php $this->includeFile( '_view/common/htmlbottom.php' ); ?>




