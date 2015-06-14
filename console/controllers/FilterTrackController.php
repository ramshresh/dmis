<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/14/2015
 * Time: 12:48 AM
 */

namespace console\controllers;


use common\components\FilterTrackConsumer;
use yii\console\Controller;

class FilterTrackController extends Controller{
    public function actionIndex()
    {

        // The OAuth credentials you received when registering your app at Twitter
        define("TWITTER_CONSUMER_KEY", "wOZVLoFlFIJyRXL8kSO3JqYqe");
        define("TWITTER_CONSUMER_SECRET", "5mZTEQzgSnPrhWjqNLQNfADV9dMnhEQtp9kqB4hjd9kK3QAhpT");


// The OAuth data for the twitter account
        define("OAUTH_TOKEN", "2903312516-aqImwAzJ7h9X9tUHNgzIGv6AvEBow8eJWxi2iYl");
        define("OAUTH_SECRET", "SVPnZXns7638XSjeLaAibwg27tRC3ldIEdD3Qh0tPbBNq");

// Start streaming
        $sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
        $sc->setTrack(array('morning', 'goodnight', 'hello', 'the'));
        print 'consuming';
        $sc->consume();
    }
}