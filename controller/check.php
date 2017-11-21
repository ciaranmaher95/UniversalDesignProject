<?php 

$l = explode('&photoid=',$_SERVER['REQUEST_URI']);
$loggedin = explode('loggedin=',$l[0]);
$imageid = explode('photoid=',$_SERVER['REQUEST_URI']);
$photoid = explode('&memberid=',$imageid[1]);
$memberid = explode('memberid=',$_SERVER['REQUEST_URI']);

if($loggedin[1] == $memberid[1])
{
	header("location:../view/displayCommentFeedback.php?loggedin=$loggedin[1]&photoid=$photoid[0]&memberid=$memberid[1]");
}

else
{
	header("location:../view/leaveCommentFeedback.php?loggedin=$loggedin[1]&photoid=$photoid[0]&memberid=$memberid[1]");
}

?>