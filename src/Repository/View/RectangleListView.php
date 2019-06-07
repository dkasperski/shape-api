<?php

namespace App\Repository\View;

class RectangleListView extends \ArrayObject implements ShapeListView
{
    /**
     * @return array
     */
    public function toArray()
    {
        $rectangleViews = call_user_func('get_object_vars', $this);

        foreach($rectangleViews as &$rectangleView) {
            /** @var RectangleView $rectangleView */
            $rectangleView = $rectangleView->toArray();
        }

        return $rectangleViews;
    }
}