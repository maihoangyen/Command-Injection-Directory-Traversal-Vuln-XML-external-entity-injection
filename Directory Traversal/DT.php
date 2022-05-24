<?php require_once "config.php"; ?>
<!DOCTYPE html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>
            My Web
        </title>
    </head>
    <body>
     <h1>Welcom to myweb</h1>
	<div>
		<a href="DT.php">Home</a>
        <a href="DT.php?page=dt1.php">dt1.php</a>
	</div>
<?php


if(isset($_GET['page'])){

   include $_GET['page'];

}else{
    echo "<p>Đây là trang web của tôi!!!</p>";
}

?>
    </body>

</html>

