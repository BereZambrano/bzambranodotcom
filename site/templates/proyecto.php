<?php namespace ProcessWire;
//if($page->content->count()
$header_image = $page->getHeaderImage();
?>
<div id="main-content" class="proyecto uk-background-secondary" pw-append>
    <div class="uk-light uk-container">

        <div class="uk-margin-large-top">
            <a href="<?= $page->parent()->url ?>">
                <img class="back-arrow" src="/site/templates/img/Arrow1.png" alt="Arrow1">
            </a>
        </div>

        <div class="" uk-grid>
            <div class="uk-width-4-5@m uk-margin-large-top">
                <h1 class="uk-h2"><?= $page->title ?></h1>
            </div>

            <div class="uk-margin-small-bottom uk-width-1-5@m uk-flex uk-flex-right uk-flex-bottom">
                <?php echo $modules->MarkupSocialShareButtons->render(); ?>
            </div>
        </div>

        <hr class="uk-margin-bottom">
    </div>

    <div class="project-container contenido uk-light  uk-margin uk-container">

        <!-- Project intro and info -->

        <div class="proyecto-data uk-margin-large">
            <img src="<?= $page->portada_proyecto->url ?>" alt="<?= $page->portada_proyecto->description ?>">

            <div class="uk-margin-medium uk-padding-small">
                <div class="uk-margin-bottom">
                    <p class="tagline"><?= __("Cliente") ?>:</p>
                    <h3 class="uk-margin-small-top"><?= $page->cliente->title ?></h3>
                </div>

                <!--<div class="uk-margin-bottom">
                    <p class="tagline"><?php /*= __("Dirección") */?>:</p>
                    <p class="">Berenice Zambrano</p>
                </div>-->


                <?php $colaboradores= $page->colaboradores; ?>
                <?php if($colaboradores->count() > 0 ): ?>
                <div class="uk-margin-bottom">
                    <p class="tagline diseñoTag"><?= __("En colaboración con") ?>:</p>

                    <?php foreach ($page->colaboradores as $colaborador) : ?>

                            <?php if ($colaborador->url_address) : ?>
                                <a href="<?= $colaborador->url_address ?>" target="_blank">
                                    <p class="colaboradores"><?= $colaborador->name ?></p>
                                </a>
                            <?php else : ?>
                            <p class="colaboradores"><?= $colaborador->name ?></p>
                            <?php endif ?>

                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="uk-margin-bottom">
                    <p class=" tagline"><?= __("Servicios") ?>:</p>
                    <ul class="uk-list">
                        <?php echo $page->servicios->implode("", function ($item) {
                            //bd($item->title);
                            return "<li><a href='$item->url'>$item->title</a></li>";
                        }); ?>
                    </ul>
                </div>

                <div class="uk-margin-bottom">
                    <p class="tagline"><?= __("Lugar") ?>:</p>
                    <h3 class="uk-margin-small-top"><?= $page->lugar ?></h3>
                </div>

                <div class="uk-margin-bottom">
                    <p class="tagline"><?= __("Año") ?>:</p>
                    <h3 class="uk-margin-small-top"><?= $page->year ?></h3>
                </div>

            </div>

            <div class="uk-flex uk-flex-right">
                <div class="uk-width-3-5@m">
                    <?= $page->text ?>
                </div>

            </div>

        </div>



        <div>

            <?php echo $page->render('content');?>

            <div class="uk-grid uk-margin-large-top uk-child-width-1-<?= $page->columnas->title ?>@m" uk-grid
                 uk-lightbox>
                <?php foreach ($page->galeria as $img): ?>
                    <div class="">
                        <div class="uk-position-relative">
                            <a data-caption="<?= $img->description ?>" href="<?= $img->url ?>">
                                <img data-src="<?= $img->url ?>"
                                     alt="<?= $img->description ?>"
                                     data-srcset="<?= $img->srcset ?>"
                                     uk-img>
                            </a>
                            <p class="caption"><?= $img->description ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <!--<div class="uk-flex uk-flex-right">
                <div class="uk-width-3-5@m uk-margin-top">
                    <?php /*= $page->text_large */?>
                </div>
            </div>-->

    </div>
    <div class="uk-background-muted">
        <div class="proyectos-relacionados uk-container">
            <h3><?php echo __("Más proyectos")?></h3>
            <div class="uk-slider" uk-slider="autoplay:true;">
                <div class="uk-position-relative">
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-4@m uk-grid uk-grid-small">
                            <?php foreach ($pages->find("template=proyecto, id!=$page") as $p): ?>
                                <?php
                                $related_header_image = $p->getHeaderImage();
                                if(!$related_header_image) continue;
                                ?>
                                <li>
                                    <div class="uk-position-relative">
                                        <a href="<?=$p->url?>">
                                            <img class="uk-width-1-1"
                                                 data-src="<?= $related_header_image->size(300, 300)->url ?>"
                                                 alt="" uk-img>
                                            <div class="uk-position-cover uk-overlay slider-overlay uk-overlay-default ">
                                                <div class="project-name uk-position-bottom-left uk-position-small">
                                                    <h5 class="uk-text-bold uk-margin-remove"><?= $p->title ?></h5>
                                                    <p class="uk-margin-remove uk-text"><?php echo $p->servicios->implode(', ', 'title'); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <!--<ul class="uk-slider-nav uk-flex-center uk-margin  uk-hidden@s uk-dotnav"></ul>-->


                    </div>


                    <a class="uk-visible@l uk-position-small uk-position-center-left-out" href="#" uk-slider-item="previous">
                        <span class="uk-icon-button" uk-icon="icon: chevron-left; ratio:1.2;"></span>
                    </a>
                    <a class="uk-visible@l uk-position-small uk-position-center-right-out" href="#" uk-slider-item="next">
                        <span class="uk-icon-button" uk-icon="icon: chevron-right; ratio:1.2;"></span>
                    </a>

                    <div class="uk-margin-right uk-margin uk-flex-right uk-hidden@l uk-slidenav-container">
                        <a class="uk-margin-small-right" href="#" uk-slider-item="previous">
                            <span class="uk-icon-button" uk-icon="icon: chevron-left; ratio:1.2;"></span>
                        </a>
                        <a class="" href="#" uk-slider-item="next" >
                            <span class="uk-icon-button" uk-icon="icon: chevron-right; ratio:1.2;"></span>
                        </a>
                    </div>

                    <!--<div class="uk-visible@s">
                        <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>

</div>



<!--

<hr>
<div class="uk-margin-small-bottom">
    <p>¿Te gusta este proyecto? Compártelo en tus redes :)</p>
    <?php echo $modules->MarkupSocialShareButtons->render(); ?>
</div>
-->
