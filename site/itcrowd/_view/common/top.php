<div class="loader"></div>
<nav class="navbar navbar-fixed-top background-white hidden ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img alt="Brand" src="/site/itcrowd/images/logo-50.png"></a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
				<?php foreach ( $this->getValue( 'newsrsstypeContentRecords', array() ) as $_newsrsstypeContentRecord ) : ?>
                    <li class="">
                        <a class="navbar-link"
                           href="/<?= $_newsrsstypeContentRecord->getUrl(); ?>"><?= $_newsrsstypeContentRecord->getTitle(); ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="navbar-link dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-haspopup="true"
                       aria-expanded="false">Személyes oldal <span class="caret"></span></a>
					<?php if ( is_null( $this->getValue( 'currentuser' ) ) ) : ?>
                        <ul class="dropdown-menu">
                            <li><a class="navbar-link" href="/bejelentkezes/">Bejelentkezés</a></li>
                            <li><a class="navbar-link" href="/regisztracio/">Regisztráció</a></li>
                            <li><a class="navbar-link" href="/elfelejtett-jelszo/">Elfelejtett jelszó</a></li>
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
        </div>
    </div>
</nav>