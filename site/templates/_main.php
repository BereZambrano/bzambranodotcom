<?php namespace ProcessWire;


\Less_Autoloader::register();

//Compile UIKit

$less_files = array();
$uikitFile = $config->paths->templates . 'css/uikit-custom.less';

$less_files = array(
  $uikitFile => $config->path->templates . 'css/uikit-custom.css'
);

$uikitOptions = array(
  'cache_dir'    => $config->paths->assets . 'cache/less/',
  'output'       => $config->paths->templates . 'css/build.css',
  'relativeUrls' => true
);


$uikitCustomFilename = \Less_Cache::Get($less_files, $uikitOptions);
//$log->save("less", $uikitCustomFilename);\


?>
<!DOCTYPE html>
<html lang="<?= $user->language->name == "default" ? "es" : "en" ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="ProcessWire">
    <meta name="p:domain_verify" content="0e8134772caa50fd446608012050877c"/>
    <link rel="stylesheet" href="<?= $urls->templates ?>css/build.css" class="href">
    <link rel="stylesheet" href="<?= $urls->templates ?>styles/main.css" class="href">
    <link rel="icon"
          type="image/png"
          href="<?= $urls->templates ?>img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <?php if ($user->language->name == "default"): ?>
        <link rel="alternate" hreflang="en" href="<?= $page->localUrl('en') ?>"/>
    <?php else: ?>
        <link rel="alternate" hreflang="es" href="<?= $page->localUrl('es') ?>"/>
    <?php endif ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,200;0,300;0,400;1,200;1,300;1,400&family=Inter:wght@300;400&display=swap"
          rel="stylesheet">

    <?php
    $page->getOpenGraphImage();
    ?>
    <?php echo $page->seo ? $page->seo->render() : ''; ?>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async data-type="text/javascript" data-category="statistics"
            data-src="https://www.googletagmanager.com/gtag/js?id=G-24ME372RVR"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-24ME372RVR');
    </script>

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KDC3Z6G"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="mobile-navbar" uk-sticky>
    <div class="uk-background-default uk-container">
        <div class="uk-hidden@m">
            <nav class="uk-navbar">
                <div class="uk-navbar-left">

                    <div class="uk-navbar-item">
                        <a class="uk-link-reset bzambrano-logo" href="<?= $home->url ?>">
                            <!-- <img class="mango" style="" src="<?= $urls->templates ?>img/mango@0.5x.png">-->
                            <span>
                            <span class="name">berenice</span><span class="apellido">zambrano</span><br>
                        </span>
                            <span class="work">[Design + Research]</span>
                        </a>
                    </div>
                </div>
                <div class="uk-navbar-right">
                    <div>
                        <a aria-haspopup="true" tabindex="0" uk-toggle="target:#offcanvas-menu"
                           class="menu-toggle uk-navbar-item">
                            <i uk-icon="icon:menu;ratio:2;"></i>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<div id="offcanvas-menu" uk-offcanvas="mode:reveal;overlay:true;flip:true;">

    <div class="uk-offcanvas-bar">

        <div class="uk-position-small uk-position-top-right">
            <a href="" uk-toggle="target:#offcanvas-menu">
                <i uk-icon="icon:close;ratio:2"></i>
            </a>
        </div>

        <ul class="uk-margin-large-top uk-nav uk-nav-default">
            <li>
                <a href="<?= $home->url ?>">
                    <?= $home->title ?>
                </a>
            </li>
            <?php foreach ($home->children() as $item): ?>
                <?php if ($item->name == "portafolio"): ?>
                    <li class="uk-parent">
                        <a href="<?= $item->url ?>"><?= $item->title ?></a>
                        <ul class="uk-nav-sub">
                            <?php foreach ($pages->find('template=servicio') as $servicio): ?>
                                <li class="<?= $servicio->name == $input->urlSegment2 ? "uk-active" : "" ?>">
                                    <a href="/portafolio/servicio/<?= $servicio->name ?>">
                                        <?= $servicio->title ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= $item->url ?>">
                            <?= $item->title ?>
                        </a>
                    </li>
                <?php endif ?>
            <?php endforeach ?>
            <li class="">
                <a class="mobile-contact-link" href="#footer-contact" uk-scroll><?= __("Contacto") ?></a>
            </li>

            <li class="language-switcher">
                <a class="uk-display-inline-block <?= $input->url == $page->localUrl('default') ? "uk-active" : "" ?>"
                   href="<?= page()->localUrl("default") ?>">es</a>

                <span style="margin:0 5px">/</span>
                <a class="uk-display-inline-block <?= $input->url == $page->localUrl('en') ? "uk-active" : "" ?>"
                   href="<?= page()->localUrl("en") ?>">en</a>
            </li>

        </ul>
    </div>

</div>

<div class="menu-container uk-background-default" uk-sticky>
    <div class="uk-container uk-container-large">
        <div class="uk-visible@m">
            <div class="uk-width-1-1">
                <!--
                hx-boost="true"
                     hx-target="main"
                     hx-swap="outerHTML"
                     hx-select="main"
                     hx-oob="true"
                -->
                <nav class="uk-navbar-container uk-flex-center uk-navbar-transparent uk-navbar"
                     uk-navbar>
                    <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav">
                            <li class="uk-flex uk-flex-middle">
                                <a class=" bzambrano-logo" href="<?= $home->url ?>">
                                    <!-- <img class="mango" style="" src="<?= $urls->templates ?>img/mango@0.5x.png">-->
                                    <span>
                                    <span class="name">berenice</span><span class="apellido">zambrano</span><br>
                                    </span>
                                    <span class="work">[Design + Research]</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-center">
                        <ul class="uk-navbar-nav  uk-flex-between">

                            <?php foreach ($home->children as $servicio): ?>
                                <li class="<?= $servicio == $page ? 'uk-active' : '' ?>">
                                    <a href="<?= $servicio->url ?>">
                                        <?= $servicio->title ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                            <li class="">
                                <a href="#footer-contact" uk-scroll><?= __("Contacto") ?></a>
                            </li>

                        </ul>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav  uk-flex-between">


                            <li class="language-switcher">
                                <div class="uk-navbar-item">
                                    <a class="uk-display-inline-block <?= $input->url == $page->localUrl('default') ? "uk-active" : "" ?>"
                                       href="<?= page()->localUrl("default") ?>">es</a>

                                    <span style="margin:0 5px">/</span>
                                    <a class="uk-display-inline-block <?= $input->url == $page->localUrl('en') ? "uk-active" : "" ?>"
                                       href="<?= page()->localUrl("en") ?>">en</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>
        </div>
    </div>
</div>

<main id="main-content">

</main>

<hr class="uk-margin-xlarge">
<footer id="footer"
        class="<?= $page->matches('template=about') ? "uk-margin-xlarge-bottom" : "uk-margin-large-top uk-margin-large" ?>">
    <div class="uk-container <?= $page->template != "proyecto" ? "uk-container-small" : '' ?>">
        <div class="">
            <div class="uk-flex-center uk-grid" uk-grid>
                <div class="uk-width-1-1 <?= $page->template == "proyecto" ? " uk-width-1-5@m" : 'uk-width-1-3@m' ?>">
                    <p class="uk-bold">
                        <?= __("I’m always open to hearing about new project opportunities, regardless of where you are located. Feel free to contact me and let's check if we are compatible to collaborate :)") ?>
                    </p>
                    <hr>
                    <div class="uk-container uk-flex uk-flex-center">
                        <ul class="uk-iconnav">
                            <?php foreach ($home->social_media as $icon): ?>
                                <?php if ($icon->title == "telegram"): ?>
                                    <li>
                                        <a target="_blank" class="uk-icon uk-icon-image uk-margin-right"
                                           style="background-image: url('/site/templates/img/telegram.png');"
                                           href="<?= $icon->url_address ?>">
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li><a class="uk-margin-right" href="<?= $icon->url_address ?>"
                                           uk-icon="icon: <?= $icon->title ?>">

                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <hr>
                    <p><a href="<?= $pages->get('/politica-de-privacidad/')->url ?>">
                            <?= $pages->get('/politica-de-privacidad/')->title ?>
                        </a></p>
                </div>
                <div id="footer-contact"
                     class="uk-width-1-1 <?= $page->template == "proyecto" ? " uk-width-3-5@m" : 'uk-width-2-3@m' ?>">
                    <?php echo $forms->embed('contacto'); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?= $urls->templates ?>js/uikit.min.js"></script>
<script src="<?= $urls->templates ?>js/uikit-icons.min.js"></script>
<script src="<?= $urls->templates ?>js/nanobar.min.js"></script>
<script src="https://unpkg.com/htmx.org@1.6.1"></script>

<script>
    var options = {
        classname: 'my-class',
        id: 'my-id'
    };
    var util = UIkit.util;

    window.bereBar = new Nanobar(options);
    htmx.on("htmx:beforeSend", function (e) {
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        var el = e.detail.elt;
        if (el.classList.contains('transition-link')) {
            bereBar.go(getRandomInt(20, 70)); // size bar 76%6
        }
    });
    htmx.on("htmx:beforeSwap", function () {
        bereBar.go(100);
    });

    htmx.onLoad(function () {
        UIkit.util.on('#services-list li a', 'click', function (e) {
            document.querySelectorAll('#services-list li a').forEach(function (item) {
                item.parentElement.classList.remove('uk-active');
            })
            this.parentElement.classList.add('uk-active');
        })
    });

    var contactMobile = document.querySelector('.mobile-contact-link');
    contactMobile.addEventListener("click", function () {
        UIkit.offcanvas("#offcanvas-menu").hide();
    });
    UIkit.util.on(document, 'load', 'img', e => {
        if (!e.target.currentSrc.startsWith('data:')) {
            e.target.classList.add('is-loaded');
        }
    }, true);

    var items = util.$$('.gallery-item');
    if (items.length) {
        items = items.map(function (item, index) {
            util.attr(item, 'data-index', index);
            return {
                "source": item.href,
                "caption": item.dataset.caption
            }
        })
        //console.log(items);
        var panelOptions = {
            "items": items
        };

        util.on(document, 'click', '.gallery-item', function (e) {
            e.preventDefault();
            var item = e.current;
            var index = item.dataset.index;
            var gallery = UIkit.lightboxPanel(panelOptions);
            gallery.show(index);
        })
    }

    var social = document.querySelectorAll('.MarkupSocialShareButtons');

    social.forEach((item, index) => {
        util.append(item, "<li uk-tooltip=\"Click to copy\"  class=\"copy-action mssb-item\" style='color:#9B9B9B'><span uk-icon=\"link\"></span></li>");
        var copy = util.$(".copy-action", item);
        var currentPage = document.location.href;

        function setClipboard(text) {
            const type = "text/plain";
            const blob = new Blob([text], {type});
            const data = [new ClipboardItem({[type]: blob})];

            navigator.clipboard.write(data).then(
                () => {
                    /*util.attr(copy, 'uk-tooltip', 'Copied!');
                    UIkit.tooltip(copy).show();*/
                },
                () => {
                    /* failure */
                    console.log("failed!");
                }
            );
        }

        util.on(copy, 'click', (e) => {
            setClipboard(currentPage);
        })
    });

</script>
</body>
</html>
