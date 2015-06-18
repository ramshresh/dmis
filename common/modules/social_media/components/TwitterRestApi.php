<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/18/2015
 * Time: 2:36 PM
 */

namespace common\modules\social_media\components;


class TwitterRestApi
{
    const URL_STATUSES_UPDATE = 'https://api.twitter.com/1.1/statuses/update.json';
    const METHOD_STATUSES_UPDATE = 'POST';

    public function updateStatus($postFields, $settings)
    {
        $url = self::URL_STATUSES_UPDATE;
        $requestMethod = self::METHOD_STATUSES_UPDATE;
        $twitter = new TwitterAPIExchange($settings);
        return $twitter->buildOauth($url, $requestMethod)
            ->setPostfields($postFields)
            ->performRequest();
    }
}