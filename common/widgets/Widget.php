<?php

namespace app\common\widgets;


class Widget extends \yii\bootstrap\Widget
{
    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     * @since 2.0.2
     */
    protected function registerClientEvent($event,$handler)
    {
        $id = $this->options['id'];
        $this->getView()->registerJs("jQuery('#$id').on('$event', $handler);");
    }
}