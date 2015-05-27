<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150526_005204_create_function_do_cross_cursor_hstore
 * @see http://okbob.blogspot.cz/2008/08/using-cursors-for-generating-cross.html
 *

--SELECT do_cross_cursor('gender', 'FROM employees','shop',
--   'FROM employees e JOIN shops s ON s.id = e.shop_id',
--   'salary');
--FETCH ALL FROM result;

--Analogy
-- gender => item_name
-- employees => incident_impact
-- shop =>report_item_id
-- employees =>report_item_incident
-- salary => magnitude

SELECT do_cross_cursor_hstore(

-- generate list of distinct rows--
't.item_name' 					-- list column name whose distinct values will be converted to columns
,'FROM "rapid_assessment".incident_need t'      -- list table for selecting distinct values from its column
-- ./ generate list of distinct rows--

-- Join Tables --
,'t1.item_name'         -- column that will be grouped
,'report_item_id'  	-- Grouped by for sum
,'FROM "rapid_assessment".incident_need t1 JOIN "rapid_assessment".report_item_incident t2 ON t2.id = t1.report_item_id'
,'t1.magnitude'         -- Expression or column name that will be sum
-- ./ Join Tables --

-- config--
,false   -- wheter to include total column??
,true--,'hstore'   -- whether to use hstore
-- ./config --

);
FETCH ALL FROM result;

 */
class m150526_005204_create_function_do_cross_cursor_hstore extends Migration
{
    public function safeUp()
    {
        $sql = <<<SQL
CREATE OR REPLACE FUNCTION do_cross_cursor_hstore(
    distinct_name varchar,
    distinct_source varchar,
    dimx_name varchar,
    dimy_name varchar,
    dim_xy_source varchar,
    expr varchar,
    with_total boolean,
    with_hstore boolean
    )
RETURNS refcursor AS $$
DECLARE
col_list text[] := '{}';
query text;
hstore_start text;
hstore_end text;
r RECORD;
result refcursor := 'result';
BEGIN
FOR r IN EXECUTE 'SELECT DISTINCT '
  || distinct_name || '::text AS val ' || distinct_source
LOOP
col_list := array_append(col_list, 'SUM(CASE ' || dimx_name
 || ' WHEN ' || quote_literal(r.val) || ' THEN ' || expr
 || ' ELSE 0 END) AS ' || quote_ident(r.val) || '');
END LOOP;


IF with_total=true THEN
   col_list :=array_append(col_list,' SUM(' || expr || ') AS total ');
END IF;

--CASE WHEN with_total=TRUE THEN
--col_list := array_append(col_list,' SUM(' || expr || ') AS Total ');
--END;

query := 'SELECT ' || dimy_name || ', '
 || array_to_string(col_list, ',')
 --|| ', SUM(' || expr || ') AS Total '
 || dim_xy_source || ' GROUP BY ' || dimy_name;

hstore_start := 'SELECT pt.'||dimy_name||',hstore(pt.*) as attributes FROM(';
hstore_end := ' ) AS pt ';

IF with_hstore=true THEN
   query := hstore_start||query||hstore_end;
END IF;


OPEN result NO SCROLL FOR EXECUTE query;
RETURN result;
END;
$$ LANGUAGE plpgsql STRICT;

SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    public function safeDown()
    {
        $sql = <<<SQL
DROP FUNCTION do_cross_cursor_hstore(
	distinct_name varchar,
    	distinct_source varchar,
	dimx_name varchar,
	 dimy_name varchar,
   	 dim_xy_source varchar,
	expr varchar,
	with_total boolean,
	with_hstore boolean
	);
SQL;
    }
}
