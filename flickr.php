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
// Subject of email sent to you.
$subject = 'Camp form from ' . htmlspecialchars($_POST['searchTerm']);
echo $subject;
// Your email address. This is where the form information will be sent.
$emailadd = 'm@mich431.net';

// Where to redirect after form is processed.
$url = 'http://mich431.net/index.html';

// Makes all fields required. If set to '1' no field can not be empty. If set to '0' any or all fields can be empty.
$req = '0';


                    $text = "Results from form:\n\n";
                    $space = ' ';
                    $line = '
';
                    $csv = '';
                    foreach ($_POST as $key => $value){
                        $value = htmlspecialchars($value);
                        if ($req == '1'){
                            if ($value == '')
                                {echo "$key is empty";die;}
                        }
                        $j = strlen($key);
                        if ($j >= 80)
                            {echo "Name of form element $key cannot be longer than 80 characters";die;}
                        echo "<br />" .  $value;
                    }
                ?>

            </div>
        </div>
    </div>

</body>
</html>

