<?php
    $conn = new PDO("pgsql:dbname=test;host=localhost", "postgres", "postgres" );

if($conn){

    $sth=$conn->prepare("SELECT media_url FROM tweet GROUP BY  media_url  ORDER BY media_url");
    $dat=$sth->execute();
    $data_count=array();
    $result = $sth->fetchALL(PDO::FETCH_ASSOC);
//print_r($result);

    foreach ($result as $key => $val) {
        $hashtags[]=$val['media_url'];
    }
    $hashtags_array=array();

    for($i=0; $i<count($hashtags);$i++){
        $hash = $hashtags[$i];
        $orginal= array("{","}","\"");
        $replace =""; //i.e replacing all empty string
        $rep_hashtags = str_replace($orginal,$replace,$hash);
        $pieces = explode(",", $rep_hashtags);

        for($j=0; $j<count($pieces) ; $j++){
            array_push($hashtags_array,(String)strtolower($pieces[$j]));
        }

    }
    //	$unique_hashtags = array_keys(array_flip($hashtags_array));
    //	print_r($unique_hashtags);
  //  echo json_encode(array_keys(array_flip($hashtags_array)));
}
else{
    echo "not connected";
}




   /* if($conn){
      //  echo "connection successful";
    }

    $sth=$conn->prepare("SELECT media_url FROM tweet group by media_url");

    $dat=$sth->execute();

    $result = $sth->fetchALL(PDO::FETCH_ASSOC);

    foreach ($result as $key => $val) {
        $media_url[]=$val['media_url'];
    }
    $urls=array();
    for($i=0;$i<count($result);$i++){
        array_push($urls,$media_url[$i]);
    }
    print_r($urls[1]);*/


?>
<html>
<body>
<script>

        window.fbAsyncInit = function() {
        FB.init({
            appId      : '743111005786426',
            xfbml      : true,
            version    : 'v2.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>