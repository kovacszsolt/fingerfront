<?php
/**
 * Page left side Menus
 */
?>
<header id="header">
	<div id="header-wrap">
		<div class="container">
			<div id="logo">
				<h1 class="text-medium"><a href="/">IT Crowd . Hu</a></h1>
				<h4>Az Internet Közepe</h4>
			</div>
			<div id="side-panel-button" class="side-panel-button">
				<button class="lines-button x" type="button" >
					<span class="lines"></span>
				</button>
			</div>
			<div id="side-panel" class="side-panel-dark">
				<div class="side-panel-wrap">
					<div id="panel-logo" class="m-b-80 text-light">
						<h1 class="text-medium"><a href="/">IT Crowd . Hu</a></h1>
						<h4>Az Internet Közepe</h4>
						<ul>
							<?php foreach ( $this->getValue( 'newsrsstypeContentRecords', array() ) as $_newsrsstypeContentRecord ) : ?>
								<li>
									<a class="text-light navbar-link"
									   href="/<?= $_newsrsstypeContentRecord->getUrl(); ?>"><?= $_newsrsstypeContentRecord->getTitle(); ?></a></li>
							<?php endforeach; ?>
                            <li class=""><a href="/hirlevel/">Hírlevél</a>
                            <li>
                                <a class="text-light navbar-link"
                                   href="/az-oldalrol/">Az oldalról</a></li>
							<?php if ( is_null( $this->getValue( 'currentuser' ) ) ) : ?>
                                    <li><a class="navbar-link" href="/bejelentkezes/">Bejelentkezés</a></li>
                                    <li><a class="navbar-link" href="/regisztracio/">Regisztráció</a></li>
                                    <li><a class="navbar-link" href="/elfelejtett-jelszo/">Elfelejtett jelszó</a></li>
							<?php else : ?>
                                    <li><a class="navbar-link" href="/adataid/">Adataid</a></li>
                                    <li><a class="navbar-link" href="/hirbekuldes/">Hír beküldés</a></li>
                                    <li><a class="navbar-link" href="/kijelentkezes/">Kijelentkezés</a></li>
							<?php endif; ?>
						</ul>
					</div>
					<div class="panel-widget">
					</div>
					<div class="panel-widget">
						<div class="social-icons social-icons-dark">
							<ul>
								<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>