<?php namespace ProcessWire;
/*bd($input->urlSegments());

if ($input->urlSegment1 && $page->template == "servicios") {
    $found = $pages->get("name=$input->urlSegment1, template=servicio");
    if ($found->id) {
        $items = $pages->find("template=proyecto, servicios=$found");
    } else {
        throw new Wire404Exception();
    }
} else {
    $items = $pages->find('template=proyecto');
}*/
if($page->template == "servicio"){
    $items = $pages->find("template=proyecto, servicios=$page");

} else{
    $items = $pages->find('template=proyecto');
}
?>

<div id="main-content" pw-append>
    <div class="uk-container uk-margin-large-top uk-margin-large uk-container-large">
        <div class="uk-grid uk-grid-small" uk-grid>
            <div class="uk-width-4-5@m">
                <h2 class="uk-hidden@m"><?= $pages->title ?></h2>
                <?php
                $slices = array_chunk($items->getArray(), 4);
                ?>
                <?php foreach ($slices as $grid): ?>
                    <div class="grid">
                        <?php foreach ($grid as $i => $item): ?>
                            <!-- <div class="uk-cover-container" uk-parallax="y:<?= ($i + 1) * -50 ?>"> -->
                            <div class="<?= ($i + 1) % 2 == 0 ? "even" : "odd"; ?> uk-cover-container">
                                <a href="<?= $item->url ?>">
                                    <img class="uk-cover" data-srcset="<?= $item->images->first()->srcset ?>"
                                         data-src="<?= $item->images->first()->url ?>" uk-cover uk-img>
                                    <div class="uk-position-cover uk-overlay uk-overlay-default ">
                                        <div class="project-name uk-position-bottom-left uk-position-small">
                                            <h4 class="uk-text-bold uk-margin-remove"><?= $item->title ?></h4>
                                            <p class="uk-margin-remove text-white uk-text"><?php echo $item->servicios->implode(', ', 'title'); ?></p>
                                        </div>
                                    </div>

                                </a>
                            </div>
                        <?php endforeach ?>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="uk-visible@m uk-width-1-5@m">

                <ul class="uk-nav uk-list-bullet uk-nav-default">
                    <?php foreach ($pages->find('template=servicio') as $servicio): ?>
                        <li class="<?= $servicio == $page ? 'uk-active' : '' ?>">
                            <a href="<?= $servicio->url() ?>">
                                <?= $servicio->title ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>

    </div>
</div>