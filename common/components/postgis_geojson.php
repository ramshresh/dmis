<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 3/17/2015
 * Time: 7:58 PM
 */

namespace common\components;


use yii\base\Component;
/**
 * PostGIS to GeoJSON
 * Query a PostGIS table or view and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 *
 * @param 		string		$geotable		The PostGIS layer name *REQUIRED*
 * @param 		string		$geomfield		The PostGIS geometry field *REQUIRED*
 * @param 		string		$srid			The SRID of the returned GeoJSON *OPTIONAL (If omitted, EPSG: 4326 will be used)*
 * @param 		string 		$fields 		Fields to be returned *OPTIONAL (If omitted, all fields will be returned)* NOTE- Uppercase field names should be wrapped in double quotes
 * @param 		string		$parameters		SQL WHERE clause parameters *OPTIONAL*
 * @param 		string		$orderby		SQL ORDER BY constraint *OPTIONAL*
 * @param 		string		$sort			SQL ORDER BY sort order (ASC or DESC) *OPTIONAL*
 * @param 		string		$limit			Limit number of results returned *OPTIONAL*
 * @param 		string		$offset			Offset used in conjunction with limit *OPTIONAL*
 * @return 		string					resulting geojson string
 */
class postgis_geojson extends Component{
    /**
     * @var string The PostGIS layer name
     * @required true
     */
    public $geoTable;
    /**
     * @var string The PostGIS geometry field
     * @required true
     */
    public $geomField;
    /**
     * @var string The EPSG SRID of the returned GeoJSON
     * @required false
     * @default  4326
     */
    public $srid='4326';
    /**
     * @var string Fields to be returned. NOTE- Uppercase field names should be wrapped in double quotes
     * @required false
     * @default  '*'
     */
    public $fields='*';
    /**
     * @var string SQL WHERE clause parameters
     * @required false
     * @default  $geomField  is not null
     */
    public $parameters;
    /**
     * @var string SQL ORDER BY constraint
     * @required false
     */
    public $orderBy;
    /**
     * @var string SQL ORDER BY sort order (ASC or DESC)
     * @required false
     */
    public $sort;
    /**
     * @var string Limit number of results returned
     * @required false
     */
    public $limit;
    /**
     * @var string Offset used in conjunction with limit
     * @required false
     */
    public $offset;
    /**
     * @var string resulting geojson string
     * @required false
     */
    public $output;

}