<header id="header" class="header-transparent">
    <div id="header-wrap">
        <div class="container">
            <div class="nav-main-menu-responsive">
                <button class="lines-button x"><span class="lines"></span></button>
            </div>
            <div class="navbar-collapse collapse main-menu-collapse navigation-wrap">
                <div class="container">
                    <nav id="mainMenu" class="main-menu mega-menu">
                        <ul class="main-menu nav nav-pills">
                            <li><a href="/"><i class="fa fa-home"></i></a></li>
							<?php foreach ( $this->getValue( 'newsrsstypeContentRecords', array() ) as $_newsrsstypeContentRecord ) : ?>
                                <li>
                                    <a href="/<?= $_newsrsstypeContentRecord->getUrl(); ?>"><?= $_newsrsstypeContentRecord->getTitle(); ?></a>
                                </li>
							<?php endforeach; ?>
                            <li class=""><a href="/hirlevel/">Hírlevél</a>
                            <li>
                                <a href="/az-oldalrol/">Az oldalról</a></li>
                            <li><a href="/hirbekuldes/">Hír beküldés <span class="label label-danger">Segíts</span></a>
                            </li>
							<?php if ( is_null( $this->getValue( 'currentuser' ) ) ) : ?>
                                <li><a href="/bejelentkezes/">Bejelentkezés</a></li>
                                <li><a href="/regisztracio/">Regisztráció</a></li>
                                <li><a href="/elfelejtett-jelszo/">Elfelejtett jelszó</a></li>
							<?php else : ?>
                                <li><a href="/adataid/">Adataid</a></li>
                                <li><a href="/kijelentkezes/">Kijelentkezés</a></li>
							<?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
