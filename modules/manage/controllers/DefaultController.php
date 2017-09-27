<?php

namespace app\modules\manage\controllers;

/**
 * Default controller for the `manage` module
 */
class DefaultController extends ManageController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
