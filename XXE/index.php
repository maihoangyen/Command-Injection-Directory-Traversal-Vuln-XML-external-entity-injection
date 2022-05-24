<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        My web
    </title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Welcome my web</h1>
    <?php
    libxml_disable_entity_loader(true);
    $xmlfile = file_get_contents('user.xml');
    $dom = new DOMDocument();
    $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
    $login = simplexml_import_dom($dom);
    $username = $login->username;
    $password = $login->password;
    echo "Chao mung ban login voi ten $username"; ?>
</body>

</html>