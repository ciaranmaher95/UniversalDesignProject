<?php

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$memberid = explode('=',$_SERVER['REQUEST_URI']);

$file_location = $_FILES['image']['tmp_name'];
$file_data = file_get_contents($file_location);
$image = addslashes(base64_encode($file_data ));

$title = pg_escape_string($_POST['title']);
$desc = pg_escape_string($_POST['desc']);
$tags = pg_escape_string($_POST['tags']);
$location = pg_escape_string($_POST['location']);

$dt = new DateTime("now", new DateTimeZone('Europe/Dublin'));

$time = $dt->format('m/d/Y, H:i:s');
echo $time;
pg_query($db_connection, "insert into photo(imagepath,title,description,tags,location,member_id,create_time) values('$image','$title','$desc','$tags','$location','$memberid[1]','$time')");


pg_query($db_connection, "insert into photo(imagepath,title,description,tags,location,member_id) values('$image','$title','$desc','$tags','$location','$memberid[1]')");

header("location:../view/home.php?memberid=$memberid[1]");




?>