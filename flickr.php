<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Michael's PHP test response.</title>
    <meta name="author" content="Michael Tomkins" />
    <meta name="robots" content="all" />
    <meta name="rights-standard" content="content;cc:by-nc" />
    <!-- <link rel="icon" type="image/png" href="http://mich431.net/siteimage.png">
    <link type="text/css" rel="stylesheet" href="http://mich431.net/css/site.css">
    <base href="http://www.mich431.net/"> -->
</head>
<body>
    <div id="outer">
        <div id="inner">
            <div id="content">
                <?php
// Validate todo.
$searchTerm = htmlspecialchars($_GET['searchTerm']);
echo $searchTerm . "<br />";
if (is_int( htmlspecialchars($_GET['page']))) {
    $page = htmlspecialchars($_GET['page']) ;
} else {
    $page = 1 ;
}

echo $page ;

// Modified, original at http://www.flickr.com/services/api/response.php.html
#
# build the API URL to call
#

$params = array(
	'api_key'	=> '90619c927f53af93c96106327c974951',
	'method'	=> 'flickr.photos.search',
	'text'	        => $searchTerm,
	'format'	=> 'php_serial',
	'page'          => $page,
);

$encoded_params = array();

foreach ($params as $k => $v){
	$encoded_params[] = urlencode($k).'='.urlencode($v);
}


#
# call the API and decode the response
#

$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);

//echo $url;

$rsp = file_get_contents($url);

//echo $rsp;
$rsp_obj = unserialize($rsp);


// end response.php.html
/*
if ($rsp_obj['stat'] == 'ok'){
		$photo_title = $rsp_obj[photos][photo][4][owner];
		$photoTotal = $rsp_obj[photos][total];
	echo $photo_title . " " .  $photoTotal;
}else{

	echo "Call failed!";
} 
//*/

$photo_total = intval($rsp_obj[photos][total]);
$page_total = intval($page);
$photo_top = $page_total * 100;
if ($photo_top > $photo_total){
    $photo_top = $photo_total;
}


$photo_base = $photo_top - 99;
if ($photo_base < 1){
    $photo_base = 1;
}
echo "<br />";

echo "ph tot " . $photo_total . "pg total " . $page_total . "photo_top " . $photo_top . "photo_base" . $photo_base;

echo "<br />";

for ($i = $photo_base; $i <= $photo_top ; $i+=5 )
{
    echo $i . " : " ;
}

                ?>

            </div>
        </div>
    </div>

</body>
</html>

