<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Michael's PHP test response.</title>
    <meta name="author" content="Michael Tomkins" />
    <meta name="robots" content="all" />
    <meta name="rights-standard" content="content;cc:by-nc" />
    <link type="text/css" rel="stylesheet" href="./site.css">
</head>
<body>
    <div id="outer">
        <div id="inner">
            <div id="content">
<?php

// Validate
$search_term = htmlspecialchars($_GET['searchTerm']);
$photo = intval(htmlspecialchars($_GET['photo'])) ;
$page = ceil($photo/100);


// Modified, original at http://www.flickr.com/services/api/response.php.html
#
# build the API URL to call
#

$params = array(
	'api_key'	=> '90619c927f53af93c96106327c974951',
	'method'	=> 'flickr.photos.search',
	'text'	        => $search_term,
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

$rsp = file_get_contents($url);

$rsp_obj = unserialize($rsp);
// end API code response.php.html

//Should do caching before API call.



$line="
                ";
$photo_total = intval($rsp_obj[photos][total]);
$page_num = intval($page);


$photo_top = $page_num * 100;
if ($photo_top > $photo_total){
    $photo_top = $photo_total;
    $page_next = false;
} else {
    $page_next = true;
}



$photo_base = $photo_top - 99;
if ($photo_base < 2){
    $photo_base = 1;
    $page_prev = false;
} else {
    $page_prev = true;
}

echo '                <div id="thumbnails">';
$photo_round_five = floor(($photo-$photo_base+1)/5)*5;

for ($i = 1; $i <= 5 ; $i++){
    $j = $photo_round_five + $i;
    $photo_farm = (string)$rsp_obj[photos][photo][$j][farm];
    $photo_server = (string)$rsp_obj[photos][photo][$j][server];
    $photo_id = (string)$rsp_obj[photos][photo][$j][id];
    $photo_secret = (string)$rsp_obj[photos][photo][$j][secret];
    $photo_alt = (string)$rsp_obj[photos][photo][$j][title];

    echo $line . '    <a href="http://farm' . $photo_farm . '.staticflickr.com/' . $photo_server . '/' . $photo_id . '_' . $photo_secret . '_b.jpg">' . '<img src="http://farm' . $photo_farm . '.staticflickr.com/' . $photo_server . '/' . $photo_id . '_'   . $photo_secret . '_t.jpg" alt="' . $photo_alt  . '"></a>' ;
}

echo $line . "</div>";
echo $line . '<div id="links">';

if ($page_prev == true) {
    echo $line . '    <a href="./flickr.php?searchTerm=' . $search_term . '&amp;photo=' . ($photo_base-100)  . '"> '. ($photo_base-100) . " - " . ($photo_base-1) . '</a>' ;
}

for ($i = $photo_base; $i <= $photo_top ; $i+=5 )
{
    if ($i > $photo || $photo > ($i+4)){
        echo $line . '    <a href="./flickr.php?searchTerm=' . $search_term . '&amp;photo=' . $i  . '"> '. $i . " - " . ($i+4) . '</a>' ;
    } else {
        echo $line . "    " . $i . " - " . ($i+4) ;
    }
}

if ($page_next == true) {
    echo $line . '    <a href="./flickr.php?searchTerm=' . $search_term . '&amp;photo=' . ($photo_top+1)  . '"> '. ($photo_top+1) . " - " . ($photo_top+100) . '</a>' ;
}

echo $line . "</div>";
?>

                <div id="flickrForm">
                    <form action="flickr.php" method="get">
                        Search: <input type="text" name="searchTerm" />
                        <input type="hidden" value="1" name="photo" />
                        <input type="submit" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

