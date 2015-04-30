<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/27/2015
 * Time: 2:31 PM
 */

namespace modules\rapid_assessment\models;


class UploadForm {
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'maxFiles' => 10], // <--- here!
        ];
    }
}