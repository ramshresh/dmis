<?php

$conn = new PDO("pgsql:dbname=test;host=localhost", "postgres", "postgres" );

if($conn){

    $sth=$conn->prepare("SELECT media_url,tweets,date_utc::TIMESTAMP FROM tweet where media_url is not Null  ORDER BY date_utc::TIMESTAMP DESC LIMIT 30");
    $dat=$sth->execute();
    $data_count=array();
    $result = $sth->fetchALL(PDO::FETCH_ASSOC);

    foreach ($result as $key => $val) {
        $media_url[]=$val['media_url'];
        $tweets[] = $val['tweets'];
    }
    $media_url_array=array();

    for($i=0; $i<count($media_url);$i++){
        $media = $media_url[$i];
        $orginal= array("{","}","\"");
        $replace =""; //i.e replacing all empty string
        $rep_media_url = str_replace($orginal,$replace,$media);
        $pieces = explode(",", $rep_media_url);

        for($j=0; $j<count($pieces) ; $j++){
            array_push($media_url_array,array((String)$pieces[$j],$tweets[$i]));
        }

    }
    echo json_encode($media_url_array);
  // print_r(array_unique($media_url_array));
  //  print_r(array_unique($media_url_array));
}
else{
    echo "not connected";
}
?>