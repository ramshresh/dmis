<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/14/2015
 * Time: 1:02 AM
 */

namespace common\components;


use console\models\Twitts;
use richweber\twitter\streaming\lib\Stream;

class MyStream extends Stream {
    // This function is called automatically by the Phirehose class
    // when a new tweet is received with the JSON data in $status
    public function enqueueStatus($status)
    {
        $stream = json_decode($status);
        if (!(isset($stream->id_str))) { return; }

        $model = new Twitts();
        $model->tweet_id = $stream->id_str;
        $model->code = base64_encode(serialize($stream));
        $model->is_processed = 0;
        $model->created_at = time();
        $model->save();

        var_dump($stream);
    }
}