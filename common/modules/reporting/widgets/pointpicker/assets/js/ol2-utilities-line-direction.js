/**
 * Created by girc on 2/5/15.
 */


/* Openlayers Utilities **/
/**
 * APIMethod: createDirection
 * Create dirction symbol point {<openLayers.Feature.Vector>} of the line
 * with attribute as angle (degree) for given position(s) on line
 * Parameter:
 * line - {<OpenLayers.Geometry.LineString>} or {<OpenLayers.Geometry.MultiLineString>}
 * postion - {string}
 *        "start" - start of the geometry / segment
 *        "end" - end of geometry / segment
 *        "middle" - middle of geometry /segment
 * forEachSegment - {boolean}
 *    if true create points on each segments of line for given position
 * look at: http://geometricnet.sourceforge.net/examples/directions.html
 *  or  include http://geometricnet.sourceforge.net/examples/Direction.js
 */

createDirection = function (line, position, forEachSegment) {
    if (line instanceof OpenLayers.Geometry.MultiLineString) {
        //TODO
    } else if (line instanceof OpenLayers.Geometry.LineString) {
        return createLineStringDirection(line, position, forEachSegment);
    } else {
        return [];
    }
};

createLineStringDirection = function (line, position, forEachSegment) {
    if (position == undefined) {
        position = "end"
    }
    if (forEachSegment == undefined) {
        forEachSegment = false;
    }
    var points = [];
    //var allSegs = line.getSortedSegments();
    var allSegs = getSegments(line);
    var segs = [];

    if (forEachSegment) {
        segs = allSegs;
    } else {
        if (position == "start") {
            segs.push(allSegs[0]);
        } else if (position == "end") {
            segs.push(allSegs[allSegs.length - 1]);
        } else if (position == "middle") {
            return [getPointOnLine(line, .5)];
        } else {
            return [];
        }
    }
    for (var i = 0; i < segs.length; i++) {
        points = points.concat(createSegDirection(segs[i], position));
    }
    return points;
};

createSegDirection = function (seg, position) {
    var segBearing = bearing(seg);
    var positions = [];
    var points = [];
    if (position == "start") {
        positions.push([seg.x1, seg.y1]);
    } else if (position == "end") {
        positions.push([seg.x2, seg.y2]);
    } else if (position == "middle") {
        positions.push([(seg.x1 + seg.x2) / 2, (seg.y1 + seg.y2) / 2]);
    } else {
        return null;
    }
    for (var i = 0; i < positions.length; i++) {
        var pt = new OpenLayers.Geometry.Point(positions[i][0], positions[i][1]);
        var ptFeature = new OpenLayers.Feature.Vector(pt, {angle: segBearing});
        points.push(ptFeature);
    }
    return points;
};

bearing = function (seg) {
    b_x = 0;
    b_y = 1;
    a_x = seg.x2 - seg.x1;
    a_y = seg.y2 - seg.y1;
    angle_rad = Math.acos((a_x * b_x + a_y * b_y) / Math.sqrt(a_x * a_x + a_y * a_y));
    angle = 360 / (2 * Math.PI) * angle_rad;
    if (a_x < 0) {
        return 360 - angle;
    } else {
        return angle;
    }
};

getPointOnLine = function (line, measure) {
    var segs = getSegments(line);
    var lineLength = line.getLength();
    var measureLength = lineLength * measure;
    var length = 0;
    var partLength = 0;
    for (var i = 0; i < segs.length; i++) {
        var segLength = getSegmentLength(segs[i]);
        if (measureLength < length + segLength) {
            partLength = measureLength - length;
            var x = segs[i].x1 + (segs[i].x2 - segs[i].x1) * partLength / segLength;
            var y = segs[i].y1 + (segs[i].y2 - segs[i].y1) * partLength / segLength;
            var segBearing = bearing(segs[i]);
            console.log("x: " + x + ", y: " + y + ", bearing: " + segBearing);
            var pt = new OpenLayers.Geometry.Point(x, y);
            var ptFeature = new OpenLayers.Feature.Vector(pt, {angle: segBearing});
            return ptFeature;
        }
        length = length + segLength;
    }
    return false;
};

getSegmentLength = function (seg) {
    return Math.sqrt(Math.pow((seg.x2 - seg.x1), 2) + Math.pow((seg.y2 - seg.y1), 2));
};

getSegments = function (line) {
    var numSeg = line.components.length - 1;
    var segments = new Array(numSeg), point1, point2;
    for (var i = 0; i < numSeg; ++i) {
        point1 = line.components[i];
        point2 = line.components[i + 1];
        segments[i] = {
            x1: point1.x,
            y1: point1.y,
            x2: point2.x,
            y2: point2.y
        };
    }
    return segments;
};
/*  end OpenLayers Utilities */

  makeLineLonLat: function (lon1, lat1, lon2, lat2, layerName) {
            /*var ppM=this;
             var lineLayer;
             var p1 = new OpenLayers.Geometry.Point(lon1,lat1).transform(
             new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
             ppM.map.getProjectionObject()
             );
             var p2 = new OpenLayers.Geometry.Point(lon2,lat2).transform(
             new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
             ppM.map.getProjectionObject()
             );
             var lineString = new OpenLayers.Geometry.LineString([p1, p2]);
             var lineFeature=new OpenLayers.Feature.Vector(lineString);
             lineLayer = new OpenLayers.Layer.Vector(layerName,
             {
             style:{strokeColor: '#0000ff',
             strokeOpacity: 0.2,
             strokeWidth: 2,
             strokeDashstyle:'dot'
             }
             });

             lineLayer.addFeatures([lineFeature]);

             return lineLayer;*/
        },

           makeDirLayer: function (vectorLayer, layerName) {
            /* layerName = (layerName)?layerName:'direction';
             var dirLayer;
             // requires APIMethod: createDirection
             // look at: http://geometricnet.sourceforge.net/examples/directions.html
             // or  include http://geometricnet.sourceforge.net/examples/Direction.js
             /*/
            /**********************add direction layer ************************

             OpenLayers.Renderer.symbol.arrow = [0,2, 1,0, 2,2, 1,0, 0,2];
             var styleMap = new OpenLayers.StyleMap(OpenLayers.Util.applyDefaults(
             {graphicName:"arrow",rotation : "${angle}",strokeColor: '#0000ff',
                 strokeOpacity: 0.5
             },
             OpenLayers.Feature.Vector.style["default"]));
             dirLayer = new OpenLayers.Layer.Vector(layerName, {styleMap: styleMap});
             //ppM.map.addLayer(ppM.dirLayer);
             updateDirection(vectorLayer,dirLayer)
             // -----------------required Methods-----------------------
             function updateDirection(vectorLayer,dirLayer) {
            dirLayer.removeAllFeatures();
            var points=[];
            var features =vectorLayer.features;
            for (var i=0;i<features.length ;i++ )	{
                var linePoints = createDirection(features[i].geometry,get_position_value(),get_foreachseg_value()) ;
                for (var j=0;j<linePoints.length ;j++ ) {
                    linePoints[j].attributes.lineFid = features[i].fid;
                }
                points =points.concat(linePoints);
            }
            dirLayer.addFeatures(points);
        }

             function get_position_value()    {
            //for (var i=0; i < document.direction.position.length; i++)
            //   {
            //   if (document.direction.position[i].checked)
            //	  {
            //	  return document.direction.position[i].value;
            //	  }
            //  }
            return 'middle';
        }
             function get_foreachseg_value()    {
            //if (document.direction.foreachseg.checked){
            //	return true;
            //} else {
            //	return false;
            //}
            return true;
        }
             /*/
            /**********************end add direction layer ************************
             return dirLayer;*/
        },
})(jQuery, window, document, undefined);





