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
</body>
</html>
