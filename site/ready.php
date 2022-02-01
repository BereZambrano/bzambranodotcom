<?php namespace ProcessWire;

$wire->addHookAfter('SeoMaestro::renderSeoDataValue', function (HookEvent $event) {
    $group = $event->arguments(0);
    $name = $event->arguments(1);
    $value = $event->arguments(2);

    if ($group === 'meta' && $name === 'description') {
        //bd($name);
        //bd($value);
        $value = $event->sanitizer->markupToLine($value);
        //bd($value);
        $event->return = $value;
    }
});

$wire->addHookMethod("Page::getPostImage", function ($e) {
    $page = $e->object;
    if ($page->hasField('content')) {
        $galeria = $page->content->get("type=galeria_modulo");
        //bd($hero);
        if ($galeria->id) {
            $image = $galeria->galeria->first();
            $e->return = $image;
        }
    }
});

$wire->addHookMethod("Page::getOpenGraphImage", function ($e) {
    $page = $e->object;
    //d($page);
    $seoImage = "";

    if (!$page->seo->opengraph->image) {
        if ($page->hasField('content')) {
            $galeria = $page->content->get("type=galeria_modulo");
            //bd($hero);

            if ($galeria) {
                $seoImage = $galeria->galeria->first();
                if($seoImage){
                    $seoImage->size(1200,630);
                }
            }
        }
        $page->seo->opengraph->image = $seoImage->httpUrl;
    }
});

$wire->addHookMethod('Page(template=proyecto)::getHeaderImage', function (HookEvent $event) {
    $page = $event->object;
    $header_image = null;
    //if($page->hasField('content'))
    $found = $page->content->find('type=galeria_modulo')->each(function($item){
        return $item->galeria->get('usar_encabezado=1');
    });
    if($found->count()){
        $header_image = $found->first()->galeria->get('usar_encabezado=1');
    }

    if(!$header_image){
        $header_image = $page->images->first();
    }
    $event->return = $header_image;
});

