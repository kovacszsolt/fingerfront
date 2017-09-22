<header class="header-transparent header-fullwidth">
    <div>
        <div class="container">

            <!--LOGO-->
            <div id="logo">
                <a href="/" class="logo" data-dark-logo="/tempates/itcrowd/images/logo.png"> <img
                            src="/site/itcrowd/images/logo.png" alt="IT Crowd"> </a>
            </div>
            <!--END: LOGO-->

            <div id="shopping-cart">
                <a href="/rss/"><i class="fa fa-rss"></i></a>
            </div>
            <div id="shopping-cart">
                <a href="https://play.google.com/store/apps/details?id=com.seatedclimb.itcrowd" target="_blank"><i
                            class="fa fa-android"></i></a>
            </div>
            <!--MOBILE MENU -->
            <div class="nav-main-menu-responsive">
                <button class="lines-button x">
                    <span class="lines"></span>
                </button>
            </div>
            <!--END: MOBILE MENU -->
            <!--END: TOP SEARCH -->


            <div class="navbar-collapse collapse main-menu-collapse navigation-wrap">
                <div class="container">
                    <nav class="main-menu mega-menu" id="mainMenu">
                        <ul class="main-menu nav nav-pills">
							<?php foreach ( $this->getValue( 'newsrsstypeContentRecords' ) as $newsrsstypeContentRecord ) : ?>
                                <li class=""><a
                                            href="/<?= $newsrsstypeContentRecord->getUrl(); ?>"><?= $newsrsstypeContentRecord->getTitle(); ?></a>
                                </li>
							<?php endforeach; ?>
                            <li class="dropdown"><a href="">Személyes oldal<i class="fa fa-angle-down"></i></a>
								<?php if ( is_null( $this->getValue( 'currentuser' ) ) ) : ?>
                                    <ul class="dropdown-menu">
                                        <li><a class="navbar-link" href="/bejelentkezes/">Bejelentkezés</a></li>
                                        <li><a class="navbar-link" href="/regisztracio/">Regisztráció</a></li>
                                        <li><a class="navbar-link" href="/elfelejtett-jelszo/">Elfelejtett jelszó</a>
                                        </li>
                                    </ul>
								<?php else : ?>
                                    <ul class="dropdown-menu">
                                        <li><a class="navbar-link" href="/adataid/">Adataid</a></li>
                                        <li><a class="navbar-link" href="/hirbekuldes/">Hír beküldés</a></li>
                                        <li><a class="navbar-link" href="/kijelentkezes/">Kijelentkezés</a></li>
                                    </ul>
								<?php endif; ?>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>

            <!--END: NAVIGATION-->
        </div>
    </div>
</header>
