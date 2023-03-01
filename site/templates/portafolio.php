<?php
namespace ProcessWire;
?>

<div id="main-content" pw-append>

    <section class="bio-section uk-margin-top">
        <div class="uk-container uk-container-xsmall">
            <div class="uk-flex-middle uk-grid-small uk-flex-center uk-grid" uk-grid>
                <div class="uk-text-center bio-pic uk-width-1-5">
                    <img src="<?= $home->image->width(120)->url ?>">
                </div>

                <div class="bio uk-width-1-2">
                    <p> <?= $home->text ?> </p>
                </div>

            </div>
            <div class="">
                <div class="bio uk-flex uk-flex-center">
                    <?= $home->quien_home ?>
                </div>
            </div>
        </div>
    </section>

    <?php $projects = $pages->find('template=proyecto, limit=5, sort=sort'); ?>
    <div class="uk-container uk-container-small uk-margin-medium-top home-portfolio">
        <div class="uk-grid uk-child-width-1-1" uk-grid>
            <?php foreach ($projects as $i => $project) : ?>
                <div class="">
                    <a href="<?= $project->url ?>">
                        <?php
                        $header_image = $project->getHeaderImage();

                        if ($header_image) :
                            ?>
                            <img width="600" height="337" class="uk-width-1-1" src="<?= $header_image->size(600, 337)->url ?>" oading="lazy">
                        <?php endif ?>
                    </a>
                    <div class="uk-margin-small project-name">
                        <a href="<?= $project->url ?>">
                            <h4 class="uk-text-bold uk-margin-remove"><?= $project->title ?></h4>
                        </a>
                        <p class="uk-margin-remove uk-text-primary uk-text-small">
                            <?= $project->servicios->implode(', ', 'title'); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="uk-container">
        <div class="uk-flex uk-flex-center">

            <button class="section-button uk-button uk-button-default uk-border-circle" uk-icon="icon: plus"></button>

        </div>
    </div>

</div>
