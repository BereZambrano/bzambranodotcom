<div class="uk-margin uk-container uk-container-small">
    <div>
        <h2>More case studies</h2>
    </div>

    <ul class="uk-list uk-list-divider">
        <?php foreach($pages->find("template=case-study, id!={$page->id}") as $study): ?>
            <li>
                <div class="uk-grid" uk-grid>
                    <div class="uk-width-4-5@m">
                        <div>
                            <h3><?=$study->title?></h3>
                            <p><?=$study->text_large?></p>
                        </div>
                    </div>
                    <div class="uk-width-1-5@m">
                        <img src="" loading="lazy" alt="">
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>