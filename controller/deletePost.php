<?php

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$photoID = $_POST['photoid'];

pg_query($db_connection, "delete from photo where photo_id = '$photoID';");

header('location:../view/displayPost.php');

?>