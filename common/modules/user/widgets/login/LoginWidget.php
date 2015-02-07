<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 1/22/15
 * Time: 3:30 PM
 */

namespace common\modules\user\widgets\login;


use common\modules\user\models\forms\LoginForm;

use yii\bootstrap\Widget;

class LoginWidget extends Widget {
    const TYPE_NAVBAR_INLINE='type_navbar_inline';
    /**
     * @var $widgetTriggets Array
     * is an array of jQuery selectors such as: '#btn-login' or 'button#btn-login' OR '.btn-login' etc,
     * that should trigger this widget.
     * By triggering widget means triggering the hidden bootstrap-modal with login form
     */
    public $triggers;
    public $formType;

    public function init(){
        parent::init();

        if($this->triggers!=NULL){
            // if string then convert to array for consistency
            $this->triggers=(gettype($this->triggers)=='array')?$this->triggers:array($this->triggers);
        }
    }

    public function run(){
        $model=new LoginForm();

        switch($this->formType){
            case $this::TYPE_NAVBAR_INLINE:
                return $this->render('form-navbar-inline',['model'=>$model]);
                break;
            default:
                return $this->render('login',['model'=>$model]);
                break;

        }
        return $this->render('login',['model'=>$model]);
    }


}