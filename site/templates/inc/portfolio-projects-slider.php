<div class="uk-margin uk-container uk-container-small">
    <div class="uk-margin">
        <h2>Portfolio</h2>
    </div>

    <div class="uk-margin">
        <div class="uk-position-relative uk-visible-toggle" uk-slider="autoplay: true">
            <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-4@m uk-grid uk-grid-small">
                <?php foreach($pages->find("template=proyecto, id!={$page->id}") as $project): ?>
                    <?php
                    $content_gallery=$project->content->get("type=galeria_modulo, galeria.count>0");
                    $first_image = $content_gallery->galeria->first();
                    ?>
                    <li>
                        <img src="<?= $first_image->size(300, 300)->url ?>" alt="<?= $first_image->description ?>" loading="lazy">

                    </li>
                <?php endforeach ?>
            </ul>

            <a class="uk-position-center-left uk-position-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
            <a class="uk-position-center-right uk-position-small" href="#" uk-slidenav-next uk-slider-item="next"></a>

        </div>
    </div>

</div>