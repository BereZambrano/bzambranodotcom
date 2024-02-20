<?php
namespace ProcessWire;
use ProcessWire\WireInput;
use function ProcessWire\wire;
use function ProcessWire\wireRenderFile;


?>
<div id="main-content" pw-append>
    <!--Home_profile -->
    <section  class="uk-margin-large uk-margin-large-top bio-section">
        <div class="uk-container">
            <div uk-scrollspy="cls: uk-animation-slide-top-small; target: > div; delay: 300; repeat: true"
                 class="uk-flex uk-flex-middle uk-flex-center">
                <div class="bio-pic">
                    <div class="uk-flex uk-flex-center uk-margin-large-bottom">
                        <img class="" src="<?= $home->image->url ?>">
                    </div>
                    <div class="bio uk-text-center uk-margin-large-bottom">
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
                <div class="uk-width-3-5@m uk-margin-xlarge-top">
                    <div class="uk-light">
                        <?= $page->first_intro ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-container uk-container-large uk-margin-large-top home-portfolio uk-margin-large-bottom">
            <div class="uk-grid uk-grid-large uk-child-width-1-2@m"
                 uk-scrollspy="target: > div; cls:uk-animation-slide-bottom-small; delay:300ms"
                 uk-grid>
                <?php foreach ($projects as $i => $project) : ?>
                    <div class="uk-light">
                        <a href="<?= $project->url ?>">
                            <?php
                            $header_image = $project->getHeaderImage();

                            if ($header_image) :
                                ?>
                                <img class="uk-width-1-1 uk-border-rounded" width="250" height="250"
                                     alt="<?= $header_image->description ?>"
                                     src="<?= $header_image->size(800, 500)->url ?>"
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

            <div class="uk-flex uk-flex-right">
                <div class="uk-width-3-5@m uk-margin-large-top uk-margin-large-bottom uk-flex uk-flex-right">
                    <div class="uk-width-4-5@m">
                        <a class="white-button uk-button" href="<?php echo $pages->get('template=portafolio')->url; ?>">See my Portfolio</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-container uk-container-large">
            <hr>
        </div>

        <div class="uk-container uk-container-large uk-margin-large-top">

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
                $case_studies_count = count($case_studies);
                $case_index = 0;
                ?>
                <div class="uk-grid-large uk-margin-top" uk-grid>
                    <?php
                    foreach ($case_studies as $case): ?>
                        <?php $case->content->find("type=galeria_modulo, galeria.count>0");
                        $content_gallery = $case->content->get("type=galeria_modulo, galeria.count>0");
                        ?>
                        <div class="uk-margin-large-bottom">
                            <div class="uk-grid uk-flex uk-grid-large uk-child-width-expand@s" uk-grid>
                                <div class="uk-width-2-3@m">
                                    <a class="uk-link-reset" href="<?= $case->url ?>">
                                        <h3 class="uk-h4">
                                            <?= $case->title; ?>
                                        </h3>
                                        <div class="large-paragraph">
                                            <p>
                                                <?= $sanitizer->truncate($case->text_large, [
                                                  'type'      => 'punctuation',
                                                  'maxLength' => 200,
                                                  'visible'   => true,
                                                  'more'      => '…'
                                                ]); ?>
                                            </p>
                                        </div>
                                    </a>
                                </div>

                                <?php if ($case->thumbnail): ?>
                                    <div class="uk-width-1-3@m">
                                        <a class="uk-link-reset" href="<?= $case->url ?>">
                                            <picture class="uk-height-match uk-flex uk-flex-right">
                                                <source media="(max-width:959px)"
                                                        srcset="<?= $case->thumbnail->size(800, 500)->url ?>">
                                                <source media="(min-width:960px)"
                                                        srcset="<?= $case->thumbnail->size(800, 500)->url ?>">
                                                <img class="uk-border-rounded uk-width-2-4@m "
                                                     src='<?= $case->thumbnail->size(800, 500)->url ?>'
                                                     loading="lazy">
                                            </picture>
                                        </a>
                                    </div>
                                <?php else: ?>
                                    <?php if ($content_gallery->id): ?>
                                        <div class="uk-width-1-2@m">
                                            <div>
                                                <a class="uk-link-reset" href="<?= $case->url ?>">
                                                    <picture class="uk-height-match">
                                                        <source media="(max-width:959px)"
                                                                srcset="<?= $content_gallery->galeria->first()->size(800,
                                                                  500)->url ?>">
                                                        <source media="(min-width:960px)"
                                                                srcset="<?= $content_gallery->galeria->first()->size(800,
                                                                  500)->url ?>">
                                                        <img class="uk-width-1-1 uk-border-rounded"
                                                             src='<?= $content_gallery->galeria->first->size(800,
                                                               500)->url ?>' loading="lazy">
                                                    </picture>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <?php /*if (++$case_index < $case_studies_count): */?><!--
                        <hr>
                    --><?php /*endif; */?>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="uk-flex uk-flex-right">
                <div class="uk-width-3-5@m uk-margin-large-top uk-flex uk-flex-right">
                    <div class="uk-width-4-5@m uk-margin-xlarge-bottom">
                        <a class="white-button uk-button" href="<?php echo $pages->get('template=case-studies')->url; ?>">See Case Studies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uk-container uk-container-large">
        <div class="uk-flex uk-flex-left">
            <div class="uk-width-4-5@m uk-margin-xlarge-top">
                <div class="">
                    <h3>What I bring to the table</h3>
                </div>
            </div>
        </div>
    </div>

        <div class="uk-margin-large">
            <div class="uk-grid uk-grid-small uk-text-center" uk-grid>
                <div class="uk-width-1-1">
                    <div class="text-animate">
                        <span class="uk-h1">
                            <span>· Branding & Visual identity Expertise · Research-Oriented Design</span>
                            <span>· Branding & Visual identity Expertise · Research-Oriented Design</span>
                        </span>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <div class="text-animate">
                        <span class="uk-h1">
                            <span>· Radical Collaboration · Proactivity · Social Impact Focus</span>
                            <span>· Radical Collaboration · Proactivity · Social Impact Focus</span>
                        </span>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <div class="text-animate">
                        <span class="uk-h1">
                        <span>· Creative Strategies · Self-Organization · Communication Skills</span>
                        <span>· Creative Strategies · Self-Organization · Communication Skills</span>
                        </span>
                    </div>
                </div>
                <div class="uk-width-1-1">
                    <div class="text-animate">
                        <span class="uk-h1">
                        <span>· Critical Thinking · Collective Process Approach</span>
                        <span>· Critical Thinking · Collective Process Approach</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

      <!--  <?php
/*        $skillSetPage=$pages->get('template=skill');
        */?>
        <div class="uk-container uk-container-large uk-margin-large">
            <div class="uk-grid-small uk-child-width-auto uk-flex-left" uk-grid>
                <?php /*foreach ($skillSetPage->skills as $skill): */?>
                    <div>
                        <div class="uk-card uk-card-body uk-border-pill tag-card ">
                            <?php /*= $skill->text; */?>
                        </div>
                    </div>
                <?php /*endforeach; */?>
            </div>
        </div>-->

    <div class="uk-container uk-container-large uk-flex uk-flex-right">
        <div class="uk-width-3-5@m uk-margin-xlarge-bottom uk-flex uk-flex-right">
            <div class="uk-width-4-5@m">
                <a class="uk-button-primary uk-button" href="<?php echo $pages->get('template=about')->url; ?>">See More About Me</a>
            </div>
        </div>
    </div>

    <div class="uk-container uk-container-large uk-padding section-white">
        <div class="uk-flex uk-flex-left uk-padding">
            <div class="uk-width-1-1@m">
                <div class="uk-margin-large-top uk-margin-large-bottom ">
                    <h2><?=
                        $home->second_intro;
                        ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <section class="testimonials uk-container uk-container-large">

        <div class="uk-width-3-5@m uk-margin-xlarge-top">
            <h2>
                <?=__("Testimonials and mentions")?>
            </h2>
        </div>

        <?php foreach($pages->find("template=servicios") as $project): ?>

            <div class="uk-width-4-5@m uk-margin-auto uk-margin-large-top uk-border-rounded">

                <div class="uk-flex">
                    <div class="uk-margin-top uk-width-1-1 uk-slider" uk-slider="autoplay: true">

                        <div class="uk-position-relative">

                            <a class="uk-visible@l uk-position-small uk-position-center-left section-white" href="#"
                               uk-slider-item="previous">
                                <span class="uk-icon-button" uk-icon="icon: chevron-left; ratio:1.2;"></span>
                            </a>
                            <a class="uk-visible@l uk-position-small uk-position-center-right section-white" href="#"
                               uk-slider-item="next">
                                <span class="uk-icon-button" uk-icon="icon: chevron-right; ratio:1.2;"></span>
                            </a>


                            <div class="uk-slider-container uk-margin-xlarge-bottom">

                                <div class="uk-position-top-right uk-position-small uk-position-z-index">
                                    <div class="uk-flex-right uk-hidden@l uk-slidenav-container">
                                        <a class="uk-margin-small-right" href="#" uk-slider-item="previous">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-left; ratio:1.2;"></span>
                                        </a>
                                        <a class="" href="#" uk-slider-item="next">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-right; ratio:1.2;"></span>
                                        </a>
                                    </div>
                                </div>

                                <ul class="uk-grid uk-slider-items">
                                    <?php foreach ($project->testimonial as $item): ?>
                                        <li class="uk-width-1-1">
                                            <div class="uk-card testimonial-card uk-card-body uk-card-large uk-card-default">
                                                <div class="uk-width-1-1@m uk-margin-auto">
                                                    <div class="uk-card-title">
                                                        <?= $item->testimonial_name ?>
                                                    </div>
                                                    <hr class="uk-margin-small">
                                                    <div>
                                                        <?= $item->testimonial_detail ?>
                                                    </div>
                                                    <div class="testimonial-card-main-text testimonial-card-link">
                                                        <?= $item->testimonial_tweet ?>
                                                    </div>
                                                    <?php if ($item->mention_link): ?>
                                                        <div class="uk-margin-auto">
                                                            <a href="<?= $item->mention_link ?>">
                                                                <button class="uk-button uk-button-text"><?= $item->mention_link ?></button>
                                                            </a>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </section>

    <div class="uk-background-secondary uk-width-1-1@m uk-padding-small">

        <div class="uk-container uk-container-large uk-light">
            <div class="uk-flex uk-flex-center uk-margin-large-top">
                <div class="uk-margin-small uk-text-center">
                    <h2 class="uk-margin-bottom">
                        Let’s collaborate!
                    </h2>
                    <p class="uk-h5">
                        If this resonates with you, let’s talk!
                    </p>
                </div>
            </div>

            <div class=" uk-flex uk-flex-center">
                <div class="uk-width-3-5@m uk-margin-xlarge-bottom uk-margin-top uk-flex uk-flex-center">
                    <div class="uk-width-4-5@m">
                        <a class="uk-button-primary uk-button" uk-scroll="offset: 100" href="#footer-contact">Say hello! 👋</a>
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
