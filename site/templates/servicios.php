<?php namespace ProcessWire; ?>

<div id="main-content" class=" uk-margin-top">
    <div class="uk-container uk-margin-xlarge-top">
        <div>
            <div class="uk-container">
                <div class="uk-margin-top">
                    <?= $page->first_intro?>
                </div>
            </div>

            <div class="uk-container uk-flex-right uk-flex uk-margin-large-right uk-margin-large-top">
                <div class="uk-margin-top uk-width-1-2@m">
                    <?= $page->second_intro?>
                </div>
            </div>
        </div>

        <ul class="uk-list-divider" uk-accordion>
            <?php foreach($page->children as $child) : ?>
            <?php
            $isOpen = false;
            $servicio = $input->get->servicio;
            if($servicio){
                if($servicio == $child->name){
                    $isOpen = true;
                }
            }
            ?>
            <li class="<?=$isOpen ? "uk-open" : ""?>">
                <a class="uk-accordion-title" href="#">
                    <?= $child->title ?>
                </a>
                <div class="uk-accordion-content">
                    <?= $child->text ?>
                </div>
                <?php $proyectos_por_servicio = $pages->find("template=proyecto, servicios=$child, limit=6") ?>
                <?php endforeach; ?>
            </li>
        </ul>

        <!--First repeater-->
        <?php foreach($page->home_repeater as $item): ?>
            <div class="">
                <div class="uk-margin-bottom uk-margin-large-top uk-width-1-3@ " uk-grid>
                    <div>
                        <?= $item->home_titles; ?>
                    </div>
                </div>
                <?php if($item->home_subtitles):?>
                    <div class="uk-container uk-flex-right uk-flex uk-margin-large-top uk-margin-large-bottom">
                        <div class="uk-width-1-2@m">
                            <?= $item->home_subtitles; ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>

            <div class="">
                <?php if($item->home_images): ?>
                    <div class="uk-flex-right">
                        <picture>
                            <source media="(max-width:959px)" srcset="<?= $item->home_images->size(800, 600)->url ?>">
                            <source media="(min-width:960px)" srcset="<?= $item->home_images->size(1200, 600)->url ?>">
                            <img alt="<?= $item->home_images->description ?>" class="uk-width-1-1" src='<?= $item->home_images->url ?>' loading="lazy">
                        </picture>
                    </div>
                <?php endif ?>

                <div class="uk-container uk-flex-right uk-flex uk-margin-top ">
                    <div class="uk-margin-top uk-width-1-2@m">
                        <?= $item->home_texts; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="uk-container uk-flex-right uk-flex ">
                <div class="uk-width-1-2@m">
                    <a class="button uk-button" href="">About Me</a>
                </div>
            </div>
    </div>

    <?php echo wireRenderFile('inc/testimonials.php'); ?>

</div>
