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
echo $subject;


// http://www.flickr.com/services/api/response.php.html
#
# build the API URL to call
#

$params = array(
	'api_key'	=> '90619c927f53af93c96106327c974951',
	'method'	=> 'flickr.photos.search',
	'text'	        => $searchTerm,
	'format'	=> 'php_serial',
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

echo $rsp;

$rsp_obj = unserialize($rsp);



#
# display the photo title (or an error if it failed)
#

if ($rsp_obj['stat'] == 'ok'){

	$photo_title = $rsp_obj['photo']['title']['_content'];

	echo "Title is $photo_title!";
}else{

	echo "Call failed!";
}


                ?>

            </div>
        </div>
    </div>

</body>
</html>

