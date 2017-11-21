<?php

$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");

if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}

$messageType = explode('&type=',$_SERVER['REQUEST_URI']);
$photoid = explode('&photoid=',$messageType[0]);
$loggedin = explode('loggedin=',$photoid[0]);


if($messageType[1] == 'comment')
{
	$comment = pg_escape_string( $_POST['comment']);
	pg_query($db_connection, "insert into comment(comment,photo_id,member_id) values('$comment','$photoid[1]','$loggedin[1]')");
}
else if($messageType[1] == 'feedback')
{
	$feedback = pg_escape_string( $_POST['feedback']);
	pg_query($db_connection, "insert into feedback(feedback,photo_id,member_id) values('$feedback','$photoid[1]','$loggedin[1]')");
}

$getmemberid = pg_query($db_connection, "select member_id from member where member_id = (select member_id from photo where photo_id = '$photoid[1]')");
$id = pg_fetch_all($getmemberid);
$memberid = $id [0]['member_id'];

header("location:../view/leaveCommentFeedback.php?loggedin=$loggedin[1]&photoid=$photoid[1]&memberid=$memberid");

?>
