<?php namespace ProcessWire; ?>
<region id="main-content" pw-append>

    <section class="uk-container uk-container-large">
        <div class="uk-margin-xlarge-bottom uk-margin-xlarge-top uk-width-1-2@m">
            <div class="uk-margin-remove-last-child">
                <?= $page->first_intro; ?>
            </div>
        </div>
        <hr>
    </section>



    <section id="research_tags_nav" class="uk-container uk-container-large uk-margin-large-top">
        <div class="uk-grid uk-grid-large" uk-grid>
            <div class="uk-width-2-3@m">
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
                                    </a>
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
                                                    <img class="uk-border-rounded uk-width-1-1 "
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

            <div class="tags-search uk-width-1-3@m">
                <div uk-sticky="end: true; offset: 100">
                    <p>TAG SEARCH</p>
                    <ul class="uk-subnav">
                        <?php foreach ($pages->find('template=research_tag') as $research_tags): ?>
                            <?php
                            $active_tag = ''; // initialize as empty
                            if ($input->get->tag) {
                                $active_tag = $input->get->tag; // set to tag name from URL parameter
                            }
                            $isActive = "";
                            if ($research_tags->name == $active_tag) {
                                $isActive = 'uk-active';
                            }
                            ?>
                            <li class="<?= $isActive ?>">
                                <?php
                                $url = $page->url([
                                  'data' => [
                                    'tag' => $research_tags->name
                                  ]
                                ]);
                                ?>
                                <a href="<?= $url; ?>">
                                    <?= $research_tags->title; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="uk-margin-large-bottom">
    </section>

    <!--For social projects-->
    <div class="large-paragraph uk-container uk-container-large">

        <div class="uk-margin-large-top uk-width-1-3@ ">
            <div>
                <?= $page->second_intro; ?>
            </div>
        </div>

        <div class=" uk-margin-large uk-flex uk-flex-right">
            <div class="text-column-wrapper">
                <?= $page->text_large; ?>
                <div class="uk-margin-medium-top">
                    <a class="uk-button-primary uk-button"
                       href="<?php echo $pages->get('template=servicios')->url; ?>">
                        <?=__("See all services here")?></a>
                </div>
            </div>
        </div>
    </div>


</region>







