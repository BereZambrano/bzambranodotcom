<?php
namespace ProcessWire;
?>

<div id="main-content" pw-append>

    <section class="bio-section uk-margin-top">
        <div class="uk-container">
            <div class="uk-grid-small uk-flex-left uk-grid" uk-grid>
                <div class=" uk-width-1-2">
                    <p> <?= $page->first_intro ?> </p>
                </div>
            </div>

        </div>
    </section>

    <?php $projects = $pages->find('template=proyecto, limit=5, sort=sort'); ?>
    <div class="uk-container uk-margin-medium-top home-portfolio uk-margin-large-bottom">
        <div class="uk-grid uk-grid-large uk-child-width-1-1" uk-grid>
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

    <hr>
    <?php
    $caseStudyPage=$pages->get("template=case-studies");
    ?>

    <div class="uk-container uk-flex-center uk-flex uk-flex-column">
        <div class="uk-margin-large-top">
            <div>
                <?= $caseStudyPage->second_intro; ?>
            </div>
        </div>
        <div class="uk-flex uk-margin-large uk-flex-right uk-height-large">
            <div class="uk-flex uk-width-4-5@m uk-flex-center uk-flex-wrap">
                <div class="uk-width-3-5@m">
                    <?= $caseStudyPage->text_large; ?>
                    <div class="uk-margin-medium-top">
                        <a class="button uk-button" href="<?php echo $pages->get('template=servicios')->url; ?>">See all services here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
