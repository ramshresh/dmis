<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/20/2015
 * Time: 1:45 AM
 */

namespace console\controllers;


use yii\console\Controller;

class TestController extends Controller {
    public function actionIndex() {
        echo "cron service runnning";

        echo exec('ls');


        return Controller::EXIT_CODE_NORMAL;
    }

    public function actionMail($to) {
        echo "Sending mail to " . $to;
        return Controller::EXIT_CODE_NORMAL;
    }

}