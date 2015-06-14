<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 6/14/2015
 * Time: 1:22 AM
 */

namespace common\components;


use richweber\twitter\streaming\lib\Stream;

class FilterTrackConsumer extends Stream{
    /**
     * Enqueue each status
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {
        print 'enqueueStatus';
        /*
         * In this simple example, we will just display to STDOUT rather than enqueue.
         * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
         *       enqueued and processed asyncronously from the collection process.
         */
        $data = json_decode($status, true);
        if (is_array($data) && isset($data['user']['screen_name'])) {
            print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
        }
    }
}