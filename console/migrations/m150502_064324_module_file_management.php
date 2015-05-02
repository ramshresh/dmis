<?php

use yii\db\Schema;
use yii\db\Migration;

class m150502_064324_module_file_management extends Migration
{
    public function safeUp()
    {
        Yii::$app->db->createCommand('CREATE SCHEMA IF NOT EXISTS "file_management";')->execute();
        Yii::$app->db->createCommand($this->createTableTempUploadedFile())->execute();
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand('DROP SCHEMA IF EXISTS "file_management" CASCADE;')->execute();
        return true;
    }

    public function createTableTempUploadedFile(){
        $sql = <<<SQL
CREATE TABLE file_management.temp_uploaded_file
(
  id bigserial NOT NULL ,
  base_name text, -- Original file base name [ defined by yii\web\UploadedFile]
  error integer, -- An error code describing the status of this file uploading....
  extension text, -- File extension
  has_error boolean, -- Whether there is an error with the uploaded file.
  name text, -- The original name of the file being uploaded
  size integer, -- The actual size of the uploaded file in bytes
  temp_name text, -- The path of the uploaded file on the server
  type text, -- The MIME-type of the uploaded file (such as "image/gif").
  data json, -- Data submitted with the file
  file text, -- attribute to be used for file widget in Yii2
  CONSTRAINT pk_filemanagement_tempuploadedfile_id PRIMARY KEY (id)
);
SQL;
return $sql;
    }

}
