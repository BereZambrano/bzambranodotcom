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
    </section>


    <!--    <hr class="uk-margin-large uk-margin-xlarge-top">
    -->
    <?php
    $selector = 'template=proyecto, sort=sort';
    $servicio = $input->get('servicio');
    if ($servicio) {
        $selector .= ", servicios=$servicio";
    } else {
        //$selector .= ", limit=6";
    }
    $projects = $pages->find($selector);
    ?>
    <div class="uk-container uk-container-large home-portfolio uk-light uk-background-secondary uk-padding">

        <div class="uk-grid uk-grid-large uk-child-width-1-2@m uk-margin-large-bottom uk-margin-large-top "  uk-grid>
            <?php foreach ($projects as $i => $project) : ?>
                <div class="">
                    <a href="<?= $project->url ?>">
                        <?php
                        $header_image = $project->getHeaderImage();

                        if ($header_image) :
                            ?>
                            <img class="uk-width-1-1 uk-border-rounded" width="600" height="337"
                                 alt="<?= $header_image->description ?>"
                                 src="<?= $header_image->size(1400, 786)->url ?>"
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
    </div>

    <?php
    $caseStudyPage = $pages->get("template=case-studies");
    ?>

    <div class="large-paragraph uk-container uk-container-large">

        <div class="uk-margin-large-top uk-width-1-3@ ">
            <div>
                <?= $caseStudyPage->second_intro; ?>
            </div>
        </div>

        <div class=" uk-margin-large uk-flex uk-flex-right">
            <div class="text-column-wrapper">
                <div class="uk-margin-remove-last-child">
                <?= $caseStudyPage->text_large; ?>
                <!--<div class="uk-margin-medium-top">
                    <a class="uk-button uk-button-primary" href="<?php /*echo $pages->get('template=servicios')->url; */
                ?>">See all services here</a>
                </div>-->
                </div>
            </div>
        </div>
    </div>

</div>
