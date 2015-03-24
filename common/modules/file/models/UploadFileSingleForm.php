<?php
/**
 * Created by PhpStorm.
 * User: girc
 * Date: 2/16/15
 * Time: 3:45 AM
 */

namespace common\modules\file\models;


use yii\base\Model;

class UploadFileSingleForm extends Model{
    /**
     * @var UploadedFile file attribute
     * attribute file that will become <input type="file">
     * in the HTML form. The attribute has the validation rule
     * named file that uses FileValidator.
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png',],
        ];
    }
}