<?php namespace ProcessWire;
//if($page->content->count()
$header_image = $page->getHeaderImage();
?>
<div id="main-content" class="proyecto" pw-append>
    <section>
        <div class="uk-container">
            <h1 class="uk-padding uk-padding-remove-left uk-margin-remove"><?= $page->title ?></h1>

            <div class="uk-hidden@m">
                <div class="uk-child-width-1-2 uk-grid-collapse uk-text-small " uk-grid>
                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Cliente") ?>:</h5>
                        <p class="uk-margin-remove"><?= $page->cliente->title ?></p>
                    </div>

                    <div class="uk-margin-small-bottom">
                        <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Lugar") ?>:</h5>
                        <p class="uk-margin-remove"><?= $page->lugar ?></p>
                    </div>

                    <div class="">
                        <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Servicios") ?>:</h5>
                        <p class="uk-margin-remove">
                            <?php echo $page->servicios->implode("<br>", function ($item) {
                                //bd($item->title);
                                return "<a href='$item->url'>$item->title</a>";
                            }); ?>
                        </p>
                    </div>

                    <div class="">
                        <h5 class="uk-text-small uk-text-bold uk-margin-remove"><?= __("Año") ?>:</h5>
                        <p class="uk-margin-remove"><?= $page->year ?></p>
                    </div>
                </div>
            </div>

        </div>


        <?php if ($page->show_header): ?>
            <div class="project-main-image uk-visible@m uk-width-1-1">
                <div class="uk-height-medium uk-cover-container">
                    <img data-src="<?= $header_image->src ?>"
                         data-srcset="<?= $header_image->srcset ?>" uk-cover uk-img>
                </div>
            </div>
        <?php endif ?>

        <div class="project-container uk-container">
            <div class="uk-grid" uk-grid>

                <div class="uk-width-4-5@m">
                    <?php
                    if ($page->show_header) {
                        $images = $page->images->not("name=$header_image")->getValues();

                    } else {
                        $images = $page->images->getValues();
                    }
                    ?>
                    <?php if ($page->text_large): ?>
                        <div class="uk-width-1-1">
                            <div class="uk-visible@m desktop-main-text">
                                <?= $page->text_large ?>
                            </div>

                        </div>
                    <?php endif ?>
                    <?php if($page->content->count()):?>
                        <?php echo $page->render('content');?>
                    <?php else: ?>
                        <div class="uk-hidden@m uk-margin-top mobile-main-text">
                            <?=$page->text?>
                        </div>
                        <div class="uk-width-1-1"  uk-lightbox>
                            <div uk-grid>
                                <?php foreach ($images as $i => $image): ?>
                                    <?php $i++; ?>
                                    <div class="uk-width-1-1">
                                        <div class="uk-position-relative">
                                            <a data-caption="<?= $image->description ?>" href="<?= $image->url ?>">
                                                <?php if($image->ext == "gif"): ?>
                                                    <img width="<?=$image->width?>" height="<?=$image->height?>"  data-src="<?= $image->url ?>"
                                                         alt="<?= $image->description ?>" uk-img>
                                                <?php else: ?>
                                                    <img width="<?=$image->width?>" height="<?=$image->height?>"  data-src="<?= $image->url ?>"
                                                         alt="<?= $image->description ?>"
                                                         data-srcset="<?= $image->srcset ?>"
                                                         uk-img>
                                                <?php endif ?>
                                            </a>
                                            <p class="caption"><?= $image->description ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif ?>

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
                <div class="proyecto-info uk-visible@m uk-width-1-5@m">

                    <div uk-sticky="offset:120;bottom: .project-container;">
                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold proyecto-descripcion uk-margin-remove"><?= __("Título") ?>:</h5>
                            <?= $page->title ?>
                        </div>
                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold proyecto-descripcion uk-margin-remove"><?= __("Proyecto") ?>:</h5>
                            <?= $page->text ?>
                        </div>

                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold uk-margin-remove"><?= __("Cliente") ?>:</h5>
                            <p class="uk-margin-remove"><?= $page->cliente->title ?></p>
                        </div>

                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold uk-margin-remove"><?= __("Lugar") ?>:</h5>
                            <p class="uk-margin-remove"><?= $page->lugar ?></p>
                        </div>

                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold uk-margin-remove"><?= __("Servicios") ?>:</h5>
                            <p class="uk-margin-remove">
                                <?php echo $page->servicios->implode("<br>", function ($item) {
                                    //bd($item->title);
                                    return "<a href='$item->url'>$item->title</a>";
                                }); ?>
                            </p>
                        </div>
                        <div class="uk-margin-small-bottom">
                            <h5 class="uk-text-bold uk-margin-remove"><?= __("Año") ?>:</h5>
                            <p class="uk-margin-remove"><?= $page->year ?></p>
                        </div>

                        <hr>
                        <div class="uk-margin-small-bottom">
                            <p>¿Te gusta este proyecto? Compártelo en tus redes :)</p>
                            <?php echo $modules->MarkupSocialShareButtons->render(); ?>
                        </div>

                    </div>

                </div>
            </div>


        </div>
        <hr class="uk-margin-large">
        <div class="proyectos-relacionados uk-margin-large uk-container">
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
                                                    <h4 class="uk-text-bold text-white uk-margin-remove"><?= $p->title ?></h4>
                                                    <p class="uk-margin-remove text-white uk-text"><?php echo $p->servicios->implode(', ', 'title'); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <!--<ul class="uk-slider-nav uk-flex-center uk-margin  uk-hidden@s uk-dotnav"></ul>-->


                    </div>
                    <a class="uk-position-center-left uk-light uk-hidden@m" href="#" uk-slidenav-previous  uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-light uk-hidden@m"  href="#" uk-slidenav-next uk-slider-item="next" ></a>

                    <div class="uk-margin uk-flex-right uk-visible@m uk-slidenav-container">
                        <a href="#" uk-slidenav-previous  uk-slider-item="previous"></a>
                        <a href="#" uk-slidenav-next uk-slider-item="next" ></a>
                    </div>

                    <!--<div class="uk-visible@s">
                        <a class="uk-position-center-left-out uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right-out uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                    </div>-->
                </div>
            </div>
        </div>

    </section>
</div>
