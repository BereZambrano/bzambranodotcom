<?php
namespace ProcessWire;
?>

<div id="main-content" pw-append>

    <section class="uk-container uk-container-large">
        <div class="uk-margin-xlarge-bottom uk-margin-xlarge-top uk-width-1-2@m">
            <div class="uk-margin-remove-last-child">
                <?= $page->first_intro; ?>
            </div>
        </div>
        <hr>
    </section>


<!--    <hr class="uk-margin-large uk-margin-xlarge-top">
-->
    <?php $projects = $pages->find('template=proyecto, limit=5, sort=sort'); ?>
    <div class="uk-container uk-container-large uk-margin-large-top home-portfolio uk-margin-large-bottom">
        <div class="uk-grid uk-grid-large uk-child-width-1-1" uk-grid>
            <?php foreach ($projects as $i => $project) : ?>
                <div class="">
                    <a href="<?= $project->url ?>">
                        <?php
                        $header_image = $project->getHeaderImage();

                        if ($header_image) :
                            ?>
                            <img width="600" height="337"
                                 class="uk-width-1-1"
                                 alt="<?=$header_image->description?>"
                                 src="<?= $header_image->size(1400, 786)->url ?>"
                                 loading="lazy">
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

    <hr class="uk-margin-xlarge-top">
    <?php
    $caseStudyPage=$pages->get("template=case-studies");
    ?>

    <div class="large-paragraph uk-container uk-container-large">

        <div class="uk-margin-large-top uk-width-1-3@ ">
            <div>
                <?= $caseStudyPage->second_intro; ?>
            </div>
        </div>

        <div class=" uk-margin-large uk-flex uk-flex-right">
            <div class="text-column-wrapper">
                <?= $caseStudyPage->text_large; ?>
                <div class="uk-margin-medium-top">
                    <a class="uk-button uk-button-primary" href="<?php echo $pages->get('template=servicios')->url; ?>">See all services here</a>
                </div>
            </div>
        </div>
    </div>

</div>
