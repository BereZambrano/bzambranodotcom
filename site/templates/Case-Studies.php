<?php namespace ProcessWire; ?>
<region id="main-content" pw-append>

    <section class="uk-container">
            <div class=" uk-margin-large-bottom uk-margin-large-top">
                <div>
                    <?= $page->first_intro; ?>
                </div>
            </div>
        <hr>
    </section>



<section id="research_tags_nav" class="uk-container uk-margin-large-top">
    <div class="uk-grid" uk-grid>
        <div class="uk-width-2-3@m">
            <?php
            /** @var $input WireInput $tag */
            $tag = $input->get->text("tag");
            if($tag){
                //  TODO
                // $selector = 'template=case-study, limit=3';
                $selector = "template=case-study, research_tags=$tag, limit=3";
            }else{
                $selector = "template=case-study, limit=3";
            }
            $case_studies = $pages->find($selector);
            ?>
            <?php
            foreach($case_studies as $case): ?>
                <?php $case->content->find("type=galeria_modulo, galeria.count>0");
                $content_gallery=$case->content->get("type=galeria_modulo, galeria.count>0");
                ?>
                <div class="uk-flex uk-flex-left">
                    <div class="uk-width-4-5@m uk-margin-large">
                        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-child-width-expand@s" uk-grid>
                            <div class="uk-width-1-2@m uk-flex uk-flex-column uk-text-small" uk-height-match>
                                <div class="uk-text-small">
                                    <?= $case->title; ?>
                                </div>
                                <div>
                                    <?= $case->text_large; ?>
                                </div>
                            </div>

                            <?php if($content_gallery->galeria->first()): ?>
                                <div class="uk-width-1-2@m">
                                    <div>
                                        <picture class="uk-height-match">
                                            <source media="(max-width:959px)" srcset="<?= $content_gallery->galeria->first()->size(500, 500)->url ?>">
                                            <source media="(min-width:960px)" srcset="<?= $content_gallery->galeria->first()->size(500, 500)->url ?>">
                                            <img src='<?= $content_gallery->galeria->first->size(500, 500)->url ?>' loading="lazy">
                                        </picture>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="uk-width-1-3@m">
            <div uk-sticky="end: true; offset: 100">
                <p>TAG SEARCH</p>
                <?php foreach ($pages->find('template=research_tag') as $research_tags): ?>
                    <?php
                    $active_tag = ''; // initialize as empty
                    if ($input->get->tag) {
                        $active_tag = $input->get->tag; // set to tag name from URL parameter
                    }
                    ?>
                <ul class="uk-subnav">
                    <li <?php if ($research_tags->name == $active_tag) echo 'class="uk-active"'; ?>>
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
                </ul>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <hr class="uk-margin-large-bottom">
</section>

        <!--For social projects-->
        <div class="uk-container">

                <div class="uk-margin-large-top uk-width-1-3@ ">
                    <div>
                        <?= $page->second_intro; ?>
                    </div>
                </div>

            <div class=" uk-margin-large uk-flex uk-flex-right">
                    <div class="uk-width-3-5@m">
                        <?= $page->text_large; ?>
                        <div class="uk-margin-medium-top">
                            <a class="button uk-button" href="">Services</a>
                        </div>
                    </div>
            </div>
        </div>





</region>







