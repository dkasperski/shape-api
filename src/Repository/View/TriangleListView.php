<?php

namespace App\Repository\View;

class TriangleListView extends \ArrayObject implements ShapeListView
{
    /**
     * @return array
     */
    public function toArray()
    {
        $triangleViews = call_user_func('get_object_vars', $this);

        foreach($triangleViews as &$triangleView) {
            /** @var RectangleView $triangleView */
            $triangleView = $triangleView->toArray();
        }

        return $triangleViews;
    }
}