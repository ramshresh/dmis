<?php

namespace common\modules\reporting\models;

use kartik\builder\TabularForm;
use kartik\grid\GridView;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "reporting.geometry".
 *
 * @property integer $id
 * @property integer $reportitem_id
 * @property string $geom
 * @property string $wkt
 * @property string $srid
 * @property string $type
 * @property string $bbox
 * @property double $perimeter_meter
 * @property double $area_sqmeter
 * @property double $length
 * @property double $latitude
 * @property double $longitude
 *
 * @property Reportitem $reportitem
 * @property Geocode[] $geocodes
 */
class Geometry extends \yii\db\ActiveRecord
{
    CONST SRID = 4326;

    CONST TYPE_POINT='POINT';
    CONST TYPE_LINESTRING='LINESTRING';
    CONST TYPE_POLYGON='POLYGON';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reporting.geometry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['reportitem_id'], 'integer'],
            [['geom', 'wkt', 'bbox'], 'string'],
            [['perimeter_meter', 'area_sqmeter', 'length', 'latitude', 'longitude'], 'number'],
            [['srid', 'type'], 'string', 'max' => 15],
            [['reportitem_id', 'type'], 'unique', 'targetAttribute' => ['reportitem_id', 'type'], 'message' => 'The combination of Reportitem ID and Type has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reportitem_id' => Yii::t('app', 'Reportitem ID'),
            'geom' => Yii::t('app', 'Geom'),
            'wkt' => Yii::t('app', 'Wkt'),
            'srid' => Yii::t('app', 'Srid'),
            'type' => Yii::t('app', 'Type'),
            'bbox' => Yii::t('app', 'Bbox'),
            'perimeter_meter' => Yii::t('app', 'Perimeter Meter'),
            'area_sqmeter' => Yii::t('app', 'Area Sqmeter'),
            'length' => Yii::t('app', 'Length'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportitem()
    {
        return $this->hasOne(Reportitem::className(), ['id' => 'reportitem_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeocodes()
    {
        return $this->hasMany(Geocode::className(), ['geometry_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->srid=$this::SRID;

            //{{{ saving wkt to geometry
            /**
             *
             * @reference http://postgis.net/docs/ST_GeomFromText.html
             * @todo: Investigate:: Why is parametrized expression not working for linestring but working for point
             * $this->geom=new Expression("(SELECT ST_PointFromText(:wkt, :srid))", array(':wkt' => $this->wkt, ':srid' => $this::SRID));
             * For above expression,
             * $this->wkt='POINT(-71.160281 42.258729)';//->working
             * $this->wkt='LINESTRING(-71.160281 42.258729,-71.160837 42.259113,-71.161144 42.25932)';//->not working
             * So used unparametrized expression,
             * $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this->srid."))");
             */
			
            if($this->wkt){
                $this->geom=new Expression("(SELECT ST_GeomFromText('".$this->wkt."',".$this->srid."))");
            }

            /* Hardcoded for POINT lat lon pointpicker */
             //$this->geom=new Expression("(SELECT ST_PointFromText(:point, :srid))", array(':point' => 'POINT(' . $this->longitude . ' ' . $this->latitude . ')', ':srid' => $this::SRID));

            //}}} ./saving wkt to geometry

            return true;
        } else {
            return false;
        }
    }

    /**
     * Single table inheritance
     * @github-reference https://github.com/samdark/yii2-cookbook/blob/master/book/ar-single-table-inheritance.md
     * @param array $row
     * @return Geometry|GeometryLinestring|GeometryPoint|GeometryPolygon
     */
    public static function instantiate($row)
    {
        switch ($row['type']) {
            case self::TYPE_POINT:
                return new GeometryPoint();
            case self::TYPE_LINESTRING:
                return new GeometryLinestring();
            case self::TYPE_POLYGON:
                return new GeometryPolygon();
            default:
                return new self;
        }
    }

    //{{{ Kartik gridview
    /**
     * @title Kartik gridview
     * @link http://demos.krajee.com/builder-details/tabular-form
     *
     * Follow these steps
     * _________________________________________________________________________________________
     * --------------------------
     * |STEP 1:| In Controller Define DataProvider
     * ---------------------------
        $queryGeometry = Geometry::find()->indexBy('id'); // where `id` is your primary key

        $geometryDataProvider = new ActiveDataProvider([
        'query' => $queryGeometry,
        ]);
     *__________________________________________________________________________________________
     * ---------------------------
     * STEP 2: In View Add TabularForm between Form::begin and Form:end tags
     * ---------------------------
        <?php
            echo \kartik\builder\TabularForm::widget([
                'dataProvider'=>$geometryDataProvider,
                'form'=>$form,
                'attributes'=>\common\modules\reporting\models\Geometry::getFormAttribs(),
                'gridSettings'=>[
                    'floatHeader'=>true,
                    'panel'=>[
                        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i> Manage Books</h3>',
                        'type' => \kartik\grid\GridView::TYPE_PRIMARY,
                        'after'=> Html::a('<i class="glyphicon glyphicon-plus"></i> Add New', '#', ['class'=>'btn btn-success']) . ' ' .
                        Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', '#', ['class'=>'btn btn-danger']) . ' ' .
                        Html::submitButton('<i class="glyphicon glyphicon-floppy-disk"></i> Save', ['class'=>'btn btn-primary'])
                    ]
                ]
            ]);
        ?> ______-____________________
     * @return array
     */
    public static function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'type'=>['type'=>TabularForm::INPUT_TEXT],


            /*'type'=>[
                'type'=>TabularForm::INPUT_DROPDOWN_LIST,
                //'items'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
                'items'=>['POINT','LINESTRING','POLYGON'],
                'columnOptions'=>['width'=>'185px']
            ],*/

            'wkt'=>[
                'type'=>TabularForm::INPUT_TEXT,
                'label'=>'WKT Geometry',
                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
        ];
    }
    //}}} ./Kartik gridview

    /**
     * Finds the Geometry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Geometry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Geometry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
