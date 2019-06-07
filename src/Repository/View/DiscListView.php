<?php

namespace App\Repository\View;

class DiscListView extends \ArrayObject implements ShapeListView
{
    /**
     * @return array
     */
    public function toArray()
    {
        $discViews = call_user_func('get_object_vars', $this);

        foreach($discViews as &$discView) {
            /** @var DiscView $discView */
            $discView = $discView->toArray();
        }

        return $discViews;
    }
}