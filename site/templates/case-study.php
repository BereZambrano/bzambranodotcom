<?php namespace ProcessWire; ?>

<div id="main-content" class="proyecto" pw-append>
    <div class="uk-light uk-background-secondary">
        <section class="uk-container contenido uk-container">

            <div class="uk-margin-large-top">
                <a href="<?= $page->parent()->url ?>">
                    <img class="back-arrow" src="/site/templates/img/Arrow1.png" alt="Arrow1">
                </a>
            </div>

            <div class="" uk-grid>
                <div class="uk-width-4-5@m uk-margin-large-top">
                    <h2><?= $page->title ?></h2>
                </div>

                <div class="uk-margin-small-bottom uk-width-1-5@m uk-flex uk-flex-right uk-flex-bottom">
                    <?php echo $modules->MarkupSocialShareButtons->render(); ?>
                </div>
            </div>

            <hr class="uk-margin-bottom">

            <!--
            <?php
            // Get the word count of the article
            $word_count = str_word_count($page->text);
            bd($word_count);
            echo $word_count;

            // Calculate the estimated reading time in minutes
            $reading_time = ceil($word_count / 250); // Assuming average reading speed of 250 words per minute

            // Initialize the page before setting the reading time
            $page->of(false);

            // Save the estimated reading time in the custom field
            $page->reading_time = $reading_time;
            $page->save();
            ?>

            <div class="article-reading-time">
                <?php echo $page->reading_time; ?> minutes read
            </div>
            -->


            <div class="uk-container uk-container-large uk-margin-large-top">

                <div class=" uk-child-width-1-2@m uk-flex uk-flex-column " uk-grid>

                <div class="proyecto-data">
                    <div class="uk-margin-bottom">
                        <p class="tagline "><?= __("Cliente") ?>:</p>
                        <h3 class="uk-margin-remove"><?= $page->cliente->title ?></h3>
                    </div>

                    <div class="uk-margin-bottom">
                        <p class="tagline"><?= __("Tácticas de investigación y metodologías") ?>:</p>
                        <ul class="uk-list">
                            <?php foreach($page->research_tags as $item) {

                                $url = $page->parent->url([
                                    'data' => [
                                        'tag' => $item->name
                                    ]
                                ]);

                                echo "<li><a href='$url'>$item->title</a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="uk-margin-bottom">
                        <p class="tagline"><?= __("Año") ?>:</p>
                        <h3 class="uk-margin-remove"><?= $page->year ?></h3>
                    </div>
                </div>
                </div>
            </div>

                <div class="uk-flex uk-flex-right uk-margin-large-top">
                    <div class="uk-margin uk-width-3-5@m uk-light">
                        <?= $page->text ?>
                    </div>
                </div>

                <hr class="uk-margin-large-top uk-margin-large-bottom">

            <?php foreach ($page->content as $item): ?>

                <?php if ($item->type == "headline"): ?>
                    <div class="uk-flex uk-flex-right uk-margin-large-top">
                        <div class="uk-margin uk-width-3-5@m">
                            <h2><?= $item->title; ?></h2>
                        </div>
                    </div>
                <?php endif ?>


                <?php if ($item->type == "text_modulo"): ?>
                    <div class="uk-flex uk-flex-right uk-margin-large-top">
                        <div class="uk-margin uk-width-3-5@m">
                            <?= $item->text; ?>
                        </div>
                    </div>
                <?php endif ?>
                <?php if ($item->type == "divider"): ?>
                    <hr class="uk-margin-large">
                <?php endif ?>
                <?php if ($item->type == "galeria_modulo"): ?>
                    <div class="uk-margin-large-top uk-container uk-container-small">
                        <div uk-slideshow="autoplay: false">

                            <div class="uk-position-relative">

                                <a class="uk-visible@l uk-position-small uk-position-center-left-out" href="#"
                                   uk-slideshow-item="previous">
                                    <span class="uk-icon-button" uk-icon="icon: chevron-left; ratio:1.2;"></span>
                                </a>
                                <a class="uk-visible@l uk-position-small uk-position-center-right-out" href="#"
                                   uk-slideshow-item="next">
                                    <span class="uk-icon-button" uk-icon="icon: chevron-right; ratio:1.2;"></span>
                                </a>


                                <ul class="uk-slideshow-items">
                                    <?php foreach ($item->galeria as $image): ?>
                                        <li>
                                            <img class="uk-border-rounded" src="<?= $image->url ?>" alt="<?= $image->description ?>"
                                                 loading="lazy" uk-cover>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <!--
                                <a class="uk-position-small" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                                <a class=" uk-position-small" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                                -->
                                <div class="uk-slider-container uk-margin uk-hidden@l">

                                    <div class=" uk-position-z-index">
                                        <div class="uk-flex-right uk-slidenav-container">
                                            <a class="uk-margin-small-right" href="#" uk-slideshow-item="previous">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-left; ratio:1.2;"></span>
                                            </a>
                                            <a class="" href="#" uk-slideshow-item="next">
                                            <span class="uk-icon-button"
                                                  uk-icon="icon: chevron-right; ratio:1.2;"></span>
                                            </a>
                                        </div>
                                    </div>

                            </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>




            </section>
        <section class="uk-section">
            <div class="uk-container uk-container">
                <div class="tags-search">
                    <div>
                        <p>TAG SEARCH</p>
                        <ul class="uk-margin-remove-bottom uk-subnav">
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
                                    $url = $page->parent->url([
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
        </section>
    </div>

    <section class="uk-section uk-dark uk-background-muted">
      <div class="uk-container">
          <?php
          $selector = "template=case-study, id!={$page->id} limit=3";
          $case_studies = $pages->find($selector);
          ?>
          <?php
          foreach ($case_studies as $case): ?>
              <?php $case->content->find("type=galeria_modulo, galeria.count>0");
              $content_gallery = $case->content->get("type=galeria_modulo, galeria.count>0");
              ?>
              <div class="uk-flex uk-flex-left">
                  <div class="">
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
          <!--<div class="uk-flex uk-flex-center">
              <div class="uk-width-1-3@m">
                  <a class="" href=""><?php /*= __("Ver mas") */?></a>
              </div>
          </div>-->
      </div>
    </section>
</div>


