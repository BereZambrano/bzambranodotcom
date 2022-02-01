<?php namespace ProcessWire; ?>
<div id="main-content" pw-append>
    <div class="uk-container uk-position-relative">
        <div class="htmx-transition-cover uk-position-z-index uk-position-cover">
            <i class="uk-position-center" uk-spinner></i>
        </div>

        <div class="uk-grid"   uk-grid>
            <div class="uk-width-4-5@m">
                <?php echo wireRenderFile('inc/proyectos-grid',
                  [
                    'projects' => $pages->find("template=proyecto, servicios={$page->name}, sort=sort")->getArray()
                  ]); ?>
            </div>
            <div class="uk-width-1-5@m">
                <h5 class="uk-text-bold uk-margin-remove">Servicios</h5>
                <ul id="services-list" hx-swap-oob="true" class="uk-nav tag-list uk-margin-large-top uk-nav-default">
                    <?php foreach ($pages->find('template=servicio') as $servicio): ?>
                        <li class="<?= $servicio == $page ? 'uk-active' : '' ?>">
                            <a hx-get="<?=$servicio->url?>"
                               hx-select="section.projects"
                               hx-push-url="true"
                               hx-target="section.projects" href="<?= $servicio->url() ?>">
                                <span class="uk-badge">
                                    <?= $servicio->title ?>
                                </span>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</div>
