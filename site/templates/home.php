<?php

use ProcessWire\WireInput;
use function ProcessWire\wire;
use function ProcessWire\wireRenderFile;

?>
<div id="main-content" pw-append>
    <!--Home_profile -->
    <section  class="uk-margin-large uk-margin-xlarge-top bio-section">
        <div class="uk-container uk-margin-large-top">
            <div uk-scrollspy="cls: uk-animation-slide-top-small; target: > div; delay: 300; repeat: true"
                 class="uk-flex uk-flex-middle uk-flex-center">
                <div class="bio-pic">
                    <div class="uk-flex uk-flex-center uk-margin-small-bottom">
                        <img class="" src="<?= $home->image->url ?>">
                    </div>
                    <div class="bio uk-text-center">
                        <?= $home->quien_home ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Seccion de projectos-->
    <?php
    $selector = $pages->get('template=home');

    $projects =$selector->proyectos_seleccionados;
    ?>

    <div class="uk-background-secondary uk-width-1-1@m">

        <div class="uk-container uk-container-large">
            <div class="uk-flex uk-flex-left">
                <div class="uk-width-4-5@m uk-margin-large-top">
                    <div class="uk-light">
                        <?= $page->first_intro ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-container uk-margin-large-top home-portfolio uk-margin-large-bottom">

            <div class="uk-grid uk-grid-large uk-child-width-1-2@m" uk-grid>
                <?php foreach ($projects as $i => $project) : ?>
                    <div class="uk-light">
                        <a href="<?= $project->url ?>">
                            <?php
                            $header_image = $project->getHeaderImage();

                            if ($header_image) :
                                ?>
                                <img class="uk-width-1-1 uk-border-rounded" width="250" height="250"
                                     alt="<?= $header_image->description ?>"
                                     src="<?= $header_image->size(500, 500)->url ?>"
                                     loading="lazy">
                            <?php endif ?>
                        </a>
                        <div class="uk-margin project-name">
                            <a class="uk-link-reset" href="<?= $project->url ?>">
                                <h4 class="uk-h5 uk-text-bold uk-margin-remove"><?= $project->title ?></h4>
                            </a>
                            <p class="uk-margin-small uk-margin-remove-top uk-text-primary uk-text-small">
                                <?=
                                $project->servicios->implode(', ', function ($item) {
                                    $url = wire('page')->url([
                                        'data' => [
                                            'servicio' => $item->name
                                        ]
                                    ]);
                                    return "<a href='{$url}'>{$item->title}</a>";
                                });
                                ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

            <div class="uk-flex uk-flex-right uk-padding-small">
                <div class="uk-width-3-5@m uk-margin-large-top uk-margin-xlarge-bottom">
                    <div class="uk-width-1-1@m">
                        <a class="white-button uk-button" href="<?php echo $pages->get('template=portafolio')->url; ?>">See my Portfolio</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-container uk-container-large">

                <div class="uk-flex uk-flex-left">
                    <div class="uk-width-3-5@m uk-margin-top">
                        <div class="uk-light">
                            <h3>With Social Impact Focus</h3>
                        </div>
                    </div>
                </div>

            <div class="uk-margin-bottom uk-margin-large-top uk-light">
                <?php
                /** @var $input WireInput $tag */
                $tag = $input->get->text("tag");
                if ($tag) {
                    //  TODO
                    // $selector = 'template=case-study, limit=3';
                    $selector = "template=case-study, research_tags=$tag, limit=3";
                } else {
                    $selector = "template=case-study, limit=3";
                }
                $case_studies = $pages->find($selector);
                ?>
                <?php
                foreach ($case_studies as $case): ?>
                    <?php $case->content->find("type=galeria_modulo, galeria.count>0");
                    $content_gallery = $case->content->get("type=galeria_modulo, galeria.count>0");
                    ?>
                    <div class="uk-flex uk-flex-left">
                        <div class="uk-margin-large">
                            <div class="uk-grid uk-flex uk-child-width-expand@s" uk-grid>
                                <div class="uk-width-2-3@m">
                                    <a class="uk-link-reset" href="<?= $case->url ?>">
                                        <h3 class="uk-h4">
                                            <?= $case->title; ?>
                                        </h3>
                                        <div class="large-paragraph">
                                            <p>
                                                <?= $sanitizer->truncate($case->text_large, [
                                                    'type'      => 'punctuation',
                                                    'maxLength' => 180,
                                                    'visible'   => true,
                                                    'more'      => '…'
                                                ]); ?>
                                            </p>
                                        </div>
                                    </a>

                                </div>

                                <?php if ($case->thumbnail): ?>
                                    <div class="uk-width-1-3@m">
                                        <div>
                                            <a class="uk-link-reset" href="<?= $case->url ?>">
                                                <picture class="uk-height-match">
                                                    <source media="(max-width:959px)"
                                                            srcset="<?= $case->thumbnail->size(500, 500)->url ?>">
                                                    <source media="(min-width:960px)"
                                                            srcset="<?= $case->thumbnail->size(500, 500)->url ?>">
                                                    <img class="uk-border-rounded  "
                                                         src='<?= $case->thumbnail->size(500, 500)->url ?>'
                                                         loading="lazy">
                                                </picture>
                                            </a>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <?php if ($content_gallery->id): ?>
                                        <div class="uk-width-1-2@m">
                                            <div>
                                                <a class="uk-link-reset" href="<?= $case->url ?>">
                                                    <picture class="uk-height-match">
                                                        <source media="(max-width:959px)"
                                                                srcset="<?= $content_gallery->galeria->first()->size(500,
                                                                    500)->url ?>">
                                                        <source media="(min-width:960px)"
                                                                srcset="<?= $content_gallery->galeria->first()->size(500,
                                                                    500)->url ?>">
                                                        <img class="uk-width-1-1 uk-border-rounded"
                                                             src='<?= $content_gallery->galeria->first->size(500,
                                                                 500)->url ?>' loading="lazy">
                                                    </picture>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="uk-container uk-flex uk-flex-right uk-padding-small">
                <div class="uk-width-3-5@m uk-margin-xlarge-bottom">
                    <div class="uk-width-1-1@m">
                        <a class="white-button uk-button" href="<?php echo $pages->get('template=portafolio')->url; ?>">See Case Studies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-left">
            <div class="uk-width-4-5@m uk-margin-large-top">
                <div class="">
                    <h3>What I bring to the table</h3>
                </div>
            </div>
        </div>
    </div>

        <?php
        $skillSetPage=$pages->get('template=skill');
        ?>
        <div class="uk-container uk-container-xsmall uk-padding">
            <div class="uk-grid-small uk-child-width-auto uk-flex-center" uk-grid>
                <?php foreach ($skillSetPage->skills as $skill): ?>
                    <div>
                        <div class="uk-card uk-card-default uk-card-body uk-border-pill tag-card">
                            <?= $skill->text; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <div class="uk-container uk-flex uk-flex-right uk-padding-small">
        <div class="uk-width-3-5@m uk-margin-xlarge-bottom">
            <div class="uk-width-1-1@m">
                <a class="uk-button-primary uk-button" href="<?php echo $pages->get('template=portafolio')->url; ?>">See More About Me</a>
            </div>
        </div>
    </div>


    <div class="uk-container uk-container-large section-white uk-padding">
        <div class="uk-flex uk-flex-left">
            <div class="uk-width-4-5@m">
                <div class="uk-margin-xlarge-top uk-margin-xlarge-bottom ">
                    <h2>As a fractional design strategist and collaborator,
                        I love working part-time or per project with diverse groups around the world,
                        including organizations, non-profit companies, public institutions, foundations,
                        collectives and so on.
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <?php echo wireRenderFile('inc/testimonials.php'); ?>

    <div class="uk-background-secondary uk-width-1-1@m uk-padding-small">

        <div class="uk-container uk-container-large uk-light">
            <div class="uk-flex uk-flex-left">
                <div class="uk-width-4-5@m uk-margin-xlarge-top">
                    <h2>
                        Let’s collaborate!
                    </h2>
                    <p>
                        If this resonates with you, let’s talk!
                    </p>
                </div>
            </div>

            <div class="uk-container uk-flex uk-flex-right uk-padding-small">
                <div class="uk-width-3-5@m uk-margin-xlarge-bottom">
                    <div class="uk-width-1-1@m">
                        <a class="uk-button-primary uk-button" href="<?php echo $pages->get('template=portafolio')->url; ?>">Say hello! 👋</a>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!--<div>
        <?php
/*        $last = $page->home_repeater->last();
        foreach($page->home_repeater as $item): */?>
                <div class="uk-container uk-container-large">
                    <div class="uk-margin-large-bottom uk-margin-large-top uk-width-1-2@m">
                        <?php /*if ($item->home_titles || $item->home_subtitles ): */?>
                            <div>
                                <?php /*= $item->home_titles ?: ""; */?>
                                <?php /*= $item->home_subtitles ?: ""; */?>
                            </div>
                        <?php /*endif */?>
                    </div>
                </div>
                <?php /*if($item->home_images): */?>
                    <div class="uk-container uk-container-large uk-margin-large-bottom ">
                        <div>
                            <picture>
                                <source media="(max-width:959px)" srcset="<?php /*= $item->home_images->size(800, 600)->url */?>">
                                <source media="(min-width:960px)" srcset="<?php /*= $item->home_images->size(1800, 900)->url */?>">
                                <img alt="<?php /*= $item->home_images->description */?>" class="uk-width-1-1 uk-border-rounded" src='<?php /*= $item->home_images->url */?>' loading="lazy">
                            </picture>
                        </div>
                    </div>
                <?php /*endif */?>

            <?php /*if($item->home_texts): */?>
                <div class="uk-container uk-container-large uk-flex-column">
                    <div class="uk-flex uk-flex-right">
                        <div class="uk-margin-remove-last-child text-column-wrapper">
                            <div class="uk-margin-remove-last-child">
                                <?php /*= $item->home_texts; */?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php /*if($item !== $last):*/?>
                    <div class="uk-container uk-container-large uk-margin-large-top">
                        <hr>
                    </div>
                <?php /*endif */?>
            <?php /*endif */?>
        <?php /*endforeach; */?>
    </div>-->
</div>
