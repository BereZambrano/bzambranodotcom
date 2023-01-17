<?php namespace ProcessWire;

$wire->addHookAfter('SeoMaestro::renderSeoDataValue', function (HookEvent $event) {
    $group = $event->arguments(0);
    $name = $event->arguments(1);
    $value = $event->arguments(2);

    if ($group === 'meta' && $name === 'description') {
        $value = $event->sanitizer->markupToLine($value);
        $event->return = $value;
    }
});

$wire->addHookMethod("Page::getPostImage", function ($e) {
    $page = $e->object;
		$width = $e->arguments(0);
		$height = $e->arguments(1);
    if ($page->hasField('content')) {
        $galeria = $page->content->get("type=galeria_modulo");
        //bd($hero);
        if ($galeria->id) {
            $image = $galeria->galeria->first();
						if($image->ext == "gif") {
							$e->return = $image;
						}else{
							if($width && $height){
								$e->return = $image->size($width, $height);
							}elseif($width){
								$e->return = $image->width($width);
							}
						}
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

