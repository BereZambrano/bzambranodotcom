<?php namespace ProcessWire;?>

<section class="projects">
    <div class="uk-container uk-margin-large-top  uk-margin-large">
        <?php
        /*$first = $home->proyectos_seleccionados->reverse();
        $all = $pages->find('template=proyecto');
        $all->removeItems($first);
        $first->each(function($item) use($all){
            $all->prepend($item);
        });*/
        //$slices = array_chunk($all->getArray(), 4);
        $slices = array_chunk($projects, 4);
        ?>
        <?php foreach ($slices as $grid): ?>
            <div class="uk-grid uk-child-width-1-2@m" uk-scrollspy="target: > div; cls: uk-animation-fade; delay: 300" uk-grid>
                <?php foreach ($grid as $i => $item): ?>
                    <!-- <div class="uk-cover-container" uk-parallax="y:<?= ($i + 1) * -50 ?>"> -->
                    <div class="<?= ($i + 1) % 2 == 0 ? "even" : "odd"; ?> uk-cover-container">
                        <a href="<?= $item->url ?>">
                            <?php
                            $header_image = $item->getHeaderImage();

                            if ($header_image):
                                ?>
                                <img width="500" height="333" class="uk-width-1-1"
                                     data-src="<?= $header_image->size(600, 433)->url ?>"
                                     uk-img>
                                <!--<div class="uk-position-cover uk-overlay uk-overlay-default ">

                                </div>-->
                            <?php endif ?>
                        </a>
                        <div class="uk-margin-small project-name">
                            <a href="<?= $item->url ?>">
                                <h4 class="uk-text-bold uk-margin-remove"><?= $item->title ?></h4>
                            </a>
                            <p class="uk-margin-remove uk-text-primary uk-text-small"><?php echo $item->servicios->implode(', ', 'title'); ?></p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endforeach ?>

        <!-- <div class="uk-text-center uk-margin-large">
             <a class="uk-button uk-button-primary show-more" href="/portafolio">+</a>
         </div>-->

    </div>
</section>
