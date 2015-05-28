<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 5/21/2015
 * Time: 8:19 PM
 */

namespace common\modules\testtabularinput\widgets;


use yii\base\Widget;

class MultipleInput extends Widget{
public $options = ['class'=>'tabular','tag'=>'div'];
public $itemOptions = ['class'=>'table-row','tag'=>'div'];
public $itemView;// = ['class'=>'table-row','tag'=>'div'];
}