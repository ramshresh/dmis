<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/15/15
 * Time: 9:50 AM
 */

namespace common\modules\reporting\widgets;


use yii\base\Widget;


class MultipleGeometriesForm extends Widget{
    /**
     * @var array $clientOptions
     */
    public $clientOptions;

    /**
     * @var Geometry[] $geometries array of model Geometry
     */
    public $geometries;

    /**
     * @var \yii\widgets\ActiveForm $form
     */
    public $form;

}