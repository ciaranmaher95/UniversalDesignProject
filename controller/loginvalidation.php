<?php

$username = $_POST['username'];
$password = $_POST['password']; 


$db_connection = pg_connect("host=localhost dbname=camcoachdb user=Ciaran password=2525A2247wng");


if (!$db_connection) {

    die("Error in connection: " . pg_last_error());
}


$u = false;
$p = false;

$getUsers =  pg_query($db_connection, "select member_id, username,password from member;");

$result = pg_fetch_all($getUsers); 

for($i = 0; $i < sizeof($result); $i++)
{
	if($username == $result[$i]['username'])
	{
		$u = true;
		
	}
	if($password == $result[$i]['password'])
	{
		$p = true;
		$memberid = $result[$i]['member_id'];
		
		
	}
}
if($u == true && $p == true)
{
	//include 'redirect.html';
	header("location:../view/home.php?loggedin=$memberid");
}
	
else
{
	header("location:../view/signup_login.php?Username or Password is incorrect'");
}

?>