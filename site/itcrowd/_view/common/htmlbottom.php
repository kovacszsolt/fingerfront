<?php
/**
 * Page footer javascript includes
 */
?>
<a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>
<script src="/site/itcrowd/js/custom.min.js<?php if ( $this->settings->get( 'developer', 0 ) == 1 ) {
	echo '?tmp=' . date( 'U' );
} ?>"></script>
<?php $_message = \finger\session::flash( 'message' ); ?>
<?php if ( $_message != '' ) : ?>
    <script type="text/javascript">
        $(document).fingerValidator.notify('<?=$_message; ?>');
    </script>
<?php endif; ?>
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js"
        data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">require(["mojo/signup-forms/Loader"], function (L) {
        L.start({"baseUrl": "mc.us15.list-manage.com", "uuid": "b31a10326345ccbc925acb4df", "lid": "844161a163"})
    })</script>
</body>
</html>
