<?php namespace ProcessWire;

/** @var RepeaterMatrixPageArray $value */
foreach($value as $i => $item) {
    /** @var RepeaterMatrixPage $item */
    echo $item->render();
}

