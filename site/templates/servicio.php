<?php namespace ProcessWire; ?>

<div id="main-content" pw-append>
    <div class="uk-container uk-position-relative">
        <div class="htmx-transition-cover uk-position-z-index uk-position-cover">
           
        </div>

        <div class="uk-grid" uk-grid>
            <div class="uk-width-4-5@m">

                
                <div class="uk-margin-large-top service-description uk-child-width-1-2@m uk-grid-match uk-grid" uk-grid>

                    <div class="uk-flex-column uk-flex uk-flex-between">
                        <div>
                            <h1 hx-swap-oob="true" id="service-title">
                                <?= $page->title ?>
                            </h1>
                        </div>
                        <div class="uk-flex uk-flex-bottom">
                            <div class="uk-visible@m">
                                <p class="uk-text-bold uk-margin-small">Servicios</p>
                                <div id="services-list" hx-swap-oob="true"
                                     class=" uk-grid uk-grid-small tag-list" uk-grid>
                                    <?php foreach ($pages->find('template=servicio') as $servicio): ?>
                                        <div>
                                            <a hx-get="<?= $servicio->url ?>"
                                               hx-select="section.projects"
                                               class="<?= $servicio == $page ? 'uk-active' : '' ?>"
                                               hx-push-url="true"
                                               hx-indicator="body"
                                               class="transition-link"
                                               hx-target="section.projects"
                                               href="<?= $servicio->url ?>">
                                                <span class="uk-badge">
                                                    <?= $servicio->title ?>
                                                </span>
                                            </a>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-2@m">
                        <div id="service-description-text" class="uk-text-lead" hx-swap-oob="true">
                            <?= $page->text ?>
                        </div>

                        <div id="services-list-mobile" hx-swap-oob="true"
                             class="uk-hidden@m uk-grid uk-grid-small tag-list" uk-grid>
                            <?php foreach ($pages->find('template=servicio') as $servicio): ?>
                                <div>
                                    <a hx-get="<?= $servicio->url ?>"
                                       hx-select="section.projects"
                                       class="<?= $servicio == $page ? 'uk-active' : '' ?>"
                                       hx-push-url="true"
                                       hx-indicator="body"
                                       class="transition-link"
                                       hx-target="section.projects"
                                       href="<?= $servicio->url ?>">
                                        <span class="uk-badge">
                                            <?= $servicio->title ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>

                    </div>
                </div>

                <hr class="uk-margin-large">
                <?php echo wireRenderFile('inc/proyectos-grid',
                  [
                    'projects' => $pages->find("template=proyecto, servicios={$page->name}, sort=sort")->getArray()
                  ]); ?>

            </div>
          

        </div>
    </div>
</div>
