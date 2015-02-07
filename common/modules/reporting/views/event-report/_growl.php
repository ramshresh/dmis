<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/2/15
 * Time: 6:55 AM
 */
/**
 * @var $title
 * @var $type
 * @var $body
 */
use \kartik\widgets\Growl;
echo Growl::widget([
    'type' => Growl::TYPE_DANGER,
    'title' => $title,//'Oh snap!',
    'icon' => 'glyphicon glyphicon-remove-sign',
    'body' => $body,//'Change a few things up and try submitting again.',
    'showSeparator' => true,
    'delay' => 4500,
    'pluginOptions' => [
        'placement' => [
            'from' => 'top',
            'align' => 'right',
        ]
    ]
]);